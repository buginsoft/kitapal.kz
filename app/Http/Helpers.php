<?php

namespace App\Http;
use App\Models\Info;
use App\Models\Page;
use Faker\Provider\DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Lang;
use Mockery\Exception;
use Auth;
use URL;
use Image;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;


class Helpers {

    public static function getTranslatedSlugRu($text)
    {
        $cyr2lat_replacements = array (
            "А" => "a","Ә" => "a", "Б" => "b","В" => "v","Г" => "g","Ғ" => "gh","Д" => "d",
            "Е" => "e","Ё" => "yo","Ж" => "zh","З" => "z","И" => "i","І" => "i",
            "Й" => "y","К" => "k","Қ" => "q","Һ" => "q","Л" => "l","М" => "m","Н" => "n","Ң" => "nh",
            "О" => "o","Ө" => "o","П" => "p","Р" => "r","С" => "s","Т" => "t",
            "У" => "u","Ұ" => "u","Ү" => "u","Ф" => "f","Х" => "kh","Ц" => "ts","Ч" => "ch",
            "Ш" => "sh","Щ" => "csh","Ъ" => "","Ы" => "y","Ь" => "",
            "Э" => "e","Ю" => "yu","Я" => "ya","?" => "",

            "а" => "a","ә" => "a","б" => "b","в" => "v","г" => "g","ғ" => "gh","д" => "d",
            "е" => "e","ё" => "yo","ж" => "dg","з" => "z","и" => "i","і" => "i",
            "й" => "y","к" => "k","қ" => "q","һ" => "q","л" => "l","м" => "m","н" => "n","ң" => "nh",
            "о" => "o","ө" => "o","п" => "p","р" => "r","с" => "s","т" => "t",
            "у" => "u","ұ" => "u","ү" => "u","ф" => "f","х" => "kh","ц" => "ts","ч" => "ch",
            "ш" => "sh","щ" => "sch","ъ" => "","ы" => "y","ь" => "",
            "э" => "e","ю" => "yu","я" => "ya",
            "(" => "", ")" => "", "," => "", "." => "", ":" => "-", "'" => "","#" => "","”" => "","“" => "",

            "-" => "-","%" => "-"," " => "-", "+" => "", "®" => "", "«" => "", "»" => "", '"' => "", "`" => "", "&" => "","/" => "-"
        );

        $str = strtr (trim($text),$cyr2lat_replacements);
        $str  = strtolower($str);
        $str  = str_replace('--',"-",$str);
        $str  = str_replace('--',"-",$str);
        $str =  substr($str, 0, 80);

        return $str;
    }

    public static function getTranslatedToLatyn($text)
    {
        $cyr2lat_replacements = array (
            "А" => "a","Ә" => "a", "Б" => "b","В" => "v","Г" => "g","Ғ" => "gh","Д" => "d",
            "Е" => "e","Ё" => "yo","Ж" => "zh","З" => "z","И" => "i","І" => "i",
            "Й" => "y","К" => "k","Қ" => "q","Һ" => "q","Л" => "l","М" => "m","Н" => "n","Ң" => "nh",
            "О" => "o","Ө" => "o","П" => "p","Р" => "r","С" => "s","Т" => "t",
            "У" => "u","Ұ" => "u","Ү" => "u","Ф" => "f","Х" => "kh","Ц" => "ts","Ч" => "ch",
            "Ш" => "sh","Щ" => "csh","Ъ" => "","Ы" => "y","Ь" => "",
            "Э" => "e","Ю" => "yu","Я" => "ya","?" => "",

            "а" => "a","ә" => "a","б" => "b","в" => "v","г" => "g","ғ" => "gh","д" => "d",
            "е" => "e","ё" => "yo","ж" => "dg","з" => "z","и" => "i","і" => "i",
            "й" => "y","к" => "k","қ" => "q","һ" => "q","л" => "l","м" => "m","н" => "n","ң" => "nh",
            "о" => "o","ө" => "o","п" => "p","р" => "r","с" => "s","т" => "t",
            "у" => "u","ұ" => "u","ү" => "u","ф" => "f","х" => "kh","ц" => "ts","ч" => "ch",
            "ш" => "sh","щ" => "sch","ъ" => "","ы" => "y","ь" => "",
            "э" => "e","ю" => "yu","я" => "ya",
            "(" => "", ")" => "", "," => "", "." => "", ":" => "-", "'" => "",

            "-" => "-","%" => "-"," " => "-", "+" => "", "®" => "", "«" => "", "»" => "", '"' => "", "`" => "", "&" => "","/" => "-"
        );

        $str = strtr (trim($text),$cyr2lat_replacements);

        return $str;
    }

