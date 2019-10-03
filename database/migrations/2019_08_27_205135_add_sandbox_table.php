<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddSandboxTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sandbox', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedInteger('admin_user_id')->index();
            $table->string('name')->index();
            $table->string('origin')->index();
            $table->boolean('voucher')->index()->default(0);
            $table->nullableTimestamps();
            $table->index(['created_at', 'updated_at']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('sandbox');
    }
}
