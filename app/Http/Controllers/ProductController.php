<?php

namespace App\Http\Controllers;

use App\Product;
use App\Sale;
use App\Shop;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProductController extends Controller
{
    public function index() {
        $products = Product::all();
        $shops = Shop::all();

        return view('products.index', compact('products', 'shops'));
    }

    // This code will be used
    private $user_id;
    private $product_id;
    private $shop_id;
    private $quantity;
    private $sales_id;

    public function processProduct(Request $request) {
        $this->setUserId();
        $this->setProductId($request->product);
        $this->setShopId($request->shop);
        $this->setQuantity($request->quantity);

        if($this->valuesAreSet())
            $this->buyProduct();
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
        $this->quantity = (int) $quantity;
    }

    private function valuesAreSet() {
        return isset(
            $this->user_id,
            $this->product_id,
            $this->shop_id,
            $this->quantity
        );
    }

    private function buyProduct() {
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
        $details = new \App\Detail();
        $details->sales_id = $this->sales_id;
        $details->product_id = $this->product_id;
        $details->quantity = $this->quantity;

        $details->save();
    }
}
