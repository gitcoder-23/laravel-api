<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FileController extends Controller
{
    function upload(Request $req) 
    {
        // return ["result"=>"upload"];
        // file saved in storage/app/apiDocs
        $result=$req->file('file')->store('apiDocs');
        return ["result"=>$result];
    }
}
