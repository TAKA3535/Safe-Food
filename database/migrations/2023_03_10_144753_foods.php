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
        Schema::create('foods', function (Blueprint $table) {
            $table->id();
            $table->string('info', 50)->nullable();
            // $table->unsignedBigInteger('image_id');
            // $table->foreignId('image_id')->constrained('images');
            $table->string('image', 200)->nullable();
            // $table->unsignedBigInteger('category_id');
            $table->foreignId('category_id')->constrained('categories');
            $table->date('limit');
            $table->date('alert');
            // $table->unsignedBigInteger('user_id');
            // foreign()メソッドの引数に外部キーであるuser_id,on()メソッドの引数には参照先のテーブルusers,references()メソッドの引数には外部キーuser_idと紐つくusersテーブルのidを指定
            $table->foreignId('user_id')->constrained('users');

            // $table->foreignId('image_id')->references('id')->on('images');
            // $table->foreignId('category_id')->references('id')->on('categories');
            // $table->foreignId('user_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('foods');
    }
};
