<?php

namespace App\Http\Livewire;

use App\Models\Menu;
use Livewire\Component;
use Livewire\WithFileUploads;

class Form extends Component
{
    use WithFileUploads;

    public $name, $description, $price, $stock, $image, $event; 

    public function mount($data)
    {
        $this->event = null;
        
        if($data) {
            $this->event = $data;
            $this->name = $this->event->name;
            $this->description = $this->event->description;
            $this->price = $this->event->price;
            $this->stock = $this->event->stock;
            $this->image = $this->event->image;
        }
    }

    public function updatedImage()
    {
        $this->validate([
            'image' => 'image|max:1024|mimes:png,jpg,jpeg', // 1MB Max
        ]);
    }

    public function submit()
    {
 
        $photo = $this->image->store('images');

        $data = [
            'name' => $this->name,
            'description' => $this->description,
            'price' => $this->price,
            'stock' => $this->stock,
            'image' => $photo,
        ];

        if($this->event) {
            Menu::find($this->event->id)->update($data);
            session()->flash('message','Berhasil Edit Menu!');
        } else {
            Menu::create($data);
            session()->flash('message','Berhasil Menambah Menu!');
        }

        return redirect()->route('dashboard');
    }

    public function render()
    {
        return view('livewire.form');
    }
}
