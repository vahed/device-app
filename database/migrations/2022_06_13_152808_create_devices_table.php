<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Ramsey\Uuid\Uuid;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('devices', function (Blueprint $table) {
            $table->string('id', 100)->unique();
            $table->char('model', 50);
            $table->char('brand', 50);
            $table->string('release_date', 50)->nullable();
            $table->char('os', 50)->nullable();
            $table->boolean('is_new')->nullable();
            $table->date('received_datatime')->nullable();
            $table->date('created_datetime')->useCurrent();
            $table->date('update_datetime')->useCurrentOnUpdate();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('devices');
    }
};
