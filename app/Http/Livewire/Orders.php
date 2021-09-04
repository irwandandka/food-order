<?php

namespace App\Http\Livewire;

use App\Models\Order;
use Livewire\Component;

class Orders extends Component
{
    public function render()
    {
        $orders = Order::get();
        return view('livewire.orders', [
            'orders' => $orders,
        ]);
    }
}
