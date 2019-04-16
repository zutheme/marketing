<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\DB;
use Validator;
use Illuminate\Support\MessageBag;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Auth;
use App\Files;
use File;
class CustomerRegController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        try {
            $_namecattype="website";
            $rs_catbytype = DB::select('call ListAllCatByTypeProcedure(?)',array($_namecattype));
            $catbytypes = json_decode(json_encode($rs_catbytype), true);
            $_start_date="";
            $_end_date="";
            $_idcategory="2";
            $_id_post_type="3";
            $_id_status_type="1";
            $result = DB::select('call ListCustomerRegister(?,?,?,?,?)',array($_start_date,$_end_date, $_idcategory, $_id_post_type, $_id_status_type));
            $customer_reg = json_decode(json_encode($result), true);
            return view('admin.customerreg.index',compact('customer_reg','catbytypes'));
        } catch (\Illuminate\Database\QueryException $ex) {
            $errors = new MessageBag(['errorlogin' => $ex->getMessage()]);
            return redirect()->route('admin.customerreg.index')->with('error',$errors);
        }
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
    public function ListCustomerByCat(Request $request){
        //$data['param'] = $param;
        try {
            $_namecattype="website";
            $rs_catbytype = DB::select('call ListAllCatByTypeProcedure(?)',array($_namecattype));
            $catbytypes = json_decode(json_encode($rs_catbytype), true);
            $_idparentcat = 1;
            $rs_post_type = DB::select('call ListPostTypeByIdcatProcedure(?)',array($_idparentcat));
            $post_types = json_decode(json_encode($rs_post_type), true);
            $_start_date="";
            $_end_date="";
            //$request->get('namedepart');
            $_idcategory = $request->input('idcategory');
            $_id_post_type=$request->input('id_post_type');
            $_id_status_type=$request->input('id_status_type');
            $result = DB::select('call ListCustomerRegister(?,?,?,?,?)',array($_start_date,$_end_date, $_idcategory, $_id_post_type, $_id_status_type));
            $customer_reg = json_decode(json_encode($result), true);
            return view('admin.customerreg.index',compact('customer_reg','catbytypes','post_types'));
        } catch (\Illuminate\Database\QueryException $ex) {
            $errors = new MessageBag(['errorlogin' => $ex->getMessage()]);
            return redirect()->route('admin.customerreg.index')->with('error',$errors);
        }
        return view('admin.customerreg.index',compact('customer_reg','data'));
    }
}
