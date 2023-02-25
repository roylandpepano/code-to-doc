<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;

class ApproveTourOperatorRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(Request $request)
    {
        switch ($request->input('submit')) {
            case 'approve':
            case 'save':
                return [
                    'operator_company' => 'required',
                    'operator_description' => 'required',
                    'operator_email' => 'required',
                    'operator_location' => 'required',
                    'operator_city' => 'required',
                    'operator_services' => 'required',
                ];
            case 'reject':
            case 'remove':
                return [
                    'operator_company' => 'required',
                    'operator_description' => 'required',
                    'operator_email' => 'required',
                    'operator_location' => 'required',
                    'operator_city' => 'required',
                    'operator_services' => 'required',
                    'reason' => 'required',
                ];
            case 'restore':
                return [];
        }
    }
}
