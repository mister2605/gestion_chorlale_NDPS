<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    // POST /login
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required|string',
        ]);

        if (! Auth::attempt($credentials, true)) {
            return response()->json(['message' => 'Identifiants incorrects.'], 422);
        }

        $request->session()->regenerate();

        return response()->json(Auth::user()->load('pupitre'));
    }

    // POST /logout
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return response()->json(['message' => 'Déconnecté.']);
    }

    // GET /api/user — utilisateur actuellement connecté (ou 401)
    public function me(Request $request)
    {
        return response()->json($request->user()->load('pupitre'));
    }
}
