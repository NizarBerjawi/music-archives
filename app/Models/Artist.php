<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Artist extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'artists';

    /**
     * Get the country that this artist belongs to
     */
    public function country()
    {
        return $this->belongsTo('App\Models\Country');
    }

    /**
     * Get the recordings belonging to this artist
     */
    public function recordings()
    {
        return $this->belongsToMany('App\Models\Recording');
    }

    /**
     * Get the genres belonging to this artist
     */
    public function genres()
    {
        return $this->belongsToMany('App\Models\Genre');
    }

    /**
     *
     *
     */



}
