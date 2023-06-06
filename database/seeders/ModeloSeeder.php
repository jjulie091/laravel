<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\rrhh\Modelo;

class ModeloSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        $modelos = [
            "Toyota",
            "Honda",
            "Ford",
            "Chevrolet",
            "Nissan",
            "Volkswagen",
            "BMW",
            "Mercedes-Benz",
            "Audi",
            "Hyundai",
            "Kia",
            "Mazda",
            "Subaru",
            "Volvo",
            "Lexus",
            "Jeep",
            "Ferrari",
            "Porsche",
            "Tesla",
            "Land Rover",
            "Jaguar",
            "Maserati",
            "Renault",
            "Peugeot",
            "Suzuki"
        ];

        foreach ($modelos as $nombreModelo) {
            Modelo::create(['nombre_modelo' => $nombreModelo]);
        }
    }
}
