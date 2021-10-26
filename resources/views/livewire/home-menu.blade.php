<div>
    {{-- Image Slider Component --}}
    <x-image-slider></x-image-slider>

    <livewire:order-user></livewire:order-user>

    <div class="container">
      @if (session('message'))
        <x-alert></x-alert>
      @endif
      <h1 class="text-center text-primary">Daftar Menu</h1>
      <hr class="border-bottom-primary divider mb-5">

      {{-- Cart User Component --}}
      <x-cart :class="$class" :carts="$carts" :payments="$payments" :summaryClass="$summaryClass" :totalPrice="$totalPrice" 
      :showAddress="$showAddress" :btnOrder="$btnOrder"></x-cart>
      
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
                <div id="card" class="card rounded shadow-lg">
                    <img src="{{ asset('storage/images/' . $menu->image) }}" class="card-img-top imgMenu" alt="...">
                    <div class="card-body">
                        <h4 class="card-title font-weight-bold text-capitalize text-center">{{ $menu->name }}</h4>
                        <p class="card-text">{{ $menu->description }}</p>
                        <h5 id="price" class="card-subtitle text-blue font-weight-bold mb-lg-2 mb-md-3 mb-sm-3"
                        style="bottom: 3em; right: 5.5em;">Rp {{ number_format($menu->price, 2, '.', ',') }}</h5>
                          <button id="button" wire:click="addItem({{ $menu->id }})" class="btn btn-primary rounded-pill font-weight-bold mb-auto">Beli</button>
                    </div>
                </div>
            </div>
          @empty
            <p class="text-danger text-center">Maaf Saat Ini Belum Ada Daftar Menu</p>
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
            <h1>E-Kantin MHS</h1>
            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Inventore pariatur eius corrupti aliquid omnis repudiandae a, quos magnam deleniti eum!</p>
            <strong>Contact Info</strong>
            <p>(+62)812-0989-9867<br>kantin.mhs@gmail.com</p>

            <a href="#" target="_blank"><i class="fab fa-facebook-square"></i></a>
            <a href="#" target="_blank"><i class="fab fa-twitter-square"></i></a>
            <a href="#" target="_blank"><i class="fab fa-instagram"></i></a>

            <hr class="socket">
            &copy 2021 E-Kantin MHS.
          </div>
        </div>
      </footer>
    </div>
</div>

