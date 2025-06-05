<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CheckDev extends Model
{
    use HasFactory;

    protected $table = 'check_dev';

    protected $fillable = [
        'dev_id',
        'name',
        'category',
        'status',
    ];
    
    public function development()
    {
        return $this->belongsTo(Development::class, 'dev_id');
    }
}
