<?php

namespace App\Http\Livewire;

use App\Models\Order;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class OrderUser extends Component
{
    public $category;

    public function showOrder($category)
    {
        if($category == 'order') {
            $this->category = 'order';
        } else {
            $this->category = 'payOrder';
        }
    }

    public function payOrder($orderId)
    {
        Order::find($orderId)->update(['status' => 'Bayar']);
    }

    public function cancelOrder($orderId)
    {
        Order::find($orderId)->update(['status' => 'Dibatalkan']);
        return redirect()->route('home');
    }

    public function render()
    {
        $order = Order::where('user_id', Auth::user()->id)->where('status', '=', 'Belum Bayar')->first();
        $orders = Order::where('user_id', Auth::user()->id)->where('status', '=', 'Bayar')->get();
        return view('livewire.order-user', [
            'order' => $order,
            'orders' => $orders,
        ]);
    }
}
