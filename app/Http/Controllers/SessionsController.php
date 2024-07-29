<?php

namespace App\Http\Controllers;

use App\Models\SiteSetting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Intern;
use App\Models\User;
use App\Models\Supervisor;
use Illuminate\Foundation\Auth\AuthenticatesUsers;



class SessionsController extends Controller
{
    public function create()
    {
        return view('session.supervisor.login');
    }

    public function createMagang()
    {
        return view('session.magang.login');
    }

    public function createAdmin()
    {
        return view('session.admin.login');
    }

    public function store()
    {
        $attributes = request()->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);


        if (Auth::attempt($attributes)) {
            $user = Supervisor::where('email', $attributes['email'])->first();

            if ($user->role === 'supervisor') {
                Auth::guard('supervisor')->login($user);
                session()->regenerate();
                return redirect()->intended(route('supervisor.dashboard'))->with(['success' => 'You are logged in.']);
            } else if (!$user) {
                return back()->withErrors(['email' => 'User Not Found']);
            }
        } else {

            return back()->withErrors(['email' => 'Email or password is Nullable.']);
        }
    }


    public function storeMagang()
    {
        $attributes = request()->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        if (Auth::guard('magang')->attempt($attributes)) {
            $user = Intern::where('email', $attributes['email'])->first();

            if ($user) {
                if ($user->role === 'magang') {
                    Auth::guard('magang')->login($user);
                    session()->regenerate();
                    return redirect()->intended(route('magang.dashboard'))->with(['success' => 'You are logged in.']);
                } else {
                    return back()->withErrors(['email' => 'User role is not magang.']);
                }
            } else {
                return back()->withErrors(['email' => 'User not found.']);
            }
        } else {
            return back()->withErrors(['email' => 'Email or password is incorrect.']);
        }

    }



    // public function storeAdmin()
    // {
    //     $attributes = request()->validate([
    //         'email' => 'required|email',
    //         'password' => 'required'
    //     ]);


    //     if (Auth::attempt($attributes)) {
    //         $user = User::where('email', $attributes['email'])->first();
    //         if (!$user) {
    //             return back()->withErrors(['email' => 'User Not Found']);
    //         }

    //         Auth::guard('web')->login($user);
    //         session()->regenerate();
    //         return redirect()->intended(route('admin.dashboard'))->with(['success' => 'You are logged in.']);

    //     } else {

    //         return back()->withErrors(['email' => 'Email or password is Nullable.']);
    //     }
    // }

    // public function storeAdmin()
    // {
    //     $siteSettings = SiteSetting::firstOrFail();
    //     $credentials = request()->validate([
    //         'email' => 'required|email',
    //         'password' => 'required'
    //     ]);

    //     if (Auth::attempt($credentials)) {
    //         $user = Auth::user();

    //         // dd($user);

    //         if ($user->role === 'admin') {
    //             return redirect()->intended(route('admin.dashboard', compact('siteSettings')))->with('success', 'You are logged in as Admin.');
    //         } elseif ($user->role === 'magang') {
    //             return redirect()->intended(route('magang.dashboard', compact('siteSettings')))->with('success', 'You are logged in as Magang.');
    //         } elseif ($user->role === 'supervisor') {
    //             return redirect()->intended(route('supervisor.dashboard', compact('siteSettings')))->with('success', 'You are logged in as Supervisor.');
    //         }

    //         // Auth::logout();
    //         // return back()->withErrors(['email' => 'Unauthorized.']);
    //     }

    //     return back()->withErrors(['email' => 'Invalid email or password.']);
    // }


    // public function destroy()
    // {
    //     $user = Auth::user();
    //     Auth::logout();

    //     if ($user->role == 'supervisor') {
    //         return redirect()->route('supervisor.dashboard')->with(['success' => 'You\'ve been logged out.']);
    //     } elseif ($user->role == 'magang') {
    //         return redirect()->route('magang.dashboard')->with(['success' => 'You\'ve been logged out.']);
    //     } else {
    //         return redirect()->route('login.admin')->with(['success' => 'You\'ve been logged out.']);
    //     }
    // }



    public function storeAdmin()
    {
        $siteSettings = SiteSetting::firstOrFail();
        $credentials = request()->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        if (Auth::attempt($credentials)) {
            $user = Auth::user();

            if ($user->hasRole('admin')) {
                return redirect()->intended(route('admin.dashboard', compact('siteSettings')))->with('success', 'You are logged in as Admin.');
            } elseif ($user->hasRole('magang')) {
                return redirect()->intended(route('magang.dashboard', compact('siteSettings')))->with('success', 'You are logged in as Magang.');
            } elseif ($user->hasRole('supervisor')) {
                return redirect()->intended(route('supervisor.dashboard', compact('siteSettings')))->with('success', 'You are logged in as Supervisor.');
            }

            Auth::logout();
            return back()->withErrors(['email' => 'Unauthorized.']);
        }

        return back()->withErrors(['email' => 'Invalid email or password.']);
    }

    public function destroy()
    {
        $user = Auth::user();
        Auth::logout();

        if ($user->hasRole('supervisor')) {
            return redirect()->route('admin.login')->with('success', 'You\'ve been logged out.');
        } elseif ($user->hasRole('magang')) {
            return redirect()->route('admin.login')->with('success', 'You\'ve been logged out.');
        } else {
            return redirect()->route('admin.login')->with('success', 'You\'ve been logged out.');
        }
    }


    public function destroyAdmin()
    {
        $user = Auth::user();
        Auth::logout();

        if ($user->role === 'supervisor') {
            return redirect()->route('supervisor.dashboard')->with(['success' => 'You\'ve been logged out.']);
        } elseif ($user->role === 'magang') {
            return redirect()->route('magang.dashboard')->with(['success' => 'You\'ve been logged out.']);
        } else {
            return redirect()->route('login.admin')->with(['success' => 'You\'ve been logged out.']);
        }
    }



    public function destroyMagang()
    {

        $user = Auth::user();
        Auth::logout();

        if ($user->role == 'supervisor') {
            return redirect()->route('supervisor.dashboard')->with(['success' => 'You\'ve been logged out.']);
        } elseif ($user->role == 'magang') {
            return redirect()->route('magang.dashboard')->with(['success' => 'You\'ve been logged out.']);
        } else {
            return redirect()->route('login.admin')->with(['success' => 'You\'ve been logged out.']);
        }
    }
}
