<?php

namespace App\Http\Requests;


use Illuminate\Foundation\Http\FormRequest;

class UpdateUserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'first_name' => 'sometimes|required|max:50',
            'middle_name' => 'nullable|max:50',
            'last_name' => 'sometimes|required|max:50',
            'office' => 'sometimes|required|max:255',
            'designation' => 'sometimes|required|max:255',
            'username' => 'sometimes|required|unique:users,username,' . $this->route('id') . '|max:50',
            'password' => 'sometimes|nullable|min:8',
            'active' => 'sometimes|boolean',
        ];
    }
}
