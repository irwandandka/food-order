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
                        <label for="name" class="col-sm-2 col-form-label">Nama Payment Method</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" wire:model="name">
                            @error('name')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="accountNumber" class="col-sm-2 col-form-label">Nomor Rekening</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="accountNumber" wire:model="accountNumber">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="image" class="col-sm-2 col-form-label">Gambar</label>
                        <div class="col-sm-10">
                            <input type="file" class="form-control" id="image" wire:model="{{ $paymentId != null ? 'updatedImage' : 'image' }}">
                            <div wire:loading wire:target="{{ $paymentId != null ? 'updatedImage' : 'image' }}">Uploading image please wait...</div>
                            @error('image') <div class="text-danger">{{ $message }}</div> @enderror
                            @error('updatedImage') <div class="text-danger">{{ $message }}</div> @enderror
                            @if ($image && $paymentId == null)
                                <img class="img-fluid w-25 mt-4" src="{{ $image->temporaryUrl() }}">
                            @elseif ($paymentId)
                                <img class="img-fluid w-25 mt-4" src="{{ $updatedImage ? $updatedImage->temporaryUrl() : asset('storage/images/payments/' . $image) }}">
                            @else
                                <div>there's no image uploaded</div>
                            @endif
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary">{{ $buttonSubmit }}</button>
                </form>
            </div>
        </div>
    </div>
</div>