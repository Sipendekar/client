@extends('layouts.app')
@section('content')
<div class="container">
    <h2 class="mb-4">Daftar Prediksi Kerusakan Jalan</h2>
    <div class="table-responsive">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Lokasi</th>
                    <th>Jenis Kerusakan</th>
                    <th>Material</th>
                    <th>Estimasi Waktu</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach($predictions as $prediction)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $prediction->form->address }}</td>
                    <td>{{ $prediction->damage_type }}</td>
                    <td>{{ $prediction->material }}</td>
                    <td>{{ $prediction->repair_time }} menit</td>
                    <td>
                        <a href="{{ route('predictions.show', $prediction->id) }}" 
                           class="btn btn-info btn-sm">Detail</a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>