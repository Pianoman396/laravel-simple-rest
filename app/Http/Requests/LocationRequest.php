<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Class LocationRequest
 * @package App\Http\Requests
 */
class LocationRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'ip' => 'nullable|ip',
            'user_id' => 'required|integer',
            'coord_x' => 'nullable|string',
            'coord_y' => 'nullable|string',
        ];
    }
}
