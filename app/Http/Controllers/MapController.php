<?php

namespace App\Http\Controllers;

use App\Http\Requests\MapStore;
use App\Http\Requests\MapUpdate;
use App\Models\Map;
use App\Services\MapService;
use App\Traits\FormatExceptionResponse;
use Exception;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\JsonResponse;

/**
 * @group Maps
 *
 * Endpoints for managing maps
 */
class MapController extends Controller
{
    use FormatExceptionResponse;

    /**
     * Display a listing of maps.
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
            return response()->json(MapService::getAll())->setStatusCode(JsonResponse::HTTP_OK);
        } catch (Exception $ex) {
            return response()->json(self::formatMessage($ex->getMessage(), $ex->code ?? null))->setStatusCode(JsonResponse::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    /**
     * Store a newly created map in storage.
     *
     * @authenticated
     */
    public function store(MapStore $request): JsonResponse
    {
        try {
            return response()->json(MapService::create($request->validated()))->setStatusCode(JsonResponse::HTTP_CREATED);
        } catch (Exception $ex) {
            return response()->json(self::formatMessage($ex->getMessage(), $ex->code ?? null))->setStatusCode(JsonResponse::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    /**
     * Display the specified map.
     *
     * @authenticated
     */
    public function show(Map $map): JsonResponse
    {
        try {
            return response()->json(MapService::getById($map->id))->setStatusCode(JsonResponse::HTTP_OK);
        } catch (ModelNotFoundException $ex) {
            return response()->json(self::formatMessage($ex->getMessage(), $ex->code ?? null))->setStatusCode(JsonResponse::HTTP_NOT_FOUND);
        } catch (Exception $ex) {
            return response()->json(self::formatMessage($ex->getMessage(), $ex->code ?? null))->setStatusCode(JsonResponse::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    /**
     * Update the specified map in storage.
     *
     * @authenticated
     */
    public function update(MapUpdate $request, Map $map): JsonResponse
    {
        try {
            return response()->json(MapService::update($request->validated(), $map->id))->setStatusCode(JsonResponse::HTTP_OK);
        } catch (ModelNotFoundException $ex) {
            return response()->json(self::formatMessage($ex->getMessage(), $ex->code ?? null))->setStatusCode(JsonResponse::HTTP_NOT_FOUND);
        } catch (Exception $ex) {
            return response()->json(self::formatMessage($ex->getMessage(), $ex->code ?? null))->setStatusCode(JsonResponse::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    /**
     * Remove the specified map from storage.
     *
     * @authenticated
     */
    public function destroy(Map $map): JsonResponse
    {
        try {
            return response()->json(MapService::delete($map->id))->setStatusCode(JsonResponse::HTTP_OK);
        } catch (ModelNotFoundException $ex) {
            return response()->json(self::formatMessage($ex->getMessage(), $ex->code ?? null))->setStatusCode(JsonResponse::HTTP_NOT_FOUND);
        } catch (Exception $ex) {
            return response()->json(self::formatMessage($ex->getMessage(), $ex->code ?? null))->setStatusCode(JsonResponse::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}
