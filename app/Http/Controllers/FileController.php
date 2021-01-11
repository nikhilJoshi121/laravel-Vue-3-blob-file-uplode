<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\FileUploade;

class FileController extends Controller
{
    public function getFile(request $request){    //get queye api
        $data = FileUploade::findOrFail($request->Id);
       
        return response()->json(['success'=> $data ]);
    }

    public function fileUploded(Request $request){    // store api

        $rules = array(
            'picture' => 'required|mimes:jpeg,png,jpg',
            'file' => 'required'
            );
    
        $validator = Validator::make($request->all(), $rules);
    
        if($validator->fails())
        {
            return response()->json(['validation'=> $validator->messages()]);
        }
    
        else
        {
            if($request->hasFile('picture') && $request->hasFile('file'))
            {
                $account = new FileUploade;
                $picturepath = $request->file('picture');
                $picturetype = pathinfo($picturepath, PATHINFO_EXTENSION);
                $picture_data = file_get_contents($picturepath);
                $picturebase64 = 'data:image/' . $picturetype . ';base64,' . base64_encode($picture_data);
                $filepath = $request->file('picture');
                $filetype = pathinfo($filepath, PATHINFO_EXTENSION);
                $filedata = file_get_contents($filepath);
                $filebase64 = 'data:file/' . $filetype . ';base64,' . base64_encode($filedata);
                $account->picture =  $picturebase64;
                $account->file = $filebase64;
                $account->save();
                                
                return response()->json(['success'=> 'file is Successfuly uploded','data'=> $account]);
            }
    
        }
        
    }
}
