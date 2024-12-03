<?php

namespace App\Http\Controllers\Api;

use App\Models\Issue;
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
}
