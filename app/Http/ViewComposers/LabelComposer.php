<?php

namespace App\Http\ViewComposers;

use Illuminate\View\View;
use App\Repositories\LabelRepository;

class LabelComposer
{
    /**
     * The label repository implementation
     *
     * @var LabelRepository
     */
    protected $labels;

    /**
     * Create a new label composer.
     *
     * @param LabelRepository  $labels
     * @return void
     */
    public function __construct(LabelRepository $labels)
    {
        $this->labels = $labels;
    }

    /**
     * Bind data to the view.
     *
     * @param View $view
     * @return void
     */
    public function compose(View $view)
    {
        $view->with('labels', $this->labels->all());
    }
}
