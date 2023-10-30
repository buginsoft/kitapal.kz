@extends('layouts.main')
@section('content')
    <div class="content">
        <div class="container">
            <div class="section-row">
                <h1 class="big-title">{{$author->name}}</h1>
                <div class="row catalog">
                    @foreach($books as $item)
                        <div class="col-md-2 col-sm-3 col-xs-6">
                            <a href="/book/{{$item->book_id}}"><div class="item-books">
                                    <div class="img-book"><img src="{{$item->main_image()->path}}"></div>
                                    <p class="text-grey fs-15">
                                        @foreach($item->authors as $key=>$author)
                                            @if($key==count($item->authors)-1)
                                                {{$author->name}}
                                            @else
                                                {{$author->name}},
                                            @endif
                                        @endforeach
                                    </p>
                                    <p>{{$item->book_name}}</p>
                                </div>
                            </a>
                            @if($item->available)
                                <span onclick="buy('paper',{{$item->book_id}})" class="item-bag">+ Добавить в корзину</span>
                            @endif
                        </div>
                    @endforeach

                </div>
                <nav>
                    {{ $books->links('vendor.pagination.custom') }}
                </nav>
            </div>
        </div>
    </div>
@endsection
@push('scripts')
    <script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
    <script src="/js/jquery.toast.min.js"></script>
    <script>
        function buy(type, bookid) {
            $.ajax({
                method: "POST",
                url: "/addToBasket",
                headers: {'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')},
                data: {
                    type: type,
                    book_id: bookid,
                }
            }).done(function (msg) {
                if (msg.success == true) {

                    let count = parseInt($('#shoppingcart_count').text()) + 1;
                    $("#shoppingcart_count").html(count);
                    $.toast({
                        heading: '{{__('status.success')}}',
                        text: '{{__('book.buysuccesstext')}}',
                        bgColor: '#8E2976',
                        showHideTransition: 'slide',
                        icon: 'success',
                        position : 'bottom-left'
                    })
                }
                else {
                    Swal.fire({
                        title: '@lang('book.buyerrortitle')',
                        icon: 'info',
                        html: '@lang('book.buyerror')',
                        showCloseButton: true,
                        showCancelButton: true,
                        focusConfirm: false,
                        confirmButtonText:
                            '<i class="fa fa-thumbs-up"></i> @lang('basket.button')!',
                        confirmButtonAriaLabel: 'Thumbs up, great!',
                        cancelButtonText:
                            '<i class="fa fa-thumbs-down"></i>@lang('book.continue')',
                        cancelButtonAriaLabel: 'Thumbs down'
                    }).then((result) => {
                        if (result.value) {
                            window.location = "https://kitapal.kz/login";
                        }
                    });

                }
            });
        }
    </script>
@endpush
