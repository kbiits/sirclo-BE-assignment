<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreBeratRequest extends FormRequest
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
            '*' => 'required',
            'date' => 'date|date_format:Y-m-d',
            'max_weight' => 'integer|gte:min_weight',
            'min_weight' => 'integer|gte:0',
        ];
    }

    public function attributes()
    {
        return [
            'max_weight' => "berat maksimum",
            'min_weight' => 'berat minimum',
            'date' => 'tanggal',
        ];
    }
}
