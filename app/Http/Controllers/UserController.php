<?php

namespace App\Http\Controllers;

use App\Mail\EmailVerification;
use App\Models\User;
use Illuminate\Http\Request;
use Auth;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth', [
            'only' => ['edit', 'update', 'destroy']
        ]);
        $this->middleware('guest', [
            'only' => ['create', 'store']
        ]);
    }

    public function index()
    {
        $users = User::paginate(10);
        return view('users.index', compact('users'));
    }

    public function create()
    {
        return view('users.create');
    }

    public function show(User $user)
    {
        return view('users.show', compact('user'));
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|unique:users|max:50',
            'email' => 'required|email|unique:users|max:255',
            'password' => 'required|confirmed|min:6'
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
        ]);

        \Mail::to($user)->send(new EmailVerification($user));
        session()->flash('success', '验证邮件已发送到你的注册邮箱上，请注意查收。');
//        session()->flash('success', '欢迎，您将在这里开启一段新的旅程~');
        return redirect()->route('home');
    }

    public function edit(User $user)
    {
        $this->authorize('update', $user);

        return view('users.edit', compact('user'));
    }

    public function update(User $user, Request $request)
    {
        $this->authorize('update', $user);

        $this->validate($request, [
            'name' => 'required|max:50',
            'password' => 'nullable|confirmed|min:6'
        ]);

        $data['name'] = $request->name;
        $request->password && $data['password'] = bcrypt($request->password);

        $user->update($data);

        session()->flash('success', '个人资料更新成功。');
        return redirect()->route('user.show', $user);
    }

    public function destroy(User $user)
    {
        $this->authorize('destroy', $user);

        $user->delete();

        session()->flash('success', '成功删除用户！');
        return back();
    }

    public function confirmEmail($token)
    {
        $user = User::where('activation_token', $token)->firstOrFail();

        $user->update([
            'actived' => true,
            'activation_token' => null,
        ]);

        Auth::login($user);
        session()->flash('success', '您的帐号已成功激活！');
        return redirect()->route('user.show', $user);
    }
}
