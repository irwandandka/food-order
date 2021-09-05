<div>
        @if(session('message'))
            <div class="alert alert-success text-center">
                <strong>{{ session('message') }}</strong>
            </div>
        @endif

        <!-- Content Row -->
        <div class="row mb-4">
            <!-- Earnings (Monthly) Card Example -->
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-primary shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="font-weight-bold text-primary text-uppercase mb-1">
                                    Pelanggan</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $users }}</div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-users fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Earnings (Monthly) Card Example -->
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-success shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="font-weight-bold text-success text-uppercase mb-1">
                                    Pendapatan</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">$215,000</div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Earnings (Monthly) Card Example -->
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-info shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="font-weight-bold text-info text-uppercase mb-1">Pesanan
                                </div>
                                <div class="row no-gutters align-items-center">
                                    <div class="col-auto">
                                        <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800">50%</div>
                                    </div>
                                    <div class="col">
                                        <div class="progress progress-sm mr-2">
                                            <div class="progress-bar bg-info" role="progressbar"
                                                style="width: 50%" aria-valuenow="50" aria-valuemin="0"
                                                aria-valuemax="100"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-clipboard-list fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Pending Requests Card Example -->
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-warning shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="font-weight-bold text-warning text-uppercase mb-1">
                                    Menu</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $totalMenu }}</div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-hamburger fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row mb-4 {{ $class }}">
            <div class="col-md-12">
                <div class="card rounded shadow">
                    <div class="card-header text-center text-primary font-weight-bold">
                        Create New Menu 
                        <span wire:click="closeForm" class="float-right" style="cursor: pointer;"><i class="fas fa-fw fa-1x fa-times"></i></span>
                    </div>
                    <div class="card-body">
                        <form wire:submit.prevent="submit">
                            <div class="form-group row">
                                <label for="name" class="col-sm-2 col-form-label">Nama Menu</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="name" wire:model="name">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="description" class="col-sm-2 col-form-label">Deskripsi Menu</label>
                                <div class="col-sm-10">
                                    <textarea id="description" cols="30" rows="5" class="form-control" wire:model="description"></textarea>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="price" class="col-sm-2 col-form-label">Harga Menu</label>
                                <div class="col-sm-10">
                                    <input type="number" class="form-control" id="price" wire:model="price">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="stock" class="col-sm-2 col-form-label">Stock Menu</label>
                                <div class="col-sm-10">
                                    <input type="number" class="form-control" id="stock" wire:model="stock">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="image" class="col-sm-2 col-form-label">Image</label>
                                <div class="col-sm-10">
                                    <div wire:loading wire:target="submit">Uploading...</div>
                                    <input type="file" class="form-control" id="image" wire:model="image">
                                    @error('image') <span class="text-danger">{{ $message }}</span> @enderror
                                    @if ($image && $updateMode == false)
                                        <img class="img-fluid w-25 mt-4" src="{{ $image->temporaryUrl() }}">
                                    @elseif ($updateMode)
                                        <img class="img-fluid w-25 mt-4" src="{{ asset('storage/images/' . $image) }}">
                                    @endif
                                </div>
                            </div>
                            <button type="submit" class="btn btn-primary">Tambah</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <!-- Content Row -->
        <div class="row">
            <div class="col-md-12 mb-5">
                <div class="card rounded shadow">
                    <div class="card-header text-center text-primary font-weight-bold">Data Menu</div>
                    <div class="card-body">
                        <button wire:click="showForm" class="btn btn-info mb-3">Create</button>
                        <div class="table-responsive">
                            <table class="table table-borderless table-hovered table-striped">
                                <thead class="bg-primary text-light">
                                    <tr class="text-center">
                                        <th>#</th>
                                        <th>Nama Makanan</th>
                                        <th>Deskripsi</th>
                                        <th>Harga</th>
                                        <th>Stock</th>
                                        <th>Image</th>
                                        <th>Options</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($menus as $no => $menu)
                                    <tr>
                                        <td class="text-center align-middle">{{ $no + 1 }}</td>
                                        <td class="text-center align-middle">{{ $menu->name }}</td>
                                        <td class="text-center align-middle">{{ $menu->description }}</td>
                                        <td class="text-center align-middle">Rp {{ $menu->price }}</td>
                                        <td class="text-center align-middle">{{ $menu->stock }}</td>
                                        <td class="text-center align-middle col-md-3">
                                            <img class="img-fluid w-50" src="{{ asset('storage/images/' . $menu->image) }}">
                                        </td>
                                        <td class="text-center align-middle">
                                            <button wire:click="showForm({{ $menu->id }})" class="btn btn-success mb-sm-2 mb-lg-0">Edit</button>
                                            <a wire:click="delete({{ $menu->id }})" class="btn btn-danger mb-sm-2 mb-lg-0">Delete</a>
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


