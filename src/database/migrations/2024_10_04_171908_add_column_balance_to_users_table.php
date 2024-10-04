<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('users', fn(Blueprint $table) => $table
            ->decimal('balance', 64, 0)->default(0));
    }

    public function down(): void
    {
        Schema::table('users', fn(Blueprint $table) => $table
            ->dropColumn('balance'));
    }
};
