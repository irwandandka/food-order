<?php

namespace App\Http\Livewire;

use App\Models\Menu;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Illuminate\Support\Str;


class HomeMenu extends Component
{
    public $countItem = 0, $showModal = false, $dataItem = [], $userId, $dataFinal;

    public function addItem($id)
    {
        $rowId = "Cart" . $id;
        $Product = Menu::find($id); 
        $userID = Auth::user()->id; 

        \Cart::session($userID)->add(array(
            'id' => $rowId,
            'name' => $Product->name,
            'description' => $Product->description,
            'price' => $Product->price,
            'quantity' => 1,
            'image' => $Product->image,
        ));
        $this->countItem++;
    }

    public function decreaseItem($rowId)
    {
        $idProduct = substr($rowId, 4,5);
        $product = Menu::find($idProduct);
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
        // \Cart::session($userID)->remove($rowId);
    }

    public function removeItem($rowId)
    {
        \Cart::session(Auth()->id())->remove($rowId);
    }

    public function showItem($idUser)
    {
        $check = \Cart::session(Auth()->id())->getContent();
        // $this->dataFinal = collect((object) $this->dataItem);
        // convert dataItem to collection
        // $this->dataFinal = collect($this->dataItem)->values();
    }

    public function render()
    {
        $menu = Menu::all();

        
        $items = \Cart::session(Auth()->id())->getContent()->sortBy(function($cart) {
            return $cart->attributes->get('added_at');
        });;
        if (\Cart::isEmpty()) {
            $cartData = [];
        } else {
            foreach ($items as $item) {
                $cart[] = [
                    'rowId' => $item->id,
                    'name' => $item->name,
                    'qty' => $item->quantity,
                    'price' => $item->price,
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
