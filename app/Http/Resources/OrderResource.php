<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\ResourceCollection;
use App\Http\Resources\OrderBookInfoResource;

class OrderResource extends ResourceCollection
{
    private $lang;
    private $result=[];
    public function __construct($resource, $lang){
        parent::__construct($resource);
        $this->resource = $resource;
        $this->lang = $lang;
    }
    public function toArray($request)
    {
        $this->collection->transform(function($order){
            $temp= [
                'order_id' => $order->order_id,
                'total' => $order->total,
                'delivery_type' => $order->delivery_type,
                'delivery_price' => $order->delivery_price,
                'is_delivered' => $order->is_delivered,
                'updated_at' => $order->updated_at->format('Y-m-d h:m'),
            ];

            foreach ($order->books as $book){
                if (!array_key_exists('books', $temp)) {
                    $temp['books']=[new OrderBookInfoResource($book,$this->lang)];
                }
                else {
                    array_push($temp['books'], new OrderBookInfoResource($book, $this->lang));
                }
            }
            array_push($this->result,$temp);
        });

        return $this->result;
    }
}