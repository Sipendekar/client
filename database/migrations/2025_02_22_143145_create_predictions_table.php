<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePredictionsTable extends Migration
{
    public function up()
    {
        Schema::create('predictions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('form_id')->constrained('tbl_form')->onDelete('cascade'); // Sesuaikan dengan nama tabel
            $table->string('damage_type');
            $table->json('size')->comment('Stored as JSON to handle both diameter and length/width measurements');
            $table->float('repair_time')->comment('Estimated repair time in minutes');
            $table->string('material')->comment('Type of repair material needed');
            $table->float('quantity')->comment('Amount of material needed');
            $table->string('quantity_unit')->comment('Unit of measurement for quantity (kg, L, etc)');
            $table->timestamps();
            $table->index('form_id');
        });
        
    }

    public function down()
    {
        Schema::dropIfExists('predictions');
    }
}