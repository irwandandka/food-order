<div class="row mb-4 {{ $class }}">
    <div class="col-md-12">
        <div class="card rounded shadow">
            <div class="card-header text-center text-primary font-weight-bold">
                Menu
                <span wire:click="closeModal" class="float-right" style="cursor: pointer;"><i class="fas fa-fw fa-1x fa-times"></i></span>
            </div>
            <div class="card-body">
              <div class="row">
                <div class="col-md-6 scroll">
                  @foreach ($carts as $cart)
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <img src="{{ asset('storage/images/' . $cart['image']) }}" class="img-fluid" alt="" style="width: 200px; height: 150px">
                        </div>
                        <div class="col-md-6">
                            <h5>{{ $cart['name'] }}</h5>
                            <p class="text-primary font-weight-bold">Total Rp <span class="badge badge-primary">{{ number_format($cart['price'] * $cart['qty'],2,',','.') }}</span></p>
                            <button wire:click="decreaseItem('{{ $cart['rowId'] }}')" class="btn btn-sm btn-danger d-inline">-</button>
                            <span class="badge badge-primary px-3 py-2 badge-pill mx-2">{{ $cart['qty'] }}</span>
                            <button wire:click="increaseItem('{{ $cart['rowId'] }}')" class="btn btn-sm btn-primary d-inline">+</button>
                            {{-- <button class="btn btn-sm btn-primary ml-2" id="messagesDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                              <i class="fas fa-comment-dots fa-fw"></i>
                            </button>
                            <div class="">
                              <div class="dropdown-list dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="messagesDropdown">
                                <h6 class="dropdown-header title-message">Catatan Pesanan?</h6>
                                <div class="dropdown-item d-flex align-items-center input-message" href="#">
                                  <input type="text" wire:model="message" class="form-control">
                                </div>
                              </div>
                            </div> --}}
                        </div>
                    </div>
                  @endforeach
                </div>
                <div class="col-md-6">
                  <h4 class="text-primary text-center font-weight-bold">Detail Pembayaran</h4>
                  <div class="mt-3 mx-4">
                    <h5 class="text-danger">Total Harga Rp <span class="badge badge-danger">{{ number_format($totalPrice,2,',','.') }}</span></h5>
                    <div class="{{ $summaryClass }}">
                      <div class="mb-3">
                        <label for="address" class="form-label">Alamat</label>
                        <input type="text" wire:model="address" id="address" class="form-control">
                      </div>
                      <p class="text-secondary">Pilih metode pembayaran</p>
                      @forelse ($payments as $payment)
                        <div class="form-check">
                          <input wire:model="paymentId" class="form-check-input" type="radio" name="exampleRadios" value="{{ $payment->id }}" id="exampleRadios1" checked>
                          <img src="{{ asset('storage/images/payments/' . $payment->image) }}" class="img-fluid" style="width: 20%" alt="">
                          <label class="form-check-label" for="exampleRadios1">
                            {{ $payment->name }}
                          </label>
                        </div>
                      @empty
                          <p class="text-danger">Saat Ini Belum Ada Metode Pembayaran</p>
                      @endforelse
                      {{-- <button wire:click="cashEvent('now')" class="btn btn-success">Bayar Sekarang</button>
                      <button wire:click="cashEvent('cod')" class="btn btn-info">COD</button> --}}
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="card-footer">
              <button wire:click="orderNow" type="button" class="btn btn-primary float-right" {{ $btnOrder }}><i class="fas fa-money-bill-wave mr-2"></i>Pesan!</button>
            </div>
        </div>
    </div>
  </div>
