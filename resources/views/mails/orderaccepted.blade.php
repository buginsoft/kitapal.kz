<!DOCTYPE html>
<html>
<head>
    <title>A Responsive Email Template</title>
</head>
<body>

<table width="100%" cellpadding="0" cellspacing="0" border="0" class="backgroundTable main-temp" style="background-color: #d5d5d5;">
    <tbody>
    <tr>
        <td>
            <table width="600" align="center" cellpadding="15" cellspacing="0" border="0" class="devicewidth" style="background-color: #ffffff;">
                <tbody>
                <tr>
                    <td style="padding-bottom: 10px;" align="center">
                        <a href="https://kitapal.kz"><img width="60" img src="https://kitapal.kz/img/logo/kitapal-logo-NEW-PNG.png" alt="kitapal.kz"></a>
                    </td>
                </tr>
                <tr>
                    <td align="center" style="padding-top: 30px;">
                        @if(app()->getLocale()=='kz')
                            Сәлеметсіз бе, {{$name}}!<br>
                            #{{$order_id}} – тапсырысыңыз қабылданды.<br>
                            Тапсырысыңызға рахмет!<br>
                        @else
                            Здравствуйте, {{$name}}!<br>
                            #{{$order_id}} – заказ принят.<br>
                            Спасибо за покупку!<br>
                        @endif
                    </td>
                </tr>

                <tr>
                    <td style="padding-top: 0;">
                    </td>
                </tr>
                <tr>
                    <td align="center" style="padding-bottom: 60px;">
                    </td>
                </tr>
                </tbody>
            </table>
        </td>
    </tr>
    </tbody>
</table>

</body>
</html>