<?php

namespace App\Http\Requests;


use Illuminate\Foundation\Http\FormRequest;

class DocumentRequest extends FormRequest
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

            'title'          => 'required|string|max:500',
            'subject'        => 'nullable|string',
            'keywords'       => 'nullable|string',
            'issuer'         => 'nullable|string',
            'range_dates'    => 'required|boolean',
            'contact_person' => 'nullable|string|max:200',
            'need_approval'  => 'required|boolean',
            'contact_number' => 'nullable|string|max:200',
            'document_type'  => 'nullable|string|max:200',
            'issue_date'     => 'required|date',
            'effect_date'    => 'required|date|after_or_equal:issue_date',
            'encoded_by'     => 'required|integer|exists:users,id',

        ];
    }

    public function messages(): array
    {
        return [
            'title.required'             => 'The document title is required.',
            'title.max'                  => 'The document title must not exceed 500 characters.',
            'range_dates.required'       => 'Please specify if the document has a date range.',
            'range_dates.boolean'        => 'The range dates field must be true or false.',
            'need_approval.required'     => 'Please specify if approval is needed.',
            'need_approval.boolean'      => 'The need approval field must be true or false.',
            'issue_date.required'        => 'The issue date is required.',
            'issue_date.date'            => 'The issue date must be a valid date.',
            'effect_date.required'       => 'The effectivity date is required.',
            'effect_date.date'           => 'The effectivity date must be a valid date.',
            'effect_date.after_or_equal' => 'The effectivity date must not be before the issue date.',
            'encoded_by.required'        => 'The encoder name is required.',
            'encoded_by.max'             => 'The encoder name must not exceed 200 characters.',
        ];
    }
}
