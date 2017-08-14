<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Country extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'countries';

    /**
     * The primary key.
     *
     * @var string
     */
    protected $primaryKey = 'code';

    /**
     * Set the primary key as non-incrementing.
     *
     * @var string
     */
    public $incrementing = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'code',
        'name',
    ];

    /**
     * Get the artists associated with this country
     */
    public function artists()
    {
        return $this->hasMany('App\Models\Artist');
    }
}