    public static function getSessionLang(){
        $lang = 'ru';
        if (isset($_COOKIE['site_lang'])) {
            $lang = $_COOKIE['site_lang'];
        }
        return $lang;
    }

    public static function getIdFromUrl($url){
        $id = strstr($url,'-',true);
        return $id;
    }

    public static function getMonthName($number) {
        $lang = App::getLocale();

        if($lang == 'ru'){
            $monthAr = array(
                1 => array('Январь', 'Января'),
                2 => array('Февраль', 'Февраля'),
                3 => array('Март', 'Марта'),
                4 => array('Апрель', 'Апреля'),
                5 => array('Май', 'Мая'),
                6 => array('Июнь', 'Июня'),
                7 => array('Июль', 'Июля'),
                8 => array('Август', 'Августа'),
                9 => array('Сентябрь', 'Сентября'),
                10=> array('Октябрь', 'Октября'),
                11=> array('Ноябрь', 'Ноября'),
                12=> array('Декабрь', 'Декабря')
            );
        }
        else if($lang == 'kz'){
            $monthAr = array(
                1 => array('Қаңтар', 'Қаңтар'),
                2 => array('Ақпан', 'Ақпан'),
                3 => array('Наурыз', 'Наурыз'),
                4 => array('Сәуір', 'Сәуір'),
                5 => array('Мамыр', 'Мамыр'),
                6 => array('Маусым', 'Маусым'),
                7 => array('Шілде', 'Шілде'),
                8 => array('Тамыз', 'Тамыз'),
                9 => array('Қыркүйек', 'Қыркүйек'),
                10=> array('Қазан', 'Қазан'),
                11=> array('Қараша', 'Қараша'),
                12=> array('Желтоқсан', 'Желтоқсан')
            );
        }
        else {
            $monthAr = array(
                1 => array('January', 'January'),
                2 => array('February', 'February'),
                3 => array('March', 'March'),
                4 => array('April', 'April'),
                5 => array('May', 'May'),
                6 => array('June', 'June'),
                7 => array('July', 'July'),
                8 => array('August', 'August'),
                9 => array('September', 'September'),
                10=> array('October', 'October'),
                11=> array('November', 'November'),
                12=> array('December', 'December')
            );
        }
        if(!isset($monthAr[(int)$number][1])){
            return '';
        }
        return $monthAr[(int)$number][1];
    }

    public static function getPhoneFormat($phone){
        if(!is_numeric($phone)) return '';
        $phone = substr($phone, -10);
        $phone = '+7' .$phone;
        $phone = substr_replace($phone, '(', 2, 0);
        $phone = substr_replace($phone, ')', 6, 0);
        return $phone;
    }

    public static function getPageText($id){
        $page = Page::find($id);
        if($page == null) return '';
        return $page['page_text_'.App::getLocale()];
    }

    public static function getPageImage($id){
        $page = Page::find($id);
        if($page == null) return '';

        return $page->page_image;
    }

    public static function getPageUrl($id){
        $page = Page::find($id);
        if($page == null) return '';
        return $page['page_url'];
    }

    public static function getPageName($id){
        $page = Page::find($id);
        if($page == null) return '';
        return $page['page_name_'.App::getLocale()];
    }

    public static function getAudioTime($minute){
        if($minute == 0) return '';
        $minutes = (int) ($minute / 60);

        if($minutes > 0)
            return $minutes.' мин';
        else {
            $seconds = (int) ($minute % 60);
            return $seconds.' сек';
        }
    }

