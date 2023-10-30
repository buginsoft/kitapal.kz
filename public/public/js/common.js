$('.big-slid').slick({
    dots: true,
    arrows: false
});
$('.slid-books').slick({
    slidesToShow: 6,
    slidesToScroll: 1,
    autoplay: true,
    autoplaySpeed: 3000,
    speed: 1000,
    centerMode:false,
    arrow: true,
    responsive: [
        {
            breakpoint: 991,
            settings: {
                slidesToShow: 4
            }
        },
        {
            breakpoint: 768,
            settings: {
                slidesToShow: 3
            }
        },
        {
            breakpoint: 480,
            settings: {
                slidesToShow: 2
            }
        }
    ]
});
$(document).ready(function(){
    /*$('button').click(function(e){
        var button_classes, value = +$('.counter').val();
        button_classes = $(e.currentTarget).prop('class');
        if(button_classes.indexOf('up_count') !== -1){
            value = (value) + 1;
        } else {
            value = (value) - 1;
        }
        value = value < 0 ? 0 : value;
        $('.counter').val(value);
    });*/
    $('.counter').click(function(){
        $(this).focus().select();
    });

    var screen = window.screen.width;
    var dropdownFull = document.querySelector('.dropdownFull');
    console.log(dropdownFull);
    if(screen < 768){
        dropdownFull.style.width = screen + "px";
    }
});




function saveDelPricenAddress(dtype,order_id) {
    $.ajax({
        method: "POST",
        url: "/saveDelPricenAddress",
        data: {
            'order_id':order_id,
            'city': $("#city").val(),
            'naselenny_punkt': $("#naselenny_punkt").val(),
            'street': $("#street").val(),
            'home': $("#home").val(),
            'podezd': $("#podezd").val(),
            'kvartira': $("#kvartira").val(),
            'post_index': $("#post_index").val(),
            'delivery_type': dtype,
            'delivery_price':$("#delivery_price").val()
        },
        headers: {'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')},
    }).done(function (respond) {
        if (respond.status==false) {
            $('div').removeClass('errorBox');
            if (respond.error.home) {
                $('#home_wrapper').addClass('errorBox');
            }
            if (respond.error.city) {
                $('#city_wrapper').addClass('errorBox');
            }
            if (respond.error.street) {
                $('#street_wrapper').addClass('errorBox');
            }

        }
        else {

            document.getElementById("address").style.display = "block";
            document.getElementById("address_change").style.display = "none";
            document.getElementById("cacldelprice").style.display = "none";
            document.getElementById("addressChangeButton").style.display = "block";
            document.getElementById("sbmBtn1").style.display = "block";
            document.getElementById("sbmBtn2").style.display = "block";



            document.getElementById("citytitle2").innerHTML = respond.city;
            document.getElementById("naselenny_punkt2").innerHTML = respond.naselenny_punkt;
            document.getElementById("streettitle2").innerHTML = respond.streettitle;
            document.getElementById("hometitle2").innerHTML = respond.hometitle;
            document.getElementById("podezd2").innerHTML = respond.podezd;
            document.getElementById("kvartira2").innerHTML = respond.kvartira;
            document.getElementById("post_index2").innerHTML = respond.post_index;


            if(dtype =='post'){
                if(respond.city=='Алматы')
                {
                    document.getElementById("deliveryerror").style.display = "block";
                    $('#deliveryerror').text('В Алматы доставка почтой не доступен')
                    document.getElementById("deliveryerrormobile").style.display = "block";
                    $('#deliveryerrormobile').text('В Алматы доставка почтой не доступен')
                    document.getElementById("sbmBtn1").style.display = "none";
                    document.getElementById("sbmBtn2").style.display = "none";
                }
                else{
                    document.getElementById("deliveryerror").style.display = "none";
                    document.getElementById("deliveryerrormobile").style.display = "none";
                    document.getElementById("sbmBtn1").style.display = "block";
                    document.getElementById("sbmBtn2").style.display = "block";
                }
            }

            if(dtype=='courier') {
                if (respond.city != 'Алматы') {
                    document.getElementById("deliveryerror").style.display = "block";
                    $('#deliveryerror').text('В города кроме Алматы только отправка почтой')
                    document.getElementById("deliveryerrormobile").style.display = "block";
                    $('#deliveryerrormobile').text('В города кроме Алматы только отправка почтой')
                    document.getElementById("sbmBtn1").style.display = "none";
                    document.getElementById("sbmBtn2").style.display = "none";
                } else {
                    document.getElementById("deliveryerror").style.display = "none";
                    document.getElementById("deliveryerrormobile").style.display = "none";
                    document.getElementById("sbmBtn1").style.display = "block";
                    document.getElementById("sbmBtn2").style.display = "block";
                }
            }
        }
    });
}

function getPostPrice(){
    $.ajax({
        method: "GET",
        url: "/getPostPrice",
        headers: {'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')},
    }).done(function (msq) {
        $("#price").html(msq);
        $("#delivery_price").val(msq);
    });
}

function changeAddress() {
    document.getElementById("address").style.display = "none";
    document.getElementById("address_change").style.display = "block";
    document.getElementById("cacldelprice").style.display = "block";
    document.getElementById("addressChangeButton").style.display = "none";
    document.getElementById("sbmBtn1").style.display = "none";
    document.getElementById("sbmBtn2").style.display = "none";
}

