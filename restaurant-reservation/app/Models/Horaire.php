<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;
use Carbon\CarbonInterface;

class Horaire extends Model
{
    protected $fillable = [
        'restaurant_id',
        'opening_time',
        'exceptional_days',
    ];

    protected $casts = [
        'opening_time' => 'array',
        'exceptional_days' => 'array',
    ];

    public function restaurant()
    {
        return $this->belongsTo(Restaurant::class);
    }

    // Accesseurs
    public function getOpeningTimeAttribute($value)
    {
        return $this->formatHours($value);
    }

    public function getExceptionalDaysAttribute($value)
    {
        return array_map(function($day) {
            return [
                'date' => Carbon::parse($day['date'])->format('d/m/Y'),
                'status' => $day['status'],
                'hours' => $this->formatHours($day['hours'] ?? [])
            ];
        }, $value ?? []);
    }

    // Mutateurs
    public function setOpeningTimeAttribute($value)
    {
        $this->attributes['opening_time'] = $this->validateHours($value);
    }

    public function setExceptionalDaysAttribute($value)
    {
        $this->attributes['exceptional_days'] = $this->validateExceptionalDays($value);
    }

    // Méthodes utilitaires
    public function isOpenNow()
    {
        $now = now();
        $dayName = strtolower($now->isoFormat('dddd'));

        if($exception = $this->getTodayException()) {
            return $exception['status'] === 'open' 
                ? $this->checkTimeSlot($exception['hours'], $now)
                : false;
        }

        return $this->checkTimeSlot(
            $this->opening_time[$dayName] ?? [], 
            $now
        );
    }

    public function getNextOpeningTime()
    {
        $today = now();
        for($i = 0; $i < 7; $i++) {
            $date = $today->copy()->addDays($i);
            $dayName = strtolower($date->isoFormat('dddd'));

            if($this->isExceptionDay($date)) continue;

            $hours = $this->opening_time[$dayName] ?? [];
            if(!empty($hours)) {
                $nextOpen = Carbon::parse($hours[0]['start']);
                if($i === 0 && $nextOpen->gt($today)) {
                    return $nextOpen;
                }
                return $date->setTimeFromTimeString($hours[0]['start']);
            }
        }
        return null;
    }

    public function getWeeklySchedule()
    {
        return collect([
            'monday', 'tuesday', 'wednesday', 
            'thursday', 'friday', 'saturday', 'sunday'
        ])->mapWithKeys(function($day) {
            return [$day => $this->opening_time[$day] ?? []];
        });
    }

    // Méthodes protégées
    protected function formatHours($hours)
    {
        return array_map(function($slot) {
            return [
                'start' => Carbon::parse($slot['start'])->format('H:i'),
                'end' => Carbon::parse($slot['end'])->format('H:i')
            ];
        }, $hours);
    }

    protected function validateHours($hours)
    {
        return collect($hours)->map(function($slot) {
            return [
                'start' => Carbon::parse($slot['start'])->format('H:i:00'),
                'end' => Carbon::parse($slot['end'])->format('H:i:00')
            ];
        })->toArray();
    }

    protected function validateExceptionalDays($days)
    {
        return collect($days)->map(function($day) {
            return [
                'date' => Carbon::parse($day['date'])->format('Y-m-d'),
                'status' => $day['status'],
                'hours' => $this->validateHours($day['hours'] ?? [])
            ];
        })->toArray();
    }

    protected function checkTimeSlot($slots, Carbon $time)
    {
        foreach($slots as $slot) {
            $start = Carbon::parse($slot['start']);
            $end = Carbon::parse($slot['end']);
            if($time->between($start, $end)) {
                return true;
            }
        }
        return false;
    }

    protected function getTodayException()
    {
        return collect($this->exceptional_days)->first(function($day) {
            return Carbon::parse($day['date'])->isToday();
        });
    }

    protected function isExceptionDay(CarbonInterface $date)
    {
        return collect($this->exceptional_days)->contains(function($day) use ($date) {
            return Carbon::parse($day['date'])->isSameDay($date);
        });
    }

    // Scopes
    public function scopeWithExceptions($query, $status = null)
    {
        return $query->whereJsonLength('exceptional_days', '>', 0)
            ->when($status, function($q) use ($status) {
                $q->whereJsonContains('exceptional_days->[*].status', $status);
            });
    }

    public function scopeCurrentlyOpen($query)
    {
        return $query->where(function($q) {
            $q->whereJsonContains('exceptional_days->[*].status', 'open')
              ->orWhereJsonLength('exceptional_days', 0);
        });
    }
}