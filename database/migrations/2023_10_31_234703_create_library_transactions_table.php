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
        Schema::create('library_transactions', function (Blueprint $table) {
            $table->id();
            $table->date('borrowing _date');
            $table->date('return_date');
            $table->unsignedBigInteger('book_id');
            $table->unsignedBigInteger('borrower_id');
            $table->foreign('book_id')->references('id')->on('books');
            $table->foreign('borrower_id')->references('id')->on('borrowers');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('library_transactions');
    }
};
