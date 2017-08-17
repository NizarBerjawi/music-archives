<?php

namespace App\Transformers;

use Illuminate\Support\Collection;
use App\Paginate\Paginate;
use ReflectionClass;

abstract class Transformer
{
    /**
     * Resource name of the json object.
     *
     * @var string
     */
    protected $resourceName = 'data';

    /**
     * The relations to be embeded in the response.
     *
     * @var array
     */
    protected $embeds = [];

    /**
     * The transformed response
     *
     * @var array
     */
    protected $transformed;

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
        $countName = $resourceName . 'Count';

        // Pass the paginated data through the transformer
        $data = collect([
            $resourceName => $paginated->getData()->map([$this, 'transform'])
        ]);

        // Return the transformed data with the count name
        return $data->merge([
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
    public function getEmbeds($includes)
    {
        $embeds = array_map(function($value) {
             return strtolower(str_replace('embed', '', $value));
        }, $this->getEmbedMethods());

        $intersection = array_keys(array_intersect($this->relationships, $includes));


        return $this->embeds = array_intersect($embeds, $intersection);
    }

    /**
     * Get all available embed methods
     *
     * @return array
     */
    private function getEmbedMethods()
    {
        // The reflection class reports information about a class
        $class = new ReflectionClass(static::class);

        // An array of the methods in the specified Filter class
        $methods = array_map(function($method) use ($class) {
            if ($method->class === $class->getName()
                        && strpos($method, 'embed') !== false) {
                return $method->name;
            }
            return null;
        }, $class->getMethods());

        // Remove all null values from the array
        return array_filter($methods);
    }

    /**
     * Apply all the requested embeds if available.
     *
     * @param \Illuminate\Database\Eloquent\Builder $builder
     * @return \Illuminate\Database\Eloquent\Builder
     */
    protected function applyEmbeds($data)
    {
        // Loop over the embeds
        foreach ($this->embeds as $name) {
            // Manipulate the method names
            $method = 'embed' . ucfirst($name);

            // Check if the embed exists in the Transformer class
            if (method_exists($this, $method)) {
                $this->$method($data);
            }
        }
    }

    /**
     * Apply the transformation.
     *
     * @param $data
     * @return mixed
     */
    public abstract function transform($data);
}
