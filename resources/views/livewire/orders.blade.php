<div>
    @if(session('message'))
        <div class="alert alert-success text-center">
            <strong>{{ session('message') }}</strong>
        </div>
    @endif
    
    <!-- Content Row -->
    @foreach ($orders as $order)
    <div class="row">
        <div class="col-12 mb-2">
            <div class="card rounded shadow mb-4">
                <div class="card-body">
                    <div class="row mx-1 my-2">
                        <span class="badge badge-primary mr-2">{{ $order->user->name }}</span>
                        <span class="badge badge-info mr-2">{{ $order->address }}</span>
                        <span class="badge badge-success mr-2">{{ $order->created_at->format('l-M-y') }}</span>
                        <span class="badge badge-success">{{ $order->address }}</span>
                    </div>
                    @foreach ($order->menu as $item)
                    <div class="row mb-3">
                        <div class="col-md-3">
                            <img src="{{ asset('storage/images/' . $item->image) }}" class="img-fluid img-order" 
                            alt="">
                        </div>
                        <div class="col-md-4">
                            <p class="d-inline-block">Menu <span class="badge badge-secondary">{{ $item->name }}</span></p>
                            <p class="d-inline-block">Description <span class="badge badge-info">{{ $item->description }}</span></p>
                            <p class="d-inline-block">Harga <span class="badge badge-primary">{{ $item->price }}</span></p>
                        </div>
                        <div class="col-md-4 center-item">
                            <p>Quantity <span class="badge badge-primary">{{ $item->pivot->quantity }}</span></p>
                            <p>Total Harga <span class="badge badge-success">{{ $item->pivot->quantity * $item->price }}</span></p>
                        </div>
                        {{-- <div class="col-md-1">
                            <span class="text-white">lorem</span>
                            <span class="text-end"><i class="fas fa-comment-dots text-right"></i></span>
                        </div> --}}
                    </div>
                    @endforeach
                </div>
            </div>
            {{-- <div class="card rounded shadow mb-4">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-3">
                            <img src="https://kasukaku.files.wordpress.com/2016/11/ayam-betutu.jpg" class="img-fluid img-order" 
                            alt="">
                        </div>
                        <div class="col-md-4">
                            <span class="d-block">Irwanda Andika</span>
                            <span class="d-block">Nasi Bakar Ayam Cabe Ijo</span>
                            <p>Sungai Panas, Puriloka 2 Blok C No 12</p>
                            <span class="d-block text-primary font-weight-bold">Rp 45000</span>
                        </div>
                        <div class="col-md-3 center-item">
                            <p>Quantity <span class="badge badge-primary">2</span></p>
                            <p>Total Harga <span class="badge badge-success">Rp 90.000</span></p>
                            <p class="text-primary font-weight-bold"></p>
                            <p>Kamis, 27 September 2020</p>
                        </div>
                        <div class="col-md-2">
                            <span class="text-white">loremipsumdolors</span>
                            <div class="position-absolute px-3 py-2 message-content">gak pedes bang</div>
                            <span class="text-end"><i class="fas fa-comment-dots text-right"></i></span>
                        </div>
                    </div>
                </div>
            </div> --}}
        </div>
    </div>
    @endforeach
</div>
