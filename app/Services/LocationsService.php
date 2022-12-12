<?php

namespace App\Services;

use App\Models\Location;
use Illuminate\Support\Facades\Log;
use Exception;

/**
 * Class LocationsService
 * @package App\Services
 */
class LocationsService {

    /**
     * Create new Location
     *
     * @param $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function createLocation($request)
    {
        try {
            if($request->validated()) {
                Location::create($request->toArray());
                return response()->json('ok',200);
            } else {
                throw new Exception('Error in step of location creation');
            }

        } catch(\Exception $e) {
            Log::error('Error when creating the user: '.$e, ['CREATE_ERROR']);

            return response()->json('error: '. $e, 500);
        }
    }

    /**
     * Update location
     *
     * @param $request
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function updateLocation($request, $id)
    {
        try {
            if($request->validated()) {
                $location = Location::findOrFail($id);
                if(!$location) {

                    return response()->json([
                        'message' => 'Location not found'
                    ], 403);
                }
                Location::where('id', $id)->update($request->toArray());

                return response()->json('ok',200);
            } else {
                throw new Exception('Error in step of user creation');
            }
        } catch(\Exception $e) {
            Log::error('Error when updating the user: '.$e, ['UPDATE_ERROR']);

            return response()->json('error: '. $e, 500);
        }
    }


    /**
     * Remove location
     *
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function deleteLocation($id)
    {
        try {
            $location = Location::findOrFail($id);
            if(!$location) {

                return response()->json([
                    'message' => 'User not found'
                ], 403);
            }
            Location::where('id', $id)->delete();
            return response()->json('ok',200);
        } catch(\Exception $e) {
            Log::error('Error when updating the user: '.$e, ['UPDATE_ERROR']);
            return response()->json('error: '. $e, 500);
        }
    }

}