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
        Schema::create('disbursements', function (Blueprint $table) {
            $table->id();
            $table->string('Scholar_code');
            $table->string('Date');
            $table->string('Date_memo');
            $table->string('MemoNumber');
            $table->decimal('amount', 10, 2);
            $table->decimal('return_cmdi', 10, 2);
            $table->string('remarks')->nullable();
            $table->timestamps();
        });
    }

     /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(): void
    {
        Schema::dropIfExists('disbursements');
    }
};