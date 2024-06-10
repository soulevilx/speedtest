<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('speedtests', function (Blueprint $table) {
            $table->id();
            $table->uuid()->unique();

            $table->json('ping');
            $table->json('download');
            $table->json('upload');
            $table->float('packetLoss')->nullable();
            $table->string('isp')->index();
            $table->json('interface');
            $table->json('server');
            $table->json('result');

            $table->unsignedBigInteger('download_speed')->index();
            $table->unsignedBigInteger('upload_speed')->index();

            $table->string('internal_ip')->index();
            $table->string('external_ip')->index();

            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('speedtests');
    }
};
