<?php

namespace App\Models;

use App\Casts\Json;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class PlanningSettings extends Model
{
    use HasFactory;

    const PLANNING_TYPE = [
        'user' => 'User',
        'family' => 'Family',
    ];

    protected $fillable = [
        'planning_type',
        'food_type',
        'number_of_meals_per_day',
        'days',
        'family_members',
        'additional_info',
    ];

    static function boot(): void
    {
        parent::boot();

        static::creating(function ($planningSettings) {
            $planningSettings->user_id = auth()->id();
        });
    }

    protected function casts(): array
    {
        return [
            'days' => Json::class,
            'family_members' => Json::class,
        ];
    }

    public function setDaysAttribute($value): void
    {
        if (is_array($value)) {
            usort($value, function ($a, $b) {
                $dayOrder = array_flip(array_keys(getWeekDays()));
                return $dayOrder[$a] <=> $dayOrder[$b];
            });
        }

        $this->attributes['days'] = json_encode($value);
    }

    public static function getTranslatedPlanningTypes(): array
    {
        $translatedPlanningTypes = [];

        foreach (self::PLANNING_TYPE as $key => $value) {
            $translatedPlanningTypes[$key] = __('messages.' . $key);
        }

        return $translatedPlanningTypes;
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function family(): BelongsTo
    {
        return $this->belongsTo(Family::class);
    }

    // public function familyMembers(): HasMany
    // {
    //     return $this->family->users();
    // }
}
