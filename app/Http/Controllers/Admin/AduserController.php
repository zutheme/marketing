<?php
namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User; 
use Illuminate\Support\Facades\Auth; 
use Validator;
use App\Department;
use Illuminate\Support\Facades\DB;
class AduserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
         $users = User::all()->toArray();
        return view('admin.aduser.index',compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $result = DB::select('call ListDepartParentProcedure()');
        $departparents = json_decode(json_encode($result), true);
        return view('admin.aduser.create',compact('departparents'));
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [ 
            'name' => 'required', 
            'email' => 'required|email', 
            'password' => 'required', 
            'c_password' => 'required|same:password', 
        ]);
        if ($validator->fails()) { 
            $errors = $validator->errors();
            return redirect()->route('admin.aduser.create')->with(compact('errors'));           
        }
        $input = $request->all(); 
        $input['password'] = bcrypt($input['password']); 
        $user = User::create($input); 
        $success['token'] =  $user->createToken('MyApp')->accessToken; 
        $success['name'] =  $user->name;
        $iduser = $user->id;
        $message="";
        $values="";
        $list_checks = $request->input('list_check');
        $sql = "INSERT INTO `depart_employees`( `iduser`, `iddepart`) VALUES";
            if($list_checks){
                foreach ($list_checks as $iddepart) {
                  $values .= "(".$iduser.",".$iddepart."),";   
                } 
            }
        $values=rtrim($values,", ");
        $sql = $sql.$values;
        $result = DB::select($sql);
        return redirect()->route('admin.aduser.index')->with('success',$sql);
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
        $users = User::find($id);
        $result = DB::select('call ListDepartParentProcedure()');
        $departparents = json_decode(json_encode($result), true);
        $rs_empdepart_seleted = DB::select('call ListSelEmpDepartProcedure(?)',array($id));
        $l_empdepart_seleted = json_decode(json_encode($rs_empdepart_seleted), true);
        return view('admin.aduser.edit',compact('users','id','departparents','l_empdepart_seleted'));
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
        $users = user::find($id);
        $validator = Validator::make($request->all(), [ 
            'password' => 'required', 
            'c_password' => 'required|same:password', 
        ]);
        if ($validator->fails()) { 
            $errors = $validator->errors();
            return redirect()->route('admin.aduser.edit')->with(compact('errors'));           
        }
        $input = $request->all(); 
        $input['password'] = bcrypt($input['password']); 
        $users->password =  $input['password'];
        $users->save();
        return redirect()->route('admin.aduser.index')->with('success','data update');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $users = User::find($id);
        $users->delete();
        return redirect()->route('admin.aduser.index')->with('success','record have deleted');
    }
    
    
}
