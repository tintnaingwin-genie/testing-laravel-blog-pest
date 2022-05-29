<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBlogPostLikesTable extends Migration
{
    public function up()
    {
        Schema::create('blog_post_likes', function (Blueprint $table) {
            $table->id();

            $table->uuid('liker_uuid');
            $table->bigInteger('blog_post_id');

            $table->unique(['blog_post_id', 'liker_uuid']);

            $table->timestamps();
        });
    }
}
