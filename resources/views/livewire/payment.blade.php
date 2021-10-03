<div>
    @if(session('message'))
        {{-- Alert Component --}}
        <x-alert></x-alert>
    @endif

    {{-- Form Create Menu Component --}}
    <x-payment-method-form :class="$class" :formTitle="$formTitle" :image="$image" :updateMode="$updateMode" 
    :buttonSubmit="$buttonSubmit"></x-payment-method-form>

    {{-- Table --}}
    <div class="row">
        <div class="col-md-12 mb-5">
            <div class="card rounded shadow">
                <div class="card-header text-center text-primary font-weight-bold">Data Payment Method</div>
                <div class="card-body">
                    <button wire:click="showForm" class="btn btn-info mb-3">Create</button>
                    <div class="table-responsive">
                        <table class="table table-borderless table-hovered table-striped">
                            <thead class="bg-primary text-light">
                                <tr class="text-center">
                                    <th>#</th>
                                    <th>Nama Payment Method</th>
                                    <th>Nomor Rekening</th>
                                    <th>Image</th>
                                    <th>Options</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($payments as $no => $payment)
                                <tr>
                                    <td class="text-center align-middle">{{ $no + 1 }}</td>
                                    <td class="text-center align-middle">{{ $payment->name }}</td>
                                    <td class="text-center align-middle">{{ $payment->account_number }}</td>
                                    <td class="text-center align-middle col-md-3">
                                        <img class="img-fluid w-50" src="{{ asset('storage/images/payments/' . $payment->image) }}">
                                    </td>
                                    <td class="text-center align-middle">
                                        <button wire:click="showForm({{ $payment->id }})" class="btn btn-success">Edit</button>
                                        <a wire:click="delete({{ $payment->id }})" class="btn btn-danger">Delete</a>
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
                            {{ $payments->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
