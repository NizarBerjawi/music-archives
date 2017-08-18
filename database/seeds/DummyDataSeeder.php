<?php

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Artist;
use App\Models\Label;
use App\Models\Country;
use App\Models\Genre;
use App\Models\Recording;
use App\Models\Track;

class DummyDataSeeder extends Seeder
{
    /**
     * Total number of users
     *
     * @var int
     */
    protected $totalUsers = 25;

    /**
     * Total number of countries
     *
     * @var int
     */
    protected $totalCountries = 10;

    /**
     * Total number of genres
     *
     * @var int
     */
    protected $totalGenres = 5;

    /**
     * Total number of labels
     *
     * @var int
     */
    protected $totalLabels = 30;


    /**
     * Maximum genres that can be associated with an artist
     *
     * @var int
     */
    protected $maxArtistsByCountry = 20;

    /**
     * Maximum genres that can be associated with an artist
     *
     * @var int
     */
    protected $maxGenresByArtist = 5;

    /**
     * Maximum genres that can be associated with a recording
     *
     * @var int
     */
    protected $maxGenresByRecording = 5;

    /**
     * Maximum recording that can be associated with an artist
     *
     * @var int
     */
    protected $maxRecordingsByArtist = 20;

    /**
     * Maximum number of labels associated with a recording
     *
     * @var int
     */
    protected $maxLabelsByRecording = 5;

    /**
     * Maximum number of tracks on a recording
     *
     * @var int
     */
    protected $maxTracksByRecording = 15;

    /**
     * Percentage of artists with an end date
     *
     * @var int
     */
    protected $artistWithEndDateRatio = 0.4;

    /**
    * Run the database seeds.
    *
    * @return void
    */
    public function run(Faker\Generator $faker)
    {
        // Create all the users
        $users = factory(User::class)
                    ->times($this->totalUsers)
                    ->create();

        // Create all countries
        $countries = factory(Country::class)
                        ->times($this->totalCountries)
                        ->create();

        // Create artists and recordings genres
        $genres = factory(Genre::class)
                    ->times($this->totalGenres)
                    ->create();

        // Create all record labels
        $labels = factory(Label::class)
        ->times($this->totalLabels)
        ->create();

        // Create artists and associate with countries
        $countries->each(
            function($country) use ($faker, $genres, $labels) {
                $country->artists()
                ->saveMany(
                    factory(Artist::class)
                    ->times($faker->numberBetween(1, $this->maxArtistsByCountry))
                    ->make([
                        'label_id' => $labels->random()->id,
                    ])
                    )
                    ->each(function($artist) use ($faker, $genres, $labels) {
                        // Associate the artist with genres
                        $artist->genres()->attach(
                            $genres->random($faker->numberBetween(1, $this->maxGenresByArtist))
                        );

                        // Associate the artist with recordings
                        $artist->recordings()
                        ->saveMany(
                            factory(Recording::class)
                            ->times($faker->numberBetween(1, $this->maxRecordingsByArtist))
                            ->make()
                            )
                            ->each(function($recording) use ($faker, $genres, $labels) {
                                $recording->genres()->attach(
                                    $genres->random($faker->numberBetween(1, $this->maxGenresByRecording))
                                );

                                $recording->tracks()->saveMany(
                                    factory(Track::class)
                                    ->times($faker->numberBetween(5, $this->maxTracksByRecording))
                                    ->make()
                                );

                                $recording->labels()->attach($labels->random(1, $this->maxLabelsByRecording));
                            });
                        });
                    }
                );
            }
        }
