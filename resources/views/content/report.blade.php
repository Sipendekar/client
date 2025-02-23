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
            </div>
            
            <div class="card card-body mx-3 mx-md-4" style="border: 1px solid black;">
            @if ($hasForm)    
                @foreach ($form as $data)
                <div class="row">
                    <div class="col-lg-4 col-sm-12 col-md-12 mb-3">
                        <img src="{{asset('road_image/'.$data->image)}}" class="img-fluid" style="width: 100%; height: 280px; object-fit: cover; border-radius: 8px;">
                    </div>
                    <div class="col-lg-8 col-sm-12 col-md-12">
                        <div class="row">
                            <p>Nama Pelapor : {{$data->name}}</p>
                        </div>
                        <div class="row mb-3">
                            <h4>Informasi Kerusakan</h4>
                        </div>
                        <div class="row">
                            <p>Provinsi :{{ $data->province_name ?? '-' }}</p>
                        </div>
                        <div class="row">
                            <p>Kabupaten / Kota : {{ $data->city_name ?? '-' }}</p>
                        </div>
                        <div class="row">
                            <p>Alamat detail : {{$data->address}}</p>
                        </div>
                        <div class="row">
                            <p>Tipe Kerusakan : {{$data->damage_type}}</p>
                        </div>
                        <div class="row">
                            @php
                                $size = json_decode($data->size, true); // Decode sebagai array
                            @endphp

                            <p>Ukuran Kerusakan : {{ is_array($size) ? number_format($size[0], 1) . ' x ' . number_format($size[1], 1) : number_format($data->size, 1) }} CM</p>
                        </div>
                        <div class="row">
                            <p>Waktu Perbaikan : {{number_format($data->repair_time,1)}} Menit</p>
                        </div>
                        <div class="row">
                            <p>Material Yang diperlukan : {{$data->material}}</p>
                        </div>
                        <div class="row">
                            <p>Jumlah Material yang diperlukan : {{number_format($data->quantity,1)}} {{$data->quantity_unit}}</p>
                        </div>
                    </div>
                </div>
            @endforeach
            @else
                <center>
                    <h2>Maaf, Tidak ada Laporan</h2>
                    <h2>Silahkan Tambah Laporan Jika Ada</h2>
                </center>
            @endif
            </div>
        </div>
    </section>
</div>
@endsection
