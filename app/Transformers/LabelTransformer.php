<?php

namespace App\Transformers;

class LabelTransformer extends Transformer
{
    /**
     * Resource name of the json object.
     *
     * @var string
     */
    protected $resourceName = 'label';

    /**
     * The possible relationships that could be eager loaded.
     *
     * @var array
     */
    protected $relationships = [
        'recordings' => 'albums',
        'artists' => 'artists',
    ];

    /**
     * Apply the transformation.
     *
     * @param $data
     * @return mixed
     */
    public function transform($data)
    {
        $this->transformed = [
            'id'   => $data->id,
            'name' => $data->name,
        ];

        // Apply any required embeds
        $this->applyEmbeds($data);

        // Return the transformed response
        return $this->transformed;
    }

    /**
     * Embed the recordings relationship.
     *
     * @param $data
     * @return mixed
     */
    public function embedRecordings($data)
    {
        $this->transformed = $this->transformed + [
            'recordings' => $data->recordings->map(function($recording) {
                return (new RecordingTransformer)->transform($recording);
            })
        ];
    }

    /**
     * Embed the artists relationship.
     *
     * @param $data
     * @return mixed
     */
    public function embedArtists($data)
    {
        $this->transformed = $this->transformed + [
            'artists' => $data->artists->map(function($artist) {
                return (new ArtistTransformer)->transform($artist);
            })
        ];
    }
}
