<?php

namespace App\Http\Requests;

use App\Enums\WorkspaceVisibility;
use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Enum;

class WorkspaceRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => "required|max:255|string",
            'cover' => [
                Rule::when($this->routeIs('workspaces.store'), ['required', 'mimes:png,jpg', 'max:2048']),
                Rule::when($this->routeIs('workspaces.update'), ['nullable', 'mimes:png,jpg', 'max:2048'])
            ],
            'logo' => [
                Rule::when($this->routeIs('workspaces.store'), ['required', 'mimes:png,jpg', 'max:2048']),
                Rule::when($this->routeIs('workspaces.update'), ['nullable', 'mimes:png,jpg', 'max:2048'])
            ],
            'visibility' => ['required', new Enum(WorkspaceVisibility::class)]
        ];
    }

    public function attributes(): array
    {
        return [
            'name' => 'Name',
            'cover' => 'Cover',
            'logo' => 'Logo',
            'visibility' => 'Visibility',
        ];
    }
}
