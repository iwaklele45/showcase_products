<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (Schema::hasTable('categories')) {
            $driver = Schema::getConnection()->getDriverName();

            if ($driver === 'pgsql') {
                DB::statement('ALTER TABLE categories DROP CONSTRAINT IF EXISTS categories_name_unique');
            } else {
                Schema::table('categories', function (Blueprint $table) {
                    $table->dropUnique('categories_name_unique');
                });
            }
        }
    }

    public function down(): void
    {
        if (Schema::hasTable('categories')) {
            Schema::table('categories', function (Blueprint $table) {
                $table->unique('name');
            });
        }
    }
};
