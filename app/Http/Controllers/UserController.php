<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\UserService;
use App\Models\User;
use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;

class UserController extends Controller
{
    //
    /**
     * The user service instance.
     *
     * @var \App\Services\UserService
     */
    protected $userService;
    
    /**
     * Create a new controller instance.
     *
     * @param  \App\Services\UserService  $userService
     * @return void
     */
    public function __construct(UserService $userService){
        $this->userService = $userService;
    }

    /**
     * Display a listing of the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(Request $request){
        $data = $this->userService->index($request);

        return response()->json($data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreUserRequest  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(StoreUserRequest $request){
        $data = $this->userService->createUser($request->validated());

        if(!($data['code'] >= 200 && $data['code'] < 300)){
            return response()->json($data, $data['code']);
        }
        
        return response()->json($data, $data['code']);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($id){
        $data = $this->userService->getUser($id);

        if(!($data['code'] >= 200 && $data['code'] < 300)){
            return response()->json($data, $data['code']);
        }

        return response()->json($data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @param  \App\Http\Requests\UpdateUserRequest  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function update($id, UpdateUserRequest $request){
        $data = $this->userService->update($id, $request->validated());

        if(!($data['code'] >= 200 && $data['code'] < 300)){
            return response()->json($data, $data['code']);
        }

        return response()->json($data, $data['code']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($id){
        $data = $this->userService->destroy($id);

        if(!($data['code'] >= 200 && $data['code'] < 300)){
            return response()->json($data, $data['code']);
        }

        return response()->json($data, $data[code]);
    }
}
