<?php

namespace App\Http\Controllers\Admin\Creator;

use App\Http\Controllers\Controller;

use Illuminate\Support\Facades\DB;

use Illuminate\Http\Request;

use App\Http\Requests\Admin\Creator\DocumentTypes\StoreRequest;
use App\Http\Requests\Admin\Creator\DocumentTypes\UpdateRequest;

use App\Repositories\Admin\DocumentTypeRepository;

use App\Services\Admin\DocumentTypeService;

class DocumentTypeController extends Controller
{
    /** @var DocumentTypeService */
    protected $documentTypeService;

    /** @var DocumentTypeRepository */
    protected $documentTypeRepository;

    public function __construct(
        DocumentTypeService $documentTypeService,
        DocumentTypeRepository $documentTypeRepository
    ) {
        $this->middleware('auth:admin');

        $this->documentTypeService = $documentTypeService;
        $this->documentTypeRepository = $documentTypeRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        try {
            $params = $this->documentTypeService->transformParams($request->all());

            $query = $this->documentTypeRepository->search($params);

            $total = $query->count();

            $items = $this->documentTypeService->customPagination($query, $params, $request->get('page'), $total);

            $links = $items->links('pagination.customized');

            return view('admin.pages.creators.document_types.index', compact('links'))
                ->nest('filters', 'admin.pages.creators.document_types.components.filters', compact('params', 'total'))
                ->nest('table', 'admin.pages.creators.document_types.components.table', compact('items'));
        } catch (\Throwable $th) {
            return redirect()->route('admin.home')->with('alert', ['title' => __('messages.error'), 'icon' => 'error', 'text' => $th->getMessage()]);
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        try {
            return view('admin.pages.creators.document_types.create');
        } catch (\Exception $th) {
            return redirect()->route('admin.home')->with('alert', ['title' => __('messages.error'), 'icon' => 'error', 'text' => $th->getMessage()]);
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  StoreRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreRequest $request)
    {
        try {
            $data = $request->all();

            $item = DB::transaction(function () use ($data) {
                return $this->documentTypeRepository->create($data);
            });

            return back()->with('alert', ['title' => __('messages.success'), 'icon' => 'success', 'text' => __('admin_pages.creators.document_types.messages.save_success', ['document_type' => $item->name])]);
        } catch (\Exception $th) {
            return back()->with('alert', ['title' => __('messages.error'), 'icon' => 'error', 'text' => __('admin_pages.creators.document_types.messages.save_error')]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        try {
            $item = $this->documentTypeRepository->getById($id);

            return view('admin.pages.creators.document_types.show', compact('item'));
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
            $item = $this->documentTypeRepository->getById($id);

            return view('admin.pages.creators.document_types.edit', compact('item'));
        } catch (\Exception $th) {
            return redirect()->route('admin.home')->with('alert', ['title' => __('messages.error'), 'icon' => 'error', 'text' => $th->getMessage()]);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  UpdateRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateRequest $request, $id)
    {
        try {
            $data = $request->all();

            $item = $this->documentTypeRepository->getById($id);

            DB::transaction(function () use ($item, $data) {
                $this->documentTypeRepository->update($item, $data);
            });

            return back()->with('alert', ['title' => __('messages.success'), 'icon' => 'success', 'text' => __('admin_pages.creators.document_types.messages.update_success', ['document_type' => $item->name])]);
        } catch (\Exception $th) {
            return back()->with('alert', ['title' => __('messages.error'), 'icon' => 'error', 'text' => __('admin_pages.creators.document_types.messages.update_error')]);
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
            $item = $this->documentTypeRepository->getById($id);

            DB::transaction(function () use ($item) {
                $this->documentTypeRepository->delete($item);
            });

            return back()->with('alert', ['title' => __('messages.success'), 'icon' => 'success', 'text' => __('admin_pages.creators.document_types.messages.delete_success', ['document_type' => $item->name])]);
        } catch (\Exception $th) {
            return back()->with('alert', ['title' => __('messages.error'), 'icon' => 'error', 'text' => __('admin_pages.creators.document_types.messages.delete_error')]);
        }
    }
}
