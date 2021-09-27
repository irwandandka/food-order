<?php

namespace App\Http\Livewire;

use App\Models\Order;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class Orders extends Component
{
    public function updateStatus($orderId)
    {
        Order::find($orderId)->update(['status' => 'Selesai']);
    }

    public function render()
    {
        $orders = Order::with('user')->get();
        return view('livewire.orders', [
            'orders' => $orders,
        ]);
    }
}
