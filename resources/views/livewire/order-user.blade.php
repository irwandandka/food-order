<div>
    <div class="modal fade" id="showOrders" tabindex="-1" aria-labelledby="showOrdersLabel" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered modal">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="showOrdersLabel">Pesanan</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
             @forelse ($orders as $item)
              <div class="row mb-4">
                <div class="col-md-12">
                  <div class="card rounded-lg shadow-lg">
                    <div class="card-body">
                      @foreach ($item->menu as $dataMenu)
                        <div class="d-block mb-1">
                          <span class="badge badge-primary px-2 py-1">{{ $dataMenu->name }} {{ $dataMenu->pivot->quantity }} pcs</span>
                        </div>
                      @endforeach
                      <div class="mt-2">
                        <p class="d-inline">Tanggal Pemesanan : <span class="badge badge-success px-2 py-1">{{ $item->created_at->format('l-d-M-Y') }}</span></p>
                        <p class="">Total : <span class="badge badge-info px-2 py-1">Rp {{ number_format($item->total, 2, '.', ',') }}</span></p>
                      </div>
                      <div>
                        <button type="button" wire:click="cancelOrder({{ $item->id }})" class="btn btn-danger btn-sm float-right rounded-lg">Batalkan?</button>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            @empty
              <p class="text-danger text-center">Anda Belum Memiliki Pesanan!</p>
            @endforelse
          </div>
        </div>
      </div>
    </div>


    <div class="modal fade" id="payOrder" tabindex="-1" aria-labelledby="payOrderLabel" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered modal">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="payOrderLabel">Bayar Pesanan</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            @if ($order)
              <div class="d-flex justify-content-between">
                <p>Total Pembayaran : </p>
                <p class="text-danger font-weight-bold">{{ number_format($order->total, 2, ".", ",") }}</p>
              </div>
              <div>
                  <div>
                    <img src="{{ asset('storage/images/payments/' . $order->payment->image) }}" class="img-fluid w-25" alt="">
                    {{ $order->payment->name }}
                  </div>
                  <label class="ml-1 font-weight-bold">No Rekening</label>
                  <div class="input-group mb-3">
                    <input type="text" class="form-control dataNumber font-weight-bold" value="{{ $order->payment->account_number }}" placeholder="Recipient's username" aria-label="Recipient's username" aria-describedby="button-addon2" disabled>
                    <div class="input-group-append">
                      <button class="btn btn-outline-primary" onclick="copyNumber()" type="button" id="button-addon2">Salin</button>
                    </div>
                  </div>
                  <span class="text-info">Dicek dalam 5 menit setelah pembayaran berhasil</span>
                  <div class="mt-3">
                    <button type="button" wire:click="payOrder({{ $order->id }})" class="btn btn-primary" data-dismiss="modal" @if(!$orders) disabled @endif><i class="fas fa-money-bill-wave"></i> Bayar</button>
                  </div>
                </div>
            @else
              <p class="text-danger text-center">Anda Belum Memiliki Pesanan!</p>
            @endif
          </div>
        </div>
      </div>
    </div>
</div>
