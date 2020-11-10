<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddFieldsToPoDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('po_details', function (Blueprint $table) {
            $table->string('Icode');
            $table->string('Qty');
            $table->string('UnitCost');
            $table->string('PO');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('po_details', function (Blueprint $table) {
            //
        });
    }
}
