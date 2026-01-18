<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {

    public function up(): void
    {
        Schema::table('payments', function (Blueprint $table) {

            // TAMBAH KOLOM YANG HILANG
            if (!Schema::hasColumn('payments', 'category_id')) {
                $table->unsignedBigInteger('category_id')->after('user_id');
            }

            if (!Schema::hasColumn('payments', 'month')) {
                $table->unsignedTinyInteger('month')->after('category_id');
            }

            if (!Schema::hasColumn('payments', 'year')) {
                $table->unsignedSmallInteger('year')->after('month');
            }

            if (!Schema::hasColumn('payments', 'amount')) {
                $table->integer('amount')->default(0)->after('year');
            }

            if (!Schema::hasColumn('payments', 'status')) {
                $table->enum('status', ['unpaid', 'partial', 'paid'])
                      ->default('unpaid')
                      ->after('amount');
            }

            if (!Schema::hasColumn('payments', 'paid_at')) {
                $table->timestamp('paid_at')->nullable()->after('status');
            }
        });
    }

    public function down(): void
    {
        // sengaja dikosongkan (biar aman)
    }
};
