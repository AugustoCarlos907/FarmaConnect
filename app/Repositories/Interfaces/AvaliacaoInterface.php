<?php 

namespace App\Repositories\Interfaces;

interface AvaliacaoInterface {

    public function createAvaliacao($data);
    public function updateAvaliacao($id, $data);
    public function deleteAvaliacao($id);
}