<?php

namespace App\Services;

use App\Models\Campaign;
use App\Traits\ApiResponse;

class CampaignService
{
    use ApiResponse;

    /**
     * Function description
     */
    public static function getAll(): array
    {
        return self::arrayResponse(Campaign::with('map')->get());
    }

    /**
     * Function description
     *
     * @param  int  $id
     */
    public static function getById($id): array
    {
        return self::arrayResponse(Campaign::findOrFail($id));
    }

    /**
     * Function description
     *
     * @param  array  $data
     */
    public static function create($data): array
    {
        $newCampaign = Campaign::create($data);

        return self::arrayResponse($newCampaign);
    }

    /**
     * Function description
     *
     * @param  array  $data
     * @param  int  $id
     */
    public static function update($data, $id): array
    {
        $updatedCampaign = Campaign::findOrFail($id);
        $updatedCampaign = Campaign::update($data);

        return self::arrayResponse($updatedCampaign);
    }

    /**
     * Function description
     *
     * @param  int  $id
     */
    public static function delete($id): array
    {
        $deletedCampaign = Campaign::findOrFail($id);
        Campaign::delete($id);

        return self::arrayResponse($deletedCampaign);
    }
}
