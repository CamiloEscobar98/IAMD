<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;

use App\Repositories\Client\IntangibleAssetRepository;

use App\Services\Client\IntangibleAssetPhaseService;
use Illuminate\Validation\Rule;

class IntangibleAssetPhaseController extends Controller
{
    /** @var IntangibleAssetPhaseService */
    protected $intangibleAssetPhaseService;

    /** @var IntangibleAssetRepository */
    protected $intangibleAssetRepository;

    public function __construct(
        IntangibleAssetPhaseService $intangibleAssetPhaseService,
        IntangibleAssetRepository $intangibleAssetRepository
    ) {
        $this->middleware('auth');

        $this->intangibleAssetPhaseService = $intangibleAssetPhaseService;

        $this->intangibleAssetRepository = $intangibleAssetRepository;
    }

    /**
     * Intangible Asset Phase One: Intangible Asset Classification
     * 
     * @param int $id
     * @param int $intangibleAsset,
     * @param Request $request
     */
    public function updatePhaseOne($id, $intangibleAsset, Request $request): RedirectResponse
    {
        try {
            $intangibleAsset = $this->intangibleAssetRepository->getById($intangibleAsset);

            $data = $request->only(['intangible_asset_type_level_3']);

            $message = $this->intangibleAssetPhaseService->updatePhaseOne($intangibleAsset, $data);
            return redirect()->back()->with('alert', ['title' => __('messages.success'), 'icon' => 'success', 'text' => $message]);
        } catch (\Exception $th) {
            return redirect()->back()->with('alert', ['title' => __('messages.error'), 'icon' => 'error', 'text' => $th->getMessage()]);
        }
    }

    /**
     * Intangible Asset Phase Two: Intangible Asset Description
     * 
     * @param int $id
     * @param int $intangibleAsset,
     * @param Request $request
     */
    public function updatePhaseTwo($id, $intangibleAsset, Request $request): RedirectResponse
    {
        try {
            $intangibleAsset = $this->intangibleAssetRepository->getById($intangibleAsset);

            $data = $request->only(['description']);

            $message = $this->intangibleAssetPhaseService->updatePhaseTwo($intangibleAsset, $data);
            return redirect()->back()->with('alert', ['title' => __('messages.success'), 'icon' => 'success', 'text' => $message]);
        } catch (\Exception $th) {
            return redirect()->back()->with('alert', ['title' => __('messages.error'), 'icon' => 'error', 'text' => $th->getMessage()]);
        }
    }

    /**
     * Intangible Asset Phase Three: Intangible Asset State
     * 
     * @param int $id
     * @param int $intangibleAsset,
     * @param Request $request
     */
    public function updatePhaseThree($id, $intangibleAsset, Request $request): RedirectResponse
    {
        try {
            $intangibleAsset = $this->intangibleAssetRepository->getById($intangibleAsset);

            $data = $request->only(['intangible_asset_state_id']);

            $message = $this->intangibleAssetPhaseService->updatePhaseThree($intangibleAsset, $data);
            return redirect()->back()->with('alert', ['title' => __('messages.success'), 'icon' => 'success', 'text' => $message]);
        } catch (\Exception $th) {
            return redirect()->back()->with('alert', ['title' => __('messages.error'), 'icon' => 'error', 'text' => $th->getMessage()]);
        }
    }

    /**
     * Intangible Asset Phase Four: Intangible Asset State
     * 
     * @param int $id
     * @param int $intangibleAsset,
     * @param Request $request
     */
    public function updatePhaseFour($id, $intangibleAsset, Request $request): RedirectResponse
    {
        try {
            $intangibleAsset = $this->intangibleAssetRepository->getById($intangibleAsset);

            $data = $request->only('dpi_id');

            $message = $this->intangibleAssetPhaseService->updatePhaseFour($intangibleAsset, $data['dpi_id']);
            return redirect()->back()->with('alert', ['title' => __('messages.success'), 'icon' => 'success', 'text' => $message]);
        } catch (\Exception $th) {
            return redirect()->back()->with('alert', ['title' => __('messages.error'), 'icon' => 'error', 'text' => $th->getMessage()]);
        }
    }

    /**
     * Intangible Asset Phase Five: Intangible Asset current State
     * 
     * @param int $id
     * @param int $intangibleAsset,
     * @param Request $request
     */
    public function updatePhaseFive($id, $intangibleAsset, Request $request) #: RedirectResponse
    {
        $request->validate(['sub_phase' => ['required']]);

        $subPhase = $request->get('sub_phase');

        $rules = [];

        $data = [];

        switch ($subPhase) {
            case '1':
                $rules = [
                    'published_in' => [Rule::requiredIf($request->is_published == 1), 'nullable', 'string'],
                    'information_scope' => [Rule::requiredIf($request->is_published == 1), 'nullable', 'string'],
                    'published_at' => [Rule::requiredIf($request->is_published == 1), 'nullable', 'date']
                ];
                $data = $request->only(['is_published', 'published_in', 'information_scope', 'published_at']);

                break;
        }
        $request->validate($rules);

        try {
            $intangibleAsset = $this->intangibleAssetRepository->getById($intangibleAsset);

            $message = $this->intangibleAssetPhaseService->updatePhaseFive($intangibleAsset, $data, $subPhase);
            return redirect()->back()->with('alert', ['title' => __('messages.success'), 'icon' => 'success', 'text' => $message]);
        } catch (\Exception $th) {
            return redirect()->back()->with('alert', ['title' => __('messages.error'), 'icon' => 'error', 'text' => $th->getMessage()]);
        }
    }
}
