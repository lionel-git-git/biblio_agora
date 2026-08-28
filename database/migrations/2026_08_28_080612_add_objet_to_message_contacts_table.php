<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('message_contacts', function (Blueprint $table) {
            $table->string('objet')->after('email');
        });
    }

    public function down(): void
    {
        Schema::table('message_contacts', function (Blueprint $table) {
            $table->dropColumn('objet');
        });
    }
};