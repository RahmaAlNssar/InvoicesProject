<?php

namespace App\Traits;



Trait saveFiles 
{
    function ImportFile($file,$folder){
        $file_extention=$file->getClientOriginalExtension();
        $filename=time().'.'.$file_extention;
        $path=$folder;
        $file->move($path,$filename);
        return response()->json($filename);
    }
}
