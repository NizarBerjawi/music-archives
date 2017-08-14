<?php

namespace App\Transformers;

class UserTransformer extends Transformer
{
    /**
     * Resource name of the json object.
     *
     * @var string
     */
    protected $resourceName = 'user';

    /**
     * Apply the transformation.
     *
     * @param $data
     * @return mixed
     */
    public function transform($data)
    {
        return [
            'name'              => $data['name'],
            'email'             => $data['email'],
        ];
    }
}
