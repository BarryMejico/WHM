<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePoListsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('po_lists', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('PO');
            $table->string('Total_Amount');
            $table->string('Created_by');
            $table->string('Status');
            $table->string('Reviewed_by');
            $table->string('Vendor');
            $table->string('Ship_to');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('po_lists');
    }
}
