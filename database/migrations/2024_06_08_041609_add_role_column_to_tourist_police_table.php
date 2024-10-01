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
        Schema::table('tourist_police', function (Blueprint $table) {
            $table->foreignId('role_id')->nullable()->constrained('roles', 'id')->nullOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('tourist_police', function (Blueprint $table) {
            $table->dropConstrainedForeignId('role_id');
        });
    }
};
