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
        Schema::table('emaillogs', function (Blueprint $table) {
            $table->bigInteger('invitation_id')->unsigned()->nullable()->change();
            $table->foreignId('notification_id')->nullable()->constrained()->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('emaillogs', function (Blueprint $table) {
            $table->integer('invitation_id')->unsigned()->change();
            $table->dropColumn('notification_id');
            
        });
    }
};
