<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\Http\RedirectResponse;

use Inertia\Inertia;
use Inertia\Response;

use App\Http\Controllers\Controller;
use App\Models\User;

class UsuarioController extends Controller {
    public function index(): Response {
        return Inertia::render('Admin/Usuario');
    }

    public function create(Request $request): RedirectResponse {
        $request->validate([
            'nome' => 'required|string|max:255',
            'email' => 'required|string|lowercase|email|max:255|unique:'.User::class,
            'senha' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        $user = User::create([
            'name' => $request->nome,
            'email' => $request->email,
            'password' => Hash::make($request->senha),
        ]);

        return back();
    }
}
