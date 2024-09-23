<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Str;

class JobPost extends Model
{
    use HasFactory;

    public const POSITION_TYPES = [
        'remote' => 'Remote',
        'hybrid' => 'Hybrid',
        'in-person' => 'In Person'
    ];

    protected $fillable = ['company_id', 'title', 'position_type', 'salary', 'location', 'description', 'is_published'];

    public function company()
    {
        return $this->belongsTo(Company::class);
    }

    protected $casts = [
        'company_id' => 'integer',
        'salary' => 'decimal:2',
        'is_published' => 'boolean',
    ];

    public function getTruncatedDescriptionAttribute()
    {
        return Str::limit($this->description, 100, '...');
    }
}
