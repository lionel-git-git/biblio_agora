<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('catalogues', function (Blueprint $table) {
            $table->id();
            $table->string('nom')->unique();
            $table->text('description')->nullable();
            $table->timestamps();
        });

        Schema::table('livres', function (Blueprint $table) {
            $table->foreignId('catalogue_id')->nullable()->after('id')->constrained()->nullOnDelete();
            $table->string('statut')->default('disponible')->after('genre');
        });
    }

    public function down(): void
    {
        Schema::table('livres', function (Blueprint $table) {
            $table->dropConstrainedForeignId('catalogue_id');
            $table->dropColumn('statut');
        });

        Schema::dropIfExists('catalogues');
    }
};
