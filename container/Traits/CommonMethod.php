<?php

namespace Core\Traits;

trait CommonMethod
{
    //check FIle exist or not
    public function checkFileAlreadyCreateOrNot($filePath,$fileName){

    }

    //folder create or directory create method
    public function makeFolderOrDirectory($FolderPath){
        $path=app_path($FolderPath);
        if(!file_exists( $path))
        {
            File::makeDirectory( $path,$mode=0777,true,true);
        }//end file create option ;
    }
}