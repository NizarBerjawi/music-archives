<?php

namespace App\Filters;

use ReflectionClass;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Builder;

abstract class Filter
{
    /**
     * @var \Illuminate\Http\Request
     */
    protected $request;

    /**
     * @var \Illuminate\Database\Eloquent\Builder
     */
    protected $builder;

    /**
     * Filter constructor.
     *
     * @param \Illuminate\Http\Request $request
     */
    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    /**
     * Get all the available filter methods.
     *
     * @return array
     */
    protected function getFilterMethods()
    {
        // The reflection class reports information about a class
        $class = new ReflectionClass(static::class);

        // An array of the methods in the specified Filter class
        $methods = array_map(function($method) use ($class) {
            if ($method->class === $class->getName()) {
                return $method->name;
            }
            return null;
        }, $class->getMethods());

        // Remove all null values from the array
        return array_filter($methods);
    }

    /**
     * Get all the filters that can be applied.
     *
     * @return array
     */
    protected function getFilters()
    {
        // Intersect returns a portion of input data that is actually
        // present on the request.
        return $this->request->intersect($this->getFilterMethods());
    }

    /**
     * Apply all the requested filters if available.
     *
     * @param \Illuminate\Database\Eloquent\Builder $builder
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function apply(Builder $builder)
    {
        // Store the query builder
        $this->builder = $builder;

        // Loop over the filters
        foreach ($this->getFilters() as $name => $value) {
            // Check if the filter exists in the filter class
            if (method_exists($this, $name)) {
                // If a value is supplied, apply the filter with the value.
                // Otherwise, just apply the filter
                if ($value) {
                    $this->$name($value);
                } else {
                    $this->$name();
                }
            }
        }

        return $this->builder;
    }
}
