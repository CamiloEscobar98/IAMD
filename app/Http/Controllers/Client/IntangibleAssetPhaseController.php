<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Validation\Rule;

use App\Repositories\Client\IntangibleAssetRepository;

use App\Services\Client\IntangibleAssetPhaseService;
use Exception;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Log;

class IntangibleAssetPhaseController extends Controller
{
    /** @var IntangibleAssetPhaseService */
    protected $intangibleAssetPhaseService;

    /** @var IntangibleAssetRepository */
    protected $intangibleAssetRepository;

    public function __construct(
        IntangibleAssetPhaseService $intangibleAssetPhaseService,
        IntangibleAssetRepository $intangibleAssetRepository,
    ) {
        $this->middleware('auth');

        $this->intangibleAssetPhaseService = $intangibleAssetPhaseService;

        $this->intangibleAssetRepository = $intangibleAssetRepository;
    }

    /**
     * Intangible Asset Phase One: Intangible Asset Classification
     * 
     * @param int $client
     * @param int $intangible_asset
     * @param Request $request
     * 
     * @return RedirectResponse
     */
    public function updatePhaseOne($client, $intangible_asset, Request $request) #: RedirectResponse
    {
        try {
            $intangibleAsset = $this->intangibleAssetRepository->getById($intangible_asset);

            $data = $request->only(['intellectual_property_right_product_id']);

            $message = $this->intangibleAssetPhaseService->updatePhaseOne($intangibleAsset, $data);
            return redirect()->route('client.intangible_assets.show', compact('client', 'intangible_asset'))->with('alert', ['title' => __('messages.success'), 'icon' => 'success', 'text' => $message]);
        } catch (QueryException $qe) {
            Log::error("@Web/Controllers/Client/IntangibleAssetPhaseController:UpdatePhaseOne/QueryException: {$qe->getMessage()}");
        } catch (Exception $e) {
            Log::error("@Web/Controllers/Client/IntangibleAssetPhaseController:UpdatePhaseOne/Exception: {$e->getMessage()}");
        }
        return redirect()->route('client.intangible_assets.show', compact('client', 'intangible_asset'))->with('alert', ['title' => __('messages.error'), 'icon' => 'error', 'text' => $message]);
    }

    /**
     * Intangible Asset Phase Two: Intangible Asset Description
     * 
     * @param int $client
     * @param int $intangible_asset,
     * @param Request $request
     * 
     * @return RedirectResponse
     */
    public function updatePhaseTwo($client, $intangible_asset, Request $request): RedirectResponse
    {
        try {
            $intangibleAsset = $this->intangibleAssetRepository->getById($intangible_asset);

            $data = $request->only(['description']);

            $message = $this->intangibleAssetPhaseService->updatePhaseTwo($intangibleAsset, $data);


            return redirect()->route('client.intangible_assets.show', compact('client', 'intangible_asset'))->with('alert', ['title' => __('messages.success'), 'icon' => 'success', 'text' => $message]);
        } catch (QueryException $qe) {
            Log::error("@Web/Controllers/Client/IntangibleAssetPhaseController:UpdatePhaseTwo/QueryException: {$qe->getMessage()}");
        } catch (Exception $e) {
            Log::error("@Web/Controllers/Client/IntangibleAssetPhaseController:UpdatePhaseTwo/Exception: {$e->getMessage()}");
        }
        return redirect()->route('client.intangible_assets.show', compact('client', 'intangible_asset'))->with('alert', ['title' => __('messages.error'), 'icon' => 'error', 'text' => $message]);
    }

