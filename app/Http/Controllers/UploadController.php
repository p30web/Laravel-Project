<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;

class UploadController extends Controller
{
    public function uploadFile(Request $request , $src , $mime)
    {
        $filenamewithextension = $request->file($src)->getClientOriginalName();
        $filename = pathinfo($filenamewithextension, PATHINFO_FILENAME);
        $extension = $request->file($src)->getClientOriginalExtension();

        if ($mime == 'image') {
            $filenametostore = $filename . '_' . time() . '.' . $extension;
            return $request->file($src)->storeAs(Carbon::now()->year . '/' . Carbon::now()->month, $filenametostore, 'public');
        }
    }
}
