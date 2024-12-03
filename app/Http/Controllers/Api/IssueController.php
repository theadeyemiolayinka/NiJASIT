<?php

namespace App\Http\Controllers\Api;

use App\Models\Issue;
use Illuminate\Support\Facades\Auth;
use Orion\Concerns\DisableAuthorization;
use Orion\Http\Controllers\Controller;

class IssueController extends Controller
{
    use DisableAuthorization;

    protected function applyMiddleware()
    {
        $this->middleware('auth:api')->only(['store', 'update', 'destroy', 'restore', 'batchStore', 'batchUpdate', 'batchDestroy', 'batchRestore']);
        $this->middleware('admin')->only(['store', 'update', 'destroy', 'restore', 'batchStore', 'batchUpdate', 'batchDestroy', 'batchRestore']);
    }

    protected $model = Issue::class;

    protected $attributes = [
        'id',
        'title',
        'description',
        'volume',
        'number',
        'year',
        'month',
        'cover',
        'doi',
        'user_id',
        'created_at',
        'updated_at'
    ];

    protected $filterable = [
        'id',
        'title',
        'description',
        'volume',
        'number',
        'year',
        'month',
        'cover',
        'doi',
        'user_id',
        'created_at',
        'updated_at'
    ];

    protected $sortable = [
        'id',
        'title',
        'description',
        'volume',
        'number',
        'year',
        'month',
        'cover',
        'doi',
        'user_id',
        'created_at',
        'updated_at'
    ];

    protected $relations = [
        'user',
        'articles'
    ];

    protected $softDeletes = true;

    protected $scopes = [];

    protected $allowedFilters = [];

    protected $allowedIncludes = [];

    protected $searchable = [
        'id',
        'title',
        'description',
        'volume',
        'number',
        'year',
        'month',
        'cover',
        'doi',
        'user_id',
        'created_at',
        'updated_at'
    ];

    protected $with = [];

    protected $withCount = [];

    protected $perPage = 20;

    protected $maxPerPage = 1000;

    protected $resource = \App\Http\Resources\IssueResource::class;

    protected function beforeStore($request, $model)
    {
        $model->user_id = Auth::user()->id;
    }
}
