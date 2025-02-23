<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class PredictionController extends Controller
{
    public function store(Request $request)
    {
        // Validasi input
        $data = $request->validate([
            'damage' => 'required|string',
            'size' => 'required',
            'repair_time' => 'required|numeric',
            'material' => 'required|string',
            'quantity' => 'required|numeric',
            'quantity_unit' => 'required|string'
        ]);

        // Log data prediksi atau simpan ke database sesuai kebutuhan
        Log::info('Prediction received:', $data);

        // Simpan data ke session agar bisa ditampilkan di view
        session()->flash('prediction', $data);

        return response()->json([
            'message' => 'Prediction received successfully',
            'data' => $data
        ], 200);
    }
}