    /**
     * Intangible Asset Phase Three: Intangible Asset State
     * 
     * @param int $client
     * @param int $intangible_asset,
     * @param Request $request
     * 
     * @return RedirectResponse
     */
    public function updatePhaseThree($client, $intangible_asset, Request $request): RedirectResponse
    {
        try {
            $intangibleAsset = $this->intangibleAssetRepository->getById($intangible_asset);

            $data = $request->only(['intangible_asset_state_id']);

            $message = $this->intangibleAssetPhaseService->updatePhaseThree($intangibleAsset, $data);
            return redirect()->route('client.intangible_assets.show', compact('client', 'intangible_asset'))->with('alert', ['title' => __('messages.success'), 'icon' => 'success', 'text' => $message]);
        } catch (QueryException $qe) {
            Log::error("@Web/Controllers/Client/IntangibleAssetPhaseController:UpdatePhaseThree/QueryException: {$qe->getMessage()}");
        } catch (Exception $e) {
            Log::error("@Web/Controllers/Client/IntangibleAssetPhaseController:UpdatePhaseThree/Exception: {$e->getMessage()}");
        }
        return redirect()->route('client.intangible_assets.show', compact('client', 'intangible_asset'))->with('alert', ['title' => __('messages.error'), 'icon' => 'error', 'text' => $message]);
    }

    /**
     * Intangible Asset Phase Four: Intangible Asset DPIS
     * 
     * @param int $client
     * @param int $intangible_asset,
     * @param Request $request
     * 
     * @return RedirectResponse
     */
    public function updatePhaseFour($client, $intangible_asset, Request $request): RedirectResponse
    {
        try {
            $intangibleAsset = $this->intangibleAssetRepository->getById($intangible_asset);

            $data = $request->get('dpi_id', []);

            $message = $this->intangibleAssetPhaseService->updatePhaseFour($intangibleAsset, $data);
            return redirect()->route('client.intangible_assets.show', compact('client', 'intangible_asset'))->with('alert', ['title' => __('messages.success'), 'icon' => 'success', 'text' => $message]);
        } catch (QueryException $qe) {
            Log::error("@Web/Controllers/Client/IntangibleAssetPhaseController:UpdatePhaseFour/QueryException: {$qe->getMessage()}");
        } catch (Exception $e) {
            Log::error("@Web/Controllers/Client/IntangibleAssetPhaseController:UpdatePhaseFour/Exception: {$e->getMessage()}");
        }
        return redirect()->route('client.intangible_assets.show', compact('client', 'intangible_asset'))->with('alert', ['title' => __('messages.error'), 'icon' => 'error', 'text' => $message]);
    }

