<?php

namespace App\Http\Controllers;

use App\Services\LocationsService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Location;
use App\Http\Requests\LocationRequest;
use Illuminate\Support\Facades\Validator;

/**
 * Class LocationsController
 * @package App\Http\Controllers
 */
class LocationsController extends Controller
{
    protected LocationsService $locationService;

    public function __construct(LocationsService $locationService) {
        $this->locationService = $locationService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Location::with('users')->get();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(LocationRequest $request): JsonResponse
    {
        return $this->locationService->createLocation($request);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return Location::findOrFail($id);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(LocationRequest $request, $id): JsonResponse
    {
        return $this->locationService->updateLocation($request, $id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id): JsonResponse
    {
        return $this->locationService->deleteLocation($id);
    }

    /**
     * @param Request $request
     * @param $id
     * @return mixed
     */
    public function getByUser(Request $request, $id): mixed
    {
        return User::where('id', $id)->with('locations')->get();
    }

    /**
     * @param Request $request
     * @return mixed
     */
    public function getByIp(Request $request): mixed
    {
        $validator = Validator::make($request->all(), [
            'ip' => 'ip'
        ]);
        if(!$validator->fails()) {
            return Location::query()->where('ip', 'LIKE', $request->ip)->get();
        }
        return response()->json(['message' => 'Something wrong:', 'errors' => $validator->errors()]);
    }

}