    public static function getMoneyRates(){
        $money_rate = null;

        try {
            $url = "http://www.nationalbank.kz/rss/rates_all.xml";
            $dataObj = simplexml_load_file($url);
            $json = json_encode($dataObj);
            $array = json_decode($json,TRUE);

            $money_rate = array();
            if ($dataObj){
                foreach ($array['channel']['item'] as $item){
                    if($item['title'] == 'USD'){
                        $money_rate[0]['title'] = $item['title'];
                        $money_rate[0]['description'] = $item['description'];
                    }
                    else if($item['title'] == 'EUR'){
                        $money_rate[1]['title'] = $item['title'];
                        $money_rate[1]['description'] = $item['description'];
                    }
                    else if($item['title'] == 'RUB'){
                        $money_rate[2]['title'] = $item['title'];
                        $money_rate[2]['description'] = $item['description'];
                    }
                    else if($item['title'] == 'CNY'){
                        $money_rate[3]['title'] = $item['title'];
                        $money_rate[3]['description'] = $item['description'];
                    }
                }
            }
        }
        catch(Exception $e){

        }

        return $money_rate;
    }

    public static function setSessionLang($lang,$request){
        $locale = $request->segment(1);
        $lang_list = ['ru','kk','en'];
        $url_path = $request->fullUrl();
        if (in_array($locale, $lang_list))
        {
            $url_path = str_replace(URL('/').'/'.$locale,URL('/'),$url_path);
        }
        $lang = str_replace(URL('/'),URL('/').'/'.$lang,$url_path);
        return $lang;
    }

    public static function getDateFormat($date_param){
        $current = strtotime(date("Y-m-d"));
        $date    = strtotime($date_param);
        $datediff = $date - $current;
        $difference = floor($datediff/(60*60*24));

        $timestamp = strtotime($date_param);
        $time_format = date("H:i", $timestamp);
        $date_format = date("d.m.Y", $timestamp);

        $month = date("m", $timestamp);
        $day = date("d", $timestamp);
        $year = date("Y", $timestamp);
        return $day .' '.Helpers::getMonthName($month).', '.$year;
    }


    public static function getDateFormatMobile($date_param){
        $current = strtotime(date("Y-m-d"));
        $date    = strtotime($date_param);
        $datediff = $date - $current;
        $difference = floor($datediff/(60*60*24));

        $timestamp = strtotime($date_param);
        $time_format = date("H:i", $timestamp);
        $date_format = date("d.m.Y", $timestamp);

        if($difference==0)
            return $time_format;
        else if($difference < -1){
            return $date_format;
        }
        else
            return $date_format;
    }

    public static function getDateFormat3($date_param){
        $current = strtotime(date("Y-m-d"));
        $date    = strtotime($date_param);
        $datediff = $date - $current;
        $difference = floor($datediff/(60*60*24));

        $timestamp = strtotime($date_param);
        $time_format = date("H:i", $timestamp);
        $date_format = date("d.m.Y", $timestamp);


        $month = date("m", $timestamp);
        $day = date("d", $timestamp);
        $year = date("Y", $timestamp);
        return $day .' '.Helpers::getMonthName($month);


    }

    public static function getInfoText($id){
        $locale = App::getLocale();

        $page = Cache::remember('info_'.$id.'_'.$locale, 1440, function () use ($locale,$id) {
            return Info::where('info_id',$id)->select('info_text_'.$locale)->first();
        });

        if($page == null) return '';
        return $page['info_text_'.$locale];
    }

    public static function getDateFormat2($date_param){
        $current = strtotime(date("Y-m-d"));
        $date    = strtotime($date_param);
        $datediff = $date - $current;
        $difference = floor($datediff/(60*60*24));

        $timestamp = strtotime($date_param);
        $time_format = date("H:i", $timestamp);

        if($difference==0)
            return $time_format;
        else {
            $month = date("m", $timestamp);
            $day = date("d", $timestamp);
            $year = date("Y", $timestamp);
            if($year == date('Y')) $year = '';
            else { $year = ', '.$year;}
            return $day .' '.Helpers::getMonthName($month).$year;
        }
    }

