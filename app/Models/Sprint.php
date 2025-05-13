<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sprint extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'start_date',
        'end_date',
        'status',
        'result_review',
        'result_retrospective',
        'project_id',
    ];

    protected $casts = [
        'start_date' => 'datetime',
        'end_date' => 'datetime',
    ];

    public function project()
    {
        return $this->belongsTo(Project::class, 'project_id');
    }

    public function getDaysLeftAttribute()
    {
        return $this->end_date->diffInDays(now());
    }

    public function scopeEndingSoon($query)
    {
        return $query->whereDate('end_date', '>=', now()->startOfDay())
                     ->whereDate('end_date', '<=', now()->addDays(3)->endOfDay());
    }

    public function isEndingSoon()
    {
        $daysLeft = $this->getDaysLeftAttribute();
        return $daysLeft <= 3 && $daysLeft >= 0 && $this->status === 'inactive';
    }

    public function isExpired()
    {
        return now()->greaterThan($this->end_date) && $this->status === 'inactive';
    }

    public function shouldSendReminder()
    {
        $daysLeft = $this->getDaysLeftAttribute();
        return in_array($daysLeft, [0, 1, 2, 3]) && $this->status === 'inactive';
    }
}
