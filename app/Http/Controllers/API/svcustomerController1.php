<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;

use App\Http\Controllers\Controller;

use App\sv_customer;

use Illuminate\Http\UploadedFile;

use Illuminate\Support\Facades\DB;

use Validator;

use Illuminate\Support\MessageBag;

use Illuminate\Foundation\Auth\AuthenticatesUsers;

use Auth;

use App\Files;

use File;

class svcustomerController extends Controller
{
    /**

     * Display a listing of the resource.

     *

     * @return \Illuminate\Http\Response

     */

    public $successStatus = 200;

    public function index()

    {

         return sv_customer::all();

         //$svcustomer = sv_customer::all();

        //return response()->json($svcustomer);

    }

    /**

     * Store a newly created resource in storage.

     *

     * @param  \Illuminate\Http\Request  $request

     * @return \Illuminate\Http\Response

     */    

    public function store(Request $request)

    {

        // $svcustomer = sv_customer::create($request->all());

        // return response()->json($svcustomer, 201);

        if (isset($_SERVER["HTTP_ORIGIN"]) === true) {

            $origin = $_SERVER["HTTP_ORIGIN"];

            $allowed_origins = array(

                "https://thammyvienthienkhue.vn",
                "https://mgk.edu.vn"
            );

            if (in_array($origin, $allowed_origins, true) === true) {

                header('Access-Control-Allow-Origin: ' . $origin);

                header('Access-Control-Allow-Credentials: true');

                header('Access-Control-Allow-Methods: POST');

                header('Access-Control-Allow-Headers: Content-Type');

                $header = "true";

            }

            if ($_SERVER["REQUEST_METHOD"] === "OPTIONS") {

                //exit; // OPTIONS request wants only the policy, we can stop here

            }

        }

        $validator = Validator::make($request->all(), [ 

            //'firstname' => 'required',  

            //'email' => 'required', 

            'mobile' => 'required', 

        ]);

        if ($validator->fails()) { 

            return response()->json(['error'=>$validator->errors()], 401);            

        }

        $input = $request->all(); 

        $svcustomer = sv_customer::create($input); 

        $success['firstname'] =  $svcustomer->firstname.",header".$header;

        return response()->json(['success'=>$success], $this->successStatus); 

    }



    /**

     * Display the specified resource.

     *

     * @param  int  $id

     * @return \Illuminate\Http\Response

     */

    public function show(sv_customer $svcustomer)

    {

        return $svcustomer;

    }



    /**

     * Update the specified resource in storage.

     *

     * @param  \Illuminate\Http\Request  $request

     * @param  int  $id

     * @return \Illuminate\Http\Response

     */

    public function update(Request $request, sv_customer $svcustomer)
    {
        $svcustomer->update($request->all());
        return response()->json($svcustomer, 200);
    }



    /**

     * Remove the specified resource from storage.

     *

     * @param  int  $id

     * @return \Illuminate\Http\Response

     */

    public function destroy($id)

    {

        $svcustomer->delete();

        return response()->json(null, 204);

    }

   
    //$validator = Validator::make($request->all(), [ 
                    //'firstname' => 'required',  
                    //'email' => 'required', 
                    //'mobile' => 'required', 
                //]);

