<div class="container">
    <div class="row mt-4">
        <div class="col">
            <div class ="table-responsive">
                <table class="table text-center">
                    <thead>
                         <tr>
                            <td>No.</td>
                            <td>Tanggal Pesan</td>
                            <td>Nama Produk</td>
                            <td>Status</td>
                            <td>Total Harga</td>
                            <td>Aksi</td>
                            <td>Hapus</td>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $no = 1 ?>
                        @forelse ($belanja as $pesanan)
                        <tr>
                            <td>{{ $no++ }}</td>

                            <td>{{ $pesanan->created_at }}</td>

                            <td>
                                <?php $produk = \App\models\Produk::where('id', $pesanan->produk_id)->first(); ?>
                                <img src="{{ asset('photos/'.$produk->file) }}" width="62px">
                                {{ $produk->nama }}
                            </td>


                            <td>
                                @if($pesanan->status == 0)
                                <p class="bg-danger text-light"><strong>pesanan belum ditambahkan ongkir</strong></p>
                                @endif
                                @if($pesanan->status == 1)
                                <p class="bg-warning text-dark"><strong>pesanan sudah ditambahkan ongkir</strong></p>
                                @endif
                                @if($pesanan->status == 2)
                                <p class="bg-success text-dark"><strong>pesanan telah dipilih pembayarannya</strong></p>
                                @endif
                            </td>
                                
                            <td><strong>Rp. {{ ( number_format($pesanan->total_harga)) }}</strong></td>

                            <td>
                                @if($pesanan->status == 0)
                                <a href="{{ url('TambahOngkir/'. $pesanan->id) }}" class="btn btn-warning btn-block">Tambahkan Ongkir</a>
                                @endif
                                @if($pesanan->status == 1)
                                <a href="{{ url('Bayar/'.$pesanan->id) }}" class="btn btn-primary btn-block">Pilih Pembayaran</a>
                                @endif
                                @if($pesanan->status == 2)
                                <a href="{{ url('Bayar/'. $pesanan->id) }}" class="btn btn-primary btn-block">Lihat status</a>
                                @endif
                            </td>

                            <td>
                                <button class="btn btn-danger btn-block" wire:click="destroy({{ $pesanan->id }})" >
                                Hapus
                                </button>
                            </td>
                        </tr>
                        @empty      
                        <tr>
                            <td colspan="7">Data Kosong</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
