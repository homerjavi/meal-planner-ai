<?php

namespace App\Models;

use App\Casts\Json;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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
        'days',
        'number_of_meals_per_day',
        'additional_info',
    ];

    static function boot()
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
        ];
    }

    public function setDaysAttribute($value)
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
}
