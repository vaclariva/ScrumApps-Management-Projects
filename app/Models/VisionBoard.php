<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class VisionBoard extends Model
{
    use HasFactory;

    protected $table = 'vision_boards';

    protected $fillable =[
      'name',
      'vision',
      'target_group',
      'needs',
      'products',
      'business_goals',
      'competitors',
      'project_id',
    ];

    protected $casts = [
    ];

    /**
     * Get the post that owns the comment.
     */
    public function project(): BelongsTo
    {
        return $this->belongsTo(Project::class);
    }
}
