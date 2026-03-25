<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreFileRequest;
use App\Jobs\ParsePharmacyStockCsvJob;
use App\Services\FileService;
use Auth;
use Illuminate\Http\Request;
use Illuminate\Session\Store;

class FileController extends Controller
{
    public function __construct(public FileService $service){}

    

    public function uploadFile(StoreFileRequest $request){
        $request->validated();

        if($request->hasFile('file')){
            $file = $request->file('file')->store('uploads');
            $relativePath = $file;
            $filename =  $request->file('file')->getClientOriginalName();

            $user = Auth::user();
            if($user->role != 'gestor_farmacia'){
                abort(403 , 'NÃO AUTORIZADO');
            }

            $farmaciaId = $user->farmacia_id;
            $data = [
                'file_path' => $relativePath, 
                'filename' => $filename,
                'farmacia_id' => $farmaciaId,
            ];
            
            $stockFile = $this->service->saveFile($data);

            ParsePharmacyStockCsvJob::dispatch($stockFile);

            return redirect()->route('medicamentos.farmacias');
        } else {
            return response()->json('Error');
        }
    }
}
