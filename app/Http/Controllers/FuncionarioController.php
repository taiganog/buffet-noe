<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Inertia\Inertia;
use Inertia\Response;

class FuncionarioController extends Controller
{
    public function index(): Response {
        return Inertia::render('Admin/Dashboard');
    }
}
