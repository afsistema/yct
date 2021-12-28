<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterNumbers extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('numbers', function (Blueprint $table) {
            $table->integer('status_preferences')->after('deleted_at')->default(0);             
        });
    }

    
    public function down()
    {
        Schema::table('numbers', function (Blueprint $table) {
            $table->dropColumn('status_preferences');            
        });
    }
}
