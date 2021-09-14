<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
// model because db Name is members
use App\Models\Member; 
use Validator;

class MemberController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // return ['result'=>'member data list'];
        return Member::all();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $rules=array(
            "member_name"=>"required|min:3",
            "email"=>"required",
            "address"=>"required|min:8",
        );
        $validator= Validator::make($request->all(), $rules); //make passes two parameters
        if($validator->fails())
        {
            // return $validator->errors();
            // for multi error request
            return response()->json($validator->errors(), 401);
        }
        else{
            $memberData= new Member;
            $memberData->member_name=$request->member_name;
            $memberData->email=$request->email;
            $memberData->address=$request->address;
            $result=$memberData->save();
            if($result){
                return ["Result"=>"Success! Member has been added"];
            }else{
                return ["Result"=>"Error! Member has not been added"];
            }
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
