<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Login;
use Illuminate\Support\Facades\Crypt;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $login = Login::all();
        $data = array("l" => $login);
        return view("User.View",$data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('User.Create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $r)
    {
        //
        $login = new Login();
        $login -> login = $r -> uName;
        $login -> password = Crypt::encrypt($r -> password);
        $login -> name = $r -> fName;
        $login -> email  = $r -> email;
        
        $login -> phone= $r -> pno;
        $login -> active = 1;

        $login -> save();
        return redirect('/user');
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
        $user = Login::find($id);
        $data = array("user"=>$user);

        return view("User.modify",$data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $r, $id)
    {
        //
        $login = Login::find($id);
        $login -> login = $r -> uName;
        $login -> password = Crypt::encrypt($r -> password);
        $login -> name = $r -> fName;
        $login -> email  = $r -> email;
        
        $login -> phone= $r -> pno;
        $login -> active = 1;

        $login -> save();
        return redirect('/user');

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
	$curUser = Login::find($id);
	$curUser->delete();
	 return redirect("/user");
    }
}
