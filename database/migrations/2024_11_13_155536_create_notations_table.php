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
            
            // Notes chef immediat Chef section
            $table->double("note_a")->nullable();
            $table->double("note_b")->nullable();
            $table->double("note_c")->nullable();
            $table->double("note_d")->nullable();
            $table->double("note_e")->nullable();
            // Notes chef hierarchique suivant chef Division
            $table->double("note_f")->nullable();
            $table->double("note_g")->nullable();
            $table->double("note_h")->nullable();
            $table->double("note_i")->nullable();
            $table->double("note_j")->nullable();
            // Notes chef hierarchique suivant Directeur

            $table->double("note_k")->nullable();
            $table->double("note_l")->nullable();
            $table->double("note_m")->nullable();
            $table->double("note_n")->nullable();
            $table->double("note_o")->nullable();
            // Notes chef hierarchique suivant DG?

            $table->double("note_p")->nullable();
            $table->double("note_q")->nullable();
            $table->double("note_r")->nullable();
            $table->double("note_s")->nullable();
            $table->double("note_t")->nullable();

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