    /**
     * Intangible Asset Phase Five: Intangible Asset current State
     * 
     * @param int $client
     * @param int $intangible_asset,
     * @param Request $request
     * 
     * @return RedirectResponse
     */
    public function updatePhaseFive($client, $intangible_asset, Request $request) #: RedirectResponse
    {
        $request->validate(['sub_phase' => ['required']]);

        $subPhase = $request->get('sub_phase');

        $rules = [];

        $data = [];

        $icon = 'error';

        switch ($subPhase) {
            case '1':
                $rules = [
                    'published_in' => [Rule::requiredIf($request->is_published == 1), 'nullable', 'string'],
                    'information_scope' => [Rule::requiredIf($request->is_published == 1), 'nullable', 'string'],
                    'published_at' => [Rule::requiredIf($request->is_published == 1), 'nullable', 'date']
                ];
                $data = $request->only(['is_published', 'published_in', 'information_scope', 'published_at']);
                break;

            case '2':
                $rules = [
                    'organization_confidenciality' => [Rule::requiredIf($request->has_confidenciality_contract == 1), 'nullable', 'string'],
                    'confidenciality_contract_file' => [Rule::requiredIf($request->has_confidenciality_contract == 1), 'nullable', 'file', 'mimes:pdf,docx'],
                ];
                $data = $request->only(['has_confidenciality_contract', 'organization_confidenciality']);
                $data['file'] = $request->file('confidenciality_contract_file');
                break;

            case '3':
                $data = $request->get('creator_id', []);

                break;

            case '4':
                $rules = [
                    'owner' => [Rule::requiredIf($request->has_session_right == 1), 'nullable', 'string'],
                    'session_right_contract_file' => [Rule::requiredIf($request->has_session_right == 1), 'nullable', 'file', 'mimes:pdf,docx'],
                ];
                $data = $request->only(['has_session_right', 'owner']);
                $data['file'] = $request->file('session_right_contract_file');
                break;

            case '5':
                $rules = [
                    'price' => [Rule::requiredIf($request->has_contability == 1), 'nullable', 'numeric'],
                    'comments' => [Rule::requiredIf($request->has_contability == 1), 'nullable', 'string'],
                ];
                $data = $request->only(['has_contability', 'price', 'comments']);
                break;

            case '6':
                $rules = [
                    'entity' => [Rule::requiredIf($request->has_academic_record == 1), 'nullable', 'string'],
                    'administrative_record_num' => [Rule::requiredIf($request->has_academic_record == 1), 'nullable', 'string'],
                    'date' => [Rule::requiredIf($request->has_academic_record == 1), 'nullable', 'date'],
                    'academic_record_file' => [Rule::requiredIf($request->has_academic_record == 1), 'nullable', 'file', 'mimes:pdf,docx'],
                ];
                $data = $request->only(['has_academic_record', 'administrative_record_num', 'date', 'entity']);
                $data['file'] = $request->file('academic_record_file');
                break;
        }
        $request->validate($rules);

        try {
            $intangibleAsset = $this->intangibleAssetRepository->getById($intangible_asset);
            $message = $this->intangibleAssetPhaseService->updatePhaseFive($intangibleAsset, $data, $subPhase);
            $icon = 'success';
        } catch (Exception $e) {
            $icon = 'error';
            Log::error("@Web/Controllers/Client/IntangibleAssetPhaseController:UpdatePhaseFive/Exception: {$e->getMessage()}");
        }
        return redirect()->route('client.intangible_assets.show', compact('client', 'intangible_asset'))->with('alert', ['title' => __('messages.error'), 'icon' => $icon, 'text' => $message]);
    }

    /**
     * @param int $client
     * @param int $intangible_asset
     * @param Request $request
     * 
     * @return RedirectResponse
     */
    public function updatePhaseSix($client, $intangible_asset, Request $request) #: RedirectResponse
    {
        $request->validate(['type' => ['required']]);

        $type = $request->get('type');

        $rules = [];

        $data = [];

        switch ($type) {
            case '1':
                $rules = [
                    'message' => ['required', 'string']
                ];
                $data = $request->only(['message']);
                $data['user_id'] = current_user()->id;
                $data['intangible_asset_id'] = $intangible_asset;
                break;

            case '2':
                # code...
                break;
        }
        $request->validate($rules);

        try {
            $intangibleAsset = $this->intangibleAssetRepository->getById($intangible_asset);


            $message = $this->intangibleAssetPhaseService->updatePhaseSix($intangibleAsset, $data, $type);
            return redirect()->route('client.intangible_assets.show', compact('client', 'intangible_asset'))->with('alert', ['title' => __('messages.success'), 'icon' => 'success', 'text' => $message]);
        } catch (QueryException $qe) {
            Log::error("@Web/Controllers/Client/IntangibleAssetPhaseController:UpdatePhaseSix/QueryException: {$qe->getMessage()}");
        } catch (Exception $e) {
            Log::error("@Web/Controllers/Client/IntangibleAssetPhaseController:UpdatePhaseSix/Exception: {$e->getMessage()}");
        }
        return redirect()->route('client.intangible_assets.show', compact('client', 'intangible_asset'))->with('alert', ['title' => __('messages.error'), 'icon' => 'error', 'text' => $message]);
    }

