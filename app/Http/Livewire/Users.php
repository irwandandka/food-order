<?php

namespace App\Http\Livewire;

use App\Models\User;
use Illuminate\Support\Facades\Validator;
use Livewire\Component;
use Livewire\WithPagination;

class Users extends Component
{
    use WithPagination;

    protected $paginationTheme = 'bootstrap';

    public $class = 'd-none', $state = [], $editMode = false, $user;

    public function showForm()
    {
        $this->class = 'd-block';
    }

    public function edit(User $user)
    {
        $this->editMode = true;
        $this->user = $user;
        $this->state = $user->toArray();
        $this->showForm();
    }

    public function closeForm()
    {
        $this->class = 'd-none';
        $this->editMode = false;
    }

    public function submit()
    {
        $validateData = Validator::make($this->state, [
            'name' => 'required|min:3',
            'email' => 'required|email|unique:users',
            'password' => 'required',
        ])->validate();

        $validateData['password'] = bcrypt($validateData['password']);

        User::create($validateData);
        session()->flash('message','Berhasil Menambah Admin!');
        session()->flash('type','success');
        
        $this->reset();
        $this->closeForm();
    }

    public function update()
    {
        $validateData = Validator::make($this->state, [
            'name' => 'required|min:3',
            'email' => 'required|email|unique:users,email,' . $this->user->id, 
            'password' => 'sometimes',
        ])->validate();

        if (!empty($validateData['password'])) {
            $validateData['password'] = bcrypt($validateData['password']);
        }

        $this->user->update($validateData);
        session()->flash('message','Berhasil Update Admin!');
        session()->flash('type','success');

        $this->reset();
        $this->closeForm();
    }

    public function render()
    {
        $users = User::latest()->paginate(5);
        return view('livewire.users', [
            'users' => $users,
        ]);
    }
}
