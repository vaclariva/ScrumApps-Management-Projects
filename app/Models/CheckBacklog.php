<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CheckBacklog extends Model
{
    use HasFactory;

    protected $fillable = [
        'backlog_id',
        'name',
        'status',
    ];

    public function backlog()
    {
        return $this->belongsTo(Backlog::class);
    }
}
