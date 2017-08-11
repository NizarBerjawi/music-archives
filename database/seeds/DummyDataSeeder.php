<?php

use Illuminate\Database\Seeder;

class DummyDataSeeder extends Seeder
{
    /**
     * Total number of countries
     *
     * @var int
     */
    protected $totalCountries = 120;

    /**
     * Total number of genres
     *
     * @var int
     */
    protected $totalGenres = 30;

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker\Generator $faker)
    {
        $countries = factory(App\Models\Country::class)
                                ->times($this->totalCountries)
                                ->create();

        $genres = factory(App\Models\Genre::class)
                                ->times($this->totalGenres)
                                ->create();
    }
}
