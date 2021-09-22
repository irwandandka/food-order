<?php

namespace App\Http\Livewire;

use App\Models\Menu;
use App\Models\Order;
use Livewire\Component;
use Illuminate\Support\Str;
use Livewire\WithPagination;
use Illuminate\Support\Facades\Auth;

class HomeMenu extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';

    public $address;
    public $btnOrder = 'disabled';
    public $cash;
    public $cashClass = 'd-none';
    public $countItem = 0;
    public $class = 'd-none';
    public $dataItem = [];
    public $message = [];
    public $messageClass = 'd-none';
    public $summaryClass = 'd-block';
    public $showModal = false;
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

    public function cashEvent($event)
    {
        if($event == 'now') {
            $this->cashClass = 'd-block';
            $this->summaryClass = 'd-none';
        } else {
            dd('tunggu dirumah');
        }
    }

    public function closeModal()
    {
        $this->class = 'd-none';
    }

    public function increaseItem($rowId)
    {
        // mengambil id dari $rowId ex: (Cart1) to (1)
        $menuId = substr($rowId, 4,5);
        // select menu berdasarkan $menuId
        $dataMenu = Menu::find($menuId);
        // Get session cart berdasarkan user yang login
        $cart = \Cart::session(Auth()->id())->getContent();
        // Get spesifik cart berdasarkan kolom id sesuai dengan $rowId
        $checkItem = $cart->whereIn('id', $rowId);

        // cek jika quantity menu di database kurang atau sama dengan quantity di session cart 
        if($dataMenu->stock <= $checkItem[$rowId]->quantity) {
            session()->flash('message','Jumlah Item Tidak Mencukupi');
        } else {
            // cek jika quantity menu di database 0
            if($dataMenu->stock == 0) {
                session()->flash('message','Jumlah Item Tidak Mencukupi');
            } else {
                // update session cart menambah jumlah quantity
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

    public function addMessage($rowId)
    {
        $this->message[] = [

        ];
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
            'pay' => $this->cash,
            'total' => $this->totalPrice,
            'address' => $this->address,
        ]);
        foreach($orders as $pivot) {
            $pivotData = $pivot['menu_id'];
            $message = $pivot['message'];
            $quantity = $pivot['quantity'];
            $order->menu()->attach($pivotData, ['quantity' => $quantity, 'message' => $message]);
        }

        \Cart::session(auth()->user()->id)->clear();
        session()->flash('message','Pesanan Kamu Sedang Diproses, Harap Menunggu 😉');
        session()->flash('type','success');
        $this->reset();
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
        return view('livewire.home-menu', [
            'menus' => $menu,
            'carts' => $cartData,
        ]);
    }
}
