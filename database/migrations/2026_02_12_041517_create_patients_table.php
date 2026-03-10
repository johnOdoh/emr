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
        Schema::create('patients', function (Blueprint $table) {
            $table->id();
            $table->string('patient_code')->unique();
            $table->string('name');
            $table->string('gender');
            $table->string('address');
            $table->string('phone');
            $table->float('weight');
            $table->float('height');
            $table->string('spo2');
            $table->string('blood_group');
            $table->string('genotype');
            $table->string('primary_diagnosis')->nullable();
            $table->string('disability')->nullable();
            $table->text('complaints')->nullable();
            $table->text('medical_history')->nullable();
            $table->json('allergies')->nullable();
            $table->json('chronic_conditions')->nullable();
            $table->json('current_medications')->nullable();
            $table->json('lab_results')->nullable();
            $table->timestamp('dob');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('patients');
    }
};
