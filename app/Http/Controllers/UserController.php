<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\UserServiceContract as UserService;
use App\Models\User;

class UserController extends Controller
{
    protected $userService;
    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('user.index', $this->userService->getDataIndex());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:6',
            'conf_password' => 'required|same:password|min:6'
        ]);

        return response()->json(['success' => $this->userService->createOrUpdateUser($request->all())]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        return response()->json(['data' => $this->userService->getUserById($id)]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users,email,'.$request->id,
            'id'    => 'required'
        ]);

        if($request->has('password') && !empty($request->password) && !empty($request->conf_password)) {
            $request->validate([
                'password' => 'required|min:6',
                'conf_password' => 'required|same:password|min:6'
            ]);
        }

        return response()->json(['success' => $this->userService->createOrUpdateUser($request->all(), true)]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        return response()->json(['success' => $this->userService->deleteUser($id)]);
    }

    public function userList(Request $request){
        return response()->json($this->userService->getUserList($request->all()));
    }
}
