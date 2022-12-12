<?php

namespace App\Services;

use App\Models\User;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Hash;
use Exception;

class UsersService {

    /**
     * Create new user
     *
     * @param $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function createUser($request)
    {
        try {

            if($request->validated()) {
                User::create([
                    'name' => $request->name,
                    'email' => $request->email,
                    'password' => Hash::make($request->password),
                    'role_id' => $request->role_id
                ]);
                return response()->json('ok',200);
            } else {
                throw new Exception('Error in step of user creation');
            }
        } catch(\Exception $e) {
            dd($e);
            Log::error('Error when creating the user: '.$e, ['CREATE_ERROR']);

            return response()->json('error: '. $e, 500);
        }
    }

    /**
     * Update user
     *
     * @param $request
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function updateUser($request, $id)
    {
        try {
            if($request->validated()) {
                $user = User::findOrFail($id);
                if(!$user) {

                    return response()->json([
                        'message' => 'User not found'
                    ], 403);
                }
                User::where('id', $id)->update($request->toArray());

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
     * Delete user
     *
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function deleteUser($id)
    {
        try {
            $user = User::findOrFail($id);
            if(!$user) {

                return response()->json([
                    'message' => 'User not found'
                ], 403);
            }
            User::where('id', $id)->delete();
            return response()->json('ok',200);
        } catch(\Exception $e) {
            Log::error('Error when updating the user: '.$e, ['UPDATE_ERROR']);
            return response()->json('error: '. $e, 500);
        }
    }

}