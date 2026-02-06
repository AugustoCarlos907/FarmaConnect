<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreFileRequest;
use App\Jobs\ParseStockCsvJob;
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

            $farmaciaId = Auth::guard('farmacia')->id();

            $stockFile = $this->service->saveFile([
                'file_path' => $relativePath, 
                'file_name' => $filename,
                'farmacia_id' => $farmaciaId,
            ]);

            ParseStockCsvJob::dispatch($stockFile);

            return response()->json([
                'message' => 'File uploaded successfully',
                'file_path' => $relativePath,
            ], 201);
        } else {
            return response()->json([
                'message' => 'No file uploaded'
            ], 400);
        }
    }
}
