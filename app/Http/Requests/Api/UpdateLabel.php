<?php

namespace App\Http\Requests\Api;

use Illuminate\Foundation\Http\FormRequest;

class UpdateLabel extends ApiRequest
{
    /**
     * Get the data to be validated from the request
     *
     * @return array
     */
    protected function validationData()
    {
        return $this->get('label') ?: [];
    }

    /**
     * Get the validation rules that apply to the request
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'required|string|max:255',
        ];
    }
}
