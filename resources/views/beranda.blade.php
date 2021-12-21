@extends('master')
@section('konten')

<div class="jumbotron text-center">
    <h1 class="display-4">E Laporz</h1>
    <p class="lead">Adalah Website untuk forum untuk pengaduan barang hilang</p>
    <hr class="my-4">
    <p>Jika anda kehilangan barang silahkan adukan ke E Laporz</p>
    <a class="btn btn-primary btn-lg" href="register" role="button">Daftar</a>
</div>

<div class="container p-5">
    <div class="row">
        <div class="col-lg-6 mx-auto text-center p-5">
            <h1><i class="fas fa-bullhorn"></i> Alur Pengaduan</h1>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-4">
            <div class="card">
                <div class="card-body">
                    <h1 class="text-center">

                        <i class="fa fa-edit"></i>
                        Daftar
                    </h1>
                </div>
            </div>
        </div>
        <div class="col-lg-4">
            <div class="card">
                <div class="card-body">
                    <h1 class="text-center">

                        <i class="fa fa-paper-plane"></i>
                        Posting
                    </h1>
                </div>
            </div>
        </div>
        <div class="col-lg-4">
            <div class="card">
                <div class="card-body">
                    <h1 class="text-center">
                        <i class="fa fa-search"></i>
                        Temukan
                    </h1>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
