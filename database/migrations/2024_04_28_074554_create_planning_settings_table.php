<?php

use App\Models\Family;
use App\Models\PlanningSettings;
use App\Models\User;
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
        Schema::create('planning_settings', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(User::class)->constrained()->cascadeOnDelete();
            $table->foreignIdFor(Family::class)->nullable()->constrained()->cascadeOnDelete();
            $table->enum('planning_type', array_keys(PlanningSettings::PLANNING_TYPE))->default(array_key_first(PlanningSettings::PLANNING_TYPE));
            $table->string('food_type', 255)->nullable();
            $table->unsignedTinyInteger('number_of_meals_per_day')->default(3);
            $table->text('additional_info')->nullable();
            $table->json('days');
            $table->json('family_members')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('planning_settings');
    }
};
