<?php

namespace App\Models;


class Order extends BaseModel
{
    const IMAGEPATH = 'orders' ;
    protected $fillable = [
        'order_num',
        'total_price',
        'status',
        'pay_status',
        'pay_type',
        'user_id',
        'coupon_id',
        'lat',
        'lng',
        'map_desc',
    ];


    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function coupon(){
        return $this->belongsTo(Coupon::class,'coupon_id','id');
    }
    public function scopeFinish($query){
        return $query -> where('status','finished') ;
    }
    public function scopeCancel($query){
        return $query -> where('status','cancelled') ;
    }
    public function scopeCurrent($query){
        return $query -> where('status','current') ;
    }
    public function getPaidType(){
        return  $this -> pay_type  == 'cash' ?  awtTrans('كاش ')   :  awtTrans(' اون لاين ')  ;
    }

}
