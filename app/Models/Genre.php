<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Genre extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'genres';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
    ];

    /**
     * Get the artists associated with this genre
     */
    public function artists()
    {
        return $this->belongsToMany('App\Models\Artist');
    }

    /**
     * Get the recordings associated with this genre
     */
    public function recordings()
    {
        return $this->belongsToMany('App\Models\Recording');
    }
}
