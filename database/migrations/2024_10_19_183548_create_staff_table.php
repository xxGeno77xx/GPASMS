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
        Schema::create('staff', function (Blueprint $table) {
            $table->id();
            $table->string("legacy_id");
            $table->string("name");
            $table->string("gender");
            $table->string('email')->unique();
            $table->date("birthDate")->nullable();
            $table->date("hireDate")->nullable();
            $table->unsignedBigInteger("affectation_id")->nullable()->constrained(table:"affectations");
            $table->unsignedBigInteger("post_id")->nullable()->constrained(table:"posts");
            $table->string("phoneNumber")->nullable();
            $table->string("group")->nullable();
            $table->string("function")->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('staff');
    }
};
