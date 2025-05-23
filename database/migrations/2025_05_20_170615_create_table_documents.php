<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * Class DB Migration (Documents)
 * @author Marylyn Lajato <flippie.cute@gmail.com>
 * @since May 20, 2025
 */
return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('documents', function (Blueprint $table) {
            $table->id();
            $table->string('doc_type', 125)->nullable();
            $table->integer('doc_user_id');
            $table->dateTime('doc_signed_at')->nullable();
            $table->string('doc_gdrive_resource_id', 255)->nullable();
            $table->timestamps();
            $table->dateTime('deleted_at')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('documents');
    }
};
