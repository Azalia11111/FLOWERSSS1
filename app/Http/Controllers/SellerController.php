<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use Illuminate\Support\Facades\Auth;
class SellerController extends Controller
{
    public function index()
    {
        // Получаем все заказы
        $orders = Order::all(); 
        // (если нужна фильтрация по продавцу, добавьте условие)
        
        return view('seller.dashboard', compact('orders'));
    }
}