    public static function convertStrFormat($lang,$str){
        if($lang == 'latyn'){
            return Helpers::convertoToLatyn($str);
        }
        elseif($lang == 'tote'){
            return Helpers::convertoToTote($str);
        }
        return $str;
    }

    public static function convertoToLatyn($str) {
        $str = str_replace("а" ,"a", $str);
        $str = str_replace("ә" ,"á", $str);
        $str = str_replace("б" ,"b", $str);
        $str = str_replace("в" ,"v", $str);
        $str = str_replace("г" ,"g", $str);
        $str = str_replace("ғ" ,"ǵ", $str);
        $str = str_replace("д" ,"d", $str);
        $str = str_replace("е" ,"e", $str);
        $str = str_replace("ж" ,"j", $str);
        $str = str_replace("з" ,"z", $str);
        $str = str_replace("и" ,"ı", $str);
        $str = str_replace("й" ,"ı", $str);
        $str = str_replace("к" ,"k", $str);
        $str = str_replace("қ" ,"q", $str);
        $str = str_replace("л" ,"l", $str);
        $str = str_replace("м" ,"m", $str);
        $str = str_replace("н" ,"n", $str);
        $str = str_replace("ң" ,"ń", $str);
        $str = str_replace("о" ,"o", $str);
        $str = str_replace("ө" ,"ó", $str);
        $str = str_replace("п" ,"p", $str);
        $str = str_replace("р" ,"r", $str);
        $str = str_replace("с" ,"s", $str);
        $str = str_replace("т" ,"t", $str);
        $str = str_replace("у" ,"ý", $str);
        $str = str_replace("ұ" ,"u", $str);
        $str = str_replace("ү" ,"ú", $str);
        $str = str_replace("ф" ,"f", $str);
        $str = str_replace("х" ,"h", $str);
        $str = str_replace("һ" ,"h", $str);
        $str = str_replace("ц" ,"s", $str);
        $str = str_replace("ч" ,"ch", $str);
        $str = str_replace("ш" ,"sh", $str);
        $str = str_replace("щ" ,"sh", $str);
        $str = str_replace("ы" ,"y", $str);
        $str = str_replace("і" ,"i", $str);
        $str = str_replace("э" ,"e", $str);
        $str = str_replace("ъ" ,"", $str);
        $str = str_replace("ь" ,"", $str);
        $str = str_replace("ю" ,"ıý", $str);
        $str = str_replace("я" ,"ıa", $str);
        $str = str_replace("ё" ,"ıo", $str);
        $str = str_replace("А" ,"A", $str);
        $str = str_replace("Ә" ,"Á", $str);
        $str = str_replace("Б" ,"B", $str);
        $str = str_replace("В" ,"V", $str);
        $str = str_replace("Г" ,"G", $str);
        $str = str_replace("Ғ" ,"Ǵ", $str);
        $str = str_replace("Д" ,"D", $str);
        $str = str_replace("Е" ,"E", $str);
        $str = str_replace("Ж" ,"J", $str);
        $str = str_replace("З" ,"Z", $str);
        $str = str_replace("И" ,"I", $str);
        $str = str_replace("Й" ,"I", $str);
        $str = str_replace("К" ,"K", $str);
        $str = str_replace("Қ" ,"Q", $str);
        $str = str_replace("Л" ,"L", $str);
        $str = str_replace("М" ,"M", $str);
        $str = str_replace("Н" ,"N", $str);
        $str = str_replace("Ң" ,"Ń", $str);
        $str = str_replace("О" ,"O", $str);
        $str = str_replace("Ө" ,"О́", $str);
        $str = str_replace("П" ,"P", $str);
        $str = str_replace("Р" ,"R", $str);
        $str = str_replace("С" ,"S", $str);
        $str = str_replace("Т" ,"T", $str);
        $str = str_replace("У" ,"Ý", $str);
        $str = str_replace("Ұ" ,"U", $str);
        $str = str_replace("Ү" ,"Ú", $str);
        $str = str_replace("Ф" ,"F", $str);
        $str = str_replace("Х" ,"H", $str);
        $str = str_replace("Һ" ,"H", $str);
        $str = str_replace("Ц" ,"S", $str);
        $str = str_replace("Ч" ,"Ch", $str);
        $str = str_replace("Ш" ,"Sh", $str);
        $str = str_replace("Щ" ,"Sh", $str);
        $str = str_replace("Ы" ,"Y", $str);
        $str = str_replace("І" ,"I", $str);
        $str = str_replace("Э" ,"E", $str);
        $str = str_replace("Ъ" ,"", $str);
        $str = str_replace("Ь" ,"", $str);
        $str = str_replace("Ю" ,"Iý", $str);
        $str = str_replace("Я" ,"Iа", $str);
        $str = str_replace("Ё" ,"Io", $str);
        return $str;
    }

