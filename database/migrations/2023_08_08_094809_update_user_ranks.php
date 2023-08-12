<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateUserRanks extends Migration
{
    public function up()
    {
        // Update existing users' ranks
        \DB::table('users')->update(['rank' => '1']); // Set admin rank to 1

        // Modify the 'rank' column to be able to store '0' and '1'
        Schema::table('users', function (Blueprint $table) {
            $table->boolean('rank')->default(0)->change();
        });
    }

    public function down()
    {
        // Revert the 'rank' column type change if necessary
        Schema::table('users', function (Blueprint $table) {
            $table->string('rank')->change();
        });
    }
}
