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

    public function commonRules(): array
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
        ];
    }
}
