<?php

namespace App\Http\Controllers;

use App\Models\Chant;
use Illuminate\Http\Request;

class ChantController extends Controller
{
    // GET /api/chants — liste, avec recherche et filtre par pupitre
    public function index(Request $request)
    {
        $chants = Chant::with(['categories', 'pupitres'])
            ->when($request->query('q'), fn ($query, $q) => $query->where('titre', 'like', "%{$q}%"))
            ->when($request->query('pupitre_id'), function ($query, $pupitreId) {
                $query->whereHas('pupitres', fn ($p) => $p->where('pupitres.id', $pupitreId));
            })
            ->latest('updated_at')
            ->get();

        return response()->json($chants);
    }

    // GET /api/chants/{chant} — détail avec historique
    public function show(Chant $chant)
    {
        $chant->load(['categories', 'pupitres', 'versions.auteur', 'auteur']);

        return response()->json($chant);
    }

    // POST /api/chants — réservé au maître de chœur (middleware EstMaitreDeChoeur)
    public function store(Request $request)
    {
        $validated = $request->validate([
            'titre' => 'required|string|max:255',
            'paroles' => 'required|string',
            'tonalite' => 'nullable|string|max:100',
            'categorie_ids' => 'array',
            'pupitre_ids' => 'array',
            'audio' => 'nullable|file|mimes:mp3,wav,m4a,ogg|max:20480', // enregistrement général, optionnel
            'audio_pupitre' => 'nullable|array', // ex: audio_pupitre[3] => fichier pour le pupitre id=3
            'audio_pupitre.*' => 'file|mimes:mp3,wav,m4a,ogg|max:20480',
        ]);

        $audioPath = $request->hasFile('audio')
            ? $request->file('audio')->store('chants/audio', 'public')
            : null;

        $chant = Chant::create([
            'titre' => $validated['titre'],
            'paroles' => $validated['paroles'],
            'tonalite' => $validated['tonalite'] ?? null,
            'audio_path' => $audioPath,
            'created_by' => $request->user()->id,
        ]);

        $chant->categories()->sync($validated['categorie_ids'] ?? []);
        $chant->pupitres()->sync($validated['pupitre_ids'] ?? []);

        // Un fichier audio distinct par pupitre (soprano, alto, ténor, basse...)
        foreach ($request->file('audio_pupitre', []) as $pupitreId => $fichier) {
            $chemin = $fichier->store('chants/audio/pupitres', 'public');
            $chant->pupitres()->updateExistingPivot($pupitreId, ['audio_path' => $chemin]);
        }

        return response()->json($chant->load(['categories', 'pupitres']), 201);
    }

    // PUT /api/chants/{chant} — réservé au maître de chœur, archive l'ancienne version
    public function update(Request $request, Chant $chant)
    {
        $validated = $request->validate([
            'paroles' => 'required|string',
        ]);

        $chant->mettreAJourParoles($validated['paroles'], $request->user());

        return response()->json($chant->fresh());
    }
}
