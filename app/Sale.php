<?php

namespace App;

use DateTime;
use Illuminate\Database\Eloquent\Model;

class Sale extends Model
{

    public $timestamps = false;

    public function setDate($date) {
        if ($this->validateDate($date))
            $this->date = $date;
    }

    private function validateDate($date, $format = 'Y-m-d H:i:s')
    {
        $d = DateTime::createFromFormat($format, $date);
        return $d && $d->format($format) == $date;
    }

    public function setUserId($user_id) {
        $this->user_id = (int) $user_id;
    }

    public function setShopId($shop_id) {
        $this->shop_id = (int) $shop_id;
    }

    public function scopeJoinWithShop($query) {
        return $query->join('shop', 'shop.id','=','sales.shop_id');
    }

    public function scopeJoinWithUsers($query) {
        return $query->join('users', 'users.id', '=', 'sales.user_id');
    }

    public function scopeJoinWithDetails($query) {
        return $query->join('details', 'details.sales_id', '=', 'sales.id');
    }

    public function scopeJoinWithProduct($query) {
        return $query->join('product', 'details.product_id', '=', 'product.id');
    }

}
