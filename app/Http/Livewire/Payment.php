<?php

namespace App\Http\Livewire;

use App\Models\Payment as ModelsPayment;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Livewire\{Component, WithFileUploads, WithPagination};

class Payment extends Component
{
    use WithPagination, WithFileUploads;
    protected $paginationTheme = 'bootstrap';

    protected $messages = [
        'name.required' => 'Kolom Nama Harus Diisi',
        'image.mimes' => 'Format File Berupa JPG, JPEG, atau PNG',
        'image.max' => 'File Yang Anda Upload Terlalu Besar',
        'updatedImage.mimes' => 'Format File Berupa JPG, JPEG, atau PNG',
        'updatedImage.max' => 'File Yang Anda Upload Terlalu Besar',
    ];

    public $name, $accountNumber, $image = null, $paymentId, $updatedImage;
    public $buttonSubmit = 'Create', $class = "d-none", $formTitle;

    public function showForm(...$paymentId)
    {
        if($paymentId) {
            $data = ModelsPayment::where('id', $paymentId)->first();
            $this->name = $data->name;
            $this->accountNumber = $data->account_number;
            $this->image = $data->image;
            $this->paymentId = $data->id;
            $this->buttonSubmit = 'Update';
            $this->formTitle = "Edit Payment $this->name";
        } else {
            $this->formTitle = 'Tambah Payment Method';
        }

        $this->class = 'd-block';
    }

    public function closeForm()
    {
        $this->class = "d-none";
        $this->buttonSubmit = 'Create';
        $this->paymentId = null;
        $this->updatedImage = null;
        $this->formTitle = 'Create New Payment Method';
        $this->reset(['name','accountNumber','image']);
    }

    public function submit()
    {
        $this->validate([
            'name' => ['required'],
            'image' => $this->paymentId == null ? ['required','mimes:png,jpg,jpeg','max:1024'] : [],
            'updatedImage' => $this->paymentId != null && $this->updatedImage != null ? ['required','mimes:png,jpg,jpeg','max:1024'] : [],
        ]);

        if($this->paymentId != null) {
            $data = ModelsPayment::find($this->paymentId);
            if($this->updatedImage != null) {
                if($this->updatedImage != $data->image) {
                    Storage::delete('storage/images/payments/' . $data->image);
                    $imgName = $this->updatedImage->getClientOriginalName();
                    $this->updatedImage->storeAs('images/payments', $imgName);
                } else {
                    $imgName = $data->image;
                }
            } else {
                $imgName = $data->image;
            }
        } else {
            if($this->image) {
                $imgName = $this->image->getClientOriginalName();
                $this->image->storeAs('images/payments', $imgName);
            } else {
                $imgName = null;
            }
        }

        // reuseable data 
        $data = [
            'name' => $this->name,
            'account_number' => $this->accountNumber ? $this->accountNumber : 'Belum Diisi',
            'image' => $imgName ?? null,
        ];

        // if event property not null will execute update action
        if($this->paymentId != null) {
            ModelsPayment::find($this->paymentId)->update($data);
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

    public function delete($id)
    {
        $payment = ModelsPayment::find($id);
        File::delete('storage/images/payments/' . $payment->image);
        $payment->delete();
        session()->flash('message','Berhasil Menghapus Payment Method!');
        session()->flash('type','success');
        return redirect()->route('payment');
    }

    public function render()
    {
        $payments = ModelsPayment::latest()->paginate(5);
        return view('livewire.payment', [
            'payments' => $payments,
        ]);
    }
}