    public static function convertoToTote($str) {
        $str = mb_strtolower($str);
        $str = str_replace("ия" ,"يا", $str);
        $str = str_replace("йя" ,"ييا", $str);
        $str = str_replace("ию" ,"يۋ", $str);
        $str = str_replace("йю" ,"يۋ", $str);
        $str = str_replace("сц" ,"س", $str);
        $str = str_replace("тч" ,"چ", $str);
        $str = str_replace("ий" ,"ي", $str);
        $str = str_replace("я" ,"يا", $str);
        $str = str_replace("ю" ,"يۋ", $str);
        $str = str_replace("щ" ,"شش", $str);
        $str = str_replace("э" ,"ە", $str);
        $str = str_replace("а","ا", $str);
        $str = str_replace("б","ب", $str);
        $str = str_replace("ц","س", $str);
        $str = str_replace("д","د", $str);
        $str = str_replace("е","ە", $str);
        $str = str_replace("ф","ف", $str);
        $str = str_replace("г","گ", $str);
        $str = str_replace("х","ح", $str);
        $str = str_replace("һ","ھ", $str);
        $str = str_replace("і","ءى", $str);
        $str = str_replace("й","ي", $str);
        $str = str_replace("и","ي", $str);
        $str = str_replace("к","ك", $str);
        $str = str_replace("л","ل", $str);
        $str = str_replace("м","م", $str);
        $str = str_replace("н","ن", $str);
        $str = str_replace("о","و", $str);
        $str = str_replace("п","پ", $str);
        $str = str_replace("қ","ق", $str);
        $str = str_replace("р","ر", $str);
        $str = str_replace("с","س", $str);
        $str = str_replace("т","ت", $str);
        $str = str_replace("ұ","ۇ", $str);
        $str = str_replace("в","ۆ", $str);
        $str = str_replace("у","ۋ", $str);
        $str = str_replace("ы","ى", $str);
        $str = str_replace("з","ز", $str);
        $str = str_replace("ә","ءا", $str);
        $str = str_replace("ө","ءو", $str);
        $str = str_replace("ү","ءۇ", $str);
        $str = str_replace("ч","چ", $str);
        $str = str_replace("ғ","ع", $str);
        $str = str_replace("ш","ش", $str);
        $str = str_replace("ж","ج", $str);
        $str = str_replace("ң","ڭ", $str);
        $str = str_replace("ь","", $str);
        $str = str_replace("Ь","", $str);
        $str = str_replace("ъ","", $str);
        $str = str_replace("Ъ","", $str);
        $str = str_replace(",","،", $str);
         $str = str_replace("?","؟", $str);
        $str = str_replace(";","؛", $str);

        $word_list = explode(" ", $str);

        foreach($word_list as $key => $words){

            if (strpos($words, 'ء') !== false) {
                $words = str_replace("ء","", $words);

                if (!(strpos($words, 'ك') !== false || strpos($words, 'گ') !== false  || strpos($words, 'ە') !== false ))
                {
                    $words = "ء" . $words;
                }
            }

            $word_list[$key] = $words;
        }


        $str = implode(" ", $word_list);

        return $str;
    }

