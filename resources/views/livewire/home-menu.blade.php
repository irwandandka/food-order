<div>

  {{-- <div class="d-block" style="height: 40rem;"> --}}
    <div id="carouselExampleIndicators" class="carousel slide mb-5" data-ride="carousel" data-interval="7000">
      <ol class="carousel-indicators">
        <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
        <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
        <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
      </ol>
      <div class="carousel-inner" role="listbox">
        <div class="carousel-item active">
          <img src="{{ asset('img/indonesia-427784_640.jpg') }}" class="w-100" alt="">
          <div class="carousel-caption">
            <h1>Welcome To Makan Bang</h1>
            <h5>Warung yang tak pernah merasa rugi</h5>
            <button class="btn btn-outline-light btn-lg">Makan Apa Nih</button>
          </div>
        </div>
        <div class="carousel-item">
          <img src="{{ asset('img/culinary-4498129_640.jpg') }}" class="w-100" alt="">
          <div class="carousel-caption d-none d-md-block">
            <h1>Fresh Food!</h1>
            <h5>Makanan Dibuat Dengan Bahan Yang Fresh</h5>
            <button class="btn btn-outline-light btn-lg">Yuk Liat Menu Nya</button>
          </div>
        </div>
        <div class="carousel-item">
          <img src="{{ asset('img/lumpia-4983901_640.jpg') }}" class="d-block w-100" alt="">
          <div class="carousel-caption d-none d-md-block">
            <h1>Anda Mager? Delivery-in aja</h1>
            <h5>Kami Siap Mengantar Sampai Ke Depan Rumah Anda</h5>
            <button class="btn btn-outline-light btn-lg">Pesan Sekarang!</button>
          </div>
        </div>
      </div>
      <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="sr-only">Previous</span>
      </a>    
      <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="sr-only">Next</span>
      </a>
    </div>
  {{-- </div> --}}

    <div class="container">
      <h1 class="text-center text-primary">All Menu</h1>
      <hr class="border-bottom-primary divider mb-5">
      <div class="row">
        <div class="ml-3 mb-4">
            <button class="btn btn-blue px-4 py-3" wire:click="showItem({{ Auth::user()->id }})" data-toggle="modal" data-target="#showItem">
                <i class="fas fa-2x fa-shopping-basket text-light"> ({{ $countItem }})</i>
            </button>
        </div>
    </div>

      <div class="row">
          @forelse ($menus as $menu)
            <div class="col-xl-3 col-lg-4 col-md-6 col-sm-12 mb-5">
                <div id="card" class="card rounded shadow">
                    {{-- <img src="https://trilogi.ac.id/universitas/wp-content/uploads/2017/07/dummy-img.png" class="card-img-top" alt="..."> --}}
                    <img src="{{ asset('img/culinary-4498129_640.jpg') }}" class="card-img-top" alt="...">
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


<!-- Modal Delete -->
<div class="modal fade" id="showItem" tabindex="-1" aria-labelledby="showItemLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="showItemLabel">Delete Menu</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        @foreach ($carts as $cart)
        <div class="row mb-3">
            <div class="col-md-6">
                <img src="https://trilogi.ac.id/universitas/wp-content/uploads/2017/07/dummy-img.png" class="img-fluid" alt="" style="width: 200px; height: 150px">
            </div>
            <div class="col-md-6">
                <h5>{{ $cart['name'] }}</h5>
                <p class="text-primary">{{ $cart['price'] }}</p>
                <button wire:click="decreateItem('{{ $cart['rowId'] }}')" class="btn btn-sm btn-danger d-inline">-</button>
                <span class="badge badge-primary px-3 py-2 badge-pill mx-2">{{ $cart['qty'] }}</span>
                <button wire:click="increaseItem('{{ $cart['rowId'] }}')" class="btn btn-sm btn-primary d-inline">+</button>
            </div>
        </div>
        @endforeach
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" wire:click="delete()" class="btn btn-danger">Delete</button>
      </div>
    </div>
  </div>
</div>
