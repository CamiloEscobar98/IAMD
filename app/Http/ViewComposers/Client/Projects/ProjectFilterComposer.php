<?php

namespace App\Http\ViewComposers\Client\Projects;

use Illuminate\View\View;

use App\Repositories\Client\CreatorRepository;

class ProjectFilterComposer
{
    /** @var CreatorRepository */
    protected $creatorRepository;

    public function __construct(
        CreatorRepository $creatorRepository
    ) {
        $this->creatorRepository = $creatorRepository;
    }

    public function compose(View $view)
    {
        /** Creators */
        $directors = $this->creatorRepository->all(['id', 'name'])->pluck('name', 'id');

        $view->with(compact('directors'));
    }
}
