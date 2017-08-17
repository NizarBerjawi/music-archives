<?php

namespace App\Filters;

class LabelFilter extends Filter
{
    /**
     * Filter by label name.
     * Get all the labels with a similar name
     *
     * @param string $code
     * @return \Illuminate\Database\Eloquent\Builder
     */
    protected function name($name)
    {
        return $this->builder->whereName($name);
    }
}
