<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

use Illuminate\Http\Request;

use App\Http\Requests\Client\SecretProtectionMeasures\StoreRequest;
use App\Http\Requests\Client\SecretProtectionMeasures\UpdateRequest;

use App\Services\Client\SecretProtectionMeasureService;
use App\Repositories\Client\SecretProtectionMeasureRepository;

class SecretProtectionMeasureController extends Controller
{
    /** @var SecretProtectionMeasureService */
    protected $secretProtectionMeasureService;

    /** @var SecretProtectionMeasureRepository */
    protected $secretProtectionMeasureRepository;

    public function __construct(
        SecretProtectionMeasureService $secretProtectionMeasureService,
        SecretProtectionMeasureRepository $secretProtectionMeasureRepository
    ) {
        $this->middleware('auth');

        $this->middleware('permission:secret_protection_measures.index')->only('index');
        $this->middleware('permission:secret_protection_measures.show')->only('show');
        $this->middleware('permission:secret_protection_measures.store')->only(['create', 'store']);
        $this->middleware('permission:secret_protection_measures.update')->only(['edit', 'update']);
        $this->middleware('permission:secret_protection_measures.destroy')->only('destroy');

        $this->secretProtectionMeasureService = $secretProtectionMeasureService;
        $this->secretProtectionMeasureRepository = $secretProtectionMeasureRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @param Request $request
     * @param string $client
     * @return View|RedirectResponse
     */
    public function index(Request $request, $client): View|RedirectResponse
    {
        try {
            [$params, $total, $items, $links] = $this->secretProtectionMeasureService->searchWithPagination($request->all(), $request->get('page'));
            return view('client.pages.secret_protection_measures.index')
                ->nest('filters', 'client.pages.secret_protection_measures.components.filters', compact('params', 'total'))
                ->nest('table', 'client.pages.secret_protection_measures.components.table', compact('items', 'links'));
        } catch (\Exception $e) {
            return redirect()->route('client.home', $client)->with('alert', ['title' => __('messages.error'), 'icon' => 'error', 'text' => __('messages.syntax_error')]);
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @param string $client
     * @return View|RedirectResponse
     */
    public function create($client): View|RedirectResponse
    {
        try {
            $item = $this->secretProtectionMeasureRepository->newInstance();
            return view('client.pages.secret_protection_measures.create', compact('item'));
        } catch (\Exception $th) {
            return redirect()->route('client.secret_protection_measures.index', $client)->with('alert', ['title' => __('messages.error'), 'icon' => 'error', 'text' => __('messages.syntax_error')]);
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  StoreRequest $request
     * @param string $client
     * @return RedirectResponse
     */
    public function store(StoreRequest $request, $client): RedirectResponse
    {
        return redirect()->route('client.secret_protection_measures.create', $client)->with('alert', $this->secretProtectionMeasureService->save($request->all()));
    }

    /**
     * Display the specified resource.
     *
     * @param int $client
     * @param int $secretProtectionMeasure
     * 
     * @return View|RedirectResponse
     */
    public function show($client, $secretProtectionMeasure): View|RedirectResponse
    {
        try {
            $item = $this->secretProtectionMeasureRepository->getById($secretProtectionMeasure);
            return view('client.pages.secret_protection_measures.show', compact('item'));
        } catch (\Exception $th) {
            return redirect()->route('client.secret_protection_measures.index', $client)->with('alert', ['title' => __('messages.error'), 'icon' => 'error', 'text' => __('messages.syntax_error')]);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $client
     * @param int $secretProtectionMeasure
     * 
     * @return View|RedirectResponse
     */
    public function edit($client, $secretProtectionMeasure): View|RedirectResponse
    {
        try {
            $item = $this->secretProtectionMeasureRepository->getById($secretProtectionMeasure);
            return view('client.pages.secret_protection_measures.edit', compact('item'));
        } catch (\Exception $th) {
            return redirect()->route('client.secret_protection_measures.show', ['secret_protection_measure' => $secretProtectionMeasure, 'client' => $client])
                ->with('alert', ['title' => __('messages.error'), 'icon' => 'error', 'text' => __('messages.syntax_error')]);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  UpdateRequest  $request
     * @param int $client
     * 
     * @return RedirectResponse
     */
    public function update(Request $request, $client, $secretProtectionMeasure): RedirectResponse
    {
        return redirect()->route('client.secret_protection_measures.edit', ['secret_protection_measure' => $secretProtectionMeasure, 'client' => $client])
            ->with('alert', $this->secretProtectionMeasureService->update($request->all(), $secretProtectionMeasure));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $client
     * @param int $secretProtectionMeasure
     * 
     * @return View|RedirectResponse
     */
    public function destroy($client, $secretProtectionMeasure): RedirectResponse
    {
        return redirect()->route('client.secret_protection_measures.index', $client)->with('alert', $this->secretProtectionMeasureService->delete($secretProtectionMeasure));
    }
}
