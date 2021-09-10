<div>
    <x-image-slider></x-image-slider>

    <div class="container">
      @if (session('message'))
        <x-alert></x-alert>
      @endif
      <h1 class="text-center text-primary">All Menu</h1>
      <hr class="border-bottom-primary divider mb-5">

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
                            </div>
                        </div>
                      @endforeach
                    </div>
                    <div class="col-md-6">
                      <h4 class="text-primary text-center font-weight-bold">Detail Pembayaran</h4>
                      <div class="mt-3 mx-4">
                        <h5 class="text-danger">Total Harga Rp <span class="badge badge-danger">{{ number_format($totalPrice,2,',','.') }}</span></h5>
                        <div class="{{ $summaryClass }}">
                          <p class="text-secondary">Pilih opsi pembayaran</p>
                          <button wire:click="cashEvent('now')" class="btn btn-success">Bayar Sekarang</button>
                          <button wire:click="cashEvent('cod')" class="btn btn-info">COD</button>
                        </div>
                        <div class="{{ $cashClass }}">
                          <label for="cash" class="form-label">Masukkan Nominal</label>
                          <input type="number" wire:model="cash" id="cash" class="form-control">
                          @if ($errors->has('cash'))
                              <div class="text-danger">{{ $errors->first('cash') }}</div>
                          @endif
                          <button wire:click="checkCash" class="btn btn-success mt-2">Check</button>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="card-footer">
                  <button wire:click="orderNow" type="button" class="btn btn-primary float-right"><i class="fas fa-money-bill-wave mr-2"></i>Pesan!</button>
                </div>
            </div>
        </div>
      </div>
      
      <div class="row">
        <div class="ml-3 mb-4">
            <button class="btn btn-blue px-4 py-3" wire:click="showItem()" data-toggle="modal" data-target="#showItem">
                <i class="fas fa-2x fa-shopping-basket text-light"> ({{ $countItem }})</i>
            </button>
        </div>
    </div>

      <div class="row">
          @forelse ($menus as $menu)
            <div class="col-xl-3 col-lg-4 col-md-6 col-sm-12 mb-5">
                <div id="card" class="card rounded shadow">
                    {{-- <img src="https://trilogi.ac.id/universitas/wp-content/uploads/2017/07/dummy-img.png" class="card-img-top" alt="..."> --}}
                    <img src="{{ asset('storage/images/' . $menu->image) }}" class="card-img-top imgMenu" alt="...">
                    <div class="card-body">
                        <h4 class="card-title font-weight-bold text-capitalize text-center">{{ $menu->name }}</h4>
                        <p class="card-text">{{ $menu->description }}</p>
                        <h5 id="price" class="card-subtitle text-blue font-weight-bold mb-lg-2 mb-md-3 mb-sm-3"
                        style="bottom: 3em; right: 7em;">Rp {{ $menu->price }}</h5>
                          <button id="button" wire:click="addItem({{ $menu->id }})" class="btn btn-primary rounded-pill font-weight-bold mb-auto">Beli</button>
                    </div>
                </div>
            </div>
          @empty
            <p class="text-danger text-center">Belum Ada Menu Bang</p>
          @endforelse
      </div>
      <div class="d-flex justify-content-center">
        {{ $menus->links() }}
      </div>
    </div>

    <div id="contact">
      <footer>
        <div class="row justify-content-center">
          <div class="col-md-5 text-center">
            <h1>Makan Bang</h1>
            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Inventore pariatur eius corrupti aliquid omnis repudiandae a, quos magnam deleniti eum!</p>
            <strong>Contact Info</strong>
            <p>(+62)812-0989-9867<br>makan.bang@gmail.com</p>

            <a href="#" target="_blank"><i class="fab fa-facebook-square"></i></a>
            <a href="#" target="_blank"><i class="fab fa-twitter-square"></i></a>
            <a href="#" target="_blank"><i class="fab fa-instagram"></i></a>

            <hr class="socket">
            &copy 2021 Makan Bang.
          </div>
        </div>
      </footer>
    </div>
</div>

