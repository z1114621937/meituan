<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{   protected $table = "comment";
    public $timestamps = true;
    protected $primaryKey = "comment_id";
    protected $guarded = [];

    /***
     * 提交评价
     * @param $order_id '订单id'
     * @param $message '文本'
     * @param $reason '理由'
     * @param $attitude '态度'
     * @param $envrionment '环境'
     * @param $comment '总体评价'
     * @param $iamge_url '图片'
     * @return '创建是否成功'
     */
    public static function assess($order_id,$message, $attitude, $envrionment
        ,  $comment, $iamge_url){
        $user_idAndBusiness_id = Order::getUser_idAndBusiness_id($order_id);
        try{
            $date=self::create(
                [
                    'user_id'=> $user_idAndBusiness_id[0]->user_id,
                    'business_id'=> $user_idAndBusiness_id[0]->business_id,
                    'message'=>$message,
                    'attitude'=>$attitude,
                    'envrionment'=>$envrionment,
                    'comment'=>$comment,
                    'iamge_url'=>$iamge_url
                ]
            );
            return $date;

      }catch(\Exception $e){
            logError('增加评价错误',[$e->getMessage()]);
            return null;
        }
    }
}
