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
        Schema::create('monthly__budgets', function (Blueprint $table) {
            $table->id();
            $table->date('month_year');
            $table->decimal('monthly_income', 10, 3);
            $table->decimal('total_expenses', 10, 2);
            $table->decimal('balance', 10, 2);
            $table->text('notes')->nullable(); 
            $table->timestamps();


            $table->unsignedBigInteger('user_id');

            $table->foreign('user_id')
                ->references('id')
                ->on('users')
                ->onUpdate('cascade')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('monthly__budgets');
    }
};
