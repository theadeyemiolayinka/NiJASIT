<?php

namespace App\Http\Requests;

use Orion\Http\Requests\Request;
use Illuminate\Support\Facades\Auth;

class ArticleRequest extends Request
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
            'abstract' => 'required|string',
            'citation' => 'required|string',
            'keywords' => 'required|array',
            'keywords.*' => 'string',
            'authors' => 'sometimes|array',
            'authors.*' => 'sometimes|array',
            'authors.*.name' => 'sometimes|required_with:authors.*.department|string',
            'authors.*.department' => 'sometimes|required_with:authors.*.name|string',
            'file' => 'required|mimes:pdf|max:15360',
            'cover' => 'required|string',
            'references' => 'nullable|string',
            'affiliations' => 'nullable|string',
            'funding' => 'nullable|string',
            'acknowledgements' => 'nullable|string',
            'conflicts' => 'nullable|string',
            'data_availability' => 'nullable|string',
            'license' => 'nullable|string',
            'doi' => 'nullable|string',
            'pages' => 'required|regex:/^\d+[-‐‑‒–—―]\d+$/',
            'status' => 'nullable|string',
            'issue_id' => 'nullable|exists:issues,id',
        ];
    }

    public function updateRules(): array
    {
        return [
            'title' => 'sometimes|string',
            'abstract' => 'sometimes|string',
            'citation' => 'sometimes|string',
            'keywords' => 'sometimes|array',
            'keywords.*' => 'sometimes|string',
            'authors' => 'sometimes|array',
            'authors.*' => 'sometimes|array',
            'authors.*.name' => 'sometimes|required_with:authors.*.department|string',
            'authors.*.department' => 'sometimes|required_with:authors.*.name|string',
            'file' => 'sometimes|mimes:pdf|max:15360',
            'cover' => 'sometimes|string',
            'references' => 'nullable|string',
            'affiliations' => 'nullable|string',
            'funding' => 'nullable|string',
            'acknowledgements' => 'nullable|string',
            'conflicts' => 'nullable|string',
            'data_availability' => 'nullable|string',
            'license' => 'nullable|string',
            'doi' => 'nullable|string',
            'pages' => 'sometimes|regex:/^\d+[-‐‑‒–—―]\d+$/',
            'status' => 'nullable|string',
            'issue_id' => 'nullable|exists:issues,id',
        ];
    }

    public function batchStoreRules(): array
    {
        return [

            'resources.*.authors.*.name' => 'required_with:resources.*.authors.*.department|string',
            'resources.*.authors.*.department' => 'required_with:resources.*.authors.*.name|string',
        ];
    }

    public function batchUpdateRules(): array
    {
        return [
            'resources.*.authors.*.name' => 'required_with:resources.*.authors.*.department|string',
            'resources.*.authors.*.department' => 'required_with:resources.*.authors.*.name|string',
        ];
    }
}
