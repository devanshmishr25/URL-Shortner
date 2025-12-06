<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class ShortUrl extends Model
{
    use HasFactory;

    protected $fillable = [
        'original_url',
        'short_code',
        'user_id',
        'company_id',
        'clicks',
    ];

    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function company()
    {
        return $this->belongsTo(Company::class);
    }

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            if (!$model->short_code) {
                $model->short_code = Str::random(6);
            }
        });
    }

    public function incrementClicks()
    {
        $this->increment('clicks');
    }
}
