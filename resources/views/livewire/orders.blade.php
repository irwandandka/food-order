<div>
    @if(session('message'))
        <div class="alert alert-success text-center">
            <strong>{{ session('message') }}</strong>
        </div>
    @endif
    
    <!-- Content Row -->
    {{-- @foreach ($orders as $order) --}}
    <div class="row">
        <div class="col-12 mb-5">
            <div class="card rounded shadow">
                <div class="card-body">
                    <div class="row">
                        <div class="">
                            <img src="{{ asset('storage/images/0DDdthRJOwrmDBTyXYBSUaWNkogNJPoZVM8piByU.jpg') }}" class="img-fluid px-2 img-order" 
                            alt="">
                        </div>
                        <div class="">
                            <p></p>
                            <p></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endforeach
</div>
