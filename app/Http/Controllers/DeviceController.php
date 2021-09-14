<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

// Add model first
use App\Models\Device;
use Validator;


// controller & Model name same name as table
class DeviceController extends Controller
{
    // all data & id respected data
    function list($id=null) 
    {
        return $id?Device::find($id):Device::all();
    }

    // individual function for list
    function listdata() 
    {
        return Device::all();
    }
    // individual function for singleData
    function singledata($id=null) 
    {
        return Device::find($id);
    }

    // Add Data
    function add(Request $req)
    {
        $device= new Device;
        $device->name=$req->name;
        $device->member_id=$req->member_id;
        $result=$device->save();
        if($result){
            return ["Result"=>"Success! Data has been added"];
        }else{
            return ["Result"=>"Error! Data has not been added"];
        }
    }

    // update data-1
    function update(Request $req)
    {
        $device= Device::find($req->id);
        $device->name=$req->name;
        $device->member_id=$req->member_id;
        $result=$device->save();
        if($result){
            return ["Result"=>"Success! Data has been updated"];
        }else{
            return ["Result"=>"Error! Data has not been updated"];
        }
    }

    // update data-2
    function updatedata(Request $req, $id=null)
    {
        $device= Device::find($req->id);
        $device->name=$req->name;
        $device->member_id=$req->member_id;
        $result=$device->save();
        if($result){
            return ["Result"=>"Success! Data has been updated"];
        }else{
            return ["Result"=>"Error! Data has not been updated"];
        }
    }

    // Search
    function search($name) 
    {
        return Device::where("name", $name)->get();
    }

    // Search as character
    function searchcharacter($name) 
    {
        return Device::where("name","like","%".$name."%")->get();
    }

    // Delete
    function delete($id)
    {
        $device= Device::find($id);
        $result=$device->delete();
        if($result){
            return ["Result"=>"Success! Data has been deleted".$id]; 
        }else{
            return ["Result"=>"Error! Data has not been deleted".$id]; 
        }
    }

    // data save with Api validation
    function saveValidation(Request $req)
    {
        $rules=array(
            "name"=>"required|min:3",
            "member_id"=>"required|min:2|max:4",
        );
        $validator= Validator::make($req->all(), $rules); //make passes two parameters
        if($validator->fails())
        {
            // return $validator->errors();
            // for multi error request
            return response()->json($validator->errors(), 401);
        }
        else{
            // return ["x"=>"y"];
            $device= new Device;
            $device->name=$req->name;
            $device->member_id=$req->member_id;
            $result=$device->save();
            if($result){
                return ["Result"=>"Success! Data has been added"];
            }else{
                return ["Result"=>"Error! Data has not been added"];
            }
        }
    }

    
    function updateValidation(Request $req, $id=null)
    {
        $rules=array(
            "name"=>"required|min:3",
            "member_id"=>"required|min:2|max:4",
        );
        $validator= Validator::make($req->all(), $rules); //make passes two parameters
        if($validator->fails())
        {
            // return $validator->errors();
            // for multi error request
            return response()->json($validator->errors(), 401);
        }
        else{
            $device= Device::find($req->id);
            $device->name=$req->name;
            $device->member_id=$req->member_id;
            $result=$device->save();
            if($result){
                return ["Result"=>"Success! Data has been updated"];
            }else{
                return ["Result"=>"Error! Data has not been updated"];
            }
        }
    }




}
