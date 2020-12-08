<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReceivingListsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('receiving_lists', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('PO');
            $table->string('Total_Amount');
            $table->string('Created_by');
            $table->string('Status');
            $table->string('Reviewed_by');
            $table->string('ReceivingCode');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('receiving_lists');
    }
}
