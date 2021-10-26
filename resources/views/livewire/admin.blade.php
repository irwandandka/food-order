<div>
        @if(session('message'))
            {{-- Alert Component --}}
            <x-alert></x-alert>
        @endif

        {{-- Card Info Component--}}
        <x-card-info :users="$users" :earning="$earning" :orders="$orders" :totalMenu="$totalMenu"></x-card-info>

        {{-- Form Create Menu Component --}}
        <x-create-menu-form :class="$class" :formTitle="$formTitle" :image="$image" :menuId="$menuId" :updatedImage="$updatedImage"
        :buttonSubmit="$buttonSubmit"></x-create-menu-form>

        {{-- Table --}}
        <div class="row">
            <div class="col-md-12 mb-5">
                <div class="card rounded shadow">
                    <div class="card-header text-center text-primary font-weight-bold">Data Menu</div>
                    <div class="card-body">
                        <button wire:click="showForm" class="btn btn-info mb-3">Tambah</button>
                        <div class="table-responsive">
                            <table class="table table-borderless table-hovered table-striped">
                                <thead class="bg-primary text-light">
                                    <tr class="text-center">
                                        <th>#</th>
                                        <th>Nama Makanan</th>
                                        <th>Deskripsi</th>
                                        <th>Harga</th>
                                        <th>Stok</th>
                                        <th>Gambar</th>
                                        <th>Opsi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($menus as $no => $menu)
                                    <tr>
                                        <td class="text-center align-middle">{{ $no + 1 }}</td>
                                        <td class="text-center align-middle">{{ $menu->name }}</td>
                                        <td class="text-center align-middle">{{ $menu->description }}</td>
                                        <td class="text-center align-middle">Rp {{ number_format($menu->price,2,',','.') }}</td>
                                        <td class="text-center align-middle">{{ $menu->stock }}</td>
                                        <td class="text-center align-middle col-md-3">
                                            <img class="img-fluid w-50" src="{{ asset('storage/images/' . $menu->image) }}">
                                        </td>
                                        <td class="text-center align-middle">
                                            <button wire:click="showForm({{ $menu->id }})" class="btn btn-success mb-2">Edit</button>
                                            <a wire:click="delete({{ $menu->id }})" class="btn btn-danger">Hapus</a>
                                        </td>
                                    </tr>
                                    @empty
                                        <tr>
                                            <td class="text-danger text-center" colspan="7">Belum Ada Data Menu</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                            <div class="d-flex justify-content-center">
                                {{ $menus->links() }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
</div>


