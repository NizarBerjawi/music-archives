<?php

namespace App\Transformers;

use App\Models\Artist;
use Illuminate\Support\Facades\Input;

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
        $this->transformed = [
            'id'                => $data->id,
            'name'              => $data->name,
            'begin_date'        => $data->begin_date->format('Y-m-d'),
            'end_date'          => $data->end_date->format('Y-m-d'),
        ];

        // Apply any required embeds
        $this->applyEmbeds($data);

        // Return the transformed response
        return $this->transformed;
    }

    /**
     * Embed the recordings relationship.
     *
     * @param App\Transformers\RecordingTransformer
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
     * Embed the country relationship.
     *
     * @param App\Transformers\CountryTransformer
     * @param $data
     * @return mixed
     */
    public function embedCountry($data)
    {
        $this->transformed = $this->transformed + [
            'country' => (new CountryTransformer)->transform($data->country)
        ];
    }

    /**
     * Embed the genres relationship.
     *
     * @param App\Transformers\GenreTransformer
     * @param $data
     * @return mixed
     */
    public function embedGenres($data)
    {
        $this->transformed = $this->transformed + [
            'genres' => $data->genres->map(function($genre) {
                return (new GenreTransformer)->transform($genre);
            })
        ];
    }

    /**
     * Embed the label relationship.
     *
     * @param App\Transformers\LabelTransformer
     * @param $data
     * @return mixed
     */
    public function embedLabel($data)
    {
        $this->transformed = $this->transformed + [
            'label' => (new LabelTransformer)->transform($data->label)
        ];
    }
}
