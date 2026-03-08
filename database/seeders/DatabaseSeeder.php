<?php

namespace Database\Seeders;

use App\Models\Avaliacao;
use App\Models\Companhia;
use App\Models\Entregador;
use App\Models\Farmacia;
use App\Models\User;
use Carbon\Carbon;
use DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        // Companhia::create([
        //     'nif' => '123456789',
        //     'logo' => 'logo.png',
        //     'created_at' => Carbon::now(),
        //     'updated_at' => Carbon::now(),
        // ]);

        User::create([
            'name' => ' Gestor da Companhia',
            'email' => 'augusto12@gmail.com',
            'phone'=>'931334499',
            'endereco' => 'Luanda , Angola',
            'password' => Hash::make('123456'),
            'role'=>'entregador',
            'companhia_id' => 1,
            'farmacia_id' => 1,
           
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);

        // Avaliacao::create([
        //     'user_id'=>1,
        //     'classificacao' => 1,
        //     'comentario' => 'Ótimo serviço!',
        //     'farmacia_id' => 2,
        //     'created_at' => Carbon::now(),
        //     'updated_at' => Carbon::now(),
        // ]);

        
        // Farmacia::create([
        //     'name' => 'Farmacia Central',
        //     'email' => 'farmacia@gmail.com',
        //     'password' => Hash::make('123456'),
        //     'telefone' => '1234567890',
        //     'descricao' => 'Farmacia central da cidade',
        //     'endereco' => 'Rua das Flores, 123',
        //     'latitude' => -23.5505,
        //     'longitude' => -46.6333,
        //     'status' => 'Ativo',
        //     'created_at' => Carbon::now(),
        //     'updated_at' => Carbon::now(),
        // ]);


        // // Entregador::create([
        // //     'name' => 'Entregador Central',
        // //     'email' => 'entregador@gmail.com',
        // //     'password' => Hash::make('123456'),
        // //     'telefone' => '1234567890',
        // //     'descricao' => 'Entregador central da cidade',
        // //     'numero_bi' => '1234567890123',
        // //     'matricula_veiculo' => 'ABC-1234',
        // //     'foto_perfil' => 'perfil.jpg',
        // //     'status' => 'Ativo',
        // //     'latitude' => -23.5505,
        // //     'longitude' => -46.6333,
        // //     'farmacia_id' => 1,
        // //     'created_at' => Carbon::now(),
        // //     'updated_at' => Carbon::now(),
        // // ]);

        
        // DB::table('entregadores')->insert([
        //     'name' => 'Entregador Central',
        //     'email' => 'entregador@gmail.com',
        //     'password' => Hash::make('123456'),
        //     'telefone' => '1234567890',
        //     'descricao' => 'Entregador central da cidade',
        //     'numero_bi' => '1234567890123',
        //     'matricula_veiculo' => 'ABC-1234',
        //     'foto_perfil' => 'perfil.jpg',
        //     'status' => 'Ativo',
        //     'latitude' => -23.5505,
        //     'longitude' => -46.6333,
        //     'farmacia_id' => 1,
        //     'created_at' => Carbon::now(),
        //     'updated_at' => Carbon::now(),
        // ]);


        // $categorias = [
        //     'Analgésicos e Antitérmicos',
        //     'Anti-inflamatórios',
        //     'Antibióticos',
        //     'Antivirais',
        //     'Antifúngicos',
        //     'Antiparasitários',
        //     'Antialérgicos',
        //     'Antigripais',
        //     'Anestésicos',
        //     'Antidepressivos',
        //     'Ansiolíticos e Sedativos',
        //     'Antipsicóticos',
        //     'Antiepilépticos',
        //     'Anti-hipertensivos',
        //     'Diuréticos',
        //     'Antidiabéticos',
        //     'Hipolipemiantes',
        //     'Medicamentos Cardiovasculares',
        //     'Medicamentos Respiratórios',
        //     'Medicamentos Gastrointestinais',
        //     'Medicamentos Dermatológicos',
        //     'Medicamentos Oftálmicos',
        //     'Medicamentos Otológicos',
        //     'Medicamentos Urológicos',
        //     'Medicamentos Ginecológicos',
        //     'Medicamentos Pediátricos',
        //     'Medicamentos Oncológicos',
        //     'Medicamentos Imunológicos',
        //     'Vacinas',
        //     'Hormônios e Endócrinos',
        //     'Material Médico-Hospitalar',
        //     'Produtos para Primeiros Socorros',
        //     'Produtos Ortopédicos',
        //     'Produtos para Diabéticos',
        //     'Higiene Pessoal',
        //     'Higiene Oral',
        //     'Produtos Dermatológicos e Cosméticos',
        //     'Vitaminas e Suplementos',
        //     'Produtos Naturais e Fitoterápicos',
        //     'Saúde Infantil',
        //     'Saúde da Mulher',
        //     'Saúde do Homem',
        //     'Saúde do Idoso',
        // ];

        // foreach ($categorias as $categoria) {
        //     DB::table('categorias')->insert([
        //         'name' => $categoria,
        //         'created_at' => Carbon::now(),
        //         'updated_at' => Carbon::now(),
        //     ]);
        // }
    }
}
