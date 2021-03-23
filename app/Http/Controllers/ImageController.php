<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class ImageController extends Controller
{

    /**
     * ajaxImage
     *
     * @param  mixed $request
     *
     * @return void
     */
    public function ajaxImage(Request $request)
    {
        if ($request->isMethod('get'))
            return view('ajax_image_upload');
        else {
            $validator = Validator::make($request->all(), [
                'photos' => 'required|mimes:jpeg,jpg,png|max:10000',
            ]);
            if ($validator->fails())
                return array(
                    'fail' => true,
                    'errors' => $validator->errors()
                );

            $extension = $request->file('photos')->getClientOriginalExtension();

            $cookie = ($request->cookie('uniq_id') ? Cookie::get('uniq_id') :  uniqid());

            $filename = $cookie . '_' . rand() . '.' . $extension;

            $request->file('photos')->storeAs('images/product',$filename,'public');


            return response()->json($filename,200)->cookie(
                'uniq_id', $cookie, 6
            );

        }
    }

    /**
     * deleteImage
     *
     * @param  mixed $filename
     *
     * @return void
     */
    public function deleteImage($filename)
    {
        \File::delete('uploads/' . $filename);
    }
}
