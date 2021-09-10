<div>
    @if(session('message'))
        <x-alert></x-alert>
    @endif
    
    <div class="row mb-4 {{ $class }}">
        <div class="col-md-12">
            <div class="card rounded shadow">
                <div class="card-header text-center text-primary font-weight-bold">
                    {{ $editMode ? 'Update Admin' : 'Create New Admin' }} 
                    <span wire:click="closeForm" class="float-right" style="cursor: pointer;"><i class="fas fa-fw fa-1x fa-times"></i></span>
                </div>
                <div class="card-body">
                    <form wire:submit.prevent="{{ $editMode ? 'update' : 'submit' }}">
                        <div class="form-group row">
                            <label for="name" class="col-sm-2 col-form-label">Nama</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" wire:model.defer="state.name">
                                @error('name')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="email" class="col-sm-2 col-form-label">Email</label>
                            <div class="col-sm-10">
                                <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" wire:model.defer="state.email">
                                @error('email')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="password" class="col-sm-2 col-form-label">Password</label>
                            <div class="col-sm-10">
                                <input type="password" class="form-control @error('password') is-invalid @enderror" id="password" wire:model.defer="state.password">
                                @error('password')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary"><i class="fas fa-save mr-2"></i>{{ $editMode ? 'Update' : 'Create' }}</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Content Row -->
    <div class="row">
        <div class="col-md-12 mb-5">
            <div class="card rounded shadow">
                <div class="card-header text-center text-primary font-weight-bold">Data Admin</div>
                <div class="card-body">
                    <button wire:click="showForm" class="btn btn-info mb-3"><i class="fas fa-plus-circle mr-2"></i>Create</button>
                    <div class="table-responsive">
                        <table class="table table-borderless table-hovered table-striped">
                            <thead class="bg-primary text-light">
                                <tr class="text-center">
                                    <th>#</th>
                                    <th>Nama</th>
                                    <th>Email</th>
                                    <th>Options</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($users as $no => $user)
                                <tr>
                                    <td class="text-center align-middle">{{ $no + 1 }}</td>
                                    <td class="text-center align-middle">{{ $user->name }}</td>
                                    <td class="text-center align-middle">{{ $user->email }}</td>
                                    <td class="text-center align-middle">
                                        <button wire:click="edit({{ $user }})" class="btn btn-success mb-sm-2 mb-lg-0"><i class="fas fa-edit mr-2"></i>Edit</button>
                                        <a wire:click="delete({{ $user->id }})" class="btn btn-danger mb-sm-2 mb-lg-0"><i class="fas fa-trash mr-2"></i>Delete</a>
                                    </td>
                                </tr>
                                @empty
                                    <tr>
                                        <td class="text-danger text-center" colspan="7">Data Tidak Ditemukan</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
