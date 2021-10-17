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
                            <input type="text" class="form-control" id="name" wire:model="name">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="accountNumber" class="col-sm-2 col-form-label">Nomor Rekening</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="accountNumber" wire:model="accountNumber">
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
                                <img class="img-fluid w-25 mt-4" src="{{ asset('storage/images/payments/' . $image) }}">
                            @else
                                <span>there's no image uploaded</span>
                            @endif
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary">{{ $buttonSubmit }}</button>
                </form>
            </div>
        </div>
    </div>
</div>