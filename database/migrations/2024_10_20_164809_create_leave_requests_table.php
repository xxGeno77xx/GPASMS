<?php

use App\Enums\StatesClass;
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
        Schema::create('leave_requests', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger("staff_id");
            $table->unsignedBigInteger("leave_reason_id");
            $table->date("startDate");
            $table->date("endDate");
            $table->enum("status", [
                StatesClass::onGoing()->value,
                StatesClass::completed()->value
            ]);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('leave_requests');
    }
};