                //if ($validator->fails()) {
                    //return response()->json(['error'=>$validator->errors()],401);            
                //}
    public function consultant(Request $request) {

        if (isset($_SERVER["HTTP_ORIGIN"]) === true) {
            $origin = $_SERVER["HTTP_ORIGIN"];
            $allowed_origins = array(
                "https://thammyvienthienkhue.vn",
                "http://thammyvienthienkhue.vn",
                "https://mgk.edu.vn",
                "http://localhost"
            );
            //if right domain
            if (in_array($origin, $allowed_origins, true) === true) {
                        header('Access-Control-Allow-Origin: ' . $origin);
                        header('Access-Control-Allow-Credentials: true');
                        header('Access-Control-Allow-Methods: POST');
                        header('Access-Control-Allow-Headers: Content-Type'); 
                        $input = json_decode(file_get_contents('php://input'),true);
                        //$base64_string = $input['file'];      
                        $_firstname = $input['firstname'];
                        $_mobile = $input['mobile'];
                        $_email = $input['email'];
                        //$_job = $input['job'];
                        $_address = $input['address'];
                        $_namecat = $input['namecat'];
                        $_body = $input['body'];
                        $_typepost = $input['typepost'];
                        $_name_status_type = $input['name_status_type'];
                        $str_test = $_firstname.",".$_mobile.",".$_email.",".$_address.",".$_namecat.",".$_body.",".$_typepost.",".$_name_status_type;
                        return response()->json(array('success' => true, 'str_test' => "test ok"), 200);
                        $path_relative = ""; 
                        $errors = "";
                        $_idfile = 0; 
                        //if have file                                  
                        // if($base64_string!="nofile"){
                        //         $orfilename = $input['orfilename'];
                        //         $dir = 'uploads/';
                        //         $data = explode( ',', $base64_string );

                        //         $mimeString = $data[0];

                        //         $mimeString = explode( ':', $mimeString);

                        //         $mimeString = explode( ';', $mimeString[1]);

                        //         $extension =  explode( '/', $mimeString[0]);

                        //         $data1 = $data[1];

                        //         $decoded = base64_decode($data1);   

                        //         $typefile = $extension[1];

                        //         $path = base_path($dir . date('Y') . '/'.date('m').'/'.date('d').'/');

                        //         $path_relative = $dir . date('Y') . '/'.date('m').'/'.date('d').'/';

                        //         if(!File::exists($path)) {
                        //             File::makeDirectory($path, 0777, true, true);
                        //         }     
                        //         $filename = date('Ymd').'_'.time().'_'.uniqid().'.'.$typefile;
                        //         file_put_contents( $path.$filename , $decoded);                               
                        //         try {
                        //                 $idinserteds = DB::select('call InsertFilesProcedure(?,?,?,?)',array($path_relative,$orfilename,$filename,$typefile));
                        //                 $idinserted = json_decode(json_encode($idinserteds), true);
                        //                 $_idfile = $idinserted[0]['idfile'];
                        //                 //return response()->json(array('success' => true, 'id_inserted' => $idinserted ), 200);
                        //             } catch (\Illuminate\Database\QueryException $ex) {
                        //                 $errors = new MessageBag(['errorlogin' => $ex->getMessage()]);
                        //                 return response()->json(array('error' => true, 'error' => $errors), 200);
                        //             }
                        // }
                       //end have file                  
                    
                    // try {
                    //     $idinserteds = DB::select('call CreatPostApiProcedure(?,?,?,?,?,?,?,?,?)',array($_namecat,$_body,$_typepost,$_idfile,$_firstname,$_mobile,$_email,$_address,$_name_status_type));
                    //     $idinserted = json_decode(json_encode($idinserteds), true);
                    //     $id_imppost = $idinserted[0]['_id_imppost'];
                    //     return response()->json(array('success' => true, 'id_inserted' => $id_imppost ), 200);
                    // } catch (\Illuminate\Database\QueryException $ex) {
                    //     $errors = new MessageBag(['errorlogin' => $ex->getMessage()]);
                    //     return response()->json(array('error' => true, 'error' => $errors), 200);
                    // }
                    // if ($_SERVER["REQUEST_METHOD"] === "OPTIONS") {
                    //     //exit; // OPTIONS request wants only the policy, we can stop here
                    // }
                }else{
                    $errors['error'] = "error access control allow headers";
                    return response()->json(['error'=>$errors],401);
                }
        }
    }

/*

200: OK. The standard success code and default option.

201: Object created. Useful for the store actions.

204: No content. When an action was executed successfully, but there is no content to return.

206: Partial content. Useful when you have to return a paginated list of resources.

400: Bad request. The standard option for requests that fail to pass validation.

401: Unauthorized. The user needs to be authenticated.

403: Forbidden. The user is authenticated, but does not have the permissions to perform an action.

404: Not found. This will be returned automatically by Laravel when the resource is not found.

500: Internal server error. Ideally you're not going to be explicitly returning this, but if something unexpected breaks, this is what your user is going to receive.

503: Service unavailable. Pretty self explanatory, but also another code that is not going to be returned explicitly by the application

*/