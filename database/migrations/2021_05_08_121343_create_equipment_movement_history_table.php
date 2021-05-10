<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEquipmentMovementHistoryTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('equipment_movement_history', function (Blueprint $table) {
            $table->id();
            $table->integer('equipment_id');
            $table->date('date_send');
            $table->date('date_accept')->nullable();
            $table->integer('from_warehouse_id');
            $table->integer('to_warehouse_id');
            $table->integer('founder_warehouse_id');
            $table->integer('status');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('equipment_movement_history');
    }
}
