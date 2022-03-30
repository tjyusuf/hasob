<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAssignmentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('assignments', function (Blueprint $table) {
            $table->id();
            $table->date('assignment_date');
            $table->boolean('status')->default(true);
            $table->boolean('is_due')->default(false);
            $table->unsignedBigInteger('assigned_user_id')->nullable()->default(null);
            $table->unsignedBigInteger('assigned_by');
            $table->unsignedBigInteger('asset_id');
            $table->timestamps();

            $table->foreign('assigned_user_id')->references('id')->on('users');    
            $table->foreign('assigned_by')->references('id')->on('users');        
            $table->foreign('asset_id')->references('id')->on('assets');        
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('assignments');
    }
}
