<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\UpdateProfileRequest;
use App\Models\Admin\Country;
use App\Models\Admin\User;
use Illuminate\Http\Request;
use Auth;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $data = Country::all();
        $country = Auth::user()->id_country;
        return view('admin.profile.user', compact('data', 'country'));
    }
    public function logout()
    {
        Auth::logout();
        return redirect("/login");
    }

    public function update(UpdateProfileRequest $request)
    {
        $userId = Auth::id();
        $user = User::findOrFail($userId);

        $data = $request->all();
        $file = $request->avatar;

        if (!empty($file)) {
            $data['avatar'] = $file->getClientOriginalName();
        }

        if ($data['password'] && $data['password'] == $data['password-c']) {
            $data['password'] = bcrypt($data['password']);

        } else {
            $data['password'] = $user->password;
        }

        if ($user->update($data)) {
            if (!empty($file)) {
                $file->move('upload/user/avatar', $file->getClientOriginalName());
            }
            return redirect()->back()->with('success', _('Update profile successfully.'));

        } else {
            return redirect()->back()->withErrors('Update profile failed.');
        }

    }
}
