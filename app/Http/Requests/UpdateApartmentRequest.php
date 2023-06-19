<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateApartmentRequest extends FormRequest
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
            "title" => 'required|string|max:255',
            "rooms" => 'required|numeric|min:1',
            "bathrooms" => 'required|numeric|min:1',
            "beds" => 'required|numeric|min:1',
            "square_meters" => 'required|numeric|min:28',
            "cover_image" => 'nullable',
            "address" => 'required',
            "visible" => 'required',
            "price" => 'required|numeric|min:20',
            "service" => "required|exists:services,id" 
        ];
    }
}
