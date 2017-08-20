<?php

namespace App\Http\ViewComposers;

use Illuminate\View\View;
use App\Repositories\ArtistRepository;

class ArtistComposer
{
    /**
     * The artist repository implementation
     *
     * @var CountryRepository
     */
    protected $artists;

    /**
     * Create a new artist composer.
     *
     * @param CountryRepository  $artists
     * @return void
     */
    public function __construct(ArtistRepository $artists)
    {
        $this->artists = $artists;
    }

    /**
     * Bind data to the view.
     *
     * @param View $view
     * @return void
     */
    public function compose(View $view)
    {
        $view->with('artists', $this->artists->all());
    }
}
