<?php

use App\Models\Enums\ExternalPostStatus;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateExternalPostsTable extends Migration
{
    public function up()
    {
        Schema::create('external_posts', function (Blueprint $table) {
            $table->id();

            $table->string('url');
            $table->string('domain');
            $table->string('title');
            $table->string('date');
            $table->string('status')->default(ExternalPostStatus::PENDING()->value);

            $table->timestamps();
        });
    }
}
