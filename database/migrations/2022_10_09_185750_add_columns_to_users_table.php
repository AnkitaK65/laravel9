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
            $table->string('user_type', 25)->after('remember_token')->default('user');
            $table->bigInteger('mobile')->after('user_type')->nullable();
            $table->string('address')->after('mobile')->nullable();
            $table->enum('gender', ['male', 'female'])->after('address')->nullable();
            $table->string('image')->after('gender')->nullable();
            $table->string('cv')->after('image')->nullable();
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
            $table->dropColumn('user_type');
            $table->dropColumn('mobile');
            $table->dropColumn('address');
            $table->dropColumn('gender');
            $table->dropColumn('image');
            $table->dropColumn('cv');
        });
    }
};