    public static function getTranslatedImage($text)
    {
        $cyr2lat_replacements = array (
            "А" => "a","Ә" => "a", "Б" => "b","В" => "v","Г" => "g","Ғ" => "gh","Д" => "d",
            "Е" => "e","Ё" => "yo","Ж" => "zh","З" => "z","И" => "i","І" => "i",
            "Й" => "y","К" => "k","Қ" => "q","Һ" => "q","Л" => "l","М" => "m","Н" => "n","Ң" => "nh",
            "О" => "o","Ө" => "o","П" => "p","Р" => "r","С" => "s","Т" => "t",
            "У" => "u","Ұ" => "u","Ү" => "u","Ф" => "f","Х" => "kh","Ц" => "ts","Ч" => "ch",
            "Ш" => "sh","Щ" => "csh","Ъ" => "","Ы" => "y","Ь" => "",
            "Э" => "e","Ю" => "yu","Я" => "ya","?" => "",

            "а" => "a","ә" => "a","б" => "b","в" => "v","г" => "g","ғ" => "gh","д" => "d",
            "е" => "e","ё" => "yo","ж" => "dg","з" => "z","и" => "i","і" => "i",
            "й" => "y","к" => "k","қ" => "q","һ" => "q","л" => "l","м" => "m","н" => "n","ң" => "nh",
            "о" => "o","ө" => "o","п" => "p","р" => "r","с" => "s","т" => "t",
            "у" => "u","ұ" => "u","ү" => "u","ф" => "f","х" => "kh","ц" => "ts","ч" => "ch",
            "ш" => "sh","щ" => "sch","ъ" => "","ы" => "y","ь" => "",
            "э" => "e","ю" => "yu","я" => "ya",
            "(" => "", ")" => "", "," => "", ":" => "-", "'" => "",

            "-" => "-","%" => "-"," " => "-", "+" => "", "®" => "", "«" => "", "»" => "", '"' => "", "`" => "", "&" => "","/" => "-"
        );

        $str = strtr (trim($text),$cyr2lat_replacements);
        $str  = strtolower($str);
        $str  = str_replace('--',"-",$str);
        $str  = str_replace('--',"-",$str);
        $str =  substr($str, 0, 80);

        return $str;
    }

