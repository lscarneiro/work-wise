<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Str;

class Company extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'location', 'description'];

    public function jobPosts()
    {
        return $this->hasMany(JobPost::class);
    }

    public function getTruncatedDescriptionAttribute()
    {
        return Str::limit($this->description, 20, '...');
    }

    public function getJobPostsCountAttribute()
    {
        return $this->jobPosts()->count();
    }
}
