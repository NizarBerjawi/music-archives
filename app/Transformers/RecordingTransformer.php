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
        'labels'     => 'labels',
        'tracks'     => 'tracks',
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
            'release_date'      => $data->release_date,
        ];

        // Apply any required embeds
        $this->applyEmbeds($data);

        // Return the transformed response
        return $this->transformed;
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
            'arists' => $data->artists->map(function($artist) {
                return (new ArtistTransformer)->transform($artist);
            })
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
     * Embed the labels relationship.
     *
     * @param App\Transformers\LabelTransformer
     * @param $data
     * @return mixed
     */
    public function embedLabels($data)
    {
        $this->transformed = $this->transformed + [
            'labels' => $data->labels->map(function($label) {
                return (new LabelTransformer)->transform($label);
            })
        ];
    }

    /**
     * Embed the labels relationship.
     *
     * @param App\Transformers\TrackTransformer
     * @param $data
     * @return mixed
     */
    public function embedTracks($data)
    {
        $this->transformed = $this->transformed + [
            'tracks' => $data->tracks->map(function($track) {
                return (new TrackTransformer)->transform($track);
            })
        ];
    }
}
