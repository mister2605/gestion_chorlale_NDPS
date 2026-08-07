<?php

namespace App\Http\Controllers;

use App\Models\Pupitre;

class PupitreController extends Controller
{
    // GET /api/pupitres
    public function index()
    {
        return response()->json(Pupitre::orderBy('nom')->get());
    }
}
