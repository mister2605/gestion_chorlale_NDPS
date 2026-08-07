<?php

namespace Database\Seeders;

use App\Models\Categorie;
use App\Models\Pupitre;
use Illuminate\Database\Seeder;

class RepertoireSeeder extends Seeder
{
    public function run(): void
    {
        foreach (['Soprano', 'Alto', 'Ténor', 'Basse'] as $nom) {
            Pupitre::firstOrCreate(['nom' => $nom]);
        }

        foreach ([
            'Avent / Carême', 'Noël / Pâques', 'Temps ordinaire', 'Pentecôte / Fêtes', 'Mariage',
            'Adoration', 'Action de grâce', 'Louange',
        ] as $nom) {
            Categorie::firstOrCreate(['nom' => $nom]);
        }
    }
}
