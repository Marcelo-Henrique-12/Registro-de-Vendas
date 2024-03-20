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
        Schema::create('parcelas', function (Blueprint $table) {
            $table->id();
            $table->integer('quantidade');
            $table->integer('numero_parcela');
            $table->decimal('valor', 8, 2);
            $table->date('data_vencimento');
            $table->foreignId('venda_id')->constrained('vendas')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('parcelas', function (Blueprint $table) {
            $table->dropForeign(['venda_id']);
        });
        Schema::dropIfExists('parcelas');
    }
};
