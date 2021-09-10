<?php

namespace App\Http\Livewire;

use App\Models\Menu;
use App\Models\User;
use Livewire\Component;
use Livewire\WithFileUploads;

class Admin extends Component
{
    use WithFileUploads;

    // public property for form create and update
    public $name, $description, $price, $stock, $menuId;
    // public property for livewire admin
    public $users, $totalMenu, $order, $image, $class = "d-none", $updateMode = false;

    public function mount()
    {
        $this->users = User::where('roles', 'user')->count();
        $this->totalMenu = Menu::count();
    }

    // method for showing form
    public function showForm(...$menuId)
    {
        if($menuId) {
            $menu = Menu::where('id', $menuId)->first();
            $this->name = $menu->name; 
            $this->description = $menu->description; 
            $this->price = $menu->price; 
            $this->stock = $menu->stock; 
            $this->image = $menu->image; 
            $this->updateMode = true;
        }
        $this->class = "d-block";
    }

    // method for closing form
    public function closeForm()
    {
        $this->class = "d-none";
        $this->reset(['name','description','price','stock','image']);
    }

    // realtime validation image upload livewire
    public function updatedImage()
    {
        $this->validate([
            'image' => 'image|max:1024|mimes:png,jpg,jpeg', // 1MB Max
        ]);
    }

    // action for create and update menu
    public function submit()
    {
        // storing uploaded image to images  
        $name = md5($this->image . microtime()).'.'.$this->image->extension();
        $this->image->storeAs('images', $name);

        // reuseable data 
        $data = [
            'name' => $this->name,
            'description' => $this->description,
            'price' => $this->price,
            'stock' => $this->stock,
            'image' => $name,
        ];

        // if event property not null will execute update action
        if($this->updateMode == true) {
            Menu::find($this->menuId)->update($data);
            session()->flash('message','Berhasil Edit Menu');
            session()->flash('type','success');
        } else {
            Menu::create($data);
            session()->flash('message','Berhasil Menambah Menu!');
            session()->flash('type','success');
        }
        $this->reset(['name','description','price','stock','image']);
        $this->closeForm();
    }

    // method for delete menu
    public function delete($id)
    {
        Menu::find($id)->delete();
        session()->flash('message','Berhasil Menghapus Menu!');
        return redirect()->route('dashboard');
    }

    public function render()
    {
        $menu = Menu::all();
        return view('livewire.admin', ['menus' => $menu]);
    }
}
