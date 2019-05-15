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

    public function postcustomer(Request $request)
    {

        if (isset($_SERVER["HTTP_ORIGIN"]) === true) {

            $origin = $_SERVER["HTTP_ORIGIN"];

            $allowed_origins = array(
                "https://thammyvienthienkhue.vn",
                "https://mgk.edu.vn",
                "http://mgkgroup.vn",
                "http://localhost"
            );

            if (in_array($origin, $allowed_origins, true) === true) {

                header('Access-Control-Allow-Origin: ' . $origin);

                header('Access-Control-Allow-Credentials: true');

                header('Access-Control-Allow-Methods: POST');

                header('Access-Control-Allow-Headers: Content-Type');

                $validator = Validator::make($request->all(), [ 
                    //'firstname' => 'required',  
                    //'email' => 'required', 
                    //'mobile' => 'required', 
                ]);

                if ($validator->fails()) { 

                    return response()->json(['error'=>$validator->errors()],401);            

                }
                //$input = $request->all(); 
                //$svcustomer = sv_customer::create($input); 
                $svcustomer = new sv_customer(['firstname'=> $request->get('firstname'),'lastname'=>$request->get('lastname'),'email'=> $request->get('email'),'mobile'=>$request->get('mobile'),'address'=> $request->get('address'),'job'=>$request->get('job'),'note'=> $request->get('note')]);
                $svcustomer->save();
                $success['firstname'] =  $svcustomer->firstname;

                return response()->json(['success'=>$success], $this->successStatus); 

            }

            if ($_SERVER["REQUEST_METHOD"] === "OPTIONS") {

                //exit; // OPTIONS request wants only the policy, we can stop here

            }

        }

        $errors['error'] = "error access control allow headers";

        return response()->json(['error'=>$errors],401);       

    }
    

   public function consultant(Request $request) {
        if (isset($_SERVER["HTTP_ORIGIN"]) === true) {
            $origin = $_SERVER["HTTP_ORIGIN"];
            $allowed_origins = array(
                "https://thammyvienthienkhue.vn",
                "http://thammyvienthienkhue.vn",
                "https://mgk.edu.vn",
                "http://mgk.edu.vn",
                "http://phuntheuthammykovibe.vn",
                "http://mgkgroup.vn",
                "http://localhost"
            );
            if (in_array($origin, $allowed_origins, true) === true) {
                header('Access-Control-Allow-Origin: ' . $origin);
                header('Access-Control-Allow-Credentials: true');
                header('Access-Control-Allow-Methods: POST');
                header('Access-Control-Allow-Headers: Content-Type');
                
                        $input = json_decode(file_get_contents('php://input'),true);
                        $base64_string = $input['file'];       
                        $_namecat = $input['namecat'];
                        $_body = $input['body'];
                        $_typepost = $input['typepost'];
                        $_firstname = $input['firstname'];
                        $_mobile = $input['mobile'];
                        $_email = $input['email'];
                        $_address = $input['address'];
                        $_name_status_type = $input['name_status_type'];
                        //if have exist file
                        $_idfile = 0;
                        $path_relative = "";                                    
                        if($base64_string!="nofile"){
                                $orfilename = $input['orfilename'];
                                $dir = 'uploads/';
                                $data = explode( ',', $base64_string );
                                $mimeString = $data[0];
                                $mimeString = explode( ':', $mimeString);
                                $mimeString = explode( ';', $mimeString[1]);
                                $extension =  explode( '/', $mimeString[0]);
                                $data1 = $data[1];
                                $decoded = base64_decode($data1);   
                                $typefile = $extension[1];
                                $path = base_path($dir . date('Y') . '/'.date('m').'/'.date('d').'/');
                                $path_relative = $dir . date('Y') . '/'.date('m').'/'.date('d').'/';
                                if(!File::exists($path)) {
                                    File::makeDirectory($path, 0777, true, true);
                                }     
                                $filename = date('Ymd').'_'.time().'_'.uniqid().'.'.$typefile;
                                file_put_contents( $path.$filename , $decoded);
                                $errors = "";
                                try {
                                        $idinserteds = DB::select('call InsertFilesProcedure(?,?,?,?)',array($path_relative,$orfilename,$filename,$typefile));
                                        $idinserted = json_decode(json_encode($idinserteds), true);
                                        $_idfile = $idinserted[0]['idfile'];
                                        //return response()->json(array('success' => true, 'id_inserted' => $idinserted ), 200);
                                    } catch (\Illuminate\Database\QueryException $ex) {
                                        $errors = new MessageBag(['errorlogin' => $ex->getMessage()]);
                                        return response()->json(array('error' => true, 'error' => $errors), 200);
                                    }
                        }
                        //end if have file                      
                        // $svcustomer = new sv_customer(['firstname'=>$_fullname ,'lastname'=>'','email'=>$_email,'mobile'=>$_phone ,'address'=>$_address,'job'=>$_job,'note'=>$path_relative]);
                        // $svcustomer->save();
                        // return response()->json(array('success' => true, 'firstname' => $svcustomer->firstname), 200);
                         try {
                                $idinserteds = DB::select('call CreatPostApiProcedure(?,?,?,?,?,?,?,?,?)',array($_namecat,$_body,$_typepost,$_idfile,$_firstname,$_mobile,$_email,$_address,$_name_status_type));
                                $idinserted = json_decode(json_encode($idinserteds), true);
                                $id_imppost = $idinserted[0]['_id_imppost'];
                                return response()->json(array('success' => true, 'id_inserted' => $id_imppost,'firstname'=>$_firstname), 200);
                            } catch (\Illuminate\Database\QueryException $ex) {
                                $errors = new MessageBag(['errorlogin' => $ex->getMessage()]);
                                return response()->json(array('error' => true, 'error' => $errors), 200);
                            }
                    } //end allow header
                    if ($_SERVER["REQUEST_METHOD"] === "OPTIONS") {
                        //exit; // OPTIONS request wants only the policy, we can stop here
                    }
                }
                $errors['error'] = "error access control allow headers";
                return response()->json(['error'=>$errors],401);       
    }
    public function processfile($base64_string){
        $_idfile = 0;
        $path_relative = "";                                  
            if($base64_string!=""){
                $orfilename = "";
                $dir = 'uploads/';
                $data = explode( ',', $base64_string );
                $mimeString = $data[0];
                $mimeString = explode( ':', $mimeString);
                $mimeString = explode( ';', $mimeString[1]);
                $extension =  explode( '/', $mimeString[0]);
                $data1 = $data[1];
                $decoded = base64_decode($data1);   
                $typefile = $extension[1];
                $path = base_path($dir . date('Y') . '/'.date('m').'/'.date('d').'/');
                $path_relative = $dir . date('Y') . '/'.date('m').'/'.date('d').'/';
                if(!File::exists($path)) {
                    File::makeDirectory($path, 0777, true, true);
                }     
                $filename = date('Ymd').'_'.time().'_'.uniqid().'.'.$typefile;
                file_put_contents( $path.$filename , $decoded);
                $errors = "";
                try {
                        $path_relative = $path_relative.$filename;
                        $idinserteds = DB::select('call InsertFilesProcedure(?,?,?,?)',array($path_relative,$orfilename,$filename,$typefile));
                        $idinserted = json_decode(json_encode($idinserteds), true);
                        $_idfile = $idinserted[0]['idfile'];
                        return $path_relative;
                        //return response()->json(array('success' => true, 'id_inserted' => $idinserted ), 200);
                    } catch (\Illuminate\Database\QueryException $ex) {
                        $errors = new MessageBag(['errorlogin' => $ex->getMessage()]);
                        return response()->json(array('error' => true, 'error' => $errors), 200);
                    }
        }
        return $path_relative;
    }
    public function game(Request $request)
    {

        if (isset($_SERVER["HTTP_ORIGIN"]) === true) {

            $origin = $_SERVER["HTTP_ORIGIN"];

            $allowed_origins = array(
                "https://thammyvienthienkhue.vn",
                "http://thammyvienthienkhue.vn",
                "https://mgk.edu.vn",
                "http://mgk.edu.vn",
                "http://www.mgkgroup.vn",
                "http://phuntheuthammykovibe.vn",
                "http://mgkgroup.vn",
                "http://localhost"
            );

            if (in_array($origin, $allowed_origins, true) === true) {
                header('Access-Control-Allow-Origin: ' . $origin);
                header('Access-Control-Allow-Credentials: true');
                header('Access-Control-Allow-Methods: POST');
                header('Access-Control-Allow-Headers: Content-Type');
                
                        $input = json_decode(file_get_contents('php://input'),true);
                            
                        $_namecat = $input['namecat'];
                        $_body = $input['body'];
                        $_typepost = $input['typepost'];
                        $_firstname = $input['firstname'];
                        $_mobile = $input['mobile'];
                        $_email = $input['email'];
                        $_address = $input['address'];
                        $_job = $input['job'];
                        $_birthday = $input['birthday'];
                        $_facebook = $input['facebook'];
                        $_name_status_type = $input['name_status_type'];
                        $file_canvas1 = $input['file_canvas1'];
                        $file_canvas2 = $input['file_canvas2'];
                        $file_canvas3 = $input['file_canvas3'];  
                        //if have exist file
                        $_idfile = 0;
                        $canvas1 = $this->processfile($file_canvas1);
                        $canvas2 = $this->processfile($file_canvas2);
                        $canvas3 = $this->processfile($file_canvas3);
                        //return response()->json(array('success' => true, 'file_canvas1' => $canvas1,'file_canvas2'=>$canvas2,'file_canvas3'=>$canvas3), 200);
                        //end if have file 
                        $host = $request->getSchemeAndHttpHost();           
                        $_body .= "<div class='image-game'><p><img src='".$host.'/marketing/'.$canvas1."' /></p><h5>Ảnh cận đứng</h5>";
                        $_body .= "<p><img src='".$host.'/marketing/'.$canvas2."' /></p><h5>Ảnh cận ngồi</h5>";
                        $_body .= "<p><img src='".$host.'/marketing/'.$canvas3."' /><h5>Ảnh cận vùng cơ thể</h5></p></div>";
                        //file_canvas1:

                        //end file_canvas1
                         try {
                                $idinserteds = DB::select('call CreatPostApiProcedure(?,?,?,?,?,?,?,?,?,?,?,?)',array($_namecat,$_body,$_typepost,$_idfile,$_firstname,$_mobile,$_email,$_address,$_name_status_type,$_birthday, $_job, $_facebook));
                                $idinserted = json_decode(json_encode($idinserteds), true);
                                $id_imppost = $idinserted[0]['_id_imppost'];
                                return response()->json(array('success' => true, 'id_inserted' => $id_imppost,'firstname'=>$_firstname), 200);
                            } catch (\Illuminate\Database\QueryException $ex) {
                                $errors = new MessageBag(['errorlogin' => $ex->getMessage()]);
                                return response()->json(array('error' => true, 'error' => $errors), 200);
                            }
                    } //end allow header

                    if ($_SERVER["REQUEST_METHOD"] === "OPTIONS") {
                        //exit; // OPTIONS request wants only the policy, we can stop here
                    }

                }

                $errors['error'] = "error access control allow headers";

        return response()->json(['error'=>$errors],401);       

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