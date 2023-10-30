function buy(type, bookid) {
    if(type=='ebook') {
        bookid = bookid + 'e';
    }
    else if(type=='audio'){
        bookid = bookid + 'a';
    }
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
                icon: 'success'
            })
        } else {
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
function buynow(type, bookid) {
    if(type=='ebook') {
        bookid = bookid + 'e';
    }
    else if(type=='audio'){
        bookid = bookid + 'a';
    }
    $.ajax({
        method: "POST",
        url: "/addToBasket",
        headers: {'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')},
        data: {
            type: type,
            book_id: bookid,
        }
    }).done(function (msg) {
        let count = parseInt($('#shoppingcart_count').text()) + 1;
        $("#shoppingcart_count").html(count);
        window.location.href = '/basket';
    });
}
