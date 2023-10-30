<!DOCTYPE html>
<html>
<head>

    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Email Receipt</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <style type="text/css">
        /**
         * Google webfonts. Recommended to include the .woff version for cross-client compatibility.
         */
        @media screen {
            @font-face {
                font-family: 'Source Sans Pro';
                font-style: normal;
                font-weight: 400;
                src: local('Source Sans Pro Regular'), local('SourceSansPro-Regular'), url(https://fonts.gstatic.com/s/sourcesanspro/v10/ODelI1aHBYDBqgeIAH2zlBM0YzuT7MdOe03otPbuUS0.woff) format('woff');
            }

            @font-face {
                font-family: 'Source Sans Pro';
                font-style: normal;
                font-weight: 700;
                src: local('Source Sans Pro Bold'), local('SourceSansPro-Bold'), url(https://fonts.gstatic.com/s/sourcesanspro/v10/toadOcfmlt9b38dHJxOBGFkQc6VGVFSmCnC_l7QZG60.woff) format('woff');
            }
        }

        /**
         * Avoid browser level font resizing.
         * 1. Windows Mobile
         * 2. iOS / OSX
         */
        body,
        table,
        td,
        a {
            -ms-text-size-adjust: 100%; /* 1 */
            -webkit-text-size-adjust: 100%; /* 2 */
        }

        /**
         * Remove extra space added to tables and cells in Outlook.
         */
        table,
        td {
            mso-table-rspace: 0pt;
            mso-table-lspace: 0pt;
        }

        /**
         * Better fluid images in Internet Explorer.
         */
        img {
            -ms-interpolation-mode: bicubic;
        }

        /**
         * Remove blue links for iOS devices.
         */
        a[x-apple-data-detectors] {
            font-family: inherit !important;
            font-size: inherit !important;
            font-weight: inherit !important;
            line-height: inherit !important;
            color: inherit !important;
            text-decoration: none !important;
        }

        /**
         * Fix centering issues in Android 4.4.
         */
        div[style*="margin: 16px 0;"] {
            margin: 0 !important;
        }

        body {
            width: 100% !important;
            height: 100% !important;
            padding: 0 !important;
            margin: 0 !important;
        }

        /**
         * Collapse table borders to avoid space between cells.
         */
        table {
            border-collapse: collapse !important;
        }

        a {
            color: #1a82e2;
        }

        img {
            height: auto;
            line-height: 100%;
            text-decoration: none;
            border: 0;
            outline: none;
        }
    </style>

</head>
<body style="background-color: #8E2976;">

<!-- start preheader -->
<div class="preheader" style="display: none; max-width: 0; max-height: 0; overflow: hidden; font-size: 1px; line-height: 1px; color: #fff; opacity: 0;">
    Сәлеметсіз бе, Kesebaev Miras!  #{{$order_id}} – тапсырысыңызға төлем алдық. Сәлден соң менеджер сіздің тапсырысты қабылдап, мәлімет жібереді.
    Тапсырысыңызға рахмет! Пайдалы кітап болсын! Сабыр етіп күтеніңізге рахмет
</div>
<!-- end preheader -->

<!-- start body -->
<table border="0" cellpadding="0" cellspacing="0" width="100%">

    <!-- start logo -->
    <tr>
        <td align="center" bgcolor="#fff">
            <!--[if (gte mso 9)|(IE)]>
            <table align="center" border="0" cellpadding="0" cellspacing="0" width="600">
                <tr>
                    <td align="center" valign="top" width="600">
            <![endif]-->
            <table border="0" cellpadding="0" cellspacing="0" width="100%" style="max-width: 600px;">
                <tr>
                    <td align="center" valign="top" style="padding: 36px 24px;">
                        <a href="https://sendgrid.com" target="_blank" style="display: inline-block;">
                            <img src="https://kitapal.kz/img/logo/logo.png" alt="Logo" border="0" width="144" style="display: block; width: 144px; max-width: 150px; min-width: 48px;">
                        </a>
                    </td>
                </tr>
            </table>
            <!--[if (gte mso 9)|(IE)]>
            </td>
            </tr>
            </table>
            <![endif]-->
        </td>
    </tr>
    <!-- end logo -->

    <!-- start hero -->
    <tr>
        <td align="center" bgcolor="#fff">
            <!--[if (gte mso 9)|(IE)]>
            <table align="center" border="0" cellpadding="0" cellspacing="0" width="600">
                <tr>
                    <td align="center" valign="top" width="600">
            <![endif]-->
            <table border="0" cellpadding="0" cellspacing="0" width="100%" style="max-width: 600px;">
                <tr>
                    <td align="left" bgcolor="#ffffff" style="padding: 36px 24px 0; font-family: 'Source Sans Pro', Helvetica, Arial, sans-serif; border-top: 3px solid #d4dadf;">
                        <h1 style="margin: 0; font-size: 32px; font-weight: 700; letter-spacing: -1px; line-height: 48px;">Төлем сәтті жасалды</h1>
                    </td>
                </tr>
            </table>
            <!--[if (gte mso 9)|(IE)]>
            </td>
            </tr>
            </table>
            <![endif]-->
        </td>
    </tr>
    <!-- end hero -->

    <!-- start copy block -->
    <tr>
        <td align="center" bgcolor="#fff">
            <!--[if (gte mso 9)|(IE)]>
            <table align="center" border="0" cellpadding="0" cellspacing="0" width="600">
                <tr>
                    <td align="center" valign="top" width="600">
            <![endif]-->
            <table border="0" cellpadding="0" cellspacing="0" width="100%" style="max-width: 600px;">

                <!-- start copy -->
                <tr>
                    <td align="left" bgcolor="#ffffff" style="padding: 24px; font-family: 'Source Sans Pro', Helvetica, Arial, sans-serif; font-size: 16px; line-height: 24px;">
                        <p style="margin: 0;">
                            Сәлеметсіз бе, Kesebaev Miras!<br>
                            #{{$order_id}} – тапсырысыңызға төлем алдық.<br>
                            Сәлден соң менеджер сіздің тапсырысты қабылдап, мәлімет жібереді.<br>
                            Тапсырысыңызға рахмет! Пайдалы кітап болсын! Сабыр етіп күтеніңізге рахмет.</p>
                    </td>
                </tr>
                <!-- end copy -->

                <!-- start receipt table -->
                <tr>
                    <td align="left" bgcolor="#ffffff" style="padding: 24px; font-family: 'Source Sans Pro', Helvetica, Arial, sans-serif; font-size: 16px; line-height: 24px;">
                        <table border="0" cellpadding="0" cellspacing="0" width="100%">
                            <tr>
                                <td align="left" bgcolor="#8E2976" width="33%" style="color:#fff;padding: 12px;font-family: 'Source Sans Pro', Helvetica, Arial, sans-serif; font-size: 16px; line-height: 24px;"><strong>Order #</strong></td>
                                <td align="left" bgcolor="#8E2976" width="33%" style="color:#fff;padding: 12px;font-family: 'Source Sans Pro', Helvetica, Arial, sans-serif; font-size: 16px; line-height: 24px;"><strong></strong></td>
                                <td align="left" bgcolor="#8E2976" width="33%" style="color:#fff;padding: 12px;font-family: 'Source Sans Pro', Helvetica, Arial, sans-serif; font-size: 16px; line-height: 24px;"><strong></strong></td>
                                <td align="left" bgcolor="#8E2976" width="33%" style="color:#fff;padding: 12px;font-family: 'Source Sans Pro', Helvetica, Arial, sans-serif; font-size: 16px; line-height: 24px;"><strong>{{$order_id}}</strong></td>
                            </tr>
                            @foreach($order_items as $book)
                                <tr>
                                    <td align="left" width="80%" style="padding: 6px 12px;font-family: 'Source Sans Pro', Helvetica, Arial, sans-serif; font-size: 16px; line-height: 24px;">{{$book[0]?$book[0]:'1'}}</td>
                                    <td align="left" width="33%" style="padding: 6px 12px;font-family: 'Source Sans Pro', Helvetica, Arial, sans-serif; font-size: 16px; line-height: 24px;">{{$book[1]?$book[1].' дана':''}}</td>
                                    @if($book[2])
                                        @if($book[2]=='paper')
                                            <td align="left" width="33%" style="padding: 6px 12px;font-family: 'Source Sans Pro', Helvetica, Arial, sans-serif; font-size: 16px; line-height: 24px;">қағаз</td>
                                        @elseif($book[2]=='audio')
                                            <td align="left" width="33%" style="padding: 6px 12px;font-family: 'Source Sans Pro', Helvetica, Arial, sans-serif; font-size: 16px; line-height: 24px;">аудио</td>
                                        @elseif($book[2]=='ebook')
                                            <td align="left" width="33%" style="padding: 6px 12px;font-family: 'Source Sans Pro', Helvetica, Arial, sans-serif; font-size: 16px; line-height: 24px;">электронды</td>
                                        @endif
                                    @endif
                                    <td align="left" width="33%" style="padding: 6px 12px;font-family: 'Source Sans Pro', Helvetica, Arial, sans-serif; font-size: 16px; line-height: 24px;">{{$book[3]?$book[3].'тг':''}}</td>
                                </tr>
                            @endforeach
                            <tr>
                                <td align="left" bgcolor="#8E2976" width="33%" style="color:#fff;padding: 12px;font-family: 'Source Sans Pro', Helvetica, Arial, sans-serif; font-size: 16px; line-height: 24px;">Барлығы</td>
                                <td align="left" bgcolor="#8E2976" width="33%" style="color:#fff;padding: 12px;font-family: 'Source Sans Pro', Helvetica, Arial, sans-serif; font-size: 16px; line-height: 24px;"></td>
                                <td align="left" bgcolor="#8E2976" width="33%" style="color:#fff;padding: 12px;font-family: 'Source Sans Pro', Helvetica, Arial, sans-serif; font-size: 16px; line-height: 24px;"></td>
                                <td align="left" bgcolor="#8E2976" width="33%" style="color:#fff;padding: 12px;font-family: 'Source Sans Pro', Helvetica, Arial, sans-serif; font-size: 16px; line-height: 24px;">{{$total.' тг'}}</td>
                            </tr>
                        </table>
                    </td>
                </tr>
                <!-- end reeipt table -->

            </table>
            <!--[if (gte mso 9)|(IE)]>
            </td>
            </tr>
            </table>
            <![endif]-->
        </td>
    </tr>
    <!-- end copy block -->

    <!-- start receipt address block -->

    <!-- end receipt address block -->

    <!-- start footer -->
    <tr>
        <td align="center" bgcolor="#fff" style="padding: 24px;">
            <!--[if (gte mso 9)|(IE)]>
            <table align="center" border="0" cellpadding="0" cellspacing="0" width="600">
                <tr>
                    <td align="center" valign="top" width="600">
            <![endif]-->
            <table border="0" cellpadding="0" cellspacing="0" width="100%" style="max-width: 600px;">

                <!-- start unsubscribe -->
                <tr>
                    <td align="center" bgcolor="#8E2976" style="padding: 12px 24px; font-family: 'Source Sans Pro', Helvetica, Arial, sans-serif; font-size: 14px; line-height: 20px; color: #fff;">
                        ТОО «Самға баспасы»<br>
                        Юр. адрес: РК, г. Алматы,<br>
                        мкр. 5, дом 18, н.п. 67<br>

                        БИН 180140037919<br>
                        ИИК: KZ43722S000001356971 – KZT<br>
                        Кбе – 17<br>
                        АО «KASPI BANK»<br>
                        БИК CASPKZKA<br>
                        Директор: Махмутов А.А.<br>
                        Тел.: 8 701 071 75 66<br>
                    </td>
                </tr>
                <!-- end unsubscribe -->

            </table>
            <!--[if (gte mso 9)|(IE)]>
            </td>
            </tr>
            </table>
            <![endif]-->
        </td>
    </tr>
    <!-- end footer -->

</table>
<!-- end body -->

</body>
</html>