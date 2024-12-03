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
            'description' => 'required|string',
            'volume' => 'required|string|max:255',
            'number' => 'required|string|max:255',
            'year' => 'required|string|max:4',
            'month' => 'required|string|max:2',
            'cover' => 'required|string',
            'doi' => 'nullable|string|max:255',
        ];
    }
}
