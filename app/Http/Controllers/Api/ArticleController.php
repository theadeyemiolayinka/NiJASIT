<?php

namespace App\Http\Controllers\Api;

use App\Models\Article;
use Illuminate\Support\Facades\Auth;
use Orion\Concerns\DisableAuthorization;
use Orion\Http\Controllers\Controller;

class ArticleController extends Controller
{

    use DisableAuthorization;

    protected function applyMiddleware()
    {
        $this->middleware('auth:api')->only(['store', 'update', 'destroy', 'restore', 'batchStore', 'batchUpdate', 'batchDestroy', 'batchRestore']);
        $this->middleware('admin')->only(['store', 'update', 'destroy', 'restore', 'batchStore', 'batchUpdate', 'batchDestroy', 'batchRestore']);
    }

    protected $model = Article::class;

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
        'issue_id',
        'created_at',
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
        'issue_id',
        'created_at',
    ];

    protected $relations = [
        'user',
        'issue'
    ];

    protected $softDeletes = true;

    protected $scopes = [];

    protected $allowedFilters = [];

    protected $allowedIncludes = [];

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
        'issue_id',
        'created_at',
    ];

    protected $with = [];

    protected $withCount = [];

    protected $perPage = 20;

    protected $maxPerPage = 1000;

    protected $resource = \App\Http\Resources\ArticleResource::class;
    protected function beforeStore($request, $model)
    {
        if ($request->has('file')) {
            $file = $request->file('file');
            $fileExtension = $file->getClientOriginalExtension();
            $originalFileName = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);
            $fileName = $originalFileName . '-' . uniqid() . '.' . $fileExtension;
            $filePath = $file->storeAs('articles', $fileName, 'public');
            $model->file = $filePath;
        }
        $model->user_id = Auth::user()->id;
    }

    protected function beforeUpdate($request, $model)
    {
        if ($request->has('file')) {
            $file = $request->file('file');
            $fileExtension = $file->getClientOriginalExtension();
            $originalFileName = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);
            $fileName = $originalFileName . '-' . uniqid() . '.' . $fileExtension;
            $filePath = $file->storeAs('articles', $fileName, 'public');
            if ($filePath) {
                // Delete the previous file if it exists
                try {
                    if ($model->file && \Storage::disk('public')->exists($model->file)) {
                        \Storage::disk('public')->delete($model->file);
                    }
                } catch (\Throwable $th) {
                    //
                }
                $model->file = $filePath;
            }
        }
    }
}
