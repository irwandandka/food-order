<?php

namespace App\Http\Livewire;

use App\Models\Menu;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithPagination;

class HomeMenu extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';

    public $countItem = 0;
    public $showModal = false;
    public $dataItem = [];
    public $userId; 
    public $class = 'd-none';
    public $totalPrice;
    public $cashClass = 'd-none';
    public $summaryClass = 'd-block';
    public $cash;

    public function mount()
    {
        $carts = \Cart::session(auth()->user()->id)->getContent();
        $total = 0;
        foreach($carts as $cart) {
            $total += $cart['quantity'];
        }
        $this->countItem = $total;
    }

    protected $rules = [
        'cash' => 'required|numeric|min:10000',
    ];

    public function addItem($id)
    {
        $rowId = "Cart" . $id;
        $Product = Menu::find($id); 
        $userID = Auth::user()->id; 

        \Cart::session($userID)->add(array(
            'id' => $rowId,
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
        // $this->addError('cash', 'Kurang Duitmu');
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
