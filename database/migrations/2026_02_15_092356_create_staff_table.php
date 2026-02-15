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
        Schema::create('staff', function (Blueprint $table) {
            $table->id();
            $table->string('surname');
            $table->string('firstname');
            $table->string('middlename')->nullable();
            $table->string('marital_status');
            $table->string('gender');
            $table->string('phone');
            $table->string('address');
            $table->string('email');
            $table->json('emergency_contact_details');
            $table->string('job_title');
            $table->string('department');
            $table->string('role');
            $table->string('employment_status');
            $table->string('employment_type');
            $table->decimal('salary', 10, 2);
            $table->json('account_details')->nullable();
            $table->string('payment_frequency')->default('Monthly');
            $table->timestamp('employment_date');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('staff');
    }
};
