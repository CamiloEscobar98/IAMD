<?php

namespace App\Http\Controllers\Admin\Localization;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

use Illuminate\Http\Request;

use App\Http\Requests\Admin\Localizations\States\StoreRequest;
use App\Http\Requests\Admin\Localizations\States\UpdateRequest;

use App\Services\Admin\StateService;

use App\Repositories\Admin\StateRepository;

class StateController extends Controller
{
    /** @var StateService */
    protected $stateService;

    /** @var StateRepository */
    protected $stateRepository;

    public function __construct(
        StateService $stateService,

        StateRepository $stateRepository,
    ) {
        $this->middleware('auth:admin');

        $this->stateService = $stateService;

        $this->stateRepository = $stateRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        try {

            $oldParams = $request->all();

            $params = $this->stateService->transformParams($request->all());

            $query = $this->stateRepository->search($params, ['cities'], ['cities']);

            $total = $query->count();
            $items = $this->stateService->customPagination($query, $params, null, $request->get('page'), $total);

            $links = $items->links('pagination.customized');

            $params = $oldParams;

            return view('admin.pages.localization.states.index', compact('links'))
                ->nest('filters', 'admin.pages.localization.states.components.filters', compact('params', 'total'))
                ->nest('table', 'admin.pages.localization.states.components.table', compact('items'));
        } catch (\Exception $th) {
            return $th->getMessage();
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.pages.localization.states.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreRequest $request)
    {
        try {
            $data = $request->all();

            $item = DB::transaction(function () use ($data) {
                return $this->stateRepository->create($data);
            });

            return redirect()->back()->with('alert', ['title' => __('messages.success'), 'icon' => 'success', 'text' => __('pages.admin.localizations.states.messages.save_success', ['state' => $item->name])]);
        } catch (\Exception $th) {
            return $th->getMessage();
            return redirect()->back()->with('alert', ['title' => __('messages.error'), 'icon' => 'error', 'text' => __('pages.admin.localizations.states.messages.save_error')]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param Request $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, $id)
    {
        try {
            $item = $this->stateRepository->getById($id);

            return view('admin.pages.localization.states.show', compact('item'));
        } catch (\Exception $th) {
            return redirect()->route('admin.home')->with('alert', ['title' => __('messages.error'), 'icon' => 'error', 'text' => $th->getMessage()]);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        try {
            $item = $this->stateRepository->getById($id);

            return view('admin.pages.localization.states.edit', compact('item'));
        } catch (\Exception $th) {
            return redirect()->route('admin.home')->with('alert', ['title' => __('messages.error'), 'icon' => 'error', 'text' => $th->getMessage()]);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateRequest $request, $id)
    {
        try {
            $data = $request->all();
            $item = $this->stateRepository->getById($id);

            DB::transaction(function () use ($data, $item) {
                $this->stateRepository->update($item, $data);
            });

            return redirect()->back()->with('alert', ['title' => __('messages.success'), 'icon' => 'success', 'text' => __('pages.admin.localizations.states.messages.update_success', ['state' => $item->name])]);
        } catch (\Exception $th) {
            return redirect()->back()->with('alert', ['title' => __('messages.error'), 'icon' => 'error', 'text' => __('pages.admin.localizations.states.messages.update_error')]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            $item = $this->stateRepository->getById($id);

            DB::transaction(function () use ($item) {
                $this->stateRepository->delete($item);
            });

            return redirect()->back()->with('alert', ['title' => __('messages.success'), 'icon' => 'success', 'text' => __('pages.admin.localizations.states.messages.delete_success', ['state' => $item->name])]);
        } catch (\Exception $th) {
            return redirect()->back()->with('alert', ['title' => __('messages.error'), 'icon' => 'error', 'text' => __('pages.admin.localizations.states.messages.delete_error')]);
        }
    }
}
