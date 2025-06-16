<?php

namespace App\Http\Controllers;

use App\Http\Requests\CampaignStore;
use App\Http\Requests\CampaignUpdate;
use App\Models\Campaign;
use App\Services\CampaignService;
use App\Traits\FormatExceptionResponse;
use Exception;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\JsonResponse;

/**
 * @group Campaigns
 *
 * Endpoints for managing campaigns
 */
class CampaignController extends Controller
{
    use FormatExceptionResponse;

    /**
     * Display a listing of campaigns.
     *
     * @authenticated
     *
     * @queryParam sort string Field to sort by. Defaults to 'id'
     * @queryParam direction string Direction of the sorting 'asc'/'desc'
     *
     */
    public function index(): JsonResponse
    {
        try {
            return response()->json(CampaignService::getAll())->setStatusCode(JsonResponse::HTTP_OK);
        } catch (Exception $ex) {
            return response()->json(self::formatMessage($ex->getMessage(), $ex->code ?? null))->setStatusCode(JsonResponse::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    /**
     * Store a newly created campaign in storage.
     *
     * @authenticated
     *
     */
    public function store(CampaignStore $request)
    {
        try {
            return response()->json(CampaignService::create($request->validated()))->setStatusCode(JsonResponse::HTTP_CREATED);
        } catch (Exception $ex) {
            return response()->json(self::formatMessage($ex->getMessage(), $ex->code ?? null))->setStatusCode(JsonResponse::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    /**
     * Display the specified campaign.
     *
     * @authenticated
     */
    public function show(Campaign $campaign)
    {
        try {
            return response()->json(CampaignService::getById($campaign->id))->setStatusCode(JsonResponse::HTTP_OK);
        } catch (ModelNotFoundException $ex) {
            return response()->json(self::formatMessage($ex->getMessage(), $ex->code ?? null))->setStatusCode(JsonResponse::HTTP_NOT_FOUND);
        } catch (Exception $ex) {
            return response()->json(self::formatMessage($ex->getMessage(), $ex->code ?? null))->setStatusCode(JsonResponse::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    /**
     * Update the specified campaign in storage.
     *
     * @authenticated
     */
    public function update(CampaignUpdate $request, Campaign $campaign)
    {
        try {
            return response()->json(CampaignService::update($request->validated(), $campaign->id))->setStatusCode(JsonResponse::HTTP_OK);
        } catch (ModelNotFoundException $ex) {
            return response()->json(self::formatMessage($ex->getMessage(), $ex->code ?? null))->setStatusCode(JsonResponse::HTTP_NOT_FOUND);
        } catch (Exception $ex) {
            return response()->json(self::formatMessage($ex->getMessage(), $ex->code ?? null))->setStatusCode(JsonResponse::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    /**
     * Remove the specified campaign from storage.
     *
     * @authenticated
     */
    public function destroy(Campaign $campaign)
    {
        try {
            return response()->json(CampaignService::delete($campaign->id))->setStatusCode(JsonResponse::HTTP_OK);
        } catch (ModelNotFoundException $ex) {
            return response()->json(self::formatMessage($ex->getMessage(), $ex->code ?? null))->setStatusCode(JsonResponse::HTTP_NOT_FOUND);
        } catch (Exception $ex) {
            return response()->json(self::formatMessage($ex->getMessage(), $ex->code ?? null))->setStatusCode(JsonResponse::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}
