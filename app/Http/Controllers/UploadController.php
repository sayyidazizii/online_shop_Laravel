<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Produk;

class UploadController extends Controller
{
    public function index(){
        //ambil data dari database
        $data = Produk::all();

        //passing data ke view
        return view('upload-file')->with('data', $data);
    }

    public function store(Request $request){

        //membuat validasi, jika tidak diisi maka akan menampilkan pesan error
        $this->validate($request, [
            'file'          => 'required',
            'nama'          => 'required',
            'harga'         => 'required',
            'berat'         => 'required'
        ]);

        //mengambil data file yang diupload
        $file           = $request->file('file');
        //mengambil nama file
        $nama_file      = $file->getClientOriginalName();

        //memindahkan file ke folder tujuan
        $file->move('photos',$file->getClientOriginalName());


        $upload = new Produk;
        $upload->file       = $nama_file;
        $upload->nama = $request->input('nama');
        $upload->harga = $request->input('harga');
        $upload->berat = $request->input('berat');
        // dd($upload);
        //menyimpan data ke database
        $upload->save();

        //kembali ke halaman sebelumnya
        return redirect()->to('');
    }
}
