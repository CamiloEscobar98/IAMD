<?php

namespace App\Http\Middleware;

use Illuminate\Http\Request;

use Closure;

use App\Repositories\TenantRepository;

use App\Models\Tenant;

class CheckClientExist
{
    /** @var TenantRepository */
    protected $tenantRepository;

    public function __construct(
        TenantRepository $tenantRepository,
    ) {
        $this->tenantRepository = $tenantRepository;
    }

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        $client = $this->initClient($request->client);

        if (!is_null($client)) {
            return $next($request);
        } else {
            abort(500);
        }
    }

    /**
     * @param int $name
     * 
     * @return void
     */
    protected function initClient($name)
    {
        return $this->tenantRepository->getByAttribute('name', $name);
    }
}