    public static function sendSMSKcell($phone,$message)
    {
        $login = 'qamshy_rest';
        $password = 'y7Gf109afvK1f';

        $data['client_message_id'] = 777888;
        $data['sender'] = "Qamshy.kz";
        $data['recipient'] = $phone;
        $data['message_text'] = $message;
        $data['time_bounds'] = 'full';

        $json = json_encode($data);

        $c = curl_init();
        curl_setopt($c, CURLOPT_URL,"https://api.kcell.kz/app/smsgw/rest/v2/messages");
        curl_setopt($c, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($c, CURLOPT_SSL_VERIFYHOST, false);
        curl_setopt($c, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($c, CURLOPT_POSTFIELDS, $json);
        curl_setopt($c, CURLOPT_HTTPHEADER,
            array(
                'Content-Type: application/json',
                'Authorization: Basic '.base64_encode($login.":".$password)
            ));
        $res = curl_exec($c);
        dd($res);

        $data = json_decode($res, TRUE);

        return $data;
    }


    public static function getRubricByURl(){
        $rubric_id = 0;

        if(URL('/') == 'http://mediakit.qamshy.kz' || URL('/') == 'https://mediakit.qamshy.kz'){
            $rubric_id = 1;
        }
        elseif(URL('/') == 'http://ozger-is.qamshy.kz' || URL('/') == 'https://ozger-is.qamshy.kz'){
            $rubric_id = 2;
        }

        return $rubric_id;
    }

    public static function getWeather($region_id){
        $whether = null;

        try {
            $url = "https://export.yandex.ru/bar/reginfo.xml?region=".$region_id;

            $context = [
                "ssl"=>[
                    "verify_peer"=>false,
                    "verify_peer_name"=>false,
                ]
            ];

            libxml_set_streams_context(stream_context_create($context));
            $dataObj = simplexml_load_file($url);
            $json = json_encode($dataObj);
            $array = json_decode($json,TRUE);

            if(isset($array['weather']['day']['day_part'][0])){
                if(isset($array['weather']['day']['day_part'][0]['temperature_to']))
                $whether['temperature'] = $array['weather']['day']['day_part'][0]['temperature_to'];
                elseif(isset($array['weather']['day']['day_part'][0]['temperature']))
                $whether['temperature'] = $array['weather']['day']['day_part'][0]['temperature'];
                if(isset($array['weather']['day']['day_part'][0]['image-v2']))
                $whether['image'] = $array['weather']['day']['day_part'][0]['image-v2'];
            }
        }
        catch(Exception $e){

        }

        return $whether;
    }

    public static function storeImg($name, $disk_name, $request)
    {
        $image = $request->file($name);
        $image_name = $image->getClientOriginalName();
        $extension = $image->getClientOriginalExtension();
        $destinationPath = $request->disk . '/' . date('Y') . '/' . date('m') . '/' . date('d');
        $image_name = $destinationPath . '/' . $image_name;

        if (Storage::disk($disk_name)->exists($image_name)) {
            $now = \DateTime::createFromFormat('U.u', microtime(true));
            $image_name = $destinationPath . '/' . $now->format("Hisu") . '.' . $extension;
        }

        Storage::disk($disk_name)->put($image_name, File::get($image));

        if ($disk_name == 'avatar') {
            $result = '/media_avatar' .$image_name;
        }else{
            $result = '/media' .$image_name;
        }
        return $result;
    }

    public static function newStoreImg($image, $disk_name, $request)
    {
        $image_name = $image->getClientOriginalName();
        $extension = $image->getClientOriginalExtension();
        $destinationPath = $request->disk . '/' . date('Y') . '/' . date('m') . '/' . date('d');
        $image_name = $destinationPath . '/' . $image_name;

        if (Storage::disk($disk_name)->exists($image_name)) {
            $now = \DateTime::createFromFormat('U.u', microtime(true));
            $image_name = $destinationPath . '/' . $now->format("Hisu") . '.' . $extension;
        }

        Storage::disk($disk_name)->put($image_name, File::get($image));

        if ($disk_name == 'avatar') {
            $result = '/media_avatar' .$image_name;
        }else{
            $result = '/media' .$image_name;
        }
        return $result;
    }
    public static function storeThumbnail($path, $height,$width)
    {
        $path   =  storage_path().'/app/image/'.substr($path,7);
        $resize = Image::make($path)->fit($width,$height)->encode('png');
        $hash = md5($resize->__toString());
        $path = "{$hash}.png";
        $resize->save(storage_path('app/thumbnail/'.$path));
        $result = '/thumbnail/' .$path;

        return $result;
    }


    public static function storeFromUrl($image, $disk_name)
    {
        $image = file_get_contents($image);
        $now = \DateTime::createFromFormat('U.u', microtime(true));
        $image_name = $now->format("Hisu") . '.png';
        file_put_contents(storage_path('app/avatar/'.$image_name), $image);

        return ($disk_name == 'avatar')?'/media_avatar/' .$image_name:'/media' .$image_name;
    }

    public static function savetags($array){
        $tags2=[];
        foreach (json_decode($array) as $item){
            array_push($tags2,$item->value);
        }

        return $tags2;
    }
    public static function storeImgThumb($name, $disk_name, $request,$width,$height)
    {
        $path   = $request->file($name);
        $resize = Image::make($path)->fit($width,$height)->encode('jpg');
        $hash = md5($resize->__toString());
        $path = "{$hash}.jpg";
        $resize->save(storage_path('app/image/'.$path));

        if ($disk_name == 'avatar') {
            $result = '/media_avatar/' .$path;
        } else {
            $result = '/media/' .$path;
        }
        return $result;
    }

    public static function sendMail($subject,$to_name,$to_email,$mailpath,$order_id,$parameters){

            \Mail::send($mailpath, $parameters,
                function ($message) use ($to_name, $to_email,$subject)  {
                    $message->to($to_email, $to_name)
                        ->subject($subject);
                    $message->from('kitapall18@gmail.com', 'kitapall');
                });
     
    }
    public static  function is_have_token($headers){
        if(isset($headers['authorization'])) {
            return JWTAuth::parseToken()->authenticate();
        }
        else{
            return false;
        }
    }

}
