<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Text;

class TextController extends Controller
{
    public $lang = 'ru';

    public function __construct(Request $request)
    {
        $this->lang = $request->header('lang')?:'ru';
    }

    public function getTextList()
    {
        $text = Text::all();
        $row = array();
        foreach ($text as $key => $value) {
            $row[$key]['text_id'] = $value->text_id;
            $row[$key]['title'] = $value['title_'.$this->lang];
            $row[$key]['text'] = $value['text_'.$this->lang];
            $row[$key]['show_free_page'] = ($value->show_free_page == 1) ? true : false;
        }

        $result['data'] = $row;
        $result['status'] = true;

        return $result;
    }
}
