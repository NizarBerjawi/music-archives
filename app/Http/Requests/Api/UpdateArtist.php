<?php

namespace App\Http\Requests\Api;

class UpdateArtist extends ApiRequest
{
    /**
     * Get the data to be validated from the request
     *
     * @return array
     */
    protected function validationData()
    {
        return $this->get('article') ?: [];
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
            'begin_date' =>  'sometimes|date',
            'end_date' => 'sometimes|date|after:'.$this->input('artist.begin_date'),
            'label_id' => 'required|integer',
            'country_code' => 'required|string',
        ];
    }
}
