<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Filters\Filterable;

class Label extends Model
{
    use Filterable;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'labels';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
    ];

    /**
     * Get the recordings associated with this label
     */
    public function recordings()
    {
        return $this->belongsToMany('App\Models\Recording');
    }

    /**
     * Get the artists associated with this label
     */
    public function artists()
    {
        return $this->hasMany('App\Models\Artist');
    }

    /**
     * Load all required relationships with only necessary content.
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeLoadRelations($query, $relations)
    {
        return $query->with($relations);
    }
};
