<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Exercise extends Model
{
    use HasFactory;

    const INTENSITY_OPTIONS = [
        'low' => 'Low',
        'medium' => 'Medium',
        'high' => 'High'
    ];

    protected $fillable = [
        'name',
        'times_per_week',
        'intensity',
        'session_duration',
        'description',
    ];

    static function boot()
    {
        parent::boot();

        static::creating(function ($exercise) {
            $exercise->user_id = auth()->id();
        });
    }

    public static function getTranslatedIntensities(): array
    {
        $translatedPlanningTypes = [];

        foreach (self::INTENSITY_OPTIONS as $key => $value) {
            $translatedPlanningTypes[$key] = __('messages.' . $key);
        }

        return $translatedPlanningTypes;
    }
}
