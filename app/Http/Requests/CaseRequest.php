<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CaseRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return auth()->check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => [
                'required', 'min:3'
            ],
            'defect_type' => [
                'required', 'exists:defect_types,id'
            ],
            'responsibility_by' => [
                'required', 'exists:responsibilities,id'
            ],
            'defect_desc' => [
                'required'
            ],
            'pic' => [
                'required', 'min:3'
            ],
            'latitude' => [
                'required'
            ],
            'longitude' => [
                'required'
            ],
            'datetime_issue' => [
                'required'
            ],
            'file' => [
                'required'
            ]

        ];
    }
}
