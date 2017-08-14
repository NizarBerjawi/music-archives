<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Filters\Filterable;

class Artist extends Model
{
    use Filterable;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'artists';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'begin_date',
        'end_date',
        'label_id',
        'country_code',
    ];

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = [
        'created_at',
        'updated_at',
        'begin_date',
        'end_date',
    ];

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
     * Get the record label associated with this artist
     */
    public function label()
    {
        return $this->belongsTo('App\Models\Label');
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
}
