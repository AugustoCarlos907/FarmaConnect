<?php 

namespace App\Repositories\Interfaces;

use App\Models\StockFile;

interface FileInterface
{
    public function saveFile( $data = []);

}