<?php 


namespace App\Repositories;

use App\Models\StockFile;
use App\Repositories\Interfaces\FileInterface;


class FileRepository implements FileInterface
{

    public function saveFile( $data = [])
    {
        return StockFile::create($data);
    } 
}