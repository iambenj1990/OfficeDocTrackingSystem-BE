<?php

namespace App\Http\Controllers;


use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Models\User;


class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        try {
            $users = User::where('active', true)->get();
            if ($users->isEmpty()) {
                return response()->json(['success' => false, 'message' => 'No users found.'], 404);
            }
            return response()->json(['success' => true, 'Users' => $users], 200);
        } catch (\Throwable $th) {
            return response()->json(['success' => false, 'error' => $th->getMessage()], 500);
        }catch (\Illuminate\Database\QueryException $e) {
            return response()->json(['success' => false, 'error' => $e->getMessage()], 500);
        } catch (\Illuminate\Validation\ValidationException $e) {
            return response()->json(['success' => false, 'error' => $e->errors()], 422);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'error' => $e->getMessage()], 500);
        }
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreUserRequest $request)
    {
        //
        try {
            $validated = $request->validated();
            $user = User::create($validated);
            return response()->json(['success' => true, 'message' => "User {$user->last_name}, {$user->first_name} {$user->middle_name} successfully saved"], 201);
        } catch (\Throwable $th) {
            return response()->json(['success' => false, 'error' => $th->getMessage()], 500);
        } catch (\Illuminate\Database\QueryException $e) {
            return response()->json(['success' => false, 'error' => $e->getMessage()], 500);
        } catch (\Illuminate\Validation\ValidationException $e) {
            return response()->json(['success' => false, 'error' => $e->errors()], 422);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'error' => $e->getMessage()], 500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //

        try {

            $user = User::findOrFail($id);
             return response()->json(['success' => true, 'user' => $user], 200);

        } catch (\Throwable $th) {
            //throw $th;
            return response()->json(['success' => false, 'error' => $th->getMessage()], 500);
        }catch (\Illuminate\Database\QueryException $e) {
            return response()->json(['success' => false, 'error' => $e->getMessage()], 500);
        } catch (\Illuminate\Validation\ValidationException $e) {
            return response()->json(['success' => false, 'error' => $e->errors()], 422);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'error' => $e->getMessage()], 500);
        }
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateUserRequest $request, string $id)
    {
        //
        try {

            $user = User::findOrFail($id);
            $validated = $request->validated();
            $user->update($validated);
            return response()->json(['success' => true, 'message' => 'User updated successfully'], 200);

        } catch (\Throwable $th) {
            return response()->json(['success' => false, 'error' => $th->getMessage()], 500);
        }catch (\Illuminate\Database\QueryException $e) {
            return response()->json(['success' => false, 'error' => $e->getMessage()], 500);
        } catch (\Illuminate\Validation\ValidationException $e) {
            return response()->json(['success' => false, 'error' => $e->errors()], 422);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'error' => $e->getMessage()], 500);
        }
    }

    /**
     * Deactivate the specified user from storage.
     */
    public function deactivate(string $id)
    {
        //
        try {

            $user = User::findOrFail($id);
            $user->update(['active' => false]);

            return response()->json(['success' => true, 'message' => 'User deactivated successfully'], 200);
        } catch (\Throwable $th) {
            return response()->json(['success' => false, 'error' => $th->getMessage()], 500);
        }catch (\Illuminate\Database\QueryException $e) {
            return response()->json(['success' => false, 'error' => $e->getMessage()], 500);
        } catch (\Illuminate\Validation\ValidationException $e) {
            return response()->json(['success' => false, 'error' => $e->errors()], 422);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'error' => $e->getMessage()], 500);
        }
    }
}
