<?php

if (!function_exists('getWeekDays')) {
    function getWeekDays(): array
    {
        return [
            'monday' => __('messages.monday'),
            'tuesday' => __('messages.tuesday'),
            'wednesday' => __('messages.wednesday'),
            'thursday' => __('messages.thursday'),
            'friday' => __('messages.friday'),
            'saturday' => __('messages.saturday'),
            'sunday' => __('messages.sunday'),
        ];
    }
}
