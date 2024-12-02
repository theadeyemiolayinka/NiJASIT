<?php

namespace App\Http\Controllers\Api;

use App\Models\Issue;
use App\Http\Requests\StoreIssueRequest;
use App\Http\Requests\UpdateIssueRequest;
use Illuminate\Support\Facades\Auth;
use Orion\Http\Controllers\Controller;

class IssueController extends Controller
{

    public function __construct()
    {
        $this->middleware(['auth:api', 'admin'])->only(['store', 'update', 'destroy', 'restore', 'batchStore', 'batchUpdate', 'batchDestroy', 'batchRestore']);
    }

    protected $model = Issue::class;

    protected $request = StoreIssueRequest::class;

    protected $updateRequest = UpdateIssueRequest::class;

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

    // protected $scopes = [];

    // protected $allowedFilters = [];

    // protected $allowedIncludes = [];

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

    // protected $with = [];

    // protected $withCount = [];

    protected $perPage = 20;

    protected $maxPerPage = 1000;

    protected $resource = 'App\Http\Resources\IssueResource';

    protected function beforeStore($request, $model)
    {
        $model->user_id = Auth::user()->id;
    }
}
