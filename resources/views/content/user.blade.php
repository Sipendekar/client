@extends('layouts.app')
@section('content')
<header class="header-2">
    <div class="page-header min-vh-75 relative">
        <span class="mask bg-gradient-primary opacity-4"></span>
        <div class="container">
            <div class="row">
                <div class="col-lg-7 text-center mx-auto">
                    <h1 class="text-white pt-3 mt-n5">SI PENDEKAR</h1>
                    <p class="lead text-white mt-3">Sistem Deteksi dan Prediksi<br/> Kerusakan Jalan Berbasis AI</p>
                </div>
            </div>
        </div>
    </div>
</header>

<div class="card card-body blur shadow-blur mx-3 mx-md-4 mt-n6">
    <section class="pt-3 pb-4" id="count-stats">
        <div class="container">
            <div class="text-center">
                <h1>List Lokasi Kerusakan Jalan</h1>
                <h1>Harap Pengendara Berhati-hati!</h1>
            </div>
            
            
            @if ($hasForm)   
            <div class="card card-body mx-3 mx-md-4 mt-5 mb-5" style="border: 1px solid black;">
                @foreach ($form as $data)
                <div class="row">
                    <div class="col-lg-12 col-sm-12 col-md-12">
                        <div class="row">
                            <h5>Provinsi :{{ $data->province_name ?? '-' }}</h5>
                        </div>
                        <div class="row">
                            <h5>Kabupaten / Kota : {{ $data->city_name ?? '-' }}</h5>
                        </div>
                        <div class="row">
                            <h5>Alamat detail : {{$data->address}}</h5>
                        </div>
                    </div>
                </div>
            @endforeach
            </div>
            @else
            <div class="card card-body mx-3 mx-md-4" style="border: 1px solid black;">
                <center>
                    <h2>Maaf, Tidak ada Kerusakan Jalan</h2>
                </center>
            </div>
            @endif
        </div>
    </section>
</div>
@endsection
