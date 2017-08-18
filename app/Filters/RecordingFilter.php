<?php
namespace App\Filters;

class RecordingFilter extends Filter
{
    /**
     * Filter by recordings by artist name.
     *
     * @param string $name
     * @return \Illuminate\Database\Eloquent\Builder
     */
    protected function artistName($name)
    {
        return $this->builder->whereHas('artists', function($query) use ($name) {
                $query->where('name', 'like', '%$name%');
        });
    }
}
