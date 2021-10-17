<?php

namespace App\Http\Livewire;

use App\Models\{Menu, User, Order};
use Illuminate\Support\Facades\{File, Storage};
use Livewire\{Component, WithFileUploads, WithPagination};

class Admin extends Component
{
    use WithFileUploads, WithPagination;
    
    protected $paginationTheme = 'bootstrap';

    // public property for form create and update
    public $name, $description, $price, $stock, $menuId;
    // public property for view admin livewire
    public $buttonSubmit = 'Create', $class = "d-none", $formTitle = 'Create New Menu';
    // public property for admin livewire component 
    public $users, $totalMenu, $orders, $earning, $image, $updateMode = false;

    public function mount()
    {
        $this->users = User::where('roles', 'user')->count();
        $this->totalMenu = Menu::count();
        $this->orders = Order::count();
        $this->earning = Order::where('status', 'Bayar')->sum('total');
    }

    // method for showing form
    public function showForm(...$menuId)
    {
        if($menuId) {
            $menu = Menu::where('id', $menuId)->first();
            $this->menuId = $menu->id;
            $this->name = $menu->name; 
            $this->description = $menu->description; 
            $this->price = $menu->price; 
            $this->stock = $menu->stock;
            $this->image = $menu->image;
            $this->updateMode = true;
            $this->buttonSubmit = 'Update';
            $this->formTitle = "Update Menu $this->name";
        }
        $this->class = "d-block";
    }

    // method for closing form
    public function closeForm()
    {
        $this->class = "d-none";
        $this->updateMode = false;
        $this->buttonSubmit = 'Create';
        $this->formTitle = 'Create New Menu';
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
        if($this->updateMode == false) {
            $name = md5($this->image . microtime()).'.'.$this->image->extension();
            $this->image->storeAs('images', $name);
        } else {
            $data = Menu::find($this->menuId);
            if($this->image != $data->image) {
                File::delete('storage/images/' . $data->image);
                $name = md5($this->image . microtime()).'.'.$this->image->extension();
                $this->image->storeAs('images', $name);
            } else {
                $name = $data->image;
            }
        }

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
        $menu = Menu::find($id);
        File::delete('storage/images/' . $menu->image);
        $menu->delete();
        session()->flash('message','Berhasil Menghapus Menu!');
        session()->flash('type','success');
        return redirect()->route('dashboard');
    }

    public function render()
    {
        $menu = Menu::latest()->paginate(5);
        return view('livewire.admin', ['menus' => $menu]);
    }
}
