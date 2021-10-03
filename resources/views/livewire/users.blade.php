<div>
    @if(session('message'))
        <x-alert></x-alert>
    @endif
    
    <x-create-admin-form :class="$class" :editMode="$editMode"></x-create-admin-form>

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
                        <div class="d-flex justify-content-center">
                            {{ $users->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
