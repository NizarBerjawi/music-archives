<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Recording extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'recordings';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'title',
        'playlength',
        'release_date',
        'label_id',
    ];

    /**
     * Get the artists that appear on this recording
     */
    public function artists()
    {
        return $this->belongsToMany('App\Models\Artist');
    }

    /**
     * Get the genres belonging to this recording
     */
    public function genres()
    {
        return $this->belongsToMany('App\Models\Genre');
    }

    /**
     * Get the labels associated with this recording
     */
    public function labels()
    {
        return $this->belongsToMany('App\Models\Label');
    }

    /**
     * Get the tracks belonging to this recording
     */
    public function tracks()
    {
        return $this->hasMany('App\Models\Track');
    }
}
