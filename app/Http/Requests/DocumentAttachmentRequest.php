<?php

namespace App\Http\Requests;


use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class DocumentAttachmentRequest extends FormRequest
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
            // document_id can come from the route or form body
            'document_id'    => [
                'required',
                'integer',
                Rule::exists('tbl_documents', 'id'),
            ],

            // Simple flat array of files — matches: <input name="attachments[]" multiple>
            'attachments'    => ['required', 'array', 'min:1', 'max:5'],
            'attachments.*'  => [
                'required',
                'file',
                'mimes:pdf,doc,docx,xls,xlsx,png,jpg,jpeg',
                'max:10240', // 10MB
            ],
        ];
    }

    public function messages(): array
    {
        return [
            'document_id.required'   => 'A document ID is required.',
            'document_id.integer'    => 'The document ID must be a valid integer.',
            'document_id.exists'     => 'The selected document does not exist.',

            'attachments.required'   => 'At least one attachment is required.',
            'attachments.array'      => 'Attachments must be provided as an array.',
            'attachments.min'        => 'At least one attachment must be provided.',
            'attachments.max'        => 'You may not upload more than 5 attachments at once.',

            'attachments.*.required' => 'Each attachment must be a valid file.',
            'attachments.*.file'     => 'Each attachment must be a valid file.',
            'attachments.*.mimes'    => 'Allowed types: pdf, doc, docx, xls, xlsx, png, jpg, jpeg.',
            'attachments.*.max'      => 'Each file must not exceed 10MB.',
        ];
    }
}
