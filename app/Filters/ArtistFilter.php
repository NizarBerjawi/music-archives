<?php
namespace App\Filters;

use App\Models\Artist;

class ArtistFilter extends Filter
{
    /**
     * Filter by artist country.
     * Get all the artists in a country by country code
     *
     * @param string $code
     * @return \Illuminate\Database\Eloquent\Builder
     */
    protected function country($code)
    {
        return $this->builder->whereCountryCode($code);
    }    
}
