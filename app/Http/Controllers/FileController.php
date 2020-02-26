<?php

namespace App\Http\Controllers;
use App\FileEmail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
class FileController extends Controller
{
    //
    public function layout(Request $request)
    {
        return view('file');
    }

    public function postFile(Request $request)
    {
        if ($request->hasFile('fileFacebook')) {
           // die('18');
            $file = $request->fileFacebook;
            try
            {
                $contents = File::get($file->getRealPath());
                foreach(explode(" ",$contents) as $content){
                    $email = new FileEmail;
                    $email->email = $content;
                    $email->save();
                }
                return redirect('formemail')->with('message', 'success!');
            } catch (Illuminate\Contracts\Filesystem\FileNotFoundException $exception) {
                die("The file doesn't exist");
            }
        }else{
            return redirect('file')->with('message', 'error!');
        }

    }
}
