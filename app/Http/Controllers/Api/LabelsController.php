<?php

namespace App\Http\Controllers\Api;

use App\Models\Label;
use App\Paginate\Paginate;
use App\Filters\LabelFilter;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use App\Http\Requests\Api\CreateLabel;
use App\Http\Requests\Api\UpdateLabel;
use App\Http\Requests\Api\DeleteLabel;
use App\Transformers\LabelTransformer;

class LabelsController extends ApiController
{

    /**
     * LabelsController constructor.
     *
     * @param LabelTransformer $transformer
     */
    public function __construct(LabelTransformer $transformer)
    {
        $this->transformer = $transformer;

        $this->middleware('auth.api')->except(['index', 'show']);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(LabelFilter $filter)
    {
        // Filter the labels
        $builder = Label::filter($filter);

        // Get the embeds query parameter and split by commas
        $includes = explode(',', Input::get('include', ''));

        // Relationships to be embedded
        $embeds = $this->transformer->getEmbeds($includes);

        // Load relations, if any
        $builder = $builder->loadRelations($embeds);

        // Instantiate a new Paginate object
        $labels = new Paginate($builder);

        // Return the paginated response
        return $this->respondWithPagination($labels);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\Api\CreateLabel  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateLabel $request)
    {
        $label = Label::create([
            'name' => $request->input('label.name')
        ]);

        return $this->respondWithTransformer($label);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Label $label)
    {
        return $this->respondWithTransformer($label);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateLabel $request, Label $label)
    {
        if ($request->has('label')) {
            $label->update($request->input('label'));
        }

        return $this->respondWithTransformer($label);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(DeleteLabel $request, Label $label)
    {
        $label->delete();

        return $this->respondSuccess();
    }
}
