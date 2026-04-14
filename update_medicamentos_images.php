<?php

require __DIR__ . '/vendor/autoload.php';

use App\Models\Medicamento;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;

// Configurar ambiente Laravel
$app = require_once __DIR__ . '/bootstrap/app.php';
$app->make('Illuminate\Contracts\Console\Kernel')->bootstrap();

echo "🚀 Iniciando atualização de imagens dos medicamentos...\n";

$pasta = __DIR__ . '/public/storage/img';
$arquivos = scandir($pasta);

// Mapeamento dos nomes atuais para nomes padronizados (slug)
$renomear = [
    // Baseado na listagem fornecida
    'Ácido Acetilsalicílico 100mg.jpeg' => 'acido_acetilsalicilico_100mg.jpg',
    'AMOXICILINA_500MG 1.jpg'           => 'amoxicilina_500mg.jpg',
    'atorvastatina-20mg.jpg'             => 'atorvastatina_20mg.jpg',
    'diazepam1.jpg'                      => 'diazepam_5mg.jpg',
    'Fexofenadina.jpeg'                  => 'fexofenadina_180mg.jpg',
    'Furosemida 40mg.jpeg'               => 'furosemida_40mg.jpg',
    'hidroclorotiazida2530t.png'         => 'hidroclorotiazida_25mg.png',
    'iburon-400.png'                     => 'ibuprofeno_400mg.png',
    'iburon-600.png'                     => 'ibuprofeno_600mg.png',
    'Lisinopril-10mg.png'                => 'lisinopril_10mg.png',
    'oratadina10mg.png'                  => 'loratadina_10mg.png',
    'losartana-potassica.jpg'            => 'losartana.jpg',
    'Nistatina 100000 UI.png'            => 'nistatina_100000_ui.png',
    'omeprazol.jpg'                      => 'omeprazol_20mg.jpg',
    'Oseltamivir 75mg.jpg'               => 'oseltamivir_75mg.jpg',
    'roacutan_20mg.png'                  => 'roacutan.png',
    'Salbutamol .png'                    => 'salbutamol.png',
    'Vitamin-D-3-2000-IU-30-softgels.jpg'=> 'vitamina_d3_2000ui.jpg',
    // Adicione outros ficheiros se necessário
];

// Primeiro: renomear os ficheiros na pasta
echo "📁 Renomeando ficheiros na pasta...\n";
foreach ($renomear as $antigo => $novo) {
    $caminhoAntigo = $pasta . '/' . $antigo;
    $caminhoNovo   = $pasta . '/' . $novo;
    if (file_exists($caminhoAntigo)) {
        rename($caminhoAntigo, $caminhoNovo);
        echo "  ✔ $antigo -> $novo\n";
    } else {
        echo "  ⚠️ $antigo não encontrado.\n";
    }
}

// Agora, associar cada imagem a um medicamento na base de dados
// Mapeamento entre o nome do ficheiro (slug) e o medicamento correspondente
// Pode ser feito por nome exacto ou por similaridade

echo "\n📝 Actualizando campo 'img' na tabela medicamentos...\n";

// Lista de medicamentos e o nome da imagem (slug) esperado
// Baseado na sua lista original de medicamentos
$medicamentosImagens = [
    'acido_acetilsalicilico_100mg.jpg' => 'Ácido Acetilsalicílico 100mg',
    'amoxicilina_500mg.jpg'            => 'Amoxicilina 500mg',
    'atorvastatina_20mg.jpg'           => 'Atorvastatina 20mg',
    'diazepam_5mg.jpg'                 => 'Diazepam 5mg',
    'diclofenac.jpg'                   => 'Diclofenac',
    'dipirona.jpg'                     => 'Dipirona',
    'dipirona_500mg.jpg'               => 'Dipirona 500mg',
    'fexofenadina_180mg.jpg'           => 'Fexofenadina 180mg',
    'furosemida_40mg.jpg'              => 'Furosemida 40mg',
    'hidroclorotiazida_25mg.png'       => 'Hidroclorotiazida 25mg',
    'ibuprofeno_400mg.png'             => 'Ibuprofeno 400mg',
    'ibuprofeno_600mg.png'             => 'Ibuprofeno 600mg',
    'lisinopril_10mg.png'              => 'Lisinopril 10mg',
    'loratadina_10mg.png'              => 'Loratadina 10mg',
    'losartana.jpg'                    => 'Losartana',
    'mesopostrol.jpg'                  => 'Mesopostrol',
    'nistatina_100000_ui.png'          => 'Nistatina 100000 UI',
    'omeprazol_20mg.jpg'               => 'Omeprazol 20mg',
    'oseltamivir_75mg.jpg'             => 'Oseltamivir 75mg',
    'paracetamol.jpg'                  => 'Paracetamol',
    'roacutan.png'                     => 'Roacutan',
    'salbutamol.png'                   => 'Salbutamol',
    'vitamina_c.jpg'                   => 'Vitamina C',
    'vitamina_d3_2000ui.jpg'           => 'Vitamina D3 2000UI',
    'vitamina_e.jpg'                   => 'Vitamina E',
];

$atualizados = 0;
$naoEncontrados = [];

foreach ($medicamentosImagens as $imagem => $nomeMedicamento) {
    // Procura o medicamento pelo nome exacto
    $medicamento = Medicamento::where('name', $nomeMedicamento)->first();
    if ($medicamento) {
        $medicamento->img = $imagem;
        $medicamento->save();
        echo "  ✔ {$nomeMedicamento} -> {$imagem}\n";
        $atualizados++;
    } else {
        // Tenta busca aproximada (LIKE)
        $medicamento = Medicamento::where('name', 'LIKE', "%{$nomeMedicamento}%")->first();
        if ($medicamento) {
            $medicamento->img = $imagem;
            $medicamento->save();
            echo "  ✔ (aproximado) {$medicamento->name} -> {$imagem}\n";
            $atualizados++;
        } else {
            $naoEncontrados[] = $nomeMedicamento;
            echo "  ❌ Medicamento não encontrado: {$nomeMedicamento}\n";
        }
    }
}

echo "\n✅ Atualização concluída. {$atualizados} medicamentos atualizados.\n";
if (!empty($naoEncontrados)) {
    echo "⚠️ Medicamentos não encontrados:\n";
    foreach ($naoEncontrados as $nome) {
        echo "   - {$nome}\n";
    }
}