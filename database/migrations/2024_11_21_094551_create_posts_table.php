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
        Schema::create('posts', function (Blueprint $table) {
            $table->id();
            $table->string('title');  // Tên bài viết
            $table->text('content');  // Nội dung bài viết
            $table->string('author')->nullable();  // Tác giả bài viết (nếu có)
           
            $table->timestamps();  // Thời gian tạo và cập nhật
        });
        Schema::table('posts', function (Blueprint $table) {
            $table->string('image')->nullable()->after('content');
        });
    }

    public function down()
    {
        Schema::dropIfExists('posts');
    }
};