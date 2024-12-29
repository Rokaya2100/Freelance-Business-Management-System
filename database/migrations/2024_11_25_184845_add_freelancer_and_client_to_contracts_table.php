<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::table('contracts', function (Blueprint $table) {
            $table->foreignId('freelancer_id')->constrained('users')->onDelete('cascade')->after('project_id');
            $table->foreignId('client_id')->constrained('users')->onDelete('cascade')->after('freelancer_id');
        });
    }

    public function down()
    {
        Schema::table('contracts', function (Blueprint $table) {
            $table->dropForeign(['freelancer_id']);
            $table->dropColumn('freelancer_id');
            $table->dropForeign(['client_id']);
            $table->dropColumn('client_id');
        });
    }

};