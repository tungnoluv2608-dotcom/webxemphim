<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        
        // Chỉ xóa bảng tracker cuối cùng
        if (Schema::hasTable('tracker_sql_query_bindings_parameters')) {
            Schema::dropIfExists('tracker_sql_query_bindings_parameters');
        }
        
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
    }

    public function down()
    {
        // Không reverse được
        throw new Exception('Cannot reverse this migration');
    }
};