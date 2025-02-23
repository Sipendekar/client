<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('tbl_form', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('province_code');
            $table->string('city_id');
            $table->text('address');
            $table->text('image');
            $table->string('damage_type');
            $table->json('size')->comment('Stored as JSON to handle both diameter and length/width measurements');
            $table->float('repair_time')->comment('Estimated repair time in minutes');
            $table->string('material')->comment('Type of repair material needed');
            $table->float('quantity')->comment('Amount of material needed');
            $table->string('quantity_unit')->comment('Unit of measurement for quantity (kg, L, etc)');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tbl_form');
    }
};
