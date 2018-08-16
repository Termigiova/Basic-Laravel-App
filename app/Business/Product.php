<?php

namespace App\Business;

use App\Detail;
use App\Sale;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class Product {

    private $user_id;
    private $product_id;
    private $shop_id;
    private $quantity;
    private $sales_id;

    public function __construct(Request $request) {
        $this->setUserId();
        $this->setProductId($request->product);
        $this->setShopId($request->shop);
        $this->setQuantity($request->quantity);
    }

    private function setUserId() {
        if (Auth::check())
            $this->user_id = Auth::user()->getAuthIdentifier();
    }

    private function setProductId($id) {
        $this->product_id = (int) $id;
    }

    private function setShopId($id) {
        $this->shop_id = (int) $id;
    }

    private function setQuantity($quantity) {
        $this->quantity = ((int) $quantity > 0) ? (int) $quantity : 0;
    }

    public function valuesAreSet() {
        return  !empty($this->user_id) &&
                !empty($this->product_id) &&
                !empty($this->shop_id) &&
                !empty($this->quantity);
    }

    public function valuesAreValid() {

    }

    private function userExists() {

    }

    private function productExists() {

    }

    private function shopExists() {

    }

    private function quantityIsCorrect() {

    }

    public function buyProduct() {
        $this->salesTransaction();
        if(isset($this->sales_id))
            $this->detailsTransaction();
    }

    private function salesTransaction() {
        $sales = new Sale();

        $sales->setDate(NOW());
        $sales->setUserId($this->user_id);
        $sales->setShopId($this->shop_id);

        $sales->save();
        $this->sales_id = $sales->id;
    }

    private function detailsTransaction() {
        $details = new Detail();
        $details->sales_id = $this->sales_id;
        $details->product_id = $this->product_id;
        $details->quantity = $this->quantity;

        $details->save();
    }

}