<?php

namespace App\Http\Controllers\Api;

use App\Models\Article;
use App\Http\Requests\StoreArticleRequest;
use App\Http\Requests\UpdateArticleRequest;
use Illuminate\Support\Facades\Auth;
use Orion\Http\Controllers\Controller;

class ArticleController extends Controller
{

    public function __construct()
    {
        $this->middleware(['auth:api', 'admin'])->only(['store', 'update', 'destroy', 'restore', 'batchStore', 'batchUpdate', 'batchDestroy', 'batchRestore']);
    }

    protected $model = Article::class;

    protected $request = StoreArticleRequest::class;

    protected $updateRequest = UpdateArticleRequest::class;

    protected $attributes = [
        'id',
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
        'created_at',
        'updated_at'
    ];

    protected $filterable = [
        'id',
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
        'created_at',
        'updated_at'
    ];

    protected $sortable = [
        'id',
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
        'created_at',
        'updated_at'
    ];

    protected $relations = [
        'user',
        'issue'
    ];

    protected $softDeletes = true;

    // protected $scopes = [];

    // protected $allowedFilters = [];

    // protected $allowedIncludes = [];

    protected $searchable = [
        'id',
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
        'created_at',
        'updated_at'
    ];

    // protected $with = [];

    // protected $withCount = [];

    protected $perPage = 20;

    protected $maxPerPage = 1000;

    protected $resource = 'App\Http\Resources\ArticleResource';

    protected function beforeStore($request, $model)
    {
        $model->user_id = Auth::user()->id;
    }
}
