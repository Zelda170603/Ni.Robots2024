<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('video_calls', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('from_user_id');
            $table->unsignedBigInteger('to_user_id');
            $table->string('call_type')->default('telehealth'); // 'telehealth' | 'presential'
            $table->string('channel_name');
            $table->string('status')->default('ringing'); // ringing | accepted | ended
            $table->timestamp('expires_at')->nullable();
            $table->timestamps();

            $table->index(['to_user_id', 'status']);
            $table->index(['from_user_id']);
        });
    }
    public function down(): void {
        Schema::dropIfExists('video_calls');
    }
};
