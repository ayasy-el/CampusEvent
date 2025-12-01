<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // Check if 'date' column exists and 'start_date' doesn't
        if (Schema::hasColumn('events', 'date') && !Schema::hasColumn('events', 'start_date')) {
            Schema::table('events', function (Blueprint $table) {
                $table->renameColumn('date', 'start_date');
            });
        }

        // Add 'end_date' if it doesn't exist
        if (!Schema::hasColumn('events', 'end_date')) {
            Schema::table('events', function (Blueprint $table) {
                $table->date('end_date')->nullable()->after('start_date');
            });
        }

        // Set end_date = start_date for existing records where end_date is null
        if (Schema::hasColumn('events', 'start_date')) {
            DB::table('events')->whereNull('end_date')->update(['end_date' => DB::raw('start_date')]);
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        if (Schema::hasColumn('events', 'end_date')) {
            Schema::table('events', function (Blueprint $table) {
                $table->dropColumn('end_date');
            });
        }

        if (Schema::hasColumn('events', 'start_date') && !Schema::hasColumn('events', 'date')) {
            Schema::table('events', function (Blueprint $table) {
                $table->renameColumn('start_date', 'date');
            });
        }
    }
};
