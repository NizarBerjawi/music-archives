<?php

namespace App\Http\ViewComposers;

use Illuminate\View\View;
use App\Repositories\CountryRepository;

class CountryComposer
{
    /**
     * The country repository implementation
     *
     * @var CountryRepository
     */
    protected $countries;

    /**
     * Create a new country composer.
     *
     * @param CountryRepository  $countries
     * @return void
     */
    public function __construct(CountryRepository $countries)
    {
        $this->countries = $countries;
    }

    /**
     * Bind data to the view.
     *
     * @param View $view
     * @return void
     */
    public function compose(View $view)
    {
        $view->with('countries', $this->countries->all());
    }
}
