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
        Schema::create('scholars', function (Blueprint $table) {
            $table->id();
            $table->string('scholar_code')->unique();
            $table->string('institution');
            $table->string('unit');
            $table->string('area');
            $table->string('fullname');
            $table->string('name_of_member');
            $table->string('batch');
            $table->string('scholarship_type');
            $table->string('year_level');
            $table->string('course');
            $table->string('contact');
            $table->string('address');
            $table->string('status');
            $table->string('remarks');
            $table->boolean('account');
            $table->date('month_year')->nullable();
            $table->timestamps(); // Adds created_at and updated_at columns
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('scholars');
    }
};