<?php

namespace App\Http\Controllers\Api;

use App\Models\Issue;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
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
    ];

    public function sortableBy(): array
    {
        return [
            'id',
            'title',
            'description',
            'volume',
            'number',
            'year',
            'month',
            'cover',
            'doi',
            'created_at',
        ];
    }

    protected $relations = [
        'user',
        'articles'
    ];

    protected $softDeletes = true;

    protected $scopes = [];

    public function filterableBy(): array
    {
        return [
            'id',
            'title',
            'description',
            'volume',
            'number',
            'year',
            'month',
            'cover',
            'doi',
            'created_at',
            'articles',
            'articles.created_at'
        ];
    }

    public function includes(): array
    {
        return [
            'articles',
            'articles.title'
        ];
    }

    public function searchableBy(): array
    {
        return [
            'id',
            'title',
            'description',
            'volume',
            'number',
            'year',
            'month',
            'cover',
            'doi',
            'created_at',
            'articles.title'
        ];
    }

    protected $with = [];

    protected $withCount = [];

    protected $perPage = 20;

    protected $maxPerPage = 1000;

    protected $resource = \App\Http\Resources\IssueResource::class;

    protected function beforeStore($request, $model)
    {
        $model->user_id = Auth::user()->id;
    }

    protected function afterStore($request, $model)
    {
        if ($request->has('articles')) {
            foreach ($request->articles as $articleData) {
                try {
                    if (isset($articleData['file'])) {
                        $file = $articleData['file'];
                        $fileExtension = $file->getClientOriginalExtension();
                        $originalFileName = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);
                        $fileName = $originalFileName . '-' . uniqid() . '.' . $fileExtension;
                        $filePath = $file->storeAs('articles', $fileName, 'public');
                        $articleData['file'] = $filePath;
                    }
                    $articleData['user_id'] = Auth::user()->id;
                    //
                    $model->articles()->create($articleData);
                } catch (\Exception $e) {
                    Log::error('Error creating article: ' . $e->getMessage());
                }
            }
        }
    }
}
