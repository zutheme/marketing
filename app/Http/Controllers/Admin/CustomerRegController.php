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
    public function ListCustomerByCat($_idcategory='1',$_id_post_type='1',$_id_status_type='1'){
        //$data['param'] = $param;
        try {
            $_namecattype="website";
            $rs_catbytype = DB::select('call ListAllCatByTypeProcedure(?)',array($_namecattype));
            $catbytypes = json_decode(json_encode($rs_catbytype), true);
            $_idparentcat = 1;
            $rs_post_type = DB::select('call ListPostTypeByIdcatProcedure(?)',array($_idparentcat));
            $post_types = json_decode(json_encode($rs_post_type), true);
            $_idinter = 4;
            $rs_post_type_inter = DB::select('call ListPostTypeByIdcatProcedure(?)',array($_idinter));
            $post_type_inter = json_decode(json_encode($rs_post_type_inter), true);
            $_idparent_status = 0;
            $rs_status_type = DB::select('call ListStatusTypeProcedure(?)',array($_idparent_status));
            $status_types = json_decode(json_encode($rs_status_type), true);
            $_start_date="";
            $_end_date="";
            //$_idcategory = $request->get('idcategory');
            //$_idcategory = $request->input('idcategory');
            $result = DB::select('call ListCustomerRegister(?,?,?,?,?)',array($_start_date,$_end_date, $_idcategory, $_id_post_type, $_id_status_type));
            $customer_reg = json_decode(json_encode($result), true);
            return view('admin.customerreg.index',compact('customer_reg','catbytypes','post_types','post_type_inter','status_types'));
        } catch (\Illuminate\Database\QueryException $ex) {
            $errors = new MessageBag(['errorsql' => $ex->getMessage()]);
            return redirect()->route('admin.customerreg.index')->with('error',$errors);
        }
        return view('admin.customerreg.index',compact('customer_reg','data'));
    }
    public function make_interactive(Request $request)
    {
        $parent_idpost = $request->get('idpost');
        $body = $request->get('body');
        $id_post_type = $request->get('sel_idposttype');
        $id_status_type = $request->get('id_status_type');
        try {
            $result = DB::select('call customer_interactive_procedure(?,?,?,?)',array($parent_idpost,$body, $id_post_type,$id_status_type));
            $cus_interactive = json_decode(json_encode($result), true);
            $success = array('success'=>$cus_interactive);
            return response()->json($success); 
        } catch (\Illuminate\Database\QueryException $ex) {
            $errors = new MessageBag(['errorsql' => $ex->getMessage()]);
            return response()->json($errors);
        }
        return response()->json(array('error' =>'')); 
    }
}
