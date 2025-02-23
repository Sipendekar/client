<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Client;
use App\Models\Form;
use Laravolt\Indonesia\Indonesia;
use Illuminate\Support\Facades\Log;

class FormController extends Controller
{
    public function index()
    {
        $provinces = \Indonesia::allProvinces();
        $prediction = session('prediction', [
            'damage' => '',
            'size' => [],
            'repair_time' => '',
            'material' => '',
            'quantity' => '',
            'quantity_unit' => ''
        ]);
        return view('content.form', compact('provinces', 'prediction'));
    }

    public function store(Request $request)
    {
        // Validasi input form
        $request->validate([
            'name'=>'required',
            'province_code' => 'required',
            'city_id' => 'required',
            'address' => 'required',
            'image' => 'required',
        ]);

        $file = $request->file('image');
        
        // Buat request ke Flask API untuk prediksi
        $client = new Client();
        $response = $client->post('http://localhost:5000/predict', [
            'multipart' => [
                [
                    'name' => 'image',
                    'contents' => fopen($file->getPathname(), 'r'),
                ]
            ]
        ]);
        $prediction = json_decode($response->getBody(), true);

        // Simpan file gambar
        $nama_file = time()."_".$file->getClientOriginalName();
        $tujuan_upload = 'road_image';
        $file->move($tujuan_upload, $nama_file);

        // Simpan data form dan prediksi ke database (misal, tabel "tbl_form")
        $form = Form::create([
            'name' => $request->name,
            'province_code' => $request->province_code,
            'city_id' => $request->city_id,
            'address' => $request->address,
            'image' => $nama_file,
            'damage_type' => $prediction['damage'],
            'size' => json_encode($prediction['size']),
            'repair_time' => $prediction['repair_time'],
            'material' => $prediction['material'],
            'quantity' => $prediction['quantity'],
            'quantity_unit' => $prediction['quantity_unit']
        ]);

        return redirect()->route('form')->with([
            'prediction' => $prediction,
            'success' => 'Data Berhasil Dibuat.'
        ]);
    }
}
