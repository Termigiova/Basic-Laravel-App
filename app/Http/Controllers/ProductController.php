<?php

namespace App\Http\Controllers;

use App\Product;
use App\Shop;
use App\Business\Product as BusinessProduct;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index() {
        $products = Product::all();
        $shops = Shop::all();

        return view('products.index', compact('products', 'shops'));
    }

    public function processProduct(Request $request) {
        $productBusiness = new BusinessProduct($request);

        if($productBusiness->valuesAreSet()) {
            $productBusiness->buyProduct();
            return 'success';
        }
        else
            return "Invalid values";
    }
}
