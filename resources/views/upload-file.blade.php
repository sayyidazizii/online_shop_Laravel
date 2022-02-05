<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css"
        integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
</head>

<body>

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ ("Tambah Produk") }}</div>
                <div class="card-body">

                    <form action="{{url('upload/proses')}}" method="post" enctype="multipart/form-data">
                    
                        <div>
                            @if(session()->has('message'))
                                <div class="alert alert-success">
                                    {{ session('message') }}
                                </div>
                            @endif
                        </div>
                        @csrf
                        <div class="form-group">
                            <label for="exampleInputName">Gambar</label>
                            <input type="file" class="form-control" id="name" name="file">
                        </div>
                        {{-- pesan error  --}}
                        @error('file')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror

                        <div class="form-group">
                            <label for="exampleInputPassword1">Nama Barang</label>
                            <textarea name="nama" class="form-control"></textarea>
                        </div>
                        {{-- pesan error  --}}
                        @error('nama')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror

                        <div class="form-group">
                            <label for="exampleInputPassword1">Harga</label>
                            <textarea name="harga" class="form-control"></textarea>
                        </div>
                        {{-- pesan error  --}}
                        @error('harga')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror

                        <div class="form-group">
                            <label for="exampleInputPassword1">Berat</label>
                            <input type="number" name="berat" class="form-control">
                        </div>
                        {{-- pesan error  --}}
                        @error('berat')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    
                        <button type="submit" class="btn btn-success">Save</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>


</body>

</html>