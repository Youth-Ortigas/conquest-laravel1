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
        Schema::table('users', function (Blueprint $table) {
            $table->string('email')->nullable()->after('name');
            $table->string('first_name')->after('reg_code');
            $table->string('last_name')->after('first_name');
            $table->string('type_id')->after('last_name');
            $table->datetime('deleted_at')->nullable()->after('updated_at');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('email');
            $table->dropColumn('first_name');
            $table->dropColumn('last_name');
            $table->dropColumn('type_id');
            $table->dropColumn('deleted_at');
        });
    }
};
