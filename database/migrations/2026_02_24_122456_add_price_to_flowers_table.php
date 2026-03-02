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
       Schema::table('flowers', function (Blueprint $table) {
        $table->integer('price')->after('name'); // или decimal('price', 8, 2), если нужна цена с копейками
    });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
         Schema::table('flowers', function (Blueprint $table) {
        $table->dropColumn('price');
    });
    }
};
