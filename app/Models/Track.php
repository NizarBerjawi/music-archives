<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Track extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'tracks';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'title',
        'recording_id',
        'playtime',
    ];

    /**
     * Get the recording that this track belongs to
     */
    public function recording()
    {
        return $this->belongsTo('App\Models\Recording');
    }
}
