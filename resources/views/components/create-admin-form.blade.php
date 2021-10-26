<div class="row mb-4 {{ $class }}">
    <div class="col-md-12">
        <div class="card rounded shadow">
            <div class="card-header text-center text-primary font-weight-bold">
                {{ $editMode ? 'Edit Admin' : 'Tambah Admin' }} 
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