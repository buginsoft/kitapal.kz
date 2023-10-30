<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Slider;

class SliderController extends Controller
{
    public $lang = 'ru';

    public function __construct(Request $request)
    {
        $this->lang = $request->header('lang')?:'ru';
    }

    public function getSliderList()
    {
        $slider = Slider::whereNotNull('slider_image_'.$this->lang)->orderBy('sort_num', 'asc')->get();

        $row = array();
        foreach ($slider as $key=>$value){
            $row[$key]['slider_id'] = $value->slider_id;
            $row[$key]['slider_image'] = $value['slider_image_'.$this->lang];
            $row[$key]['sort_num'] = $value->sort_num;
            $row[$key]['slider_book_id'] = $value->slider_book_id;
        }

        $result['data'] = $row;
        $result['status'] = true;

        return $result;        
    }
}
