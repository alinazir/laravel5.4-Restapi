<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Person;
class PersonCtrl extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
         $person=Person::all();
         if (!$person) {
             throw new HttpException(400,'data is not valid');
         }
         return response()->json($person,200);
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
         $person=new Person();
         $person->name=$request->input('name');
         $person->city=$request->input('city');
         $person->email=$request->input('email');
         if ($person->save()) {
          //  return $person;
        //  return "save successfully";
          return response()->json([$person,],200);
         }

         throw new HttpException(400, 'invalid data');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
         $person=Person::where('id','=',$id)->first();
         if ($person) {
            return response()->json([$person,],200);
         }
         throw new HttpException(400, 'not found');

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
         $person=Person::where('id','=',$id)->first();
         if ($person) {
           return response( )->json([$person,],200);
         }
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
          $data=[
                    'name'=>$request->name,
                    'city'=>$request->city,
                    'email'=>$request->email,
                ];
         $person=Person::where('id','=',$id)->update($data);
         if ($person) {
             return response()->json([Person::where('id','=',$id)->first(),],200);
         }
         throw new HttpException(400, 'Not updated');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
           $person=Person::where('id','=',$id)->delete();
           if ($person) {
                  return response()->json([Person::all(),],200);
           }
           throw new HttpException(400, 'Not updated');
    }
}
