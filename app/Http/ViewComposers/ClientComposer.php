<?php

namespace App\Http\ViewComposers;

use Illuminate\View\View;

use App\Repositories\TenantRepository;
use Illuminate\Http\Request;

class ClientComposer
{
    /** @var TenantRepository */
    protected $tenantRepository;

    /** @var Request */
    protected $request;

    public function __construct(
        TenantRepository $tenantRepository,
        Request $request
    ) {
        $this->tenantRepository = $tenantRepository;
        $this->request = $request;
    }

    public function compose(View $view)
    {
        $client = $this->tenantRepository->getByAttribute('name', $this->request->client);
        $view->with(compact('client'));
    }
}
