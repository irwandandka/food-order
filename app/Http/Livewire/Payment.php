<?php

namespace App\Http\Livewire;

use App\Models\Payment as ModelsPayment;
use Illuminate\Support\Facades\File;
use Livewire\{Component, WithFileUploads, WithPagination};

class Payment extends Component
{
    use WithPagination, WithFileUploads;
    protected $paginationTheme = 'bootstrap';

    public $name, $accountNumber, $image = null, $paymentId;
    public $buttonSubmit = 'Create', $class = "d-none", $formTitle;
    public $updateMode = false;

    public function showForm(...$paymentId)
    {
        if($paymentId) {
            $data = ModelsPayment::find($paymentId);
            $this->name = $data->name;
            $this->accountNumber = $data->account_number;
            $this->image = $data->image;
            $this->paymentId = $data->id;
            $this->updateMode = true;
            $this->buttonSubmit = 'Update';
            $this->formTitle = "Update Payment $this->name";
        } else {
            $this->formTitle = 'Create New Payment Method';
        }

        $this->class = 'd-block';
    }

    public function closeForm()
    {
        $this->class = "d-none";
        $this->updateMode = false;
        $this->buttonSubmit = 'Create';
        $this->formTitle = 'Create New Payment Method';
        $this->reset(['name','accountNumber','image']);
    }

    public function submit()
    {
        // storing uploaded image to images  
        if($this->updateMode == false) {
            if($this->image !== null) {
                $name = md5($this->image . microtime()).'.'.$this->image->extension();
                $this->image->storeAs('images/payments', $name);
                dd('yes');
            }
        } else {
            $data = ModelsPayment::find($this->menuId);
            if($this->image != $data->image) {
                File::delete('storage/images/payments/' . $data->image);
                $name = md5($this->image . microtime()).'.'.$this->image->extension();
                $this->image->storeAs('images/payments', $name);
            } else {
                $name = $data->image;
            }
        }

        // reuseable data 
        $data = [
            'name' => $this->name,
            'account_number' => $this->accountNumber ? $this->accountNumber : 'Belum Diisi',
            'image' => $name ?? null,
        ];

        // if event property not null will execute update action
        if($this->updateMode == true) {
            ModelsPayment::find($this->menuId)->update($data);
            session()->flash('message','Berhasil Edit Payment Method');
            session()->flash('type','success');
        } else {
            ModelsPayment::create($data);
            session()->flash('message','Berhasil Menambah Payment Method!');
            session()->flash('type','success');
        }
        $this->reset(['name','accountNumber','image']);
        $this->closeForm();
    }

    public function render()
    {
        $payments = ModelsPayment::latest()->paginate(5);
        return view('livewire.payment', [
            'payments' => $payments,
        ]);
    }
}
