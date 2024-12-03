<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Article extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'title',
        'abstract',
        'citation',
        'keywords',
        'authors',
        'file',
        'cover',
        'references',
        'affiliations',
        'funding',
        'acknowledgements',
        'conflicts',
        'data_availability',
        'license',
        'doi',
        'published_at',
        'status',
        'user_id',
        'issue_id',
    ];

    protected $casts = [
        'keywords' => 'array',
        'authors' => 'array',
    ];

    public function issue() {
        return $this->belongsTo(Issue::class);
    }

    public function user() {
        return $this->belongsTo(User::class);
    }
}
