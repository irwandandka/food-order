<?php

namespace App\Http\Livewire;

use App\Models\Order;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class Orders extends Component
{
    public function render()
    {
        // $orders = DB::table('menu_order')->get();
        $orders = Order::with('user')->get();
        return view('livewire.orders', [
            'orders' => $orders,
        ]);
    }
}
