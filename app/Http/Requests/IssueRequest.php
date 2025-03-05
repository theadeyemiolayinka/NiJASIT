<?php

namespace App\Http\Requests;

use Orion\Http\Requests\Request;
use Illuminate\Support\Facades\Auth;

class IssueRequest extends Request
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        if (!$this->route()) {
            return true;
        }

        if ($this->route()->getActionMethod() === 'store') {
            return Auth::check() && Auth::user()->is_admin;
        }

        if ($this->route()->getActionMethod() === 'batchStore') {
            return Auth::check() && Auth::user()->is_admin;
        }

        if ($this->route()->getActionMethod() === 'update') {
            return Auth::check() && Auth::user()->is_admin;
        }

        if ($this->route()->getActionMethod() === 'batchUpdate') {
            return Auth::check() && Auth::user()->is_admin;
        }

        if ($this->route()->getActionMethod() === 'associate') {
            return Auth::check() && Auth::user()->is_admin;
        }

        if ($this->route()->getActionMethod() === 'attach') {
            return Auth::check() && Auth::user()->is_admin;
        }

        if ($this->route()->getActionMethod() === 'detach') {
            return Auth::check() && Auth::user()->is_admin;
        }

        if ($this->route()->getActionMethod() === 'sync') {
            return Auth::check() && Auth::user()->is_admin;
        }

        if ($this->route()->getActionMethod() === 'toggle') {
            return Auth::check() && Auth::user()->is_admin;
        }

        if ($this->route()->getActionMethod() === 'updatePivot') {
            return Auth::check() && Auth::user()->is_admin;
        }

        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */

    public function storeRules(): array
    {
        return [
            'title' => 'required|string',
            'description' => 'required|string',
            'volume' => 'required|numeric',
            'number' => 'required|numeric',
            'year' => 'required|integer|min:1900|max:' . date('Y'),
            'month' => 'required|integer|min:01|max:12',
            'cover' => 'required|string',
            'doi' => 'nullable|string',

            // feat: side create articles with issue
            'articles' => 'nullable|array',
            'articles.*.title' => 'required|string',
            'articles.*.abstract' => 'required|string',
            'articles.*.citation' => 'required|string',
            'articles.*.keywords' => 'required|array',
            'articles.*.keywords.*' => 'string',
            'articles.*.authors' => 'required|array',
            'articles.*.authors.*' => 'string',
            'articles.*.file' => 'required|mimes:pdf|max:15360',
            'articles.*.cover' => 'required|string',
            'articles.*.references' => 'nullable|string',
            'articles.*.affiliations' => 'nullable|string',
            'articles.*.funding' => 'nullable|string',
            'articles.*.acknowledgements' => 'nullable|string',
            'articles.*.conflicts' => 'nullable|string',
            'articles.*.data_availability' => 'nullable|string',
            'articles.*.license' => 'nullable|string',
            'articles.*.doi' => 'nullable|string',
            'articles.*.status' => 'nullable|string',
            'articles.*.issue_id' => 'nullable|exists:issues,id'
        ];
    }

    public function updateRules(): array
    {
        return [
            'title' => 'sometimes|string',
            'description' => 'sometimes|string',
            'volume' => 'sometimes|numeric',
            'number' => 'sometimes|numeric',
            'year' => 'sometimes|integer|min:1900|max:' . date('Y'),
            'month' => 'sometimes|integer|min:01|max:12',
            'cover' => 'sometimes|string',
            'doi' => 'nullable|string',

            // feat: side create articles with issue
            'articles' => 'nullable|array',
            'articles.*.title' => 'sometimes|string',
            'articles.*.abstract' => 'sometimes|string',
            'articles.*.citation' => 'sometimes|string',
            'articles.*.keywords' => 'sometimes|array',
            'articles.*.keywords.*' => 'string',
            'articles.*.authors' => 'sometimes|array',
            'articles.*.authors.*' => 'string',
            'articles.*.file' => 'sometimes|mimes:pdf|max:15360',
            'articles.*.cover' => 'sometimes|string',
            'articles.*.references' => 'nullable|string',
            'articles.*.affiliations' => 'nullable|string',
            'articles.*.funding' => 'nullable|string',
            'articles.*.acknowledgements' => 'nullable|string',
            'articles.*.conflicts' => 'nullable|string',
            'articles.*.data_availability' => 'nullable|string',
            'articles.*.license' => 'nullable|string',
            'articles.*.doi' => 'nullable|string',
            'articles.*.status' => 'nullable|string',
            'articles.*.issue_id' => 'nullable|exists:issues,id'
        ];
    }
}
