<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\DataTables;

class SaleController extends Controller
{

    public function listSales()
    {

    }

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
