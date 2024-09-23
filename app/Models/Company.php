<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'location', 'description'];

    public function jobPosts()
    {
        return $this->hasMany(JobPost::class);
    }

}
