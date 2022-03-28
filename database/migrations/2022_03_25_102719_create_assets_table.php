<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAssetsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('assets', function (Blueprint $table) {
            $table->id();
            $table->string('type');
            $table->integer('serial');
            $table->text('description')->nullable();
            $table->boolean('movable')->default(false);
            $table->string('picture_path')->nullable()->default(null);
            $table->date('purchase');
            $table->date('start_use');
            $table->date('warranty_expiry');
            $table->integer('degradation_in_years');
            $table->float('purchase_price');
            $table->float('current_value');
            $table->string('location');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('assets');
    }
}
