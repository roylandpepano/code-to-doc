<?php

namespace App\Http\Requests;

use App\Models\Destination;
use Illuminate\Foundation\Http\FormRequest;

class CreateDestinationRequest extends FormRequest
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
    public function rules()
    {
            return [
                'destination_name' => 'required',
                'image' => 'required',
                'images' => 'required',
                'business_permit' => 'required_if:owner,yes',
                'destination_description' => 'required',
                'destination_working_hours' => 'required',
                'destination_address' => 'required',
                'destination_city' => 'required|not_in:Select',
                'destination_entrance_fee' => 'required',
            ];
        }
    public function messages(){
        return [
            'business_permit.required' => 'Post Body is required',
        ];
    }
}
