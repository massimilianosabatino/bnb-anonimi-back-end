<?php

namespace Database\Seeders;

use App\Models\Service;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ServiceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        // Array associativo per il seeder della tabella services 
        $servicesArray = config('service_db');

        foreach($servicesArray as $service){
            // Nuova istanza del model Service
            $newService = new Service();
            
            // Inserimento dei dati all'interno delle colonne
            $newService->name = $service['name'];
            $newService->icon = $service['icon'];
            
            // Salvataggio dei dati
            $newService->save();
        }
        
    }
}
