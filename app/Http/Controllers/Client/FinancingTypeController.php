<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;

use Illuminate\Support\Facades\DB;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;

use Illuminate\Http\Request;

use App\Http\Requests\Client\FinancingTypes\StoreRequest;
use App\Http\Requests\Client\FinancingTypes\UpdateRequest;

use App\Services\Client\FinancingTypeService;

use App\Repositories\Client\FinancingTypeRepository;

class FinancingTypeController extends Controller
{
    /** @var FinancingTypeService */
    protected $financingTypeService;

    /** @var FinancingTypeRepository */
    protected $financingTypeRepository;

    public function __construct(
        FinancingTypeService $financingTypeService,
        FinancingTypeRepository $financingTypeRepository
    ) {
        $this->financingTypeService = $financingTypeService;
        $this->financingTypeRepository = $financingTypeRepository;
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
            $params = $this->financingTypeService->transformParams($request->all());

            $query = $this->financingTypeRepository->search($params, [], []);

            $total = $query->count();

            $items = $this->financingTypeService->customPagination($query, $params, $request->get('page'), $total);

            $links = $items->links('pagination.customized');

            return view('client.pages.financing_types.index')
                ->nest('filters', 'client.pages.financing_types.components.filters', compact('params', 'total'))
                ->nest('table', 'client.pages.financing_types.components.table', compact('items', 'links'));
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
            return view('client.pages.financing_types.create');
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

            $item = $this->financingTypeRepository->create($data);

            DB::commit();

            return redirect()->back()->with('alert', ['title' => __('messages.success'), 'icon' => 'success', 'text' => __('pages.client.financing_types.messages.save_success', ['financing_type' => $item->name])]);
        } catch (\Exception $th) {
            DB::rollBack();
            return redirect()->back()->with('alert', ['title' => __('messages.error'), 'icon' => 'error', 'text' => __('messages.syntax_error')]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @param int $financingType
     * 
     * @return View|RedirectResponse
     */
    public function show($id, $financingType): View|RedirectResponse
    {
        try {
            $item = $this->financingTypeRepository->getById($financingType);

            return view('client.pages.financing_types.show', compact('item'));
        } catch (\Exception $th) {
            return redirect()->back()->with('alert', ['title' => __('messages.error'), 'icon' => 'error', 'text' => __('messages.syntax_error')]);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @param int $financingType
     * 
     * @return View|RedirectResponse
     */
    public function edit($id, $financingType): View|RedirectResponse
    {
        try {
            $item = $this->financingTypeRepository->getById($financingType);

            return view('client.pages.financing_types.edit', compact('item'));
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
    public function update(Request $request, $id, $financingType): RedirectResponse
    {
        try {

            $data = $request->all();

            DB::beginTransaction();

            $item = $this->financingTypeRepository->getById($financingType);

            $this->financingTypeRepository->update($item, $data);

            DB::commit();

            return redirect()->back()->with('alert', ['title' => __('messages.success'), 'icon' => 'success', 'text' => __('pages.client.financing_types.messages.update_success', ['financing_type' => $item->name])]);
        } catch (\Exception $th) {
            DB::rollBack();
            return redirect()->back()->with('alert', ['title' => __('messages.error'), 'icon' => 'error', 'text' => __('messages.syntax_error')]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @param int $financingType
     * 
     * @return View|RedirectResponse
     */
    public function destroy($id, $financingType): RedirectResponse
    {
        try {
            $item = $this->financingTypeRepository->getById($financingType);

            DB::beginTransaction();

            $this->financingTypeRepository->delete($item);

            DB::commit();

            return redirect()->back()->with('alert', ['title' => __('messages.success'), 'icon' => 'success', 'text' => __('pages.client.financing_types.messages.delete_success', ['financing_type' => $item->name])]);
        } catch (\Exception $th) {
            DB::rollBack();
            return redirect()->back()->with('alert', ['title' => __('messages.error'), 'icon' => 'error', 'text' => __('messages.syntax_error')]);
        }
    }
}
