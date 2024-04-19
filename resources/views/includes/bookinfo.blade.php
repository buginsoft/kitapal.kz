<p class="fs-32 discount-price">
    {{$book->getPrice($type)}}₸
    @if($sale_percentage>0)
        <span class="old-price">{{$price?$price.' ₸':''}}</span>
    @endif
</p>
<p class="fs-15">
    <small class="text-grey">{{ trans('book.discount_info', ['percent' => $sale_percentage])}}</small>
</p>
@if($type=='paper')
    <p class="fs-15 text-grey">
        <a target="_blank" href="/page/6">@lang('book.delivery_info_title')</a>
    </p>
@elseif($type=='ebook')
    <b>@lang('book.ebook_warning_info')</b>
@elseif($type=='audio')
    <b>@lang('book.audio_warning_info')</b></p>
@endif

@if($type=='paper')
    @if($book->available)
        <div class="btn__box d-flex align-items-center justify-content-center">
            <button onclick="buynow('paper',{{$book->book_id}})" class="btn btn-blue" type="button">@lang('book.buy_now')</button>
            <button onclick="buy('paper',{{$book->book_id}})" class="btn btn-border-blue" type="button">
                <i class="icons ic-basket"></i>@lang('book.to_cart')</button>
            <a class="fav__box d-flex align-items-center justify-content-center" onclick="addToSelected({{$book->book_id}})">
                <i id="heart" class="@if(\Auth::user() && \App\Models\UserSelected::where([['user_id',\Auth::user()->user_id],['book_id',$book->book_id]])->first()) selected @endif fas fa-heart"></i>
            </a>
        </div>
    @else
        <h3 style="color: red"><b>@lang('book.not_available')</b></h3>
    @endif
@elseif($type=='ebook')

    @if(Auth::guest())
        @if($book->free)
            <a class="btn btn-blue" type="button" target="_blank" href="/readbook/{{$book_id}}">
                @lang('book.read')
            </a>
        @else
            <div class="d-flex">
                @if($book->subscribable)
                    <a class="btn btn-blue" type="button" href="/buy-subscription">Купить подписку</a>

                @endif
                <button onclick="buynow('ebook',{{$book_id}})" class="btn btn-blue" type="button">
                    @lang('book.buy_now')
                </button>
            </div>
            <div class="d-flex">
                <a class="btn btn-border-blue" type="button" href="/giftpage/{{$book_id}}">
                    <i class="icons ic-pod"></i>@lang('book.podarit')
                </a>
                <button onclick="buy('ebook',{{$book->book_id}})" class="btn btn-border-blue" type="button">
                    <i class="icons ic-basket"></i>@lang('book.to_cart')
                </button>
            </div>
        @endif
    @else
        @if(check_access(\Auth::user(),$book_id)['success'])
            <button class="btn btn-blue" type="button"  title="Тек мобильді қосымшада оқи аласыздар" onclick="readbook_clicked_on_browser()">
                @lang('book.read')
            </button>
            <a class="btn btn-border-blue" type="button" href="/giftpage/{{$book_id}}">
                <i class="icons ic-pod"></i>@lang('book.podarit')
            </a>
        @else
            @if($book->subscribable)
                <a class="btn btn-blue" type="button" href="/buy-subscription">Купить подписку</a>
            @endif
            <button onclick="buynow('ebook',{{$book_id}})" class="btn btn-blue" type="button">
                @lang('book.buy_now')
            </button>
            <a class="btn btn-border-blue" type="button" href="/giftpage/{{$book_id}}">
                <i class="icons ic-pod"></i>@lang('book.podarit')
            </a>
            <button onclick="buy('ebook',{{$book->book_id}})" class="btn btn-border-blue" type="button">
                <i class="icons ic-basket"></i>@lang('book.to_cart')
            </button>
        @endif
    @endif
@elseif($type=='audio')
    @if(isset($audio) && $audio)
        @lang('book.audio_bought')
    @else
        <button onclick="buynow('audio',{{$book_id}})" class="btn btn-blue" type="button">@lang('book.buy_now')</button>
        <button onclick="buy('audio',{{$book_id}})" class="btn btn-border-blue" type="button">
            <i class="icons ic-basket"></i>@lang('book.to_cart')
        </button>
    @endif
@endif
@include('includes.paymentinfo')



