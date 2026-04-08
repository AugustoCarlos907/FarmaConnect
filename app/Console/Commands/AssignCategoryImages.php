<?php

namespace App\Console\Commands;

use App\Models\Categoria;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class AssignCategoryImages extends Command
{
    //php artisan categorias:images
    
    protected $signature = 'categorias:images';
    protected $description = 'Atribui imagens às categorias com base no slug';

    public function handle()
    {
        $disk = Storage::disk('public');
        $path = 'categorias';

        if (!$disk->exists($path)) {
            $this->error("Pasta '{$path}' não encontrada.");
            return;
        }

        $files = $disk->files($path);
        $categories = Categoria::all();

        $assigned = 0;
        foreach ($categories as $cat) {
            $slug = Str::slug($cat->name);  // ex: "Analgésicos e Antitérmicos" -> "analgesicos-e-antitermicos"
            $extensions = ['jpg', 'jpeg', 'png', 'webp'];

            $found = null;
            foreach ($extensions as $ext) {
                $candidate = $path . '/' . $slug . '.' . $ext;
                if ($disk->exists($candidate)) {
                    $found = $candidate;
                    break;
                }
            }

            if ($found) {
                $cat->imagem = $found;
                $cat->save();
                $this->info("✓ Imagem atribuída a '{$cat->name}' -> {$found}");
                $assigned++;
            } else {
                $this->warn("✗ Imagem não encontrada para '{$cat->name}' (slug: {$slug})");
            }
        }

        $this->newLine();
        $this->info("Total: {$assigned} de {$categories->count()} categorias actualizadas.");
    }
}