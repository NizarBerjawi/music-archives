<?php

namespace App\Transformers;

class TrackTransformer extends Transformer
{
    /**
     * Resource name of the json object.
     *
     * @var string
     */
    protected $resourceName = 'track';

    /**
     * The possible relationships that could be eager loaded.
     *
     * @var array
     */
    protected $relationships = [
        'recording' => 'albums',
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
            'id'                => $data->id,
            'title'             => $data->title,
            'length'            => $data->length,
        ];

        // Apply any required embeds
        $this->applyEmbeds($data);

        // Return the transformed response
        return $this->transformed;
    }

    /**
     * Embed the recording relationship.
     *
     * @param App\Transformers\RecordingTransformer
     * @param $data
     * @return mixed
     */
    public function embedRecording($data)
    {
        $this->transformed = $this->transformed + [
            'recording' => (new RecordingTransformer)->transform($data->recording)
        ];
    }
}
