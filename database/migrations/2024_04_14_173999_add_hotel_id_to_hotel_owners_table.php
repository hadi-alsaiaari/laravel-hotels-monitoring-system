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
        Schema::table('hotel_owners', function (Blueprint $table) {
            $table->foreignId('hotel_id')->nullable()->after('id')->constrained('hotels', 'id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('hotel_owners', function (Blueprint $table) {
            $table->dropConstrainedForeignId('hotel_id');
        });
    }
};
