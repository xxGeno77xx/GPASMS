<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('notations', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger("staff_id")->constrained(table: 'staff');
            $table->date("period")->nullable();

            $table->unsignedBigInteger("firstValidator")->nullable()->constrained(table: "staff");
            $table->unsignedBigInteger("secondValidator")->nullable()->constrained(table: "staff");
            $table->unsignedBigInteger("thirdValidator")->nullable()->constrained(table: "staff");

            // Notes chef immediat Chef section
            $table->double("assiduite1")->nullable();
            $table->double("commerciale1")->nullable();
            $table->double("connaissance1")->nullable();
            $table->double("encadrement1")->nullable();
            $table->double("promptitude1")->nullable();
            // Notes chef hierarchique suivant chef Division
            $table->double("assiduite2")->nullable();
            $table->double("commerciale2")->nullable();
            $table->double("connaissance2")->nullable();
            $table->double("encadrement2")->nullable();
            $table->double("promptitude2")->nullable();
            // Notes chef hierarchique suivant Directeur

            $table->double("assiduite3")->nullable();
            $table->double("commerciale3")->nullable();
            $table->double("connaissance3")->nullable();
            $table->double("encadrement3")->nullable();
            $table->double("promptitude3")->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('notations');
    }
};
