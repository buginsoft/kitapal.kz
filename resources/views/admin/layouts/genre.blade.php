@php
    $genre = App\Models\Genre::all();
@endphp
@foreach ($genre as $item)
    @if (!empty($book))
    @php
        $book_genre = App\Models\BookGenre::where('bg_book_id', $book->book_id)->where('bg_genre_id', $item->genre_id)->first();
    @endphp
        @if(!empty($book_genre))
            <input class="form-check-input" id="item{{ $item->genre_id }}" type="checkbox" value="{{ $item->genre_id }}" name="book_genre[]" checked>
            <label for="item{{ $item->genre_id }}">{{ $item->genre_name_ru }}</label> 
        @else
            <input class="form-check-input" id="item{{ $item->genre_id }}" type="checkbox" value="{{ $item->genre_id }}" name="book_genre[]">
            <label for="item{{ $item->genre_id }}">{{ $item->genre_name_ru }}</label> 
        @endif      
    @else
        <input class="form-check-input" id="item{{ $item->genre_id }}" type="checkbox" value="{{ $item->genre_id }}" name="book_genre[]">
        <label for="item{{ $item->genre_id }}">{{ $item->genre_name_ru }}</label>    
    @endif
@endforeach