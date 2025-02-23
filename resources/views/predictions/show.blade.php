@extends('layouts.app')
@section('content')
<div class="container">
    <div class="card">
        <div class="card-header bg-primary text-white">
            Detail Prediksi Kerusakan Jalan
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-6">
                    <img src="{{ asset('road_image/' . $prediction->form->image) }}" 
                         class="img-fluid rounded" alt="Road damage image">
                </div>
                <div class="col-md-6">
                    <h5>Informasi Lokasi</h5>
                    <p><strong>Pelapor:</strong> {{ $prediction->form->name }}</p>
                    <p><strong>Alamat:</strong> {{ $prediction->form->address }}</p>
                    
                    <h5 class="mt-4">Hasil Prediksi</h5>
                    <p><strong>Jenis Kerusakan:</strong> {{ $prediction->damage_type }}</p>
                    <p><strong>Ukuran:</strong> 
                        @if(is_array($prediction->size))
                            @if(count($prediction->size) == 2)
                                @if($prediction->damage_type == 'lubang jalan' || $prediction->damage_type == 'area perbaikan')
                                    Diameter: {{ $prediction->size[0] }} cm
                                @else
                                    Panjang: {{ $prediction->size[0] }} cm, 
                                    Lebar: {{ $prediction->size[1] }} cm
                                @endif
                            @endif
                        @endif
                    </p>
                    <p><strong>Estimasi Waktu Perbaikan:</strong> {{ $prediction->repair_time }} Menit</p>
                    <p><strong>Material:</strong> {{ $prediction->material }}</p>
                    <p><strong>Jumlah Material:</strong> {{ $prediction->quantity }} {{ $prediction->quantity_unit }}</p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection