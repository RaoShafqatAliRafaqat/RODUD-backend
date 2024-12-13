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
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            
            $table->boolean('is_active')->default(1);
            $table->string('title');
            $table->string('location');
            $table->string('size');
            $table->decimal('weight', 8, 2);
            $table->timestamp('pickup_time');
            $table->timestamp('delivery_time');
            $table->enum('status',['pending','in_progress','delivered'])->default('pending');
            $table->foreignId('created_by')->constrained('users','id')->onDelete('cascade');
            $table->foreignId('updated_by')->nullable()->constrained('users','id')->onDelete('cascade');
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->useCurrentOnUpdate()->useCurrent();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
