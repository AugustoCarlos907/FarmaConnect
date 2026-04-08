<?php

namespace Database\Seeders;

use App\Models\Avaliacao;
use App\Models\Companhia;
use App\Models\Endereco;
use App\Models\Entregador;
use App\Models\Farmacia;
use App\Models\ItemPedido;
use App\Models\Medicamento;
use App\Models\Pedido;
use App\Models\StockItem;
use App\Models\User;
use Carbon\Carbon;
use DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Str;

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

        // User::create([
        //     'name' => ' Gestor da Companhia',
        //     'email' => 'augusto12@gmail.com',
        //     'phone'=>'931334499',
        //     'endereco' => 'Luanda , Angola',
        //     'password' => Hash::make('123456'),
        //     'role'=>'entregador',
        //     'companhia_id' => 1,
        //     'farmacia_id' => 1,
           
        //     'created_at' => Carbon::now(),
        //     'updated_at' => Carbon::now(),
        // ]);

        // Avaliacao::create([
        //     'user_id'=>1,
        //     'classificacao' => 5,
        //     'comentario' => 'Ótimo serviço!',
        //     'farmacia_id' => 3,
        //     'created_at' => Carbon::now(),
        //     'updated_at' => Carbon::now(),
        // ]);

        
        // Farmacia::create([
        //     'name' => 'Farmacia Mecofarma',
        //     // 'email' => 'mecofarma@gmail.com',
        //     // 'telefone' => '1234567890',
        //     'descricao' => 'Farmacia central da cidade',
        //     'endereco' => 'Rua das Flores, 123',
        //     'latitude' => -23.5505,
        //     'longitude' => -46.6333,
        //     'status' => 'Ativo',
        //     // 'horario_abertura' => '08:00:00',
        //     // 'horario_fechamento' => '20:00:00',
        //     'created_at' => Carbon::now(),
        //     'updated_at' => Carbon::now(),
        // ]);

        // Farmacia::create([
        //      'name' => fake()->company() . ' Pharmacy',
        //     // 'logo' => 'logos/default.png',
        //     'descricao' => fake()->sentence(),
        //     'status' => fake()->randomElement(['Ativo', 'Desativado']),
        //     'endereco' => fake()->address(),
        //     'latitude' => fake()->latitude(),
        //     'longitude' => fake()->longitude(),
        //     'iban' => fake()->iban('AO'), // 'AO' para Angola, se aplicável
        //     'numero_express' => fake()->phoneNumber(),
        //     'alvara' => fake()->numerify('ALV-#####'),
        //     'nif' => fake()->unique()->numerify('#########'),
        //     'companhia_id' => 1, // Ou \App\Models\Companhia::factory()
        //     'rua' => fake()->streetName(),
        //     'bairro' => fake()->city(),
        //     'municipio' => fake()->city()
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
        //     'descricao' => 'Entregador Seguro',
        //     'status' => 'Ativo',
        //     'numero_bi' => '1234567890123',

        //     'matricula_veiculo' => 'ABC-1234',
        //     // 'foto_perfil' => 'p', 
        //     // 'disponivel' =>true
        //     'latitude' => -23.5505,
        //     'longitude' => -46.6333,
        //     'farmacia_id' => 1,
        //     'user_id' => 6,
        //     'created_at' => Carbon::now(),
        //     'updated_at' => Carbon::now(),
        // ]);


        $categorias = [
            'Analgésicos e Antitérmicos',
            'Anti-inflamatórios',
            'Antibióticos',
            'Antivirais',
            'Antifúngicos',
            'Antiparasitários',
            'Antialérgicos',
            'Antigripais',
            'Anestésicos',
            'Antidepressivos',
            'Ansiolíticos e Sedativos',
            'Antipsicóticos',
            'Antiepilépticos',
            'Anti-hipertensivos',
            'Diuréticos',
            'Antidiabéticos',
            'Hipolipemiantes',
            'Medicamentos Cardiovasculares',
            'Medicamentos Respiratórios',
            'Medicamentos Gastrointestinais',
            'Medicamentos Dermatológicos',
            'Medicamentos Oftálmicos',
            'Medicamentos Otológicos',
            'Medicamentos Urológicos',
            'Medicamentos Ginecológicos',
            'Medicamentos Pediátricos',
            'Medicamentos Oncológicos',
            'Medicamentos Imunológicos',
            'Vacinas',
            'Hormônios e Endócrinos',
            'Material Médico-Hospitalar',
            'Produtos para Primeiros Socorros',
            'Produtos Ortopédicos',
            'Produtos para Diabéticos',
            'Higiene Pessoal',
            'Higiene Oral',
            'Produtos Dermatológicos e Cosméticos',
            'Vitaminas e Suplementos',
            'Produtos Naturais e Fitoterápicos',
            'Saúde Infantil',
            'Saúde da Mulher',
            'Saúde do Homem',
            'Saúde do Idoso',
        ];

        foreach ($categorias as $categoria) {
            DB::table('categorias')->insert([
                'name'       => $categoria,
                'descricao'  => fake()->paragraph(),
                'imagem' => 'https://idec.org.br/noticia/o-que-e-um-medicamento-e-quais-tipos-temos-por-ai-0',
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }

        // Medicamento::create([
        //     'name' => 'Paracetamol',
        //     'preco' => 400.00,
        //     'descricao' => 'klrw',
        //     'dosagem' => 200 .'mg',
        //     'forma_farmaceutica' => 'Âmpola',
        //     'categoria_id' => 1,
        //     // 'farmacia_id' => 1,
        //     'created_at' => Carbon::now(),
        //     'updated_at' => Carbon::now(),

        // ]);

        // StockItem::create([
        //         'medicamento_id' => 30,
        //         'farmacia_id' => 2,
        //         'quantidade' => 1,
        //         'preco' => 400.00,
        //         'data_validade' => Carbon::now()->addMonths(6),
        //         'lote' => Str::upper(Str::random(10)),
        //         'ativo' => true,
        //         'created_at' => Carbon::now(),
        //         'updated_at' => Carbon::now(),
        // ]);

        // Pedido::create([
        //     'user_id' => 3,
        //     'farmacia_id' => 1,
        //     // 'total' => 800.00,
        //     'endereco' => 'Rua das Flores, 123',
        //     'latitude' => -23.5505,
        //     'longitude' => -46.6333,
        //     // 'metodo_pagamento' => 'Cartão de Crédito',
        //     'status' => 'Concluído',
        //     'data_pedido' => Carbon::now(),
        //     'created_at' => Carbon::now(),
        //     'updated_at' => Carbon::now(),
        // ]);

        //  Pedido::create([
        //     'user_id' => 4,
        //     'farmacia_id' => 1,
        //     'total' => 800.00,
        //     'endereco' => 'São Paulo',
        //     'latitude' => -24.5505,
        //     'longitude' => -12.6333,
        //     'metodo_pagamento' => 'express',
        //     'status' => 'Concluído',
        //     'data_pedido' => Carbon::now(),
        //     'created_at' => Carbon::now(),
        //     'updated_at' => Carbon::now(),
        //  ]);

        // ItemPedido::create([
        //     'pedido_id' => 22,
        //     'stock_items_id'=> 20,
        //     'quantidade' =>2,
        //     'preco_unitario'=> 100.00,
        //     'subtotal'=> 100.00

        // ]);

        //  Endereco::create([
        //     'user_id' => 3,
        //     'name'=>'casa',
        //     'endereco' => 'IngombotA ',
        //     'latitude' => -23.5505,
        //     'longitude' => -46.6333,
        //  ]);

        $farmacia = Farmacia::findOrFail(3);
        $farmacia->update([
            'endereco' => "Largo da Mutamba, n.º 5",
            'rua' => "Rua Major Kanhangulo ",
            'bairro' => "Mutamba",
            'municipio' => "Luanda",
            'latitude' => "-8.814700",
            'longitude' => "13.230600",
        ]);
    }
}
