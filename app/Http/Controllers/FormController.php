<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Form;

class FormController extends Controller
{

    public function index()
    {
        //
    }
    public function create()
    {
        $provinces = \Laravolt\Indonesia\Models\Province::all();
        return view('content.form', [
            'provinces' => $provinces
        ]);
    }
    public function store(Request $request)
    {
        $request->validate([
            'name'=>'required',
            'province_code' => 'required',
            'city_id' => 'required',
            'address' => 'required',
            'image' => 'required',
        ]);

        $file = $request->file('image');
        $nama_file = time()."_".$file->getClientOriginalName();

        $tujuan_upload = 'road_image';
        $file->move($tujuan_upload, $nama_file);

        $form = Form::create([
            'name' => $request->name,
            'description' => $request->description,
            'province_code' => $request->province_code,
            'city_id' => $request->city_id,
            'address' => $request->address,
            'image' =>$nama_file,
        ]);
        return redirect()->route('form') ->with('success','Data Berhasil Dibuat.');

    }
}
