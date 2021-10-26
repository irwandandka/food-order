<div class="row mb-4 {{ $class }}">
    <div class="col-md-12">
        <div class="card rounded shadow">
            <div class="card-header text-center text-primary font-weight-bold">
                {{ $formTitle }} 
                <span wire:click="closeForm" class="float-right" style="cursor: pointer;"><i class="fas fa-fw fa-1x fa-times"></i></span>
            </div>
            <div class="card-body">
                <form wire:submit.prevent="submit">
                    <div class="form-group row">
                        <label for="name" class="col-sm-2 col-form-label">Nama Menu</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control  @error('name') is-invalid @enderror" id="name" wire:model="name">
                            @error('name')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="description" class="col-sm-2 col-form-label">Deskripsi Menu</label>
                        <div class="col-sm-10">
                            <textarea id="description" cols="30" rows="5" class="form-control @error('description') is-invalid @enderror" wire:model="description"></textarea>
                            @error('description')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="price" class="col-sm-2 col-form-label">Harga Menu</label>
                        <div class="col-sm-10">
                            <input type="number" class="form-control @error('price') is-invalid @enderror" wire:model="price">
                            @error('price')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="stock" class="col-sm-2 col-form-label">Stok Menu</label>
                        <div class="col-sm-10">
                            <input type="number" class="form-control @error('stock') is-invalid @enderror" id="stock" wire:model="stock">
                            @error('stock')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="image" class="col-sm-2 col-form-label">Gambar</label>
                        <div class="col-sm-10">
                            <input type="file" class="form-control" id="image" wire:model="{{ $menuId != null ? 'updatedImage' : 'image' }}">
                            <div wire:loading wire:target="{{ $menuId != null ? 'updatedImage' : 'image' }}">Uploading image please wait...</div>
                            @error('updatedImage') <div class="text-danger">{{ $message }}</div> @enderror
                            @error('image') <div class="text-danger">{{ $message }}</div> @enderror
                            @if ($image && $menuId == null)
                                <img class="img-fluid w-25 mt-4" src="{{ $image->temporaryUrl() }}">
                            @elseif ($menuId)
                                <img class="img-fluid w-25 mt-4" src="{{ $updatedImage ? $updatedImage->temporaryUrl() : asset('storage/images/' . $image) }}">
                            @else
                                <span>There's no image uploaded</span>
                            @endif
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary">{{ $buttonSubmit }}</button>
                </form>
            </div>
        </div>
    </div>
</div>