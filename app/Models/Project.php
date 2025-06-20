<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Project extends Model
{
    use HasFactory;

    protected $table = 'projects';

    protected $fillable = [
        'icon',
        'name',
        'label',
        'start_date',
        'end_date',
        'user_id',
        'status',
        'read'
    ];

    protected $casts = [
        'start_date'    =>  'datetime',
        'end_date'      =>  'datetime',
        'read'          =>  'boolean'
    ];

    /**
     * Get the post that owns the comment.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function visionBoards(): HasMany
    {
        return $this->hasMany(VisionBoard::class);
    }

    public function sprints(): HasMany
    {
        return $this->hasMany(Sprint::class);
    }
    public function teams(): HasMany
    {
        return $this->hasMany(Team::class);
    }
    public function owner()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
    public function productOwner()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
    public function readers()
    {
        return $this->belongsToMany(User::class, 'project_user_reads')
                    ->withPivot('read', 'read_at')
                    ->withTimestamps();
    }
}
