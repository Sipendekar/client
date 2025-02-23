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
            <form action="{{ route('form.store') }}" method="post" enctype="multipart/form-data">
                @csrf
                <!-- Input Form -->
                <div class="row py-5">
                    <div class="col-lg-10 mx-auto text-center">
                        <h3>Silahkan Isi Lokasi Kerusakan Jalan</h3>
                    </div>
                </div>
                <!-- Nama Pelapor -->
                <div class="row py-2">
                    <div class="col-lg-10 mx-auto">
                        <div class="input-group input-group-outline mb-4">
                            <label class="form-label">Nama Pelapor</label>
                            <input class="form-control" name="name" type="text">
                        </div>
                    </div>
                </div>
                <!-- Provinsi -->
                <div class="row py-2">
                    <div class="col-lg-10 mx-auto">
                        <label>Provinsi</label>
                        <select class="form-select" name="province_code" id="province">
                            <option value="">Pilih Provinsi</option>
                            @foreach($provinces as $province)
                                <option value="{{ $province->code }}">{{ $province->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <!-- Kota/Kabupaten -->
                <div class="row py-2">
                    <div class="col-lg-10 mx-auto">
                        <label>Kota/Kabupaten</label>
                        <select class="form-select" name="city_id" id="city">
                            <option value="">-</option>
                        </select>
                    </div>
                </div>
                <!-- Alamat -->
                <div class="row py-2">
                    <div class="col-lg-10 mx-auto">
                        <div class="input-group mb-4 input-group-static">
                            <label>Alamat Lengkap</label>
                            <textarea name="address" class="form-control" id="message" rows="1"></textarea>
                        </div>
                    </div>
                </div>
                <!-- Upload Gambar -->
                <div class="row py-2">
                    <div class="col-lg-10 mx-auto">
                        <div class="input-group input-group-outline mb-4">
                            <input class="form-control" name="image" type="file" id="imageInput">
                        </div>
                    </div>
                </div>
                <div class="row py-2">
                    <div class="col-lg-10 mx-auto text-center">
                        <img id="preview" alt="Preview Gambar" style="max-width: 100%; display: none;">
                    </div>
                </div>
                <!-- Tombol Simpan -->
                <div class="row py-2">
                    <div class="col-lg-10 mx-auto text-center">
                        <input type="submit" class="btn bg-gradient-success w-50 me-2" value="Simpan">
                    </div>
                </div>
                <!-- Card Hasil Prediksi -->
                @if(session('prediction'))
                <div class="card mt-4">
                    <div class="card-header bg-primary text-white">
                        Hasil Prediksi Kerusakan Jalan
                    </div>
                    <div class="card-body">
                        <h5 class="card-title">Jenis Kerusakan: {{ session('prediction')['damage'] }}</h5>
                        <p class="card-text">
                            <strong>Ukuran:</strong>
                            @if(is_array(session('prediction')['size']))
                                @if(in_array(session('prediction')['damage'], ['lubang jalan', 'area perbaikan']))
                                    Diameter: {{ session('prediction')['size'] }} cm
                                @else
                                    Panjang: {{ session('prediction')['size'][0] }} cm, Lebar: {{ session('prediction')['size'][1] }} cm
                                @endif
                            @else
                                {{ session('prediction')['size'] }}
                            @endif
                        </p>
                        <p class="card-text"><strong>Estimasi Waktu Perbaikan:</strong> {{ session('prediction')['repair_time'] }} Menit</p>
                        <p class="card-text"><strong>Bahan Perbaikan:</strong> {{ session('prediction')['material'] }}</p>
                        <p class="card-text"><strong>Estimasi Jumlah Bahan:</strong> {{ session('prediction')['quantity'] }} {{ session('prediction')['quantity_unit'] }}</p>
                        @if(session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                        @endif
                    </div>
                </div>
                @endif
            </form>
        </div>
    </section>
</div>

<!-- JavaScript: Preview Gambar dan Dropdown Kota -->
<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
<script>
    document.getElementById('imageInput').addEventListener('change', function(event) {
        const file = event.target.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = function(e) {
                const preview = document.getElementById('preview');
                preview.src = e.target.result;
                preview.style.display = 'block';
            };
            reader.readAsDataURL(file);
        }
    });

    document.getElementById('province').addEventListener('change', function () {
        let provinceId = this.value;
        if (provinceId) {
            $.ajax({
                url: `{{ route('cities',['province_code' => ':province_code']) }}`.replace(':province_code', provinceId),
                type: "GET",
                headers: { 'X-CSRF-TOKEN': '{{ csrf_token() }}' },
                success: function(data) {
                    $('#city').empty();
                    for (let key in data) {
                        $('#city').append(`<option value="${key}">${data[key]}</option>`);
                    }
                },
                error: function(xhr, status, error) {
                    console.error('Error get data:', status, error);
                }
            });
        }
    });
</script>
@endsection
