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
        Schema::create('activities', function (Blueprint $table) {
            $table->id();
            $table->string('activity_type'); // loại hoạt động (create, update, delete)
            $table->string('model_type');    // bảng liên quan (User, Post, Category)
            $table->unsignedBigInteger('model_id'); // ID của bản ghi
            $table->text('details'); // Chi tiết thay đổi
            $table->timestamps();
        });
        Schema::table('activities', function (Blueprint $table) {
            $table->string('activity_type')->default('user_creation')->change(); // Cập nhật để có giá trị mặc định
        });
        
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('activities');
    }
    
};