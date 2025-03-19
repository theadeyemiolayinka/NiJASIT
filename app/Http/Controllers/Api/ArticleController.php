<?php

namespace App\Http\Controllers\Api;

use App\Models\Article;
use Illuminate\Http\Request;
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
        'pages',
        // 'published_at',
        'status',
        'user_id',
        'issue_id',
        'created_at',
    ];

    public function filterableBy(): array
    {
        return [
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
            'pages',
            // 'published_at',
            'status',
            'issue_id',
            'created_at',
        ];
    }

    public function sortableBy(): array
    {
        return [
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
            'pages',
            // 'published_at',
            'status',
            'issue_id',
            'created_at',
        ];
    }

    protected $relations = [
        'user',
        'issue'
    ];

    protected $softDeletes = true;

    protected $scopes = [];

    protected $allowedFilters = [];

    protected $allowedIncludes = [];

    public function searchableBy(): array
    {
        return [
            'id',
            'title',
            'abstract',
            'citation',
            'keywords',
            'authors',
            'references',
            'affiliations',
            'funding',
            'acknowledgements',
            'conflicts',
            'data_availability',
            'doi',
            'pages',
        ];
    }

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

    public function download(int $article_id)
    {
        try {
            $article = Article::findOrFail($article_id);
            $filePath = $article->file;
            if (!is_null($filePath)) {
                if (\Storage::disk('public')->exists($filePath)) {
                    $fileExtension = pathinfo($filePath, PATHINFO_EXTENSION);
                    $fileName = str_replace(' ', '_', $article->title) . '.' . $fileExtension;
                    return response()->download(storage_path('app/public/' . $filePath), $fileName);
                }
            }
            return response()->json(['message' => 'File not found.'], 404);
        } catch (\Throwable $th) {
            return response()->json(['message' => 'File not found'], 404);
        }

    }
}
