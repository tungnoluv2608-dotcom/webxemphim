<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('packages', function (Blueprint $table) {
            $table->enum('type', ['free', 'premium'])->default('premium')->after('id');
            $table->integer('daily_limit')->nullable()->after('duration_days'); // Giới hạn xem mỗi ngày
            $table->integer('quality_limit')->default(1)->after('daily_limit'); // 1=SD, 2=HD, 3=FullHD, 4=4K
            $table->boolean('ads_enabled')->default(true)->after('quality_limit'); // Có quảng cáo không
            $table->boolean('download_enabled')->default(false)->after('ads_enabled'); // Cho phép tải xuống
        });
    }

    public function down()
    {
        Schema::table('packages', function (Blueprint $table) {
            $table->dropColumn(['type', 'daily_limit', 'quality_limit', 'ads_enabled', 'download_enabled']);
        });
    }
};