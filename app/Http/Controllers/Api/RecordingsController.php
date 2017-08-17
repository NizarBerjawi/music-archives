<?php

namespace App\Http\Controllers\Api;

use App\Models\Recording;
use App\Paginate\Paginate;
use App\Filters\RecordingFilter;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use App\Http\Requests\Api\CreateRecording;
use App\Http\Requests\Api\UpdateRecording;
use App\Http\Requests\Api\DeleteRecording;
use App\Transformers\RecordingTransformer;

class RecordingsController extends ApiController
{
    /**
     * RecordingsController constructor.
     *
     * @param RecordingTransformer $transformer
     */
    public function __construct(RecordingTransformer $transformer)
    {
        $this->transformer = $transformer;

        $this->middleware('auth.api')->except(['index', 'show']);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(RecordingFilter $filter)
    {
        // Filter the recordings
        $builder = Recording::filter($filter);

        // Get the embeds query parameter and split by commas
        $includes = explode(',', Input::get('include', ''));

        // Relationships to be embedded
        $embeds = $this->transformer->getEmbeds($includes);

        // Load relations, if any
        $builder = $builder->loadRelations($embeds);

        // Instantiate a new Paginate object
        $recordings = new Paginate($builder);

        // Return the paginated response
        return $this->respondWithPagination($recordings);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\Api\CreateRecording  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateRecording $request)
    {
        $recording = Recording::create([
            'title' => $request->input('recording.title'),
            'length' => $request->input('recording.length'),
            'release_date' => $request->input('recording.release_date')
        ]);

        return $this->respondWithTransformer($recording);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Recording $recording)
    {
        return $this->respondWithTransformer($recording);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateRecording $request, Recording $recording)
    {
        if ($request->has('recording')) {
            $recording->update($request->input('recording'));
        }

        return $this->respondWithTransformer($recording);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(DeleteRecording $request, Recording $recording)
    {
        $recording->delete();

        return $this->respondSuccess();
    }
}
