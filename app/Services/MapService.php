<?php

namespace App\Services;

use App\Models\Map;
use App\Traits\ApiResponse;

class MapService
{
    use ApiResponse;

    /**
     * Function description
     * @param array $data
     * @return array
     */
    public static function getAll(): array
    {
        return self::arrayResponse(Map::all());
    }

    /**
     * Function description
     * @param int $id
     * @return array
     */
    public static function getById(int $id): array
    {
        return self::arrayResponse(Map::findOrFail($id));
    }

    /**
     * Function description
     * @param array $data
     * @return array
     */
    public static function create($data): array
    {
        $newMap = Map::create($data);
        return self::arrayResponse($newMap);
    }

    /**
     * Function description
     * @param array $data
     * @param int $id
     * @return array
     */
    public static function update($data, $id): array
    {
        $updatedMap = Map::findOrFail($id);
        $updatedMap->update($data);
        return self::arrayResponse($updatedMap);
    }

    /**
     * Function description
     * @param array $id
     * @return array
     */
    public static function delete($id): array
    {
        $deletedMap = Map::findOrFail($id);
        Map::delete($id);
        return self::arrayResponse($deletedMap);
    }
}
