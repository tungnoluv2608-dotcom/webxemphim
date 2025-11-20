<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up()
    {
        // Tắt foreign key checks
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');

        // Danh sách bảng cần xóa
        $tables = [
            'tracker_agents',
            'tracker_connections',
            'tracker_cookies',
            'tracker_devices',
            'tracker_domains',
            'tracker_errors',
            'tracker_events',
            'tracker_events_log',
            'tracker_geoip',
            'tracker_languages',
            'tracker_log',
            'tracker_paths',
            'tracker_queries',
            'tracker_query_arguments',
            'tracker_referers',
            'tracker_referers_search_terms',
            'tracker_routes',
            'tracker_route_paths',
            'tracker_route_path_parameters',
            'tracker_sessions',
            'tracker_sql_queries',
            'tracker_sql_queries_log',
            'tracker_sql_query_bindings',
            'tracker_sql_query_bindings_parameters',
            'tracker_system_classes',
        ];

        foreach ($tables as $table) {
            DB::statement("DROP TABLE IF EXISTS `{$table}`");
        }

        // Bật lại foreign key checks
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
    }

    public function down()
    {
        throw new Exception('Cannot reverse this migration');
    }
};