<?php

namespace App\Http\Controllers\Api;

use App\Models\Artist;
use App\Paginate\Paginate;
use App\Filters\ArtistFilter;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use App\Http\Requests\Api\CreateArtist;
use App\Http\Requests\Api\UpdateArtist;
use App\Http\Requests\Api\DeleteArtist;
use App\Transformers\ArtistTransformer;

class ArtistsController extends ApiController
{
    /**
     * ArtistsController constructor.
     *
     * @param UserTransformer $transformer
     */
    public function __construct(ArtistTransformer $transformer)
    {
        // Get an instance of the UserTransformer
        $this->transformer = $transformer;

        $this->middleware('auth:api')->except(['index', 'show']);
    }

    /**
     * Get all the artists.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(ArtistFilter $filter)
    {
        // Filter the artists
        $builder = Artist::filter($filter);

        // Get the embeds query parameter and split by commas
        $includes = explode(',', Input::get('include', ''));

        // Relationships to be embedded
        $embeds = $this->transformer->getEmbeds($includes);

        // Load relations, if any
        $builder = $builder->loadRelations($embeds);

        // Instantiate a new Paginate object
        $artists = new Paginate($builder);

        // Return the paginated response
        return $this->respondWithPagination($artists);
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\Api\CreateArtist  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateArtist $request)
    {
        $artist = Artist::create([
            'name' => $request->input('artist.name'),
            'begin_date' => $request->input('artist.begin_date'),
            'end_date' => $request->input('artist.end_date'),
            'label_id' => $request->input('artist.label_id'),
            'country_code' => $request->input('artist.country_code'),
        ]);

        return $this->respondWithTransformer($artist);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Artist  $artist
     * @return \Illuminate\Http\Response
     */
    public function show(Artist $artist)
    {
        return $this->respondWithTransformer($artist);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\Api\UpdateArtist  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Artist $artist)
    {
        if ($request->has('artist')) {
            $artist->update($request->input('artist'));
        }

        return $this->respondWithTransformer($artist);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(DeleteArtist $request, Artist $artist)
    {
        $artist->delete();

        return $this->respondSuccess();
    }
}
