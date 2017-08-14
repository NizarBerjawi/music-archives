<?php

namespace App\Http\Requests\Api;

use Illuminate\Foundation\Http\FormRequest;

class UpdateUser extends ApiRequest
{
    /**
     * Get the data to be validated from the request
     *
     * @return array
     */
    protected function validationData()
    {
        return $this->get('user') ?: [];
    }

    /**
     * Get the validation rules that apply to the request
     *
     * @return array
     */
    public function rules()
    {
        return [
            'email' => 'sometimes|email|max:255|unique:users,email,' . $this->user()->id,
            'password' => 'sometimes|min:6',
        ];
    }
}
