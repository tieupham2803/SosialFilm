<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateCommentsTable extends Migration
{
    public function up()
    {
        if (Schema::hasColumn('comments', 'commentable_type')) {
        } else {
            Schema::table('comments', function ($table) {
                $table->string('commentable_type');
            });
        }

        if (Schema::hasColumn('comments', 'commentable_id')) {
        } else {
            Schema::table('comments', function ($table) {
                $table->integer('commentable_id')->unsigned();
            });
        }

        if (Schema::hasColumn('comments', 'review_id')) {
            Schema::table('comments', function ($table) {
                $table->dropColumn('review_id');
            });
        }
    }

    public function down()
    {
        Schema::table('comments', function ($table) {
            $table->dropColumn('commentable_type');
            $table->dropColumn('commentable_id');
            $table->integer('review_id');
        });
    }
}
