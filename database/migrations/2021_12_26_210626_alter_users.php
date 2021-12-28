<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterUsers extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->enum('roles', ['Administrador', 'Customer'])->after('remember_token'); 
            $table->enum('status', ['active', 'inactive'])->default('active')->after('roles'); 
            $table->softDeletes()->after('updated_at');
        });
    }

    
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('roles');
            $table->dropColumn('status');
            $table->dropColumn('deleted_at');
        });
    }
}
