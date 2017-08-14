<?php

namespace App\Transformers;

class ArtistTransformer extends Transformer
{
    /**
     * Resource name of the json object.
     *
     * @var string
     */
    protected $resourceName = 'artist';

    /**
     * The possible relationships that could be eager loaded.
     *
     * @var array
     */
    protected $relationships = [
        'recordings' => 'albums',
        'country'    => 'country',
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
            'begin_date'        => $data['begin_date']->toAtomString(),
            'end_date'          => $data['end_date']->toAtomString(),
            'recordings'        => $data['recordings']->map(function($recording) {
                                        return [
                                            'id'            => $recording->id,
                                            'title'         => $recording->title,
                                            'length'        => $recording->length,
                                            'release_date'  => $recording->release_date,
                                        ];
                                  }),
            'country'          => [
                'name'            => $data['country']->name,
                'country_code'    => $data['country']->code,
                ]
        ];
    }
}
