<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreArticleRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {

        return [
            'title' => 'required|string|max:255',
            'abstract' => 'required|string',
            'citation' => 'required|string',
            'keywords' => 'required|array',
            'keywords.*' => 'string',
            'authors' => 'required|array',
            'authors.*' => 'string',
            'file' => 'required|string',
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
            'user_id' => 'required|exists:users,id',
            'issue_id' => 'required|exists:issues,id',
        ];
    }
}
