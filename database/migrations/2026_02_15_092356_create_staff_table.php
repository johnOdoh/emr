<?php

use App\Enums\Departments;
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
            //personal details
            $table->string('surname');
            $table->string('firstname');
            $table->string('middlename')->nullable();
            $table->string('marital_status');
            $table->string('gender');
            $table->string('phone');
            $table->string('address');
            $table->string('email')->unique();
            $table->string('cv')->nullable();
            $table->string('id_document')->nullable();
            $table->json('emergency_contact_details');

            //employment details
            $table->string('job_title');
            $table->enum('department', Departments::toArray())->default(Departments::NURSE->value);
            $table->string('employment_status');
            $table->string('employment_type');
            $table->timestamp('employment_date');

            //payment details
            $table->decimal('salary', 10, 2);
            $table->json('account_details')->nullable();
            $table->string('payment_frequency')->default('Monthly');
            $table->string('tin');

            //leave
            $table->json('annual_leave')->nullable();
            $table->json('sick_leave')->nullable();

            //compliance
            $table->string('employment_contract')->nullable();
            $table->string('nda')->nullable();
            $table->json('work_authorization')->nullable();
            $table->json('certifications')->nullable();
            $table->string('background_check_status')->default('Pending');

            //performance
            $table->json('performance_reviews')->nullable();
            $table->json('disciplinary_records')->nullable();
            $table->json('training_records')->nullable();
            $table->json('promotion_history')->nullable();
            $table->json('skills')->nullable();

            //termination details
            $table->timestamp('termination_date')->nullable();
            $table->string('termination_reason')->nullable();
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
