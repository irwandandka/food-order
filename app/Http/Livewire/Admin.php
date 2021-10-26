<?php

namespace App\Http\Livewire;

use App\Models\{Menu, User, Order};
use Illuminate\Support\Facades\{File, Storage};
use Livewire\{Component, WithFileUploads, WithPagination};

class Admin extends Component
{
    use WithFileUploads, WithPagination;

    protected $paginationTheme = 'bootstrap';
    
    protected $messages = [
        'name.required' => 'Kolom Nama Harus Diisi',
        'name.min' => 'Minimal 3 Karakter',
        'name.max' => 'Maksimal 20 Karakter',
        'description.required' => 'Kolom Deskripsi harus diisi',
        'description.max' => 'Maksimal 30 Karakter',
        'price.required' => 'Kolom Harga Harus Diisi',
        'stock.required' => 'Kolom Stok Harus Diisi',
        'image.required' => 'Anda Harus Mengupload Gambar',
        'image.mimes' => 'Format Gambar Harus Berupa JPG, JPEG, atau PNG',
        'image.max' => 'File Yang Anda Upload Terlalu Besar',
        'updatedImage.required' => 'Anda Harus Mengupload Gambar',
        'updatedImage.mimes' => 'Format Gambar Harus Berupa JPG, JPEG, atau PNG',
        'updatedImage.max' => 'File Yang Anda Upload Terlalu Besar',
    ];

    public $name, $description, $price, $stock, $menuId, $updatedImage;
    public $buttonSubmit = 'Create', $class = "d-none", $formTitle = 'Create New Menu';
    public $users, $totalMenu, $orders, $earning, $image;

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
            $this->buttonSubmit = 'Update';
            $this->formTitle = "Edit Menu $this->name";
        }
        $this->class = "d-block";
    }

    // method for closing form
    public function closeForm()
    {
        $this->class = "d-none";
        $this->buttonSubmit = 'Create';
        $this->formTitle = 'Tambah Menu Baru';
        $this->menuId = null;
        $this->updatedImage = null;
        $this->reset(['name','description','price','stock','image']);
    }

    // action for create and update menu
    public function submit()
    {
        $this->validate([
            'name' => ['required','min:3','max:20'],
            'description' => ['required','max:30'],
            'price' => ['required','numeric'],
            'stock' => ['required','numeric'],
            'image' => $this->menuId == null ? ['required','mimes:jpg,jpeg,png','max:1024'] : [],
            'updatedImage' => $this->menuId != null && $this->updatedImage != null ? ['required','mimes:jpg,jpeg,png','max:1024'] : [],
        ]);

        if($this->menuId != null) {
            $data = Menu::find($this->menuId);
            if($this->updatedImage != null) {
                if($this->updatedImage != $data->image) {
                    Storage::delete('storage/images/' . $data->image);
                    $imgName = $this->updatedImage->getClientOriginalName();
                    $this->updatedImage->storeAs('images', $imgName);
                } else {
                    $imgName = $data->image;
                }
            } else {
                $imgName = $data->image;
            }
        } else {
            if($this->image) {
                $imgName = $this->image->getClientOriginalName();
                $this->image->storeAs('images', $imgName);
            } else {
                $imgName = null;
            }
        }

        // reuseable data 
        $data = [
            'name' => $this->name,
            'description' => $this->description,
            'price' => $this->price,
            'stock' => $this->stock,
            'image' => $imgName,
        ];

        // if event property not null will execute update action
        if($this->menuId != null) {
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
