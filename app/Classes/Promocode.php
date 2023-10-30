<?php namespace App\Classes;
/**
 * PHPBenelux Promo Code Generator
 *
 * @copyright PHPBenelux
 * @license Creative Commons Attribution-ShareAlike 3.0
 * @author DragonBe
 */
use App\Models\Promocodes;
use App\Models\UsedPromocode;


class Promocode
{
    /**
     * Generates promo codes
     *
     * @param int $length The length of codes you want
     */
    public function generate($length)
    {
        $chars = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789";
        $res = "";
        for ($i = 0; $i < $length; $i++) {
            $res .= $chars[mt_rand(0, strlen($chars)-1)];
        }
        return $res;

    }
    
    public function check($promocode,$order_id=null){
        $promo = Promocodes::where('code',$promocode)->first();
        if($promo){
            if($promo->status){
                if($order_id) {
                    \App\Models\CustomerOrder::find($order_id)->update(['promocode_id' => $promo->id]);
                }
                return ['success'=>'true','percentage'=>$promo->percentage ,'id'=>$promo->id];
            }
            else{
                return ['success'=>'false','error'=>'Промокод уже активирован или время промокода прошло'];
            }
        }
        else{
            return ['success'=>'false','error'=>'Такого промокода не существует'];
        }

        /*Cron na expire tekseru*/
    }
    public function used($user_id,$promocode_id){
        $promo = Promocodes::find($promocode_id);
        if($promo){
            if(!$promo->reuseable){
                $promo->update(['status'=>0]);
                UsedPromocode::create(['user_id'=>$user_id,'promocode_id'=>$promocode_id]);
            }
            else{
                $quantity =  UsedPromocode::where('promocode_id',$promocode_id)->count();
                if($quantity>=$promo->quantity){
                    $promo->update(['status'=>0]);
                }
                UsedPromocode::create(['user_id'=>$user_id,'promocode_id'=>$promocode_id]);
            }
        }
    }
}