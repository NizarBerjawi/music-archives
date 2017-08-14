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
            'id'                => $data['id'],
            'name'              => $data['name'],
            'begin_date'        => $data['begin_date'],
            'end_date'          => $data['end_date'],
            'country_code'      => $data['country_code'],
            'createdAt'         => $data['created_at']->toAtomString(),
            'updatedAt'         => $data['updated_at']->toAtomString(),
            'recordings'        => [
                $data['recordings'][0],
                // 'title'  => $data['recordings']['title'],
                // 'length' => $data['recordings']['length'],
            ]
        ];
    }
}
