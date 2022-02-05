<?php

namespace App\Http\Livewire;

use App\Models\Produk;
use App\Models\Belanja;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;

class Home extends Component
{

    public $barangs = [];

    //atribut filterring
    public $search,$min,$max;

    //Autentifikasi
    public function mount()
    {
        if(!Auth::user())
        {
            return Redirect()->route('login');
        }
    }

    public function beli($id)
    {
        //mencari produk
        $produk = Produk::find($id);
        // dd($produk);
        Belanja::create(
            [
                'user_id'   => Auth::user()->id,
                'total_harga'=> $produk->harga,
                'produk_id' => $produk->id,
                'status'    => 0   
            ]
        );
        return redirect()->to('BelanjaUser');
    }

    public function render()
    {
        //filter max
        if($this->max)
        {
            $harga_max = $this->max;
        }
        else{
            $harga_max = 500000000;
        }

        //filter min
        if($this->min)
        {
            $harga_min = $this->min;
        }
        else{
            $harga_min = 0;
        }
        if($this->search)
        {
            $this->barangs = Produk::where('nama','like','%'.$this->search.'%')
                                    ->where('harga','>=',$harga_min)
                                    ->where('harga','<=',$harga_max)
                                    ->get();
        }
        else
        {
            $this->barangs =  Produk::where('harga','>=',$harga_min)
                                    ->where('harga','<=',$harga_max)
                                    ->get();
        }

        // $this->barangs = Produk::all();
        return view('livewire.home')
        ->extends('layouts.app')->section('content');
    }
}
