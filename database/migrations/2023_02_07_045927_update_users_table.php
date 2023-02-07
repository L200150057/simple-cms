<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->date('photo')->after('email')->nullable();
            $table->date('date_of_birth')->after('photo')->nullable();
            $table->string('gender')->after('date_of_birth')->nullable();
            $table->text('address')->after('gender')->nullable();
            $table->string('role')->after('address')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('date_of_birth');
            $table->dropColumn('gender');
            $table->dropColumn('role');
            $table->dropColumn('address');
        });
    }
};
