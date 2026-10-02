<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('exports', function (Blueprint $table) {
            $table->string('file_type')->after('file_name');
            $table->integer('attempt_number')->after('file_type')->nullable();
            $table->string('type')->after('file_type')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('exports', function (Blueprint $table) {
            $table->dropColumn('file_type');
            $table->dropColumn('attempt_number');
            $table->dropColumn('type');
        });
    }
};
