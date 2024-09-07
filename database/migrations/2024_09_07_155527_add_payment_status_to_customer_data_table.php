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
        Schema::table('customer_data', function (Blueprint $table) {
            $table->string('payment_status')->default('pending'); // Add the payment_status column with a default value

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('customer_data', function (Blueprint $table) {
            $table->dropColumn('payment_status'); // Drop the column if the migration is rolled back
        });
    }
};
