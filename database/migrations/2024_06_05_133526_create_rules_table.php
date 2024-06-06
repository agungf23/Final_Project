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
        Schema::create('rules', function (Blueprint $table) {
            $table->id();
            $table->integer('rule_cluster_id');
            $table->foreignId('sensor_id')->constrained('datas');
            $table->enum('sensor_operator', ['more than', 'less than']);
            $table->float('sensor_value');
            $table->foreignId('actuator_id')->constrained('devices');
            $table->integer('actuator_value');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('rules');
    }
};
