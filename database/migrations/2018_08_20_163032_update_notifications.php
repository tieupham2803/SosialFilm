<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateNotifications extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (Schema::hasColumn('notifications', 'read')) {
        } else {
            Schema::table('notifications', function ($table) {
                $table->integer('read');
            });
        }

        if (Schema::hasColumn('notifications', 'click')) {
        } else {
            Schema::table('notifications', function ($table) {
                $table->integer('click');
            });
        }

        if (Schema::hasColumn('notifications', 'type_id')) {
        } else {
            Schema::table('notifications', function ($table) {
                $table->integer('type_id');
            });
        }

        Schema::table('notifications', function ($table) {
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
