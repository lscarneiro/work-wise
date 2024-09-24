<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Scout\Searchable;

class JobPost extends Model
{
    use HasFactory, Searchable;

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
        'salary' => 'float',
        'is_published' => 'boolean',
    ];

    public function searchableAs(): string
    {
        return 'job_posts_index';
    }

    public function toSearchableArray()
    {
        $array = $this->toArray();

        $array['company_name'] = $this->company->name;

        $array['salary'] = (float) $this->salary;

        return $array;
    }
}
