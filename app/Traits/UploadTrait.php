<?php


namespace App\Traits;
use App\AdverImage;
use Carbon\Carbon;
use Intervention\Image\Facades\Image;
use Request;


trait UploadTrait
{
    /**
     *
     * @param Request $request
     * @param $src / directory for upload
     * @return false|string
     */
    public function uploadImages(Request $request , $src)
    {
        foreach($request->file($src) as $image) {
            $filenamewithextension = $image->getClientOriginalName();
            $filename = pathinfo($filenamewithextension, PATHINFO_FILENAME);
            $extension = $image->getClientOriginalExtension();
            $filenametostore = $filename.'_'.time().'.'.$extension;
            $img = Image::make($image)->resize(800, null, function ($constraint) {
                $constraint->aspectRatio();
            })->encode('jpg');
            $path = $image->storeAs(Carbon::now()->year . '/' . Carbon::now()->month , $filenametostore , 'public');

            if (!file_exists(public_path('images/') . Carbon::now()->year . '/' . Carbon::now()->month)) {
                mkdir(public_path('images/') . Carbon::now()->year . '/' . Carbon::now()->month , 666, true);
            }
            $img->save(public_path('images/') . $path);
        }
//
//        //get filename with extension
//        $filenamewithextension = $request->file($src)->getClientOriginalName();
//
//        //get filename without extension
//        $filename = pathinfo($filenamewithextension, PATHINFO_FILENAME);
//
//        //get file extension
//        $extension = $request->file($src)->getClientOriginalExtension();
//
//        if ($mime == 'image') {
//
//            $filenametostore = $filename.'_'.time().'.'.$extension;
//            return $request->file($src)->storeAs($src, $filenametostore , 'public');
//
//        }

    }

//    public function uploadOne(UploadedFile $uploadedFile, $folder = null, $disk = 'public', $filename = null)
//    {
//        $name = !is_null($filename) ? $filename : str_random(25);
//
//        $file = $uploadedFile->storeAs($folder, $name.'.'.$uploadedFile->getClientOriginalExtension(), $disk);
//
//        return $file;
//    }
}