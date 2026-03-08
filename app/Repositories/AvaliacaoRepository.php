<?php 

namespace App\Repositories;

use App\Models\Avaliacao;
use App\Repositories\Interfaces\AvaliacaoInterface;

class AvaliacaoRepository implements AvaliacaoInterface {

    public function getAllAvaliacoesByFarmacia($farmaciaId) {
        return Avaliacao::where('farmacia_id', $farmaciaId)
                        ->get();
    }

    public function createAvaliacao($data) {
        return Avaliacao::create($data);
    }

    public function updateAvaliacao($id, $data) {
        return Avaliacao::findOrFail($id)
                        ->update($data);
    }

    public function deleteAvaliacao($id) {
        return Avaliacao::findOrFail($id)->delete();
    }
}