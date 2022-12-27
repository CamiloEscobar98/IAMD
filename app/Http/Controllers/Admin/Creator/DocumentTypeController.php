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

            [$params, $total, $items, $links] = $this->documentTypeService->searchWithPagination($request->all(), $request->get('page'));
            return view('admin.pages.creators.document_types.index', compact('links'))
                ->nest('filters', 'admin.pages.creators.document_types.components.filters', compact('params', 'total'))
                ->nest('table', 'admin.pages.creators.document_types.components.table', compact('items'));
        } catch (\Exception $th) {
            return redirect()->route('admin.creators.document_types.index')->with('alert', ['title' => __('messages.error'), 'icon' => 'error', 'text' => __('messages.syntax_error')]);
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
            $item = $this->documentTypeRepository->newInstance();
            return view('admin.pages.creators.document_types.create', compact('item'));
        } catch (\Exception $th) {
            return redirect()->route('admin.home')->with('alert', ['title' => __('messages.error'), 'icon' => 'error', 'text' => __('messages.syntax_error')]);
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
        return redirect()->route('admin.creators.document_types.create')->with('alert', $this->documentTypeService->save($request->all()));
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
            return redirect()->route('admin.home')->with('alert', ['title' => __('messages.error'), 'icon' => 'error', 'text' => __('pages.admin.creators.document_types.messages.not_found')]);
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
            return redirect()->route('admin.home')->with('alert', ['title' => __('messages.error'), 'icon' => 'error', 'text' => __('pages.admin.creators.document_types.messages.not_found')]);
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
        return redirect()->route('admin.creators.document_types.edit', $id)->with('alert', $this->documentTypeService->update($request->all(), $id));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        return redirect()->route('admin.creators.document_types.index')->with('alert', $this->documentTypeService->delete($id));
    }
}
