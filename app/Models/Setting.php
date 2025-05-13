<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    use HasFactory;

    /**
     * Define fillable.
     */
    protected $fillable = [
        // SMTP settings.
        'mail_from_address',
        'from_name',
        'smtp_host',
        'smtp_port',
        'type_of_encryption',
        'smtp_username',
        'smtp_password',
    ];
}
