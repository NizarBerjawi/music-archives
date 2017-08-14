<?php

namespace App\Http\Controllers\Api;

use App\Models\Artist;
use App\Paginate\Paginate;
use App\Filters\ArtistFilter;
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

        // Load any relatioships
        if (Input::has('include')) {
            // Get the relations to eager load
            $relations = explode(',', Input::get('include'));
            // Load relations
            $builder = $builder->loadRelations($this->transformer->embeds($relations));
        }

        $artists = new Paginate($builder);

        // return response()->json($artists->getData()->first());

        return $this->respondWithPagination($artists);
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
