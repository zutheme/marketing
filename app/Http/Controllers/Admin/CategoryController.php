<?php

namespace App\Http\Controllers\Admin;
use App\category;
use App\CategoryType;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $result = DB::select('call ListCategoryProcedure()');
        $categories = json_decode(json_encode($result), true);
        return view('admin.category.index',compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = category::all()->toArray();
        $categorytypes = CategoryType::all()->toArray();
        return view('admin.category.create',compact('categories','categorytypes'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
         $this->validate($request,['namecat'=>'required']);
        $categories = new category(['namecat'=> $request->get('namecat'),'idcattype'=>$request->get('sel_idcattype'),'idparent'=> $request->get('sel_idparent')]);
        $categories->save();
        return redirect()->route('admin.category.index')->with('success','data added');
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
    public function edit($idcategory)
    {
        $categorybyid = category::find($idcategory);
        $categories = category::all()->toArray();
        $categorytypes = CategoryType::all()->toArray();
        $result = DB::select('call SelCategorybyIdProcedure(?)',array($idcategory));
        $selected = json_decode(json_encode($result), true);
        return view('admin.category.edit',compact('categorybyid','categories','idcategory','categorytypes','selected'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $idcategory)
    {
        $this->validate($request,['namecat'=>'required']);
        //$idcustomer = $category->idcustomer;
        $category = category::find($idcategory);
        $category->namecat = $request->get('namecat');
        $category->idparent = $request->get('sel_idparent');
        $category->idcattype = $request->get('sel_idcattype');
        $category->save();
        return redirect()->route('admin.category.index')->with('success','data update');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($idcategory)
    {
         $categories = category::find($idcategory);
        $categories->delete();
        return redirect()->route('admin.category.index')->with('success','record have deleted');
    }

    public function listcatbyidcat()
    {
        $input = json_decode(file_get_contents('php://input'),true);
        $idcat = $input['sel_idcategory'];
        $result = DB::select('call SellistcategorybyidProcedure(?)',array($idcat));
        $selected = json_decode(json_encode($result), true);     
        return response()->json($selected); 
    }
}
