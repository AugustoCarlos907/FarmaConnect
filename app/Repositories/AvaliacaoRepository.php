<?php 

namespace App\Repositories;

use App\Models\Avaliacao;

class AvaliacaoRepository {

    public function getAllAvaliacoes() {
        return Avaliacao::where('farmacia_id', auth()->user()->farmacia_id)
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