@extends('layouts.app')
@section('content')
<header class="header-2">
    <div class="page-header min-vh-75 relative">
        <span class="mask bg-gradient-primary opacity-4"></span>
        <div class="container">
            <div class="row">
                <div class="col-lg-7 text-center mx-auto">
                    <h1 class="text-white pt-3 mt-n5">SI PENDEKAR</h1>
                    <p class="lead text-white mt-3">Sistem Deteksi dan Prediksi<br/> Kerusakan Jalan Berbasis AI </p>
                </div>
            </div>
        </div>
    </div>
</header>

<div class="card card-body blur shadow-blur mx-3 mx-md-4 mt-n6">

<section class="pt-3 pb-4" id="count-stats">
    <div class="container">
    
    <form action="{{route('form.store')}}" method="post" enctype="multipart/form-data">
        @csrf
        <div class="row py-5">
            <div class="col-lg-10 mx-auto text-center">
                <h3>Silahkan Isi lokasi dari lubang yang ada di Jalan</h3>
            </div>
        </div>
        <div class="row py-2">
            <div class="col-lg-10 mx-auto">
                <div class="input-group input-group-outline mb-4">
                    <label class="form-label">Nama Pelapor</label>
                    <input class="form-control" name="name" type="text">
                </div>
            </div>
        </div>
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
        <div class="row py-2">
            <div class="col-lg-10 mx-auto">
                <label>Kota/Kabupaten</label>
                <select class="form-select" name="city_id" id="city">
                    <option value="">-</option>
                </select>
            </div>
        </div>
        

        <div class="row py-2">
            <div class="col-lg-10 mx-auto">
                <div class="input-group mb-4 input-group-static">
                    <label>Alamat Lengkap</label>
                    <textarea name="address" class="form-control" id="message" rows="1"></textarea>
                </div>
            </div>
        </div>

        <div class="row py-2">
            <div class="col-lg-10 mx-auto">
                <div class="input-group input-group-outline mb-4">
                    <input class="form-control" name="image" type="file" id="imageInput">
                </div>
            </div>
        </div>

        <div class="row py-2">
            <div class="col-lg-10 mx-auto text-center">
                <img id="preview" alt="Preview Gambar">
            </div>
        </div>
        
        <div class="row py-2">
            <div class="col-lg-10 mx-auto text-center">
                <input type="submit" class="btn bg-gradient-success w-50 me-2" value="Simpan"></input>
            </div>
        </div>
    </form>
    </div>
</section>
</div>

<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
<script>

// Laravolt
province.addEventListener('change', function () {
    let province = document.getElementById('province');
    let provinceId = this.value;
    let citySelect = document.getElementById('city');
    if (provinceId) {
        $.ajax({
            url: `{{ route('cities',['province_code' => ':province_code']) }}`.replace(':province_code', provinceId),
            type: "GET",
            headers: {
            'X-CSRF-TOKEN' : '{{ csrf_token() }}'
            },
            success: function name(data) {
                $('#city').empty();
                for (let key in data) {
                    citySelect.insertAdjacentHTML('beforeend',`<option value="${key}">${data[key]}</option>`)
                }
            },
            error: function(xhr, status, error) {
                    console.error('Error get data:', status, error);
            }
        })
    }
});
</script>
<script>
        document.getElementById('imageInput').addEventListener('change', function(event) {
            const file = event.target.files[0]; // Ambil file yang dipilih
            if (file) {
                const reader = new FileReader(); // Buat objek FileReader
                reader.onload = function(e) {
                    document.getElementById('preview').src = e.target.result; // Set src ke hasil pembacaan file
                    document.getElementById('preview').style.display = 'block'; // Tampilkan gambar
                };
                reader.readAsDataURL(file); // Baca file sebagai URL Data
            }
        });
    </script>
@endsection