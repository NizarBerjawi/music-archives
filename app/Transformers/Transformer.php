<?php

namespace App\Transformers;

use Illuminate\Support\Collection;
use App\Paginate\Paginate;

abstract class Transformer
{
    /**
     * Resource name of the json object.
     *
     * @var string
     */
    protected $resourceName = 'data';

    /**
     * The possible relationships that could be eager loaded.
     *
     * @var array
     */
    protected $relationships;

    /**
     * Transform a collection of items.
     *
     * @param Collection $data
     * @return array
     */
    public function collection(Collection $data)
    {
        // Pass each item in the collection through the transformer
        return [
            str_plural($this->resourceName) => $data->map([$this, 'transform'])
        ];
    }

    /**
     * Transform a single item.
     *
     * @param $data
     * @return array
     */
    public function item($data)
    {
        return [
            $this->resourceName => $this->transform($data)
        ];
    }

    /**
     * Transform a paginated item.
     *
     * @param Paginate $paginated
     * @return array
     */
    public function paginate(Paginate $paginated)
    {
        // The resource name
        $resourceName = str_plural($this->resourceName);

        // The count name
        $countName = str_plural($this->resourceName) . 'Count';

        // Pass the paginated data through the transformer
        $data = [
            $resourceName => $paginated->getData()->map([$this, 'transform'])
        ];

        // Return the transformed data with the count name
        return array_merge($data, [
            $countName => $paginated->getTotal()
        ]);
    }

    /**
     * Check for potential relationships to embed and convert from generic
     * "include" names.
     *
     * @param
     * @return array
     */
    public function embeds($relations)
    {
        return array_keys(
            array_intersect($this->relationships, $relations)
        );
    }

    /**
     * Apply the transformation.
     *
     * @param $data
     * @return mixed
     */
    public abstract function transform($data);
}
