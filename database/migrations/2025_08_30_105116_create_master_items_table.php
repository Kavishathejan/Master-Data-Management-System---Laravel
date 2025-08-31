<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('master_items', function (Blueprint $table) {
            $table->id();
            $table->foreignId('brand_id')->constrained('master_brands')->onDelete('cascade');
            $table->foreignId('category_id')->constrained('master_categories')->onDelete('cascade');
            $table->string('code')->unique();
            $table->string('name');
            $table->string('attachment')->nullable();
            $table->enum('status', ['Active', 'Inactive'])->default('Active');
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('master_items');
    }
};