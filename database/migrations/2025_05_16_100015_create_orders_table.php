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
        Schema::create('orders', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('type_id');
            $table->unsignedBigInteger('partnership_id');
            $table->unsignedBigInteger('user_id');

            $table->foreign('type_id')->references('id')->on('order_types');
            $table->foreign('partnership_id')->references('id')->on('partnerships');
            $table->foreign('user_id')->references('id')->on('users');

            $table->text('description');
            $table->timestamp('date');
            $table->string('address');
            $table->unsignedInteger('amount');
            $table->enum('status', ['Создан', 'Назначен исполнитель', 'Завершен'])->default('Создан');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->dropConstrainedForeignId('type_id');
            $table->dropConstrainedForeignId('partnership_id');
            $table->dropConstrainedForeignId('user_id');
        });

        Schema::dropIfExists('orders');
    }
};
