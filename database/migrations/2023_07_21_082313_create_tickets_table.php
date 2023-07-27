<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTicketsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tickets', function (Blueprint $table) {
            $table->id();
            $table->string('full_name');
            $table->foreignId('zone_id')->nullable()->references('id')->on('zones')->nullOnDelete();
            $table->foreignId('post_id')->nullable()->references('id')->on('posts')->nullOnDelete();
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users');
            $table->string('email');
            $table->string('number');
            $table->string('age');
            $table->string('people');
            $table->string('zone');
            $table->string('zone_price');
            $table->string('total_price');
            $table->string('ticket_code')->unique()->nullable();
            $table->string('status')->default('pending');
            $table->string('is_approved')->default(2); //1->approved 2->not approved
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
        Schema::dropIfExists('tickets');
        Schema::table('tickets', function (Blueprint $table) {
            $table->dropColumn('status');
        });
    }
}
