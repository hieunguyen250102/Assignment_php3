<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::where('role', '=', 1)->get();
        return view('admin.account.index', [
            'users' => $users
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        return view('client.register');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UserRequest $request)
    {
        $data = $request->all();
        $flash = $request->flash([
            'email' => $request->email,
            'phone' => $request->phone,
            'firtsname' => $request->firtsname,
            'lastname' => $request->lastname,
            'avatar' => $request->avatar,
            'address' => $request->address,
            'birthday' => $request->birthday,
            'password' => $request->password,
        ]);
        // dd($flash);
        $data['code'] = 'PH' . rand(1, 99999);
        $data['status'] = 0;
        $data['role'] = 1;
        if ($request->hasFile('avatar')) {
            $destination_path = 'public/images/avatar';
            $image = $request->file('avatar');
            $image_name = $image->getClientOriginalName();
            $path = $request->file('avatar')->storeAs($destination_path, $image_name);
            $data['avatar'] = $image_name;
        }
        $data['password'] = Hash::make($request->password);
        User::create($data);
        return redirect()->route('users.index')->with('alert', 'Create account successfully!!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request)
    {
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
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
    public function login()
    {
        return view('client.login');
    }

    public function checkLogin(Request $request)
    {
        $validate = $request->validate([
            'email' => 'required',
            'password' => 'required',
        ]);
        $email = $request->email;
        $password = $request->password;

        // dd(Auth::attempt(['email' => $email, 'password' => $password]));
        if (Auth::attempt(['email' => $email, 'password' => $password])) {
            $auth = Auth::user();
            if ($auth->role == 1 && $auth->status == 1) {
                return redirect()->route('client.index');
            } else if ($auth->role == 0 && $auth->status == 1) {
                return redirect()->route('admin.index');
            }
        } else {
            return redirect()->route('users.login')->with('error', 'Email or password is incorrect');
        }
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('users.login');
    }

    public function getAccount()
    {
    }

    public function updateStatusUser(User $User, Request $request)
    {
        // dd($request->status);
        $User = User::find($request->id);
        $User->fill($request->all());
        $User->save();
        return redirect()->route('users.index')->with('alert', 'Update status successfully!!');
    }
}
