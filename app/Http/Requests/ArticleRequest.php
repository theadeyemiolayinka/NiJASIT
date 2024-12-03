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
        return true;
        // return Auth::check() && Auth::user()->is_admin;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function commonRules(): array
    {

        return [
            'title' => 'required|string',
            'abstract' => 'required|string',
            'citation' => 'required|string',
            'keywords' => 'required|array',
            'keywords.*' => 'string',
            'authors' => 'required|array',
            'authors.*' => 'string',
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
            'status' => 'nullable|string',
            'issue_id' => 'required|exists:issues,id',
        ];
    }
}
