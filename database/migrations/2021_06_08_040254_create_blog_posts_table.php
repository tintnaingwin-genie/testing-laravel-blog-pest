<?php

use App\Models\Enums\BlogPostStatus;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBlogPostsTable extends Migration
{
    public function up()
    {
        Schema::create('blog_posts', function (Blueprint $table) {
            $table->id();

            $table->string('title');
            $table->string('slug');
            $table->string('author');
            $table->timestamp('date');
            $table->longText('body');
            $table->integer('likes')->default(0);
            $table->string('status')->default(BlogPostStatus::DRAFT()->value);

            $table->timestamps();

            $table->unique('slug');
            $table->index('date');
        });
    }
}
