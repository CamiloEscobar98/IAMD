<?php

namespace App\Http\ViewComposers\Client\IntangibleAssets;

use Illuminate\View\View;
use Illuminate\Http\Request;

use App\Repositories\Client\ProjectRepository;
use App\Repositories\Admin\IntangibleAssetStateRepository;

class IntangibleAssetFilterComposer
{
    /** @var ProjectRepository */
    protected $projectRepository;

    /** @var IntangibleAssetStateRepository */
    protected $intangibleAssetStateRepository;

    public function __construct(
        ProjectRepository $projectRepository,
        IntangibleAssetStateRepository $intangibleAssetStateRepository,
    ) {
        $this->projectRepository = $projectRepository;
        $this->intangibleAssetStateRepository = $intangibleAssetStateRepository;
    }

    public function compose(View $view)
    {
        $projects = $this->projectRepository->all();
        $states = $this->intangibleAssetStateRepository->all();

        $view->with(compact('projects', 'states'));
    }
}
