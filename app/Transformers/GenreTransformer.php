<?php

namespace App\Transformers;

class GenreTransformer extends Transformer
{
    /**
     * Resource name of the json object.
     *
     * @var string
     */
    protected $resourceName = 'genre';

    /**
     * The possible relationships that could be eager loaded.
     *
     * @var array
     */
    protected $relationships = [
        'artists'    => 'artists',
        'recordings' => 'albums',
    ];

    /**
     * Apply the transformation.
     *
     * @param $data
     * @return mixed
     */
    public function transform($data)
    {
        return [
            'id'                => $data->id,
            'title'             => $data->name,
        ];
    }
}
