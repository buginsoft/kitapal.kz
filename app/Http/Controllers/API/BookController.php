<?php

namespace App\Http\Controllers\API;

use App\Models\CustomerOrder;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Auth;
use App\Models\Book;
use App\Models\Genre;
use App\Models\BookGenre;
use App\Models\Chapter;
use App\Models\UserBooks;
use App\Models\Author;
use App\Models\Feedback;
use App\Models\UserSubscription;
use App\Http\Resources\Book as BookResource;
use App\Http\Resources\CatalogResource;
use App\Http\Resources\UserBooksResource;
use App\Http\Resources\MySubscriptionsResource;
use Illuminate\Support\Facades\Validator;
use App\Http\Resources\PublisherResource;
use App\Http\Resources\SinglePublisherResource;
use App\Http\Resources\SingleAuthorResource;
use App\Http\Resources\BookShortInfoResource;
use App\Models\UserSubscriptionReading;
use App\Models\NowReadingBook;
use App\Http\Resources\AuthorResource;

use DB;
use App\Models\Publisher;
use Mockery\Matcher\Not;

class BookController extends Controller
{

    public $lang = 'ru';

    public function __construct(Request $request)
    {
        $this->lang = $request->header('lang') ?: 'ru';
    }

    public function getBookList(Request $request)
    {
        $books = Cache::remember('books', 1, function () use ($request) {
            $row = BookGenre::leftJoin('books', 'book_genres.bg_book_id', '=', 'books.book_id')
                ->orderBy('books.book_views', 'desc')
                ->groupBy('book_id')
                ->where('book_lang', 'like', '%' . $this->lang . '%')
                ->select(
                    'book_id',
                    'book_name',
                    'book_image',
                    'author',
                    'book_lang',
                    'book_collection_id',
                    'book_views'
//                            DB::raw('(select count(u.ub_book_id) from user_books u where u.ub_book_id = books.book_id) as book_views')
                );

            $request_name = "";

            if (isset($request->search) && $request->search != '') {
                $row->where('author', 'like', '%' . $request->search . '%')
                    ->orWhere('book_name', 'like', '%' . $request->search . '%');
            }

            if ($request->genre_id && $request->genre_id != 6) {
                $row->where('bg_genre_id', $request->genre_id);
                $request_name = 'genre_id';
            }

            if ($request->collection_id) {
                $row->where('book_collection_id', $request->collection_id);
                $request_name = 'collection_id';
            }

            $row = $row->paginate(10)->appends([$request_name => $request->input($request_name)]);

            return $row;
        });

        $custom = collect(['status' => true]);

        $data = $custom->merge($books);

        return $data;

    }

    public function getBookById(Request $request)
    {
        return new BookResource(Book::with(['genres', 'authors', 'feedbacks'])->whereIn('book_id', [$request->book_id])->first(), $request->lang);
    }

    public function getBookChaptersById(Request $request)
    {
        $chapters = Chapter::where('ch_book_id', $request->id)
            ->orderBy('sort_num', 'asc')
            ->select(
                'chapter_id', 'chapter_name', 'chapter_time', 'sort_num'
            )->get();

        $result['data'] = $chapters;

        return $result;
    }

    public function removeReadBook(Request $request)
    {
        $status['succses'] = false;

        if ($request->type == 'delete') {
            UserBooks::where('ub_user_id', auth('api')->user()->user_id)
                ->where('ub_book_id', $request->book_id)
                ->update(['is_read' => 0]);
            $status['succses'] = true;
        }

        return response()->json($status);
    }

    public function getUserReadBook()
    {
        $read_book['data'] = UserBooks::leftJoin('books', 'user_books.ub_book_id', '=', 'books.book_id')
            ->orderBy('user_books.updated_at', 'desc')->groupBy('book_id')
            ->where([['ub_user_id', auth('api')->user()->user_id], ['is_read', 1]])
            ->select('book_id', 'book_name', 'book_image', 'author', 'book_lang')->get();
        $read_book['status'] = true;

        return $read_book;
    }

    public function userBooks(Request $request)
    {
        $user = auth()->guard('api')->user();
        $userbooks = CustomerOrder::where('paid', 1)->where('is_gift', 0)->where('user_id', $user->user_id)->get();

        return new UserBooksResource($userbooks, $request->lang, $user->user_id);
    }

    public function leaveFeedback(Request $request)
    {
        $user = auth()->guard('api')->user();
        $validator = Validator::make($request->all(), [
            'book_id' => 'required',
            'text' => 'required|min:120',
            'rating' => 'required|integer',
        ]);
        if ($validator->fails()) {
            return [
                'error' => $validator->errors()
            ];
        }
        Feedback::create([
            'user_id' => $user->user_id,
            'book_id' => $request->book_id,
            'text' => $request->text,
            'rating' => $request->rating,
        ]);
        return ['success' => true];
    }

