<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMediaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('media', function (Blueprint $table) {
            $table->id();
            $table->string('video_id',16)->nullable()->comment('阿里云点播id');
            $table->string('name',64)->comment('名称');
            $table->string('conversions_disk',32)->nullable()->comment('驱动');
            $table->string('mime_type',32)->comment('类型');
            $table->string('path',255)->nullable()->comment('图片地址');
            $table->integer('size')->default(0)->comment('大小');
            $table->integer('duration')->default(0)->comment('时间长度');
            $table->text('extend')->nullable()->comment('扩展字段');
            $table->timestamps();
        });

        Schema::create('media_relation', function (Blueprint $table) {
            $table->id();
            $table->integer('media_id')->nullable()->comment('媒体ID');
            $table->morphs('target');
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
        Schema::dropIfExists('media');
        Schema::dropIfExists('media_relation');
    }
}
