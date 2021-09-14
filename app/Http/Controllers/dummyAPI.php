<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class dummyApi extends Controller
{
    //
    function getData() {
        // array format and converted to json in postman
        return ['name'=>'Rahul', 'email'=> 'rahul@gmail.com'];
    }
}
