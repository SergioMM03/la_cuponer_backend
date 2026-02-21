<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('offers', function (Blueprint $table) {
            $table->id();
            $table->foreignId('company_id')->constrained()->cascadeOnDelete();
            $table->string('title');
            $table->decimal('regular_price', 10, 2);
            $table->decimal('offer_price', 10, 2);
            $table->date('start_date');
            $table->date('end_date');
            $table->date('limit_date');
            $table->integer('coupon_limit')->nullable();
            $table->text('description');
            $table->text('details');
            $table->string('status'); // pending, approved, etc
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('offers');
    }
};
