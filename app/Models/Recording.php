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
     * Get the artists that released this recording
     *
     */
    public function artist()
    {
        return $this->belongsToMany('App\Models\Artist');
    }
}
