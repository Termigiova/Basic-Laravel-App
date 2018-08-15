<?php

namespace App\Http\Controllers;

use App\Shop;
use App\Sale;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\DataTables;

class SaleController extends Controller
{

    public function listSalesByShop() {
        $sales = Sale::query()
            ->joinWithShop()
            ->joinWithUsers()
            ->joinWithDetails()
            ->joinWithProduct()
            ->select('users.name as userName',
                'shop.name as shopName',
                'sales.date as saleDate',
                'product.name as productName',
                'product.price as productPrice',
                'details.quantity as quantity')
            ->get();

        return view('sales.list', compact('sales'));
    }


    // Functions to test DataTables library

    public function getIndex()
    {
        return view('sales.list');
    }

    public function getData()
    {
        $model = DB::table('shop')
            ->join('sales', 'sales.shop_id', '=', 'shop.id')
            ->join('users', 'sales.user_id', '=', 'users.id')
            ->select('shop.id', 'shop.name', 'sales.date', 'users.name');
        return datatables::of($model)->toJson();
    }
}
