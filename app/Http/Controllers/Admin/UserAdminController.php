<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class UserAdminController extends BaseController
{
    // use AuthorizesRequests, ValidatesRequests;
    protected $Model;

    public function __construct(Request $request)
    {
        $this->Model['User'] = new User();
    }

    public function index()
    {
        $users = User::all();
        return view('admin.user.index', ['users' => $users]);
    }

    function storeUser(Request $request)
    {
        // Validate the incoming request data
        $validator = Validator::make($request->all(), [
            'username' => 'required|string|max:255',
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email|max:255',
            'password' => 'required|string|min:8', // Minimum password length
            'access' => 'required|string|in:admin,user',
            'status' => 'required|string|in:active,inactive',
        ]);

        // Return validation errors if any
        if ($validator->fails()) {
            return response()->json([
                'errors' => $validator->errors(),
            ], 422); // Unprocessable Entity
        }

        // Hash the password securely
        $hashedPassword = Hash::make($request->input('password'));

        $check = $this->Model['User']->checkEmail($request->input('email'), $request->input('access'));

        if ($check > 0) {
            return response()->json([
                'errors' => 'Email Already Registered',
            ], 400);
        }

        // Create a new user (you can adjust this part according to your User model)
        $user = User::create([
            'username' => $request->input('username'),
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'password' => $hashedPassword,
            'access' => $request->input('access'),
            'status' => $request->input('status') === 'active' ? 1 : 0,
        ]);
        // Return a success response
        return response()->json([
            'message' => 'User created successfully.',
            'user' => [
                'id' => $user->id,
            ],
        ], 200);
    }

    function getDataUser(Request $request)
    {
        $id_user = $request->input('id');
        $user = User::find($id_user);

        if ($user) {
            return response()->json([
                'code' => 200,
                'user' => $user,
                'success' => true,
            ]);
        }
        return response()->json([
            'code' => 404,
            'massage' => 'Data Tidak ditemukan',
            'success' => false,
        ]);
    }

    public function updateUser(Request $request)
    {
        // Validate the incoming request data
        $validator = Validator::make($request->all(), [
            'id' => 'required|exists:users,id', // Ensure the user exists
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users,email,' . $request->input('id'), // Ignore current user email
            'username' => 'required|string|max:255|unique:users,username,' . $request->input('id'), // Ignore current username
            'access' => 'required|in:admin,user',
            'status' => 'required|in:active,inactive',
        ]);

        // If validation fails, return an error response
        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'errors' => $validator->errors(),
            ], 422);
        }

        // Find the user by ID
        $user = User::find($request->input('id'));

        if ($user) {
            // Update the user's data
            $user->name = $request->input('name');
            $user->email = $request->input('email');
            $user->username = $request->input('username');
            $user->access = $request->input('access');
            $user->status = $request->input('status');

            // Save the changes
            $user->save();

            return response()->json([
                'status' => 'success',
                'message' => 'User updated successfully!',
                'data' => $user,
            ]);
        }

        // If user not found, return an error response
        return response()->json([
            'status' => 'error',
            'message' => 'User not found.',
        ], 404);
    }

    public function deleteUser(Request $request)
    {
        // Validate the incoming request data
        $validator = Validator::make($request->all(), [
            'id' => 'required|exists:users,id',
        ]);
        // If validation fails, return an error response
        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'errors' => $validator->errors(),
            ], 422);
        }

        // Find the user by ID
        $user = User::find($request->input('id'));

        if ($user) {
            // Update the user's data
            $user->status = 'inactive';

            // Save the changes
            $user->save();

            return response()->json([
                'status' => 'success',
                'message' => 'User Delete successfully!',
                'data' => $user,
            ]);
        }
        // If user not found, return an error response
        return response()->json([
            'status' => 'error',
            'message' => 'User not found.',
        ], 404);
    }
}
