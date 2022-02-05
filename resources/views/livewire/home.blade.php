<div class="container">
    @if(Auth::user())
        @if(Auth::user()->level == 1)
        <div class="col-md-3">
            <a href="{{ url('file-upload') }}" class="btn btn-success btn-block">Tambah Produk</a>
        </div>
        @endif
    @endif
    <br/>
    
    <div class="row">
        <div class="colmd-6">
            <div class="input-group mb-3">
                <input wire:model="search" type="text" class="form-control" placeholder="Search..." aria-label="Search"
                aria-describedby="basic-adddon1" value="search">
            </div>

            <div class="input-group mb-3">
                <input wire:model="min" type="text" class="form-control" placeholder="Harga min..." aria-label="harga min"
                aria-describedby="basic-adddon1">
            </div>

            <div class="input-group mb-3">
                <input wire:model="max" type="text" class="form-control" placeholder="harga max..." aria-label="harga max"
                aria-describedby="basic-adddon1">
            </div>
        </div>
    </div>


    <section class="products mb-5">
        <div class="row mt-4">
            @foreach($barangs as $barang)
                <div class="col-md-3 mb-3">
            <div class="card">
                    <div class="card-body text-center">
                <img src="{{ asset('photos/' . $barang->file) }}" width="200px" height="270px">
                    <div class="row mt-2">
                        <div class="col-md-12">
                            <h5><strong>{{ $barang->nama }}</strong> </h5>
                            <h6><strong>Rp. {{ number_format($barang->harga) }}</strong></h6>
                        </div>
                    </div>
                    <div class="row mt-2">
                        <div class="col-md-12">
                        <button type="submit" class="btn btn-success btn-block" wire:click="beli({{ $barang->id }})" >
                         Beli
                        </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
        {{-- {{ $barang->links() }} --}}
        </div>
        </section>
        
     
</div>
