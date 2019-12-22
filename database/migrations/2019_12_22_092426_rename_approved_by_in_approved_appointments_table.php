<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class RenameApprovedByInApprovedAppointmentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('approved_appointments', function (Blueprint $table) {
            $table->renameColumn('approved_by', 'approved_by_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('approved_appointments', function (Blueprint $table) {
            $table->renameColumn('approved_by_id','approved_by');
        });
    }
}
