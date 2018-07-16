<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

class CreateBasicAuthTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('basic_auth', function (Blueprint $table) {
            $table->Uuid('id');
            $table->string('name');
            $table->string('email')->unique();
            $table->string('password');
            $table->string('user_agent')->nullable();
            $table->string('access_token')->unique();
            $table->string('refresh_token')->unique();
            $table->bigInteger('expire')->default(36000);
            $table->string('app_id')->unique();
            $table->timestamp('created_at')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->timestamp('updated_at')->default(DB::raw('CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP'));
            $table->primary('id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('basic_auth');
    }
}
