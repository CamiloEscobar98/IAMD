<?php

namespace App\Http\ViewComposers\Admin\Localization\States;

use Illuminate\View\View;

use Illuminate\Http\Request;

use App\Services\Admin\CityService;

use App\Repositories\Admin\CityRepository;

class StateShowComposer
{
    /** @var Request */
    protected $request;

    /** @var CityService */
    protected $cityService;

    /** @var CityRepository */
    protected $cityRepository;

    public function __construct(
        Request $request,

        CityService $cityService,
        CityRepository $cityRepository
    ) {
        $this->request = $request;

        $this->cityService = $cityService;
        $this->cityRepository = $cityRepository;
    }

    public function compose(View $view)
    {
        $params = $this->cityService->transformParams($this->request->all());

        $query = $this->cityRepository->search($params, [], [], $this->request->id);

        $total = $query->count();
        $cities = $this->cityService->customPagination($query, $params, 10, $this->request->get('page'), $total);
        $links = $cities->links('pagination.customized');

        $view->with(compact('total', 'cities', 'links'));
    }
}
