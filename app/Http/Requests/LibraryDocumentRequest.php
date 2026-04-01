<?php

namespace App\Http\Requests;


use Illuminate\Foundation\Http\FormRequest;

class LibraryDocumentRequest extends FormRequest
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
            //
           'document_Type' => 'required|string|unique:lib_documents,document_Type|max:150',
        ];
    }
}
