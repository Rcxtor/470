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
        Schema::create('product', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('brand');
            $table->string('price');
            $table->string('type');
            $table->timestamps();
        });

        Schema::create('processor', function (Blueprint $table) {
            $table->id();
            $table->foreignId('processor_id')->constrained('product')->onDelete('cascade');
            $table->string('gen');
            $table->integer('core');
            $table->string('socket');
        });

        Schema::create('motherboard', function (Blueprint $table) {
            $table->id();
            $table->foreignId('motherboard_product_id')->constrained('product')->onDelete('cascade');
            $table->string('gen');
            $table->string('processor');
            $table->string('socket');
            $table->string('ramtype');
        });

        Schema::create('ram', function (Blueprint $table) {
            $table->id();
            $table->foreignId('ram_product_id')->constrained('product')->onDelete('cascade');
            $table->string('capacity');
            $table->string('ramtype');
            $table->string('speed');
        });

        Schema::create('gpu', function (Blueprint $table) {
            $table->id();
            $table->foreignId('gpu_id')->constrained('product')->onDelete('cascade');
            $table->string('chipset');
            $table->string('memory');
        });

        Schema::create('case', function (Blueprint $table) {
            $table->id();
            $table->foreignId('case_id')->constrained('product')->onDelete('cascade');
            $table->string('color');

        });

        Schema::create('storage', function (Blueprint $table) {
            $table->id();
            $table->foreignId('storage_id')->constrained('product')->onDelete('cascade');
            $table->string('interface');
            $table->string('capacity');

        });

        Schema::create('monitor', function (Blueprint $table) {
            $table->id();
            $table->foreignId('monitor_id')->constrained('product')->onDelete('cascade');
            $table->string('size');
            $table->string('panel');
            $table->string('rate');
            $table->string('resolution');
        });

        Schema::create('accessories', function (Blueprint $table) {
            $table->id();
            $table->foreignId('acce_id')->constrained('product')->onDelete('cascade');
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('accessories', function (Blueprint $table) {
            $table->dropForeign(['acce_id']);
        });

        Schema::dropIfExists('accessories');

        Schema::table('monitor', function (Blueprint $table) {
            $table->dropForeign(['monitor_id']);
        });

        Schema::dropIfExists('monitor');

        Schema::table('storage', function (Blueprint $table) {
            $table->dropForeign(['storage_id']);
        });

        Schema::dropIfExists('storage');

        Schema::table('case', function (Blueprint $table) {
            $table->dropForeign(['case_id']);
        });

        Schema::dropIfExists('case');

        Schema::table('gpu', function (Blueprint $table) {
            $table->dropForeign(['gpu_id']);
        });

        Schema::dropIfExists('gpu');

        Schema::table('ram', function (Blueprint $table) {
            $table->dropForeign(['ram_product_id']);
        });

        Schema::dropIfExists('ram');

        Schema::table('motherboard', function (Blueprint $table) {
            $table->dropForeign(['motherboard_product_id']);
        });

        Schema::dropIfExists('motherboard');

        Schema::table('processor', function (Blueprint $table) {
            $table->dropForeign(['processor_id']);
        });

        Schema::dropIfExists('processor');

        Schema::dropIfExists('product');
    }
};
