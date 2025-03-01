<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\api\LoginRequest;
use App\Models\Admin\User;
use Auth;
use Illuminate\Http\Request;

class MemberController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Do login
     *
     * @param LoginRequest $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */


    public function login(LoginRequest $request)
    {
        // echo 111;
        // exit;
        $login = [
            'email' => $request->email,
            'password' => $request->password,
            'level' => 0
        ];

        $remember = false;

        if ($request->remember_me) {
            $remember = true;
        }

        // echo 11 ;
        // exit;
        if (Auth::attempt($login, $remember)) {

            // echo 11;

            // $login['password'] = bcrypt($login['password']);
            $user = Auth::user();
            // $user = User::create($login);
            $token = $user->createToken('authToken')->plainTextToken;
            // var_dump($token);
            // echo 11;
            // exit;
            return response()->json(
                [
                    'success' => 'success',
                    'token' => $token,
                    'Auth' => Auth::user()
                ]
            );
        } else {
            return response()->json(
                [
                    'response' => 'error',
                    'errors' => ['errors' => 'invalid email or password'],
                ]
            );

        }
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
