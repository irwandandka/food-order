<?php

namespace App\Http\Livewire;

use App\Models\{Menu, Order, Payment};
use Livewire\{Component, WithPagination};
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;

class HomeMenu extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';

    public $address;
    public $btnOrder = 'disabled';
    public $cash;
    public $cashType;
    public $countItem = 0;
    public $class = 'd-none';
    public $dataItem = [];
    public $message = [];
    public $messageClass = 'd-none';
    public $summaryClass = 'd-block';
    public $paymentId;
    public $showModal = false;
    public $showAddress = 'd-none';
    public $totalPrice;
    public $userId; 

    public function mount()
    {
        $carts = \Cart::session(auth()->user()->id)->getContent();
        $total = 0;
        foreach($carts as $cart) {
            $total += $cart['quantity'];
        }
        $this->countItem = $total;
    }

    protected function rules()
    {
        return [
            'cash' => ['required', 'numeric', 'min:' . $this->totalPrice],
        ];
    }

    public function addItem($id)
    {
        $rowId = "Cart" . $id;
        $Product = Menu::find($id); 
        $userID = Auth::user()->id; 

        \Cart::session($userID)->add(array(
            'id' => $rowId,
            // 'menu_id' => $Product->id,
            'name' => $Product->name,
            'price' => $Product->price,
            'quantity' => 1,
            'associatedModel' => $Product,
        ));
        $this->countItem++;
    }

    public function checkCash()
    {
        $this->validate();
        $this->btnOrder = '';
    }

    public function createOrder()
    {
        if($this->btnOrder = '') {
            dd('pesan');
        }
    }

    public function closeModal()
    {
        $this->class = 'd-none';
    }

    public function increaseItem($rowId)
    {
        $menuId = substr($rowId, 4,5);
        $dataMenu = Menu::find($menuId);
        $cart = \Cart::session(Auth()->id())->getContent();
        $checkItem = $cart->whereIn('id', $rowId);

        if($dataMenu->stock <= $checkItem[$rowId]->quantity) {
            session()->flash('message','Jumlah Item Tidak Mencukupi');
        } else {
            if($dataMenu->stock == 0) {
                session()->flash('message','Jumlah Item Tidak Mencukupi');
            } else {
                \Cart::session(Auth()->id())->update($rowId, [
                    'quantity' => [
                        'relative' => true,
                        'value' => +1,
                    ],
                ]);
            }
        }
    }

    public function decreaseItem($rowId)
    {
        $cart = \Cart::session(Auth()->id())->getContent();
        $checkItem = $cart->whereIn('id', $rowId);

        if ($checkItem[$rowId]->quantity == 1) {
            $this->removeItem($rowId);
        } else {
            \Cart::session(Auth()->id())->update($rowId, [
                'quantity' => [
                    'relative' => true,
                    'value' => -1,
                ]
            ]);
        }
    }

    public function removeItem($rowId)
    {
        \Cart::session(Auth()->id())->remove($rowId);
    }

    public function showItem()
    {
        $this->class = 'd-block';
    }

    public function orderNow()
    {
        $carts = \Cart::session(auth()->user()->id)->getContent();
        foreach($carts as $order) {
            $orders[] = [
                'user_id' => auth()->user()->id,
                'menu_id' => $order['associatedModel']['id'],
                'message' => 'lorem ipsum',
                'quantity' => $order['quantity'],
                'pay' => $this->cash,
                'total' => $this->totalPrice,
            ];
        }
        $order = Order::create([
            'invoice_number' => Str::random(10),
            'user_id' => auth()->user()->id,
            'payment_id' => $this->paymentId,
            'pay' => $this->totalPrice,
            'total' => $this->totalPrice,
            'address' => $this->address,
        ]);
        $payment = Payment::where('name', '=', 'Bayar Langsung')->first();
        if($this->paymentId == $payment->id) {
            $dataOrder = Order::find($order->id);
            $dataOrder->update(['status' => 'Bayar']);
        }
        foreach($orders as $pivot) {
            $pivotData = $pivot['menu_id'];
            $message = $pivot['message'];
            $quantity = $pivot['quantity'];
            $order->menu()->attach($pivotData, ['quantity' => $quantity, 'message' => $message]);
            $menu = Menu::find($pivotData);
            $menu->update(['stock' => $menu->stock - $quantity]);
        }

        \Cart::session(auth()->user()->id)->clear();
        session()->flash('message','Pesanan Berhasil Dibuat, Harap Melakukan Pembayaran 😉');
        session()->flash('type','success');
        $this->reset();
        return redirect()->route('home');
    }

    public function render()
    {
        $menu = Menu::paginate(8);
        $this->totalPrice = \Cart::session(auth()->user()->id)->getTotal();
        $items = \Cart::session(Auth()->id())->getContent();
        if (\Cart::isEmpty()) {
            $cartData = [];
        } else {
            foreach ($items as $item) {
                $cart[] = [
                    'rowId' => $item->id,
                    'name' => $item->name,
                    'qty' => $item->quantity,
                    'price' => $item->price,
                    'image' => $item->associatedModel->image,
                ];
            }
            $cartData = collect($cart);
        }
        if($this->address && $this->paymentId != null) {
            $this->btnOrder = '';
        }
        $payments = Payment::get();
        return view('livewire.home-menu', [
            'menus' => $menu,
            'carts' => $cartData,
            'payments' => $payments,
        ]);
    }
}
