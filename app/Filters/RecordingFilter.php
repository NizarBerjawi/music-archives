<?php
namespace App\Filters;

class LabelFilter extends Filter
{
    /**
     * Filter by recordings by artist name.
     *
     * @param string $name
     * @return \Illuminate\Database\Eloquent\Builder
     */
    protected function name($name)
    {
        return $this->builder->whereHas($name);
    }
}
