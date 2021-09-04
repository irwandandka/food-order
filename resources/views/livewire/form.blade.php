<div class="col-md-12">
    <div class="card">
        <div class="card-header text-blue text-center font-weight-bold">Form Tambah Menu</div>
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
                        @if ($image)
                        Photo Preview:
                        <img class="img-fluid w-25 mt-4" src="{{ $image->temporaryUrl() }}">
                        @endif
                    </div>
                </div>
                <button type="submit" class="btn btn-blue">Tambah</button>
            </form>
        </div>
    </div>
</div>
