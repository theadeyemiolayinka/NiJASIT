<?php

namespace App\Http\Controllers\Api;

use App\Models\Issue;
use Illuminate\Support\Facades\Auth;
use Orion\Concerns\DisableAuthorization;
use Orion\Http\Controllers\RelationController;

class IssueArticlesController extends RelationController
{

    use DisableAuthorization;

    /**
     * Fully-qualified model class name
     */
    protected $model = Issue::class;

    /**
     * Name of the relationship as it is defined on the Post model
     */
    protected $relation = 'articles';


    protected function beforeStore($request, $parentEntity, $entity): void
    {
        if ($request->has('file')) {
            $file = $request->file('file');
            $fileExtension = $file->getClientOriginalExtension();
            $originalFileName = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);
            $fileName = $originalFileName . '-' . uniqid() . '.' . $fileExtension;
            $filePath = $file->storeAs('articles', $fileName, 'public');
            $entity->file = $filePath;
        }
        $entity->user_id = Auth::user()->id;
    }
}
