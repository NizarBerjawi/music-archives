<?php

namespace App\Transformers;

class RecordingTransformer extends Transformer
{
    /**
     * Resource name of the json object.
     *
     * @var string
     */
    protected $resourceName = 'recording';

    /**
     * The possible relationships that could be eager loaded.
     *
     * @var array
     */
    protected $relationships = [
        'artists'    => 'artists',
        'genres'     => 'genres',
        'label'      => 'label',
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
            'title'             => $data->title,
            'length'            => $data->length,
            'release_date'      => $data->release_date,
        ];
    }
}
