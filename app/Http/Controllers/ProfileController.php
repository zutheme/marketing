<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
class ProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($iduser)
    {
        try {
            $_namecattype="website";
            $rs_catbytype = DB::select('call ListAllCatByTypeProcedure(?)',array($_namecattype));
            $catbytypes = json_decode(json_encode($rs_catbytype), true);
        } catch (\Illuminate\Database\QueryException $ex) {
            $errors = new MessageBag(['errorlogin' => $ex->getMessage()]);
            return redirect()->route('profile.show')->with('error',$errors);
        }
        $qr_select_profile = DB::select('call SelectProfileProcedure(?)',array($iduser));
        $profile = json_decode(json_encode($qr_select_profile), true);
        return view('profile.show',compact('profile','catbytypes','iduser'));
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
    public function update(Request $request, $iduser)
    {
        try {
            $_namecattype="website";
            $rs_catbytype = DB::select('call ListAllCatByTypeProcedure(?)',array($_namecattype));
            $catbytypes = json_decode(json_encode($rs_catbytype), true);
            //update profile
            $_idprofile = $request->get('idprofile');
            $_firstname = $request->get('firstname');
            $_lastname = $request->get('lastname');
            $_middlename = $request->get('middlename');
            $_sel_sex = $request->get('sel_sex');
            $_birthday = $request->get('_birthday');
            $address = $request->get('address');
            $mobile = $request->get('mobile');
            $qr_update_profile = DB::select('call UpdateProfileProcedure(?,?,?,?,?,?,?,?)',array($_idprofile,$_firstname,$_lastname,$_middlename,$_sel_sex,$_birthday,$address,$mobile));
            $rs_update_profile = json_decode(json_encode($qr_update_profile), true);
        } catch (\Illuminate\Database\QueryException $ex) {
            $errors = new MessageBag(['errorlogin' => $ex->getMessage()]);
            return redirect()->route('profile.show')->with('error',$errors);
        }
        $qr_select_profile = DB::select('call SelectProfileProcedure(?)',array($iduser));
        $profile = json_decode(json_encode($qr_select_profile), true);
        return view('profile.show',compact('profile','catbytypes','iduser'));
        //return redirect()->route('profile.show')->with(compact('profile','catbytypes'));
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
