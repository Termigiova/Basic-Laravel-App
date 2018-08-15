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

}
