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
        Schema::table('checkouts', function (Blueprint $table) {
            $table->string('comment')->nullable()->change();          
            $table->integer('kv')->nullable();
            $table->integer('dm')->nullable();
            $table->integer('pd')->nullable();
            $table->integer('et')->nullable();

            $table->integer('payway');
            $table->string('cardnumber')->nullable();
            $table->string('expiry')->nullable();
            $table->string('cvv')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('checkouts', function (Blueprint $table) {
            $table->string('comment')->nullable(false)->change();
            $table->dropColumn('kv');
            $table->dropColumn('dm');
            $table->dropColumn('pd');
            $table->dropColumn('et');
            
            $table->dropColumn('payway');
            $table->dropColumn('cardnumber');
            $table->dropColumn('expiry');
            $table->dropColumn('cvv');
        });
    }
};
