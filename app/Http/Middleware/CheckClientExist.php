<?php

namespace App\Http\Middleware;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;

use Closure;

use App\Repositories\Admin\TenantRepository;

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
            $currentClient = session('current_client');
            if (!is_null($currentClient)) {
                if ($client->name == $currentClient) {
                    Config::set('database.connections.tenant', $this->tenantRepository->getArrayConfigurationDatabase($client));
                    return $next($request);
                } else {
                    $client = $this->initClient($currentClient);
                    Config::set('database.connections.tenant', $this->tenantRepository->getArrayConfigurationDatabase($client));
                    return redirect(route('client.home', ['client' => $client->name]));
                }
            }
            Config::set('database.connections.tenant', $this->tenantRepository->getArrayConfigurationDatabase($client));
            return $next($request);
        } else {
            abort(500);
        }
    }

    /**
     * @param int $name
     * 
     * @return \App\Models\Admin\Tenant
     */
    protected function initClient($name)
    {
        return $this->tenantRepository->getByAttribute('name', $name);
    }
}
