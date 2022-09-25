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

        $this->secretProtectionMeasureService = $secretProtectionMeasureService;
        $this->secretProtectionMeasureRepository = $secretProtectionMeasureRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @param Request $request
     * 
     * @return View|RedirectResponse
     */
    public function index(Request $request): View|RedirectResponse
    {
        try {
            $params = $this->secretProtectionMeasureService->transformParams($request->all());

            $query = $this->secretProtectionMeasureRepository->search($params, [], []);

            $total = $query->count();

            $items = $this->secretProtectionMeasureService->customPagination($query, $params, $request->get('page'), $total);

            $links = $items->links('pagination.customized');

            return view('client.pages.secret_protection_measures.index')
                ->nest('filters', 'client.pages.secret_protection_measures.components.filters', compact('params', 'total'))
                ->nest('table', 'client.pages.secret_protection_measures.components.table', compact('items', 'links'));
        } catch (\Exception $th) {
            return redirect()->back()->with('alert', ['title' => __('messages.error'), 'icon' => 'error', 'text' => __('messages.syntax_error')]);
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return View|RedirectResponse
     */
    public function create(): View|RedirectResponse
    {
        try {
            return view('client.pages.secret_protection_measures.create');
        } catch (\Exception $th) {
            return redirect()->back()->with('alert', ['title' => __('messages.error'), 'icon' => 'error', 'text' => __('messages.syntax_error')]);
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  StoreRequest $request
     * 
     * @return RedirectResponse
     */
    public function store(StoreRequest $request): RedirectResponse
    {
        try {

            $data = $request->all();

            DB::beginTransaction();

            $item = $this->secretProtectionMeasureRepository->create($data);

            DB::commit();

            return redirect()->back()->with('alert', ['title' => __('messages.success'), 'icon' => 'success', 'text' => __('pages.client.secret_protection_measures.messages.save_success', ['secret_protection_measure' => $item->name])]);
        } catch (\Exception $th) {
            DB::rollBack();
            return redirect()->back()->with('alert', ['title' => __('messages.error'), 'icon' => 'error', 'text' => __('messages.syntax_error')]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @param int $secretProtectionMeasure
     * 
     * @return View|RedirectResponse
     */
    public function show($id, $secretProtectionMeasure): View|RedirectResponse
    {
        try {
            $item = $this->secretProtectionMeasureRepository->getById($secretProtectionMeasure);

            return view('client.pages.secret_protection_measures.show', compact('item'));
        } catch (\Exception $th) {
            return redirect()->back()->with('alert', ['title' => __('messages.error'), 'icon' => 'error', 'text' => __('messages.syntax_error')]);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @param int $secretProtectionMeasure
     * 
     * @return View|RedirectResponse
     */
    public function edit($id, $secretProtectionMeasure): View|RedirectResponse
    {
        try {
            $item = $this->secretProtectionMeasureRepository->getById($secretProtectionMeasure);

            return view('client.pages.secret_protection_measures.edit', compact('item'));
        } catch (\Exception $th) {
            return redirect()->back()->with('alert', ['title' => __('messages.error'), 'icon' => 'error', 'text' => __('messages.syntax_error')]);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  UpdateRequest  $request
     * @param  int  $id
     * 
     * @return RedirectResponse
     */
    public function update(Request $request, $id, $secretProtectionMeasure): RedirectResponse
    {
        try {

            $data = $request->all();

            DB::beginTransaction();

            $item = $this->secretProtectionMeasureRepository->getById($secretProtectionMeasure);

            $this->secretProtectionMeasureRepository->update($item, $data);

            DB::commit();

            return redirect()->back()->with('alert', ['title' => __('messages.success'), 'icon' => 'success', 'text' => __('pages.client.secret_protection_measures.messages.update_success', ['secret_protection_measure' => $item->name])]);
        } catch (\Exception $th) {
            DB::rollBack();
            return redirect()->back()->with('alert', ['title' => __('messages.error'), 'icon' => 'error', 'text' => __('messages.syntax_error')]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @param int $secretProtectionMeasure
     * 
     * @return View|RedirectResponse
     */
    public function destroy($id, $secretProtectionMeasure): RedirectResponse
    {
        try {
            $item = $this->secretProtectionMeasureRepository->getById($secretProtectionMeasure);

            DB::beginTransaction();

            $this->secretProtectionMeasureRepository->delete($item);

            DB::commit();

            return redirect()->back()->with('alert', ['title' => __('messages.success'), 'icon' => 'success', 'text' => __('pages.client.secret_protection_measures.messages.delete_success', ['secret_protection_measure' => $item->name])]);
        } catch (\Exception $th) {
            DB::rollBack();
            return redirect()->back()->with('alert', ['title' => __('messages.error'), 'icon' => 'error', 'text' => __('messages.syntax_error')]);
        }
    }
}