    /**
     * @param int $client
     * @param int $intangible_asset
     * @param Request $request
     * 
     * @return RedirectResponse
     */
    public function updatePhaseSeven($client, $intangible_asset, Request $request)
    {
        $request->validate(['sub_phase' => ['required']]);

        $subPhase = $request->get('sub_phase');

        $rules = [];

        $data = [];

        switch ($subPhase) {
            case '1':
                $rules = [
                    'reference' => ['required', 'string']
                ];
                $data = $request->only(['has_protection_action', 'reference']);
                break;

            case '2':
                $rules = [
                    'secret_protection_measure_id' => [Rule::requiredIf($request->has_secret_protection == 1)]
                ];
                $data = $request->only(['has_secret_protection']);
                $data['secret_protection_measure_id'] = $request->get('secret_protection_measure_id', []);
                break;
        }
        $request->validate($rules);

        try {
            $intangibleAsset = $this->intangibleAssetRepository->getById($intangible_asset);

            $message = $this->intangibleAssetPhaseService->updatePhaseSeven($intangibleAsset, $data, $subPhase);
            return redirect()->route('client.intangible_assets.show', compact('client', 'intangible_asset'))->with('alert', ['title' => __('messages.success'), 'icon' => 'success', 'text' => $message]);
        } catch (QueryException $qe) {
            Log::error("@Web/Controllers/Client/IntangibleAssetPhaseController:UpdatePhaseSeven/QueryException: {$qe->getMessage()}");
        } catch (Exception $e) {
            Log::error("@Web/Controllers/Client/IntangibleAssetPhaseController:UpdatePhaseSeven/Exception: {$e->getMessage()}");
        }
        return redirect()->route('client.intangible_assets.show', compact('client', 'intangible_asset'))->with('alert', ['title' => __('messages.error'), 'icon' => 'error', 'text' => $message]);
    }

    /**
     * @param int $client
     * @param int $intangible_asset
     * @param Request $request
     * 
     * @return RedirectResponse
     */
    public function updatePhaseEight($client, $intangible_asset, Request $request)
    {
        try {
            $message = $this->intangibleAssetPhaseService->updatePhaseEight($intangible_asset, $request);

            return redirect()->route('client.intangible_assets.show', compact('client', 'intangible_asset'))->with('alert', ['title' => __('messages.success'), 'icon' => 'success', 'text' => $message]);
        } catch (QueryException $qe) {
            Log::error("@Web/Controllers/Client/IntangibleAssetPhaseController:UpdatePhaseEight/QueryException: {$qe->getMessage()}");
        } catch (Exception $e) {
            Log::error("@Web/Controllers/Client/IntangibleAssetPhaseController:UpdatePhaseEight/Exception: {$e->getMessage()}");
        }
        return redirect()->route('client.intangible_assets.show', compact('client', 'intangible_asset'))->with('alert', ['title' => __('messages.error'), 'icon' => 'error', 'text' => $message]);
    }

    /**
     * @param int $client
     * @param int $intangible_asset
     * @param Request $request
     * 
     * @return RedirectResponse
     */
    public function updatePhaseNine($client, $intangible_asset, Request $request)
    {
        $rules = [
            'reason' => [Rule::requiredIf($request->is_commercial == 1)]
        ];

        $request->validate($rules);

        try {

            $intangibleAsset = $this->intangibleAssetRepository->getById($intangible_asset);

            $data = $request->only(['is_commercial', 'reason']);

            $message = $this->intangibleAssetPhaseService->updatePhaseNine($intangibleAsset, $data);

            return redirect()->route('client.intangible_assets.show', compact('client', 'intangible_asset'))->with('alert', ['title' => __('messages.success'), 'icon' => 'success', 'text' => $message]);
        } catch (QueryException $qe) {
            Log::error("@Web/Controllers/Client/IntangibleAssetPhaseController:UpdatePhaseNine/QueryException: {$qe->getMessage()}");
        } catch (Exception $e) {
            Log::error("@Web/Controllers/Client/IntangibleAssetPhaseController:UpdatePhaseNine/Exception: {$e->getMessage()}");
        }
        return redirect()->route('client.intangible_assets.show', compact('client', 'intangible_asset'))->with('alert', ['title' => __('messages.error'), 'icon' => 'error', 'text' => __('messages.syntax_error')]);
    }
}
