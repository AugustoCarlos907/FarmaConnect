<?php
// Colocar este ficheiro na raiz do Laravel e executar via CLI:
// php rename_images.php

$pasta = __DIR__ . '/public/storage/img';
$arquivos = scandir($pasta);

$mapeamento = [
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
    // Se tiver outros ficheiros que correspondam a medicamentos não listados, adicione aqui
];

foreach ($mapeamento as $antigo => $novo) {
    $caminhoAntigo = $pasta . '/' . $antigo;
    $caminhoNovo   = $pasta . '/' . $novo;
    if (file_exists($caminhoAntigo)) {
        rename($caminhoAntigo, $caminhoNovo);
        echo "Renomeado: $antigo -> $novo\n";
    } else {
        echo "Aviso: $antigo não encontrado.\n";
    }
}

// Medicamentos que ainda não têm imagem: pode criar placeholders
$faltam = [
    'diclofenac.jpg',
    'dipirona.jpg',
    'dipirona_500mg.jpg',
    'mesopostrol.jpg',
    'paracetamol.jpg',
    'vitamina_c.jpg',
    'vitamina_e.jpg',
];

foreach ($faltam as $img) {
    $caminho = $pasta . '/' . $img;
    if (!file_exists($caminho)) {
        // Cria um placeholder (opcional)
        // copy('caminho/placeholder.jpg', $caminho);
        echo "Falta: $img\n";
    }
}