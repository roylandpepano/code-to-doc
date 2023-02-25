<?php

namespace App\Http\Requests;

use Illuminate\Http\Request;
use Illuminate\Foundation\Http\FormRequest;

class ApproveDestinationRequest extends FormRequest
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
                    'destination_name' => 'required',
                    'destination_description' => 'required',
                    'destination_working_hours' => 'required',
                    'destination_address' => 'required',
                    'destination_city' => 'required|not_in:Select',
                    'destination_entrance_fee' => 'required',
                ];
            case 'reject':
            case 'remove':
                return [
                    'destination_name' => 'required',
                    'destination_description' => 'required',
                    'destination_working_hours' => 'required',
                    'destination_address' => 'required',
                    'destination_city' => 'required|not_in:Select',
                    'destination_entrance_fee' => 'required',
                    'reason' => 'required',
                ];
            case 'restore':
                return [];
        }
    }
}
