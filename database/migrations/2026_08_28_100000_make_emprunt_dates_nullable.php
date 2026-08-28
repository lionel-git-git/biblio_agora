<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('emprunts', function (Blueprint $table) {
            $table->date('date_emprunt')->nullable()->change();
            $table->date('date_retour_prevue')->nullable()->change();
        });
    }

    public function down(): void
    {
        Schema::table('emprunts', function (Blueprint $table) {
            $table->date('date_emprunt')->nullable(false)->change();
            $table->date('date_retour_prevue')->nullable(false)->change();
        });
    }
};
