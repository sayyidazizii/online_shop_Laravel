<?php

namespace App\Http\Livewire;
use App\Models\Produk;
use App\Models\Belanja;
use Livewire\Component;
use Kavist\RajaOngkir\RajaOngkir;
use Illuminate\Support\Facades\Auth;

class TambahOngkir extends Component
{
    public $belanja;
    private $apiKey = '7627a8c954b393085c3a7ad900ed6fb7';
    public $provinsi_id,$kota_id,$jasa,$daftarProvinsi,$daftarKota,$nama_jasa;
    public $result = [];
    
    public function mount($id)
    {
        if(!Auth::user())
        {
            return redirect()->route('login');
        }
       $this->belanja   = Belanja::find($id);
    }


    public function getongkir()
    {
        //validasi
        // if(!$this->provinsi_id || !$this->kota_id || !$this->jasa)
        // {
        //     return view('livewire.belanja-user');
        // }
        //mengambil data barang
        $produk = Produk::find($this->belanja->produk_id);

        //mengambil biaya ongkir
        $rajaOngkir = new RajaOngkir($this->apiKey);
        $cost       = $rajaOngkir->ongkosKirim([
            'origin'        => 489,
            'destination'   => $this->kota_id,
            'weight'        => $produk->berat,
            'courier'       => $this->jasa
        ])->get();

        //nama jasa
        $this->nama_jasa = $cost[0]['name'];
           
        foreach ($cost[0]['costs'] as $row)
        {
            $this->result[] = array(
                'description'       => $row['description'],
                'biaya'             => $row['cost'][0]['value'],
                'etd'               => $row['cost'][0]['etd']
            );
        }
        // dd($this->result);
    }

    public function save_ongkir($biaya_pengiriman)
    {
        $this->belanja->total_harga  += $biaya_pengiriman;
        $this->belanja->status = 1;
        $this->belanja->update();
        
        //redirect
        return redirect()->to('BelanjaUser');
    }


    public function render()
    {
        $rajaOngkir = new RajaOngkir($this->apiKey);
        //mencari data provinsi
        $this->daftarProvinsi = $rajaOngkir->provinsi()->all();
        // dd($this->daftaProvinsi);

        //mencari data kota
        $this->daftarKota = $rajaOngkir->kota()->all();
        // dd($daftarKota);
   
        
        return view('livewire.tambah-ongkir')
        ->extends('layouts.app')->section('content');
    }
}