    public function search(Request $request)
    {

        $search_word = $request->search;

        $books = Book::where('book_name', 'like', '%' . $search_word . '%')->where('in_archive', 0)
            ->orWhereHas('authors', function (\Illuminate\Database\Eloquent\Builder $q) use ($search_word) {
                $q->where('name_kz', 'like', '%' . $search_word . '%')
                    ->orWhere('name_ru', 'like', '%' . $search_word . '%');
            })
            ->select('book_id', 'book_name', 'book_image', 'book_lang')
            ->paginate(12);

        foreach ($books as $item) {
            $item['book_image'] = $item->main_image()->path;
            $item["author"] = new AuthorResource($item->authors);
            unset($item['authors']);
        }

        return ['books' => $books];
    }


    //Получить книги каталога или книги автора
    public function getCatalogBooks(Request $request)
    {
        $genre = Genre::where('genre_id', $request->genre_id)->with('books')->first();
        if ($request->has('author_id')) {
            $genre = Author::where('id', $request->author_id)->first();
        }
        $books = $genre->books()->with(['authors', 'images'])->filterBy($request->all());
        $books = $books->paginate(8);
        return new CatalogResource($books, $request->lang);
    }

    public function filterValues(Request $request)
    {
        $publishers = \App\Models\Publisher::all();
        $publishers = new PublisherResource($publishers, $request->lang);
        return ['publishers' => $publishers, 'covers' => ['Мягкая', 'Твердая', 'Интеграл']];
    }

    public function addToSelected(Request $request)
    {
        $book = new Book;
        return $book->addToSelected(auth()->guard('api')->user()->user_id, $request->book_id);
    }

    public function getPublisher(Request $request)
    {
        $publisher = new SinglePublisherResource(Publisher::find($request->publisher_id), $request->lang);
        return ['status' => true, 'publisher' => $publisher];
    }

    public function getAuthor(Request $request)
    {
        if (!Author::find($request->author_id)) {
            return ['status' => false];
        }
        $author = new SingleAuthorResource(Author::find($request->author_id), $request->lang);
        return ['status' => true, 'author' => $author];
    }

    public function getSelected()
    {
        $user = auth()->guard('api')->user();
        return new BookShortInfoResource($user->user_id, $user->selected);
    }

    public function openedbook(Request $request)
    {
        if (UserSubscriptionReading::where([['user_id', auth()->guard('api')->user()->user_id], ['book_id', $request->book_id], ['type', $request->type]])->count() == 0) {
            UserSubscriptionReading::create([
                'user_id' => auth()->guard('api')->user()->user_id,
                'book_id' => $request->book_id,
                'type' => $request->type
            ]);
        }
        return ['status' => true];
    }

    //менин жазылымдарым полный список
    public function mySubscriptions(Request $request)
    {
        $user = auth()->guard('api')->user();
        return new MySubscriptionsResource(
            Book::where('subscribable', 1)->get(),
            $request->lang,
            $user->user_id,
            'my_subscription'
        );
    }

    protected $books_id = [];
    protected $data2 = [
        'user_book_list' => [],
        'isreading'=>[],
    ];



    public function start(Request $request)
    {
        $user = (auth()->guard('api')->user());
        if($user->subscription) {
            $user_id = (auth()->guard('api')->user()->user_id);
            $user_book_list = Book::where('subscribable', 1)->whereNotNull('ebook_path')->orWhereNotNull('audio_file')->get();
            $user_book_list->toarray();

            foreach ($user_book_list as $book) {
                $arr2 = [
                    'book_id' => $book->book_id,
                    'type' => 'ebook',
                    'book_name' => $book->book_name,
                    'images' => $book->main_image()->path,
                    'authors' => new AuthorResource($book->authors),
                    'book_collection' => $book->collection ? $book->collection->collection_name_ru : '',
                    'color' => $book->collection ? $book->collection->color : '',
                    'icon' => $book->collection ? $book->collection->icon : '',
                    'user_selected' => $book->is_selected($user_id),
                    'ebook_path' => $book->ebook_path,
                    'audio_file' => $book->audio_file

                ];
                $this->data2['user_book_list'][] = $arr2;
            }

            foreach ($user->now_reading_book()->where('finish', 0)->where('subscription', 1)->get() as $reading_book) {
                $arr3 = [
                    'type' => 'ebook',
                    'book_id' => $reading_book->book_id,
                    'book_name' => $reading_book->book_name,
                    'images' => $reading_book->main_image()->path,
                    'authors' => new AuthorResource($book->authors),
                    'book_collection' => $reading_book->collection ? $reading_book->collection->collection_name_ru : '',
                    'user_selected' => $reading_book->is_selected($user_id),
                    'color' => $reading_book->collection ? $reading_book->collection->color : '',
                    'icon' => $reading_book->collection ? $reading_book->collection->icon : '',
                    'ebook_path' => $reading_book->ebook_path,
                    'audio_file' => $reading_book->audio_file
                ];
                $this->data2['isreading'][] = $arr3;
            }
            return $this->data2;
        }
        else{
            return [];
        }
    }
}
