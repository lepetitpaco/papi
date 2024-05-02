<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class FixSpendingsColumns extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('spendings', function (Blueprint $table) {
            // Rename incorrect column names
            $table->renameColumn('categorie', 'category');
            $table->renameColumn('intitule', 'title');
            $table->renameColumn('montant', 'amount');
            $table->renameColumn('preleve', 'withdrawn');
            // Add more renameColumn statements if needed
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('spendings', function (Blueprint $table) {
            // Reverse the renaming of columns
            $table->renameColumn('category', 'categorie');
            $table->renameColumn('title', 'intitule');
            $table->renameColumn('amount', 'montant');
            $table->renameColumn('withdrawn', 'preleve');
            // Add more renameColumn statements if needed
        });
    }
}
