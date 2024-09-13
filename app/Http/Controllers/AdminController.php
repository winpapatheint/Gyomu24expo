<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use App\Models\User;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Hash;

use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Auth;

use Illuminate\Support\Facades\DB;

use Validator;

use Mail;

use App\Providers\RouteServiceProvider;
// use App\User;
use DateTime;

use App\Models\Seminar;

use App;

use App\Http\Traits\MsgTrait;
use App\Http\Traits\ZoomTrait;

use Response;

use Illuminate\Support\Facades\Notification;
use App\Notifications\MsgNotiAdminUser;
use App\Notifications\MsgNotiAdminHcompany;
use App\Notifications\MsgNotiHcompanyHost;
use App\Notifications\MsgNotiHostHcompany;

use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\HcompanyController;

class AdminController extends Controller
{
    use MsgTrait;
    use ZoomTrait;



   /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Admin  $admin
     * @return \Illuminate\Http\Response
     */
    public function sendemailexhibit(Request $request)
    {

        $data = DB::table('exhibit')
                ->find($request->id);
        // $data = (array) $data;

        // print_r($data);die;

        $agerange = $request->agerange;
        $pics = DB::table('pic')
                    ->where(function($query) use ($agerange){
                        if (!empty($agerange)) {
                             $query->where('pic.agerange',$agerange);
                        }                        
                     })
                    ->orderBy('created_at', 'desc')->paginate(9999);
        // print_r($pics);die;
        

        foreach ($pics as $key => $value) {
            // echo $value->email;
            // echo $value->name;
              if (!empty($value->email)) {
                $info = array('name'=>$value->name);
                $mail = Mail::send([], $info, function($message) use ($value, $data) {
                   $message->to($value->email,$value->name)->subject($data->name);
                   $message->from('info@24expo-japan.com','24expo-japan.com');
                   $message->setBody("以下、展示情報をご案内いたします。
                   \r\n＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝
                   \r\n出展名：　".$data->name."
                   \r\n出展番号：　".$data->taskno."
                   \r\n"."出展日：　".$data->taskdate."

                   \r\n"."カテゴリー：　".__(config('global.category')[$data->category])."
                   \r\n
                   \r\n"."備考欄：　"."　
                   \r\n".str_replace("<br />","\r\n",$data->taskcontent)."
                   \r\n

                   \r\n＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝");
                });
              }

              // print_r($mail);die;
              $msg = __('contact.donesend');


        }


        return redirect('/admin/exhibit')->with('success','一斉に送信されました。');
        
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Admin  $admin
     * @return \Illuminate\Http\Response
     */
    public function deleteexhibit(Request $request)
    {

        $data = DB::table('exhibit')
                    ->delete($request->id);
        return redirect('/admin/exhibit')->with('success','削除されました。');
        
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function indexexhibit()
{
    $limit = 10;

    // Retrieve and sanitize inputs
    $kword = request()->input('kword', '');
    $start = request()->input('start', '');
    $end = request()->input('end', '');

    // Initialize variables for dates
    $startdate = null;
    $enddate = null;

    // Validate and format start date
    if (!empty($start)) {
        try {
            $startdate = new DateTime($start);
            //$start = $startdate->format('Y-m-d 00:00:00');
        } catch (\Exception $e) {
            // Handle invalid date format
            return back()->with('errorsearch', __('user.invalid_start_date'));
        }
    }

    // Validate and format end date
    if (!empty($end)) {
        try {
            $enddate = new DateTime($end);
            $end = $enddate->format('Y-m-d 23:59:59');
        } catch (\Exception $e) {
            // Handle invalid date format
            return back()->with('errorsearch', __('user.invalid_end_date'));
        }
    }

    // Check if end date is before start date
    if ($startdate && $enddate && $enddate < $startdate) {
        return back()->with('errorsearch', __('user.datesearcherror'));
    }

    // Build query
    $exhibits = DB::table('exhibit')
        ->where(function($query) use ($kword, $start, $end) {
            if (!empty($kword)) {
                $query->where('taskno', 'LIKE', '%' . $kword . '%')
                      ->orWhere('name', 'LIKE', '%' . $kword . '%');
            }
            if (!empty($start)) {
                $query->where('taskdate', '>=', $start);
            }
            if (!empty($end)) {
                $query->where('taskdate', '<=', $end); // Ensure to include end date
            }
        })
        ->orderBy('taskdate', 'desc')
        ->paginate($limit);

    // Calculate total pages
    $ttl = $exhibits->total();
    $ttlpage = ceil($ttl / $limit);

    // Return view with data
    return view('admin.indexexhibit', compact('exhibits', 'ttlpage', 'ttl'));
}


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function saveexhibit(Request $request)
    {



        $check = [
            'name' => 'required|string|max:255',
            'taskno' => 'required|string|max:255',
            'taskdate' => 'required|string|max:255',
            'category' => 'required|not_in:0',
            'taskcontent'=>'required|string',
        ];

        // print_r("$request->check");die;
        $validator = Validator::make($request->all(), $check,
        [
            'name.required' => __('出展名を入力してください'),
            'taskno.required' => __('出展番号を入力してください'),
            'taskdate.required' => __('出展日を入力してください'),
            'taskcontent.required' => __('出展内容/商材を入力してください'),
            'description.required' => __('validation.pleasefillexhibitmsg'),
        ]);

        if($request->ajax()){
        
            if ($validator->passes()) {
                return response()->json(['success'=>'allpasses']);
            }         
            return response()->json(['error'=>$validator->errors()]);
        
        }

        // print_r($request->all());die;

        $data=array('name'=>$request->name,
                    "taskno"=>$request->taskno,
                    "taskdate"=>$request->taskdate,
                    "taskauthor"=>$request->taskauthor,
                    "category"=>$request->category,
                    "taskcontent"=>$request->taskcontent,
                    // "created_at"=> new \DateTime(),
                );

        if (!empty($request->imageone)) {
            $data["imageone"] = $imageoneName = 'imageone'.time().'.'.$request->imageone->extension();           
            $request->imageone->move(public_path('images'), $imageoneName);
        } 

        if (!empty($request->imagetwo)) {
            $data["imagetwo"] = $imagetwoName = 'imagetwo'.time().'.'.$request->imagetwo->extension();           
            $request->imagetwo->move(public_path('images'), $imagetwoName);
        } 

        if (!empty($request->imagethr)) {
            $data["imagethr"] = $imagethrName = 'imagethr'.time().'.'.$request->imagethr->extension();           
            $request->imagethr->move(public_path('images'), $imagethrName);
        }         

        if (!empty($request->imagefou)) {
            $data["imagefou"] = $imagefouName = 'imagefou'.time().'.'.$request->imagefou->extension();           
            $request->imagefou->move(public_path('images'), $imagefouName);
        }


        if ((empty($request->id))  OR $request->makenew ) {

            $data["created_at"] = new \DateTime();

            DB::table('exhibit')->insert($data);

            $msg = __('user.doneapply');

            // // Notification case 1
            // $admin = User::where('role','admin')->get();
            // Notification::send($admin, new NewTaskApply($admin));


        } else {
            // $seminar = Seminar::find($request->id);
            
            DB::table('exhibit')->where('id',$request->id)->update($data);
            $msg = '更新されました。';
            // die('aaa');
        }

        return redirect('/admin/exhibit')->with('success',$msg);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function editexhibit(Request $request, $id)
    {


        $editmode = false;
        $edituser = array();
        if (!empty($id)) {
            $edituser = DB::table('exhibit')
                    ->find($id);
            $edituser = (array) $edituser;
            $editmode = true;
        }

        // print_r($edituser);
        // die;

        return view('admin.registerexhibit',compact('editmode','edituser'));

    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function printpdf($type)
    {
        $data = json_decode($_GET['data']);
        if ( $type == 'yeartable') {
            return view('yeartemplate',compact('data'));
        } elseif ( $type == 'monthtable') {
            return view('monthtemplate',compact('data'));
        } else {
            return view('daytemplate',compact('data'));
        }
        
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function indexcoadmin()
    {
        $limit = 10;
        if (!empty($_GET['kword'])) {
            $kword = $_GET['kword'];
        } else {
            $kword = '';
        }    


        if (!empty($_GET['start'])) {
            $start = $_GET['start'];
            $start = date("Y-m-d 00:00:00",strtotime($start));
        } else {
            $start = '';
        } 

        if (!empty($_GET['end'])) {
            $end = $_GET['end'];
            $end = date("Y-m-d 23:59:59",strtotime($end));
        } else {
            $end = '';
        } 

        $startdate = new DateTime($start);
        $enddate = new DateTime($end);

        if($enddate < $startdate) {
            return back()->with('errorsearch',__('user.datesearcherror'));
        }

        $coadmins = DB::table('coadmin')
                    ->where(function($query) use ($kword , $start , $end){
                        if (!empty($kword)) {
                            $query->where('email','LIKE','%'.$kword.'%')->orwhere('name','LIKE','%'.$kword.'%');
                        }
                        if (!empty($start)) {
                             $query->where('created_at', '>=',$start);
                        }
                        if (!empty($end)) {
                             $query->where('created_at', '<',$end);
                        }
                     })
                    ->orderBy('created_at', 'desc')->paginate($limit);

        // print_r($coadmins);die;
        $ttl = $coadmins->total();
        $ttlpage = (ceil($ttl / $limit));

        return view('admin.indexcoadmin',compact('coadmins','ttlpage','ttl'));
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function storecoadmin(Request $request)
    {

        $check = [
            'name' => 'required|string|max:255',
            'furiname' => 'required|string|max:255',
            'gender' => 'not_in:0',
            'occupation' => 'not_in:0',
            'departmentname' => 'required|string|max:255',
            'email' => 'required|string|max:255',
        ];


        // print_r("$request->check");die;
        $validator = Validator::make($request->all(), $check,
        [
            // 'phone.regex' => '有効な電話番号を入力してください',
        ]);


        if($request->ajax()){
        
            if ($validator->passes()) {
                return response()->json(['success'=>'allpasses']);
            }         
            return response()->json(['error'=>$validator->errors()]);
        
        }

        if (!empty($request->image)) {
            $imageName = time().'.'.$request->image->extension();           
            $request->image->move(public_path('images/avatar'), $imageName);
        } else {
            $imageName = '';
        }


        $data=array('name'=>$request->name,
                    'furiname' => $request->furiname,
                    'gender' => $request->gender,
                    'occupation' => $request->occupation,
                    'departmentname' => $request->departmentname,
                    'email' => $request->email,
                    'remarks' => $request->remarks,
                    // "created_at"=> new \DateTime(),
                    // 'created_by' => Auth::user()->id,
                );

        if (empty($request->id)) {

            // die('A');
            $data['created_at'] = new \DateTime();
            // $data['created_by'] = Auth::user()->id;

            DB::table('coadmin')->insert($data);

            $msg = '「'.$request->name.'」登録されました。';
        } else {
            // die('B');
            # code...
            $type = DB::table('coadmin')->where('id',$request->id)->update($data);
            $msg = '更新されました。';
        }

        return redirect('/admin/coadmin')->with('success',$msg);
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function storeagreement(Request $request)
    {


        $check = [
            'agreementid' => 'required|string|max:255',
            'agreementvalue' => 'required|numeric',
            'productname' => 'required|string|max:255',
            'startdate' => 'required|string|max:255',
            'enddate' => 'required|string|max:255',
            'negoid' => 'required|string|max:255',
            'createdate' => 'required|string|max:255',
            'created_by' => 'required|string|max:255',
        ];


        // print_r("$request->check");die;
        $validator = Validator::make($request->all(), $check,
        [
            'startdate.required' => '契約締結日を入力してください',
            'enddate.required' => '契約満了日を入力してください',
            'created_by.required' => '作成者名を入力してください',
        ]);


        if($request->ajax()){
        
            if ($validator->passes()) {
                return response()->json(['success'=>'allpasses']);
            }         
            return response()->json(['error'=>$validator->errors()]);
        
        }

        if (!empty($request->image)) {
            $imageName = time().'.'.$request->image->extension();           
            $request->image->move(public_path('images/avatar'), $imageName);
        } else {
            $imageName = '';
        }


        $data=array(

                    'agreementid' =>$request->agreementid,
                    'agreementvalue' =>$request->agreementvalue,
                    'productname' =>$request->productname,
                    'startdate' =>$request->startdate,
                    'enddate' =>$request->enddate,
                    'negoid' =>$request->negoid,
                    'remarks' =>$request->remarks,
                    'createdate' =>$request->createdate,
                    'created_by' =>$request->created_by,

                );

        if (empty($request->id)) {

            // die('A');
            $data['created_at'] = new \DateTime();

            DB::table('agreement')->insert($data);

            $msg = '「'.$request->agreementid.'」登録されました。';
        } else {
            // die('B');
            # code...
            $type = DB::table('agreement')->where('id',$request->id)->update($data);
            $msg = '更新されました。';
        }

        return redirect('/admin/agreement')->with('success',$msg);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function editcoadmin(Request $request, $id)
    {

        $editmode = false;
        $data = array();

        if (!empty($id)) {
            $data = DB::table('coadmin')
                    ->find($id);
            $data = (array) $data;
            $editmode = true;
        }

        return view('admin.registercoadmin',compact('editmode','data'));

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function editagreement(Request $request, $id)
    {

        $hcompanies = DB::table('hcompany')
                    ->orderBy('created_at', 'desc')->paginate(9999);

        $editmode = false;
        $data = array();
        $data['hcompany'] = 0;
        if (!empty($id)) {
            $data = DB::table('agreement')
                    ->find($id);
            $data = (array) $data;
            $editmode = true;
        }

        return view('admin.registeragreement',compact('hcompanies','editmode','data'));

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function editnego(Request $request, $id)
    {

        $hcompanies = DB::table('hcompany')
                    ->orderBy('created_at', 'desc')->paginate(9999);

        $editmode = false;
        $data = array();
        $data['hcompany'] = 0;
        if (!empty($id)) {
            $data = DB::table('nego')
                    ->find($id);
            $data = (array) $data;
            $editmode = true;
        }

        return view('admin.registernego',compact('hcompanies','editmode','data'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function storenego(Request $request)
    {


        $check = [
            'negoid' => 'required|string|max:255',
            'negovalue' => 'required|numeric',
            'discount' => 'required|numeric',
            'agreementnumber' => 'required|numeric',
            'purchasevalue' => 'required|numeric',
            'productname' => 'required|string|max:255',
            'createdate' => 'required|string|max:255',
            'orderdate' => 'required|string|max:255',
            'action' => 'required|string|max:255',
            'invoicetype' => 'not_in:0',
            // 'inquiryno' => 'required|numeric',
        ];


        // print_r("$request->check");die;
        $validator = Validator::make($request->all(), $check,
        [
            // 'phone.regex' => '有効な電話番号を入力してください',
        ]);


        if($request->ajax()){
        
            if ($validator->passes()) {
                return response()->json(['success'=>'allpasses']);
            }         
            return response()->json(['error'=>$validator->errors()]);
        
        }

        if (!empty($request->image)) {
            $imageName = time().'.'.$request->image->extension();           
            $request->image->move(public_path('images/avatar'), $imageName);
        } else {
            $imageName = '';
        }


        $data=array(
                    'negoid' =>$request->negoid,
                    'negovalue' =>$request->negovalue,
                    'discount' =>$request->discount,
                    'agreementnumber' =>$request->agreementnumber,
                    'purchasevalue' =>$request->purchasevalue,
                    'productname' =>$request->productname,
                    'createdate' =>$request->createdate,
                    'orderdate' =>$request->orderdate,
                    'action' =>$request->action,
                    'invoicetype' =>$request->invoicetype,
                    'creater_name' =>$request->creater_name,
                    'remarks' =>$request->remarks,
                    'inquiryno' =>1, //useless data
                    // "created_at"=> new \DateTime(),
                    // 'created_by' => Auth::user()->id,
                );

        if (empty($request->id)) {

            // die('A');
            $data['created_at'] = new \DateTime();
            $data['created_by'] = Auth::user()->id;

            DB::table('nego')->insert($data);

            $msg = '「'.$request->name.'」登録されました。';
        } else {
            // die('B');
            # code...
            $type = DB::table('nego')->where('id',$request->id)->update($data);
            $msg = '更新されました。';
        }

        return redirect('/admin/nego')->with('success',$msg);
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function editpic(Request $request, $id)
    {

        $hcompanies = DB::table('hcompany')
                    ->orderBy('created_at', 'desc')->paginate(9999);

        $editmode = false;
        $data = array();
        $data['hcompany'] = 0;
        if (!empty($id)) {
            $data = DB::table('pic')
                    ->find($id);
            $data = (array) $data;
            $editmode = true;
        }

        return view('admin.registerpic',compact('hcompanies','editmode','data'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function storepic(Request $request)
    {

        $check = [
            'name' => 'required|string|max:255',
            'furiname' => 'required|string|max:255',
            'gender' => 'not_in:0',
            'agerange' => 'not_in:0',
            'hcompany' => 'not_in:0',
            'postalcode' => 'required|string|max:255',
            'address' => 'required|string|max:255',
            'departmentname' => 'required|string|max:255',
            'occupation' => 'not_in:0',
            'phone' => 'required|string|max:255',
            'email' => 'required|string|max:255',
        ];


        // print_r("$request->check");die;
        $validator = Validator::make($request->all(), $check,
        [
            'hcompany.not_in' => '所属会社名を入力してください',
        ]);


        if($request->ajax()){
        
            if ($validator->passes()) {
                return response()->json(['success'=>'allpasses']);
            }         
            return response()->json(['error'=>$validator->errors()]);
        
        }

        if (!empty($request->image)) {
            $imageName = time().'.'.$request->image->extension();           
            $request->image->move(public_path('images/avatar'), $imageName);
        } else {
            $imageName = '';
        }


        $data=array('name'=>$request->name,
                    'furiname' => $request->furiname,
                    'gender' => $request->gender,
                    'agerange' => $request->agerange,
                    'hcompany' => $request->hcompany,
                    'postalcode' => $request->postalcode,
                    'address' => $request->address,
                    'departmentname' => $request->departmentname,
                    'occupation' => $request->occupation,
                    'phone' => $request->phone,
                    'email' => $request->email,
                    'sns' => $request->sns,
                    'dob' => $request->dob,
                    'remarks' => $request->remarks,
                    // "created_at"=> new \DateTime(),
                    // 'created_by' => Auth::user()->id,
                );

        if (empty($request->id)) {

            // die('A');
            $data['created_at'] = new \DateTime();
            $data['created_by'] = Auth::user()->id;

            DB::table('pic')->insert($data);

            $msg = '「'.$request->name.'」登録されました。';
        } else {
            // die('B');
            # code...
            $type = DB::table('pic')->where('id',$request->id)->update($data);
            $msg = '更新されました。';
        }

        return redirect('/admin/pic')->with('success',$msg);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function indexagreement()
    {
        $limit = 10;
        if (!empty($_GET['kword'])) {
            $kword = $_GET['kword'];
        } else {
            $kword = '';
        }    


        if (!empty($_GET['start'])) {
            $start = $_GET['start'];
            $start = date("Y-m-d 00:00:00",strtotime($start));
        } else {
            $start = '';
        } 

        if (!empty($_GET['end'])) {
            $end = $_GET['end'];
            $end = date("Y-m-d 23:59:59",strtotime($end));
        } else {
            $end = '';
        } 

        $startdate = new DateTime($start);
        $enddate = new DateTime($end);

        if($enddate < $startdate) {
            return back()->with('errorsearch',__('user.datesearcherror'));
        }

        $args = DB::table('agreement')
                    ->where(function($query) use ($kword , $start , $end){
                        if (!empty($kword)) {
                            $query->where('agreementid','LIKE','%'.$kword.'%')->orwhere('productname','LIKE','%'.$kword.'%');
                        }
                        if (!empty($start)) {
                             $query->where('created_at', '>=',$start);
                        }
                        if (!empty($end)) {
                             $query->where('created_at', '<',$end);
                        }
                     })
                    ->orderBy('created_at', 'desc')->paginate($limit);


        $ttl = $args->total();
        $ttlpage = (ceil($ttl / $limit));

        return view('admin.indexagreement',compact('args','ttlpage','ttl'));
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function indexnego()
{
    $limit = 10;

    // Retrieve and sanitize input values
    $kword = $_GET['kword'] ?? '';
    $start = $_GET['start'] ?? '';
    $end = $_GET['end'] ?? '';

    // Format dates if they are not empty
    if (!empty($start)) {
        $start = date("Y-m-d 00:00:00", strtotime($start));
    } else {
        $start = '';
    }

    if (!empty($end)) {
        $end = date("Y-m-d 23:59:59", strtotime($end));
    } else {
        $end = '';
    }

    // Create DateTime objects for validation
    $startdate = !empty($start) ? new DateTime($start) : null;
    $enddate = !empty($end) ? new DateTime($end) : null;

    // Check if end date is earlier than start date
    if ($startdate && $enddate && $enddate < $startdate) {
        return back()->with('errorsearch', __('user.datesearcherror'));
    }

    // Query the database
    $query = DB::table('nego')
                ->where(function($query) use ($kword, $start, $end) {
                    if (!empty($kword)) {
                        // Replace 'productname' with the correct column name
                        $query->where('productname', 'LIKE', '%' . $kword . '%');
                    }
                    if (!empty($start)) {
                        $query->where('created_at', '>=', $start);
                    }
                    if (!empty($end)) {
                        $query->where('created_at', '<=', $end); // Use <= to include the end date
                    }
                })
                ->orderBy('created_at', 'desc');

    // Debug: Print SQL query and bindings
    // Uncomment the following lines to debug
    // dd($query->toSql(), $query->getBindings());

    // Execute the query and paginate results
    $negos = $query->paginate($limit);

    // Calculate pagination details
    $ttl = $negos->total();
    $ttlpage = ceil($ttl / $limit);

    return view('admin.indexnego', compact('negos', 'ttlpage', 'ttl'));
}

    



    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function indexpic()
    {
        $limit = 10;
        if (!empty($_GET['kword'])) {
            $kword = $_GET['kword'];
        } else {
            $kword = '';
        }    

        if (!empty($_GET['agerange'])) {
            $agerange = $_GET['agerange'];
        } else {
            $agerange = '';
        } 

        if (!empty($_GET['start'])) {
            $start = $_GET['start'];
            $start = date("Y-m-d 00:00:00",strtotime($start));
        } else {
            $start = '';
        } 

        if (!empty($_GET['end'])) {
            $end = $_GET['end'];
            $end = date("Y-m-d 23:59:59",strtotime($end));
        } else {
            $end = '';
        } 

        $startdate = new DateTime($start);
        $enddate = new DateTime($end);

        if($enddate < $startdate) {
            return back()->with('errorsearch',__('user.datesearcherror'));
        }


        $pics = DB::table('pic')
                    ->select('H.name as hcompanyname', 'pic.*')
                    ->where(function($query) use ($kword , $start , $end , $agerange){
                        if (!empty($kword)) {
                            $query->where('H.name','LIKE','%'.$kword.'%')->orwhere('pic.name','LIKE','%'.$kword.'%');
                        }
                        if (!empty($start)) {
                             $query->where('pic.created_at', '>=',$start);
                        }
                        if (!empty($end)) {
                             $query->where('pic.created_at', '<',$end);
                        }
                        if (!empty($agerange)) {
                             $query->where('pic.agerange',$agerange);
                        }                        
                     })
                    ->join('hcompany as H', function ($join) {
                        $join->on('pic.hcompany', '=', 'H.id');
                    })

                    ->orderBy('created_at', 'desc')->paginate($limit);

        // print_r($pics);die;
        $ttl = $pics->total();
        $ttlpage = (ceil($ttl / $limit));

        return view('admin.indexpic',compact('pics','ttlpage','ttl'));
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function ordertemplate($id)
    {
        $data = DB::table('order')
                    ->find($id);
            $data = (array) $data;

            $hcompany = DB::table('hcompany')
                            ->where('id',$data['hcompany'])
                            ->get();
                    // print_r($hcompany[0]->name);die;
            
            $data['hcompany'] = $hcompany[0]->name;
            $data['label'] = (array) json_decode($data['label']);
            $data['quantity'] = (array) json_decode($data['quantity']);
            $data['unit'] = (array) json_decode($data['unit']);
            $data['priceperunit'] = (array) json_decode($data['priceperunit']);
            $data['totalrow'] = (array) json_decode($data['totalrow']);

        $companyinfo = DB::table('matters')
                    ->where('for','companyinfo')
                    ->get();

        $companyinfo = $companyinfo->pluck('value', 'title');

        // print_r($order);die;
        return view('ordertemplate',compact('data','companyinfo'));
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function indexorder()
    {
        $limit = 10;
        if (!empty($_GET['kword'])) {
            $kword = $_GET['kword'];
        } else {
            $kword = '';
        }    


        if (!empty($_GET['start'])) {
            $start = $_GET['start'];
            $start = date("Y-m-d 00:00:00",strtotime($start));
        } else {
            $start = '';
        } 

        if (!empty($_GET['end'])) {
            $end = $_GET['end'];
            $end = date("Y-m-d 23:59:59",strtotime($end));
        } else {
            $end = '';
        } 

        $startdate = new DateTime($start);
        $enddate = new DateTime($end);

        if($enddate < $startdate) {
            return back()->with('errorsearch',__('user.datesearcherror'));
        }

        $lists = DB::table('order')
                    ->where(function($query) use ($kword , $start , $end){
                        if (!empty($kword)) {
                            $query->where('timeid','LIKE','%'.$kword.'%')->orwhere('name','LIKE','%'.$kword.'%');
                        }
                        if (!empty($start)) {
                             $query->where('date', '>=',$start);
                        }
                        if (!empty($end)) {
                             $query->where('date', '<',$end);
                        }
                     })
                    ->orderBy('created_at', 'desc')->paginate($limit);


        $ttl = $lists->total();
        $ttlpage = (ceil($ttl / $limit));

        return view('admin.indexorder',compact('lists','ttlpage','ttl'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function storeorder(Request $request)
    {

        // print_r($request->all());die;

        $data=array('timeid'=>$request->timeid,
                    'date'=>$request->date,
                    'name'=>$request->name,
                    'duenote'=>$request->duenote,
                    'placedelivery'=>$request->placedelivery,
                    'term'=>$request->term,
                    'duedate'=>$request->duedate,
                    'remarks'=>$request->remarks,
                    'hcompany'=>$request->hcompany,
                    'postalcode'=>$request->postalcode,
                    'address'=>$request->address,
                    'addressextra'=>$request->addressextra,
                    'phone'=>$request->phone,
                    'label'=>json_encode($request->label),
                    'quantity'=>json_encode($request->quantity),
                    'unit'=>json_encode($request->unit),
                    'priceperunit'=>json_encode($request->priceperunit),
                    'totalrow'=>json_encode($request->totalrow),
                    // "created_at"=> new \DateTime(),
                    // 'created_by' => Auth::user()->id,
                );

        if (empty($request->id)) {

            // die('A');
            $data['created_at'] = new \DateTime();
            $data['created_by'] = Auth::user()->id;

            DB::table('order')->insert($data);

            $msg = '「'.$request->name.'」登録されました。';
        } else {
            // // die('B');
            // # code...
            DB::table('order')->where('id',$request->id)->update($data);
            $msg = '更新されました。';
        }

        return redirect('/admin/order')->with('success',$msg);
    }




    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function invoicetemplate($id)
    {
        $data = DB::table('invoice')
                    ->find($id);
            $data = (array) $data;

            $hcompany = DB::table('hcompany')
                            ->where('id',$data['hcompany'])
                            ->get();
                    // print_r($hcompany[0]->name);die;
            
            $data['hcompany'] = $hcompany[0]->name;
            $data['label'] = (array) json_decode($data['label']);
            $data['quantity'] = (array) json_decode($data['quantity']);
            $data['unit'] = (array) json_decode($data['unit']);
            $data['priceperunit'] = (array) json_decode($data['priceperunit']);
            $data['totalrow'] = (array) json_decode($data['totalrow']);

        $companyinfo = DB::table('matters')
                    ->where('for','companyinfo')
                    ->get();

        $companyinfo = $companyinfo->pluck('value', 'title');

        // print_r($data);die;
        return view('invoicetemplate',compact('data','companyinfo'));
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function indexinvoice()
    {
        $limit = 10;
        if (!empty($_GET['kword'])) {
            $kword = $_GET['kword'];
        } else {
            $kword = '';
        }    


        if (!empty($_GET['start'])) {
            $start = $_GET['start'];
            $start = date("Y-m-d 00:00:00",strtotime($start));
        } else {
            $start = '';
        } 

        if (!empty($_GET['end'])) {
            $end = $_GET['end'];
            $end = date("Y-m-d 23:59:59",strtotime($end));
        } else {
            $end = '';
        } 

        $startdate = new DateTime($start);
        $enddate = new DateTime($end);

        if($enddate < $startdate) {
            return back()->with('errorsearch',__('user.datesearcherror'));
        }

        $lists = DB::table('invoice')
                    ->where(function($query) use ($kword , $start , $end){
                        if (!empty($kword)) {
                            $query->where('timeid','LIKE','%'.$kword.'%')->orwhere('name','LIKE','%'.$kword.'%');
                        }
                        if (!empty($start)) {
                             $query->where('date', '>=',$start);
                        }
                        if (!empty($end)) {
                             $query->where('date', '<',$end);
                        }
                     })
                    ->orderBy('created_at', 'desc')->paginate($limit);


        $ttl = $lists->total();
        $ttlpage = (ceil($ttl / $limit));

        return view('admin.indexinvoice',compact('lists','ttlpage','ttl'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function storeinvoice(Request $request)
    {

        // print_r($request->all());die;

        $data=array('timeid'=>$request->timeid,
                    'date'=>$request->date,
                    'name'=>$request->name,
                    'duenote'=>$request->duenote,
                    'placedelivery'=>$request->placedelivery,
                    'term'=>$request->term,
                    'duedate'=>$request->duedate,
                    'remarks'=>$request->remarks,
                    'hcompany'=>$request->hcompany,
                    'postalcode'=>$request->postalcode,
                    'address'=>$request->address,
                    'addressextra'=>$request->addressextra,
                    'phone'=>$request->phone,
                    'label'=>json_encode($request->label),
                    'quantity'=>json_encode($request->quantity),
                    'unit'=>json_encode($request->unit),
                    'priceperunit'=>json_encode($request->priceperunit),
                    'totalrow'=>json_encode($request->totalrow),
                    // "created_at"=> new \DateTime(),
                    // 'created_by' => Auth::user()->id,
                );

        if (empty($request->id)) {

            // die('A');
            $data['created_at'] = new \DateTime();
            $data['created_by'] = Auth::user()->id;

            DB::table('invoice')->insert($data);

            $msg = '「'.$request->name.'」登録されました。';
        } else {
            // // die('B');
            // # code...
            DB::table('invoice')->where('id',$request->id)->update($data);
            $msg = '更新されました。';
        }

        return redirect('/admin/invoice')->with('success',$msg);
    }








    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function quotationtemplate($id)
    {
        $data = DB::table('quotation')
                    ->find($id);
            $data = (array) $data;

            $hcompany = DB::table('hcompany')
                            ->where('id',$data['hcompany'])
                            ->get();
                    // print_r($hcompany[0]->name);die;

            $data['hcompany'] = $hcompany[0]->name;
            $data['label'] = (array) json_decode($data['label']);
            $data['quantity'] = (array) json_decode($data['quantity']);
            $data['unit'] = (array) json_decode($data['unit']);
            $data['priceperunit'] = (array) json_decode($data['priceperunit']);
            $data['totalrow'] = (array) json_decode($data['totalrow']);

        $companyinfo = DB::table('matters')
                    ->where('for','companyinfo')
                    ->get();

        $companyinfo = $companyinfo->pluck('value', 'title');

        // print_r($companyinfo);die;
        return view('quotationtemplate',compact('data','companyinfo'));
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function indexquotation()
{
    $limit = 10;

    // Retrieve and sanitize input values
    $kword = $_GET['kword'] ?? '';
    $start = $_GET['start'] ?? '';
    $end = $_GET['end'] ?? '';

    // Format dates if they are not empty
    if (!empty($start)) {
        $start = date("Y-m-d 00:00:00", strtotime($start));
    } else {
        $start = null;
    }

    if (!empty($end)) {
        $end = date("Y-m-d 23:59:59", strtotime($end));
    } else {
        $end = null;
    }

    // Create DateTime objects for validation
    $startdate = $start ? new DateTime($start) : null;
    $enddate = $end ? new DateTime($end) : null;

    // Check if end date is earlier than start date
    if ($startdate && $enddate && $enddate < $startdate) {
        return back()->with('errorsearch', __('user.datesearcherror'));
    }

    // Query the database
    $lists = DB::table('quotation')
                ->where(function($query) use ($kword, $start, $end) {
                    if (!empty($kword)) {
                        $query->where(function($query) use ($kword) {
                            $query->where('timeid', 'LIKE', '%' . $kword . '%')
                                  ->orWhere('name', 'LIKE', '%' . $kword . '%');
                        });
                    }
                    if (!empty($start)) {
                        $query->where('date', '>=', $start);
                    }
                    if (!empty($end)) {
                        $query->where('date', '<=', $end); // Use <= to include the end date
                    }
                })
                ->orderBy('created_at', 'desc') // Ensure 'created_at' is a valid column
                ->paginate($limit);

    // Calculate pagination details
    $ttl = $lists->total();
    $ttlpage = ceil($ttl / $limit);

    return view('admin.indexquotation', compact('lists', 'ttlpage', 'ttl'));
}


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function storequotation(Request $request)
    {

        // print_r($request->all());die;

        $data=array('timeid'=>$request->timeid,
                    'date'=>$request->date,
                    'name'=>$request->name,
                    'duenote'=>$request->duenote,
                    'placedelivery'=>$request->placedelivery,
                    'term'=>$request->term,
                    'duedate'=>$request->duedate,
                    'remarks'=>$request->remarks,
                    'hcompany'=>$request->hcompany,
                    'postalcode'=>$request->postalcode,
                    'address'=>$request->address,
                    'addressextra'=>$request->addressextra,
                    'phone'=>$request->phone,
                    'label'=>json_encode($request->label),
                    'quantity'=>json_encode($request->quantity),
                    'unit'=>json_encode($request->unit),
                    'priceperunit'=>json_encode($request->priceperunit),
                    'totalrow'=>json_encode($request->totalrow),
                    // "created_at"=> new \DateTime(),
                    // 'created_by' => Auth::user()->id,
                );

        if (empty($request->id)) {

            // die('A');
            $data['created_at'] = new \DateTime();
            $data['created_by'] = Auth::user()->id;

            DB::table('quotation')->insert($data);

            $msg = '「'.$request->name.'」登録されました。';
        } else {
            // // die('B');
            // # code...
            DB::table('quotation')->where('id',$request->id)->update($data);
            $msg = '更新されました。';
        }

        return redirect('/admin/quotation')->with('success',$msg);
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function gethcompany(Request $request)
    {

        if($request->ajax()){
        
                $hcompany = DB::table('hcompany')
                            ->where('id',$request->id)
                            ->get();
                return response()->json(['success'=>$hcompany]);
        }

        return response()->json(['error'=>'allpasses']);


    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function editdoc(Request $request, $role, $id)
    {

        $hcompanies = DB::table('hcompany')
                    ->orderBy('created_at', 'desc')->paginate(9999);

        $editmode = false;
        $data = array();
        $data['hcompany'] = 0;
        if (!empty($id)) {
            $data = DB::table($role)
                    ->find($id);
            $data = (array) $data;
            // die('2121');
            $data['label'] = (array) json_decode($data['label']);
            $data['quantity'] = (array) json_decode($data['quantity']);
            $data['unit'] = (array) json_decode($data['unit']);
            $data['priceperunit'] = (array) json_decode($data['priceperunit']);
            $data['totalrow'] = (array) json_decode($data['totalrow']);
            // print_r($data);die;
            $editmode = true;
        }

        return view('admin.register'.$role,compact('hcompanies','editmode','data'));

    }


    public function foremployee()
    {  


        $influencers = DB::table('users')
                    ->select('users.*')
                    ->where('users.role','host')
                    // ->join('users as u', 'users.created_by', '=', 'u.id')
                    ->orderBy('users.created_at', 'asc')->paginate(8);

        $tutorarr = $influencers->pluck('id', 'email')->toArray();

        $time = new DateTime();
        $tuturclasscount = Seminar::groupBy('host_id')
                        ->whereIN('host_id',$tutorarr)
                        ->whereNotNull('joinlist')
                        ->where('end', '<=',$time)
                        ->select('host_id', DB::raw('count(*) as total'))->pluck('total', 'host_id')->toArray();




        return view('forforeigner',compact('influencers','tuturclasscount'));
        // return view('welcome');
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Admin  $admin
     * @return \Illuminate\Http\Response
     */

    public function updatestatus(Request $request)
    {

        DB::table('task')->where('id',$request->taskid)->update(array('status'=>$request->nextstatus));

        return redirect()->back()->with('success','公開されました。

            ');

        // print_r($request->all());die;
    }

    public function inflhide(Request $request)
    {

        $host = User::where('id',$request->hostid)->get();
        $host = $host[0];

        if (empty($host->inflhide)) {
            User::where('id',$request->hostid)->update(array('inflhide'=>'1',));
            return redirect()->back()->with('success','非表示に設定されました。');
        } else {
            User::where('id',$request->hostid)->update(array('inflhide'=>'0',));
            return redirect()->back()->with('success','表示に設定されました。');
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Admin  $admin
     * @return \Illuminate\Http\Response
     */
    public function deleteevent(Request $request)
    {

        $data = DB::table('seminars')
                    ->delete($request->id);
        return redirect('/admin/events')->with('success','削除されました。');
        
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function indexevents()
    {

        //
        $limit = 10;
        if (!empty($_GET['kword'])) {
            $kword = $_GET['kword'];
        } else {
            $kword = '';
        }    

        if (!empty($_GET['start'])) {
            $start = $_GET['start'];
            $start = date("Y-m-d 00:00:00",strtotime($start));
        } else {
            $start = '';
        } 

        if (!empty($_GET['end'])) {
            $end = $_GET['end'];
            $end = date("Y-m-d 23:59:59",strtotime($end));
        } else {
            $end = '';
        } 

        $startdate = new DateTime($start);
        $enddate = new DateTime($end);

        if($enddate < $startdate) {
            return back()->with('errorsearch',__('user.datesearcherror'));
        }

        // $lists = Seminar::orderBy('created_at', 'desc')->paginate($limit);
        $lists = DB::table('seminars')
                    ->select('U.name as adminname', 'U.profileimg as profileimg', 'U.profile as profile', 'seminars.*')
                    ->where(function($query) use ($kword , $start , $end){
                         
                        if (!empty($kword)) {
                            $query->where('seminars.name','LIKE','%'.$kword.'%')->orwhere('U.name','LIKE','%'.$kword.'%');
                        }                       

                        if (!empty($start)) {
                             $query->where('seminars.start', '>',$start);
                        }
                        if (!empty($end)) {
                             $query->where('seminars.end', '<',$end);
                        }

                     })
                    ->join('users as U', function ($join) {
                        $join->on('seminars.host_id', '=', 'U.id')
                             ->where('U.role','admin');
                    })
                    ->orderBy('seminars.start', 'desc')
                    ->paginate($limit)
                    ;


        $ttl = $lists->total();
        $ttlpage = (ceil($ttl / $limit));

        $toppageseminar = DB::table('matters')
                        // ->where('for','youtubevideo')
                        ->where('title','toppageseminar')
                        ->get();
        // print_r($lists[0]);die;
        $toppageseminar = $toppageseminar[0]->value;


        return view('admin.indexevent',compact('lists','ttlpage','ttl','toppageseminar'));
    }

    public function updatezoomapi(Request $request)
    {

                // return response()->json(['error'=>'aaallpasses']);
        $valarr = array('keyone' => 'required|string|max:255',
                        'keytwo' => 'required|string|max:255',
                    );

        // print_r("$request->check");die;
        $validator = Validator::make($request->all(), $valarr,
        [
            'keyone.required' => 'ZOOMキーを入力してください',
            'keytwo.required' => 'ZOOM秘密キーを入力してください',
        ]);

            // return response()->json(['error'=>$request->all()]);
        // return response()->json(['error'=>$valarr]);
        if($request->ajax()){
        
            if ($validator->passes()) {
                return response()->json(['success'=>'allpasses']);
            }         
            return response()->json(['error'=>$validator->errors()]);
        
        }

        $zoomapi = json_encode(array('keyone' => $request->keyone , 'keytwo' => $request->keytwo));
        User::find($request->subadminid)->update(array('zoomapi'=>$zoomapi));
        return redirect()->back()->with('success','設定されました。');


    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Admin  $admin
     * @return \Illuminate\Http\Response
     */
    public function deleteblog(Request $request)
    {

        $data = DB::table('blog')
                    ->delete($request->id);
        return redirect('/admin/news')->with('success','削除されました。');
        
    }


    public function download()
    {

        // echo $_GET['d'] ;
        // die;
        $filepath = public_path($_GET['d']);
        return Response::download($filepath);

    }

    public function msgread(Request $request)
    {
            // DB::table('msg')->where('id',$request->msgid)->update(array('updated_at'=>new \DateTime()));
        DB::table('msg')->where('id',$request->msgid)->update(array('updated_at'=>new \DateTime(),));
        return response()->json(['success'=>true]);
    }

    public function getmsgnoti(Request $request)
    {


        if($request->ajax()){
        // return response()->json(['success'=>Auth::user()->id]);
            $noticount = array();
            foreach ($request->arr as $key => $value) {

                if (Auth::user()->role == 'admin') {
                    $count = DB::table('msg')->select("msg.*")->whereRaw("CONCAT(`roomnum`, '/',`taskhashid`) = ?", $value)              
                                        ->join('users as Adminuser', function ($join) {
                                            $join->on('msg.sender', '=', 'Adminuser.id')
                                                 ->where('Adminuser.role','!=','admin');
                                        })
                                        ->whereNull('msg.updated_at')->count();
                } else {
                    $count = DB::table('msg')->select("id")->whereRaw("CONCAT(`roomnum`, '/',`taskhashid`) = ?", $value)->where('sender','!=',Auth::user()->id)->whereNull('updated_at')->count();
                }
                
                if (!empty($count)) {
                    $noticount[$value] = $count;
                }

            }
            return response()->json(['success'=>$noticount]);
        
        }

    }


    public function assignpaydone(Request $request)
    {

        // print_r($request->all());die;
        if (DB::table('inflassign')->where('id',$request->assignid)->update(array('paydone'=>new \DateTime()))) {
            return redirect()->back();
        }


    }

    public function validatesubadmin($request, $editpassword = true , $editmode = false, $emailuniquecheck = true, $needimg = true) 
    {

        $check = [
            'name' => 'required|string|max:255',
            // 'agerange' => 'required|not_in:0',
            'phone' => ['required', 'regex:/^(0([1-9]{1}-?[1-9]\d{3}|[1-9]{2}-?\d{3}|[1-9]{2}\d{1}-?\d{2}|[1-9]{2}\d{2}-?\d{1})-?\d{4}|0[789]0-?\d{4}-?\d{4}|050-?\d{4}-?\d{4})$/'],
            'email' => 'required|string|email|max:255',
            'password' => 'required|string|min:6|confirmed',
            'gender' => 'required|not_in:0',
            'agerange' => 'required|not_in:0',
            // 'image' => 'required|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ];



        if (!$editpassword) {
            unset($check['password']);
        }

        if ($editmode) {
            unset($check['check']);
        }

        if ($emailuniquecheck) {
            $check['email'] .= '|unique:users' ;
        }

        if (!$needimg) {
            unset($check['image']);
        }
        // print_r("$request->check");die;
        $validator = Validator::make($request->all(), $check,
        [
            'check.required' => __('validation.pleasecheck'),
            // 'phone.regex' => '有効な電話番号を入力してください。',
            'image.mimes' => '画像ファイルをアップロードしてください。',
            'image.required' => '画像ファイルをアップロードしてください。',
        ]);

        return $validator;

    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function registersubadmin(Request $request)
    {
        $validator = $this->validatesubadmin($request);

        if($request->ajax()){
        
            if ($validator->passes()) {
                return response()->json(['success'=>'allpasses']);
            }         
            return response()->json(['error'=>$validator->errors()]);
        
        }
        // print_r($request->all());die;

        //*******************************************************

        if (empty($request->role)) {
            $role = 'admin';
        } else {
            $role = $request->role;
        }

        if (!empty($request->image)) {
            $imageName = time().'.'.$request->image->extension();           
            $request->image->move(public_path('images/avatar'), $imageName);
        } else {
            $imageName = '';
        }

 // print_r($request->all());die;

        $user = User::create([
            'role' => $role,
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'gender' => $request->gender,
            'agerange' => $request->agerange,
            'phone' => $request->phone,
            'profileimg' => $imageName,
        ]);

        $user->markEmailAsVerified();

        event(new Registered($user));

        return redirect('admin/subadmin')->with('success','「'.$request->name.'」登録されました。');

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function storereport(Request $request)
    {

        $validator = Validator::make($request->all(), [            
            'assignid' => 'required',
            'title' => 'required|string|max:255',
            'message' => 'required|string',
                            ],
        [
            'moneyin.min' => ' 300円から設定可能です。 ',
            'phone.regex' => '有効な電話番号を入力してください。',
        ]);

        if($request->ajax()){
        
            if ($validator->passes()) {
                return response()->json(['success'=>'allpasses']);
            }         
            return response()->json(['error'=>$validator->errors()]);
        
        }
        
        // print_r($request->all());die;

        DB::table('inflassign')->where('id',$request->assignid)->update(array('reporttitle'=>$request->title,
                                                                              'reportbody'=>$request->message,
                                                                              'reportupdated_by'=>Auth::user()->id,
                                                                              'reportupdated_at'=>new \DateTime(),
                                                                        ));
        
        $inflassign = DB::table('inflassign')->where('id',$request->assignid)->get();

        if (($inflassign[0]->inflstatus == '8') AND ($request->submitconfirm)) {
            DB::table('inflassign')->where('id',$request->assignid)->update(array('inflstatus'=>'9',
                                                                                  'reportsubmitted_at'=>new \DateTime(),
                                                                            ));
            // $unsolved_assign_count = DB::table('inflassign')->where(DB::raw('BINARY `taskid`'),$inflassign[0]->taskid)->where('inflstatus','!=','8')->count();
            // if (empty($unsolved_assign_count)) {
            //  DB::table('task')->where(DB::raw('BINARY `hashid`'),$inflassign[0]->taskid)->update(array('status'=>'11',
            //                                                                 ));
            // }

            return redirect()->back()->with('success','提出されました。');
        }

        return redirect()->back()->with('success','保存されました。');

    }

    public function report($assignid,$taskhashid)
    {

        $list = DB::table('task')
                    ->select('Client.name as clientname','Adminuser.name as subadminname', 'task.*')
                    ->where('task.positionname','<>','')
                    ->leftJoin('users as Adminuser', function ($join) {
                        $join->on('task.subadmin', '=', 'Adminuser.id')
                             ->where('Adminuser.role','subadmin');
                    })
                    ->leftJoin('users as Client', function ($join) {
                        $join->on('task.user', '=', 'Client.id')
                             ->where('Client.role','user');
                    })
                    ->where(DB::raw('BINARY `hashid`'),$taskhashid)->get();
        $list = $list[0];

        $inflassign = DB::table('inflassign')
                    ->where('id',$assignid)->get();

        $inflassign = $inflassign[0];
        // print_r($inflassign[0]);
        // die('sasa');

        return view('report',compact('list','inflassign','assignid'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function registermoneyin(Request $request)
    {

        // print_r($request->all());die;
        $vallarr = [
            'setmoneyintaskid' => 'required|string|max:255',
        ];

        if ($request->moneyin != '0') { //  allow 0 to submit
            $vallarr['moneyin'] = 'required|numeric';
        } 

        $validator = Validator::make($request->all(), $vallarr,
        [
            'moneyin.required' => '受注額を入力してください',
            'moneyin.numeric' => '半角数字を入力してください',
        ]);

        if($request->ajax() && ($request->forvalidate == 1)  ){
        
            if ($validator->passes()) {
                return response()->json(['success'=>'allpasses']);
            }         
            return response()->json(['error'=>$validator->errors()]);
        
        } else {

             DB::table('task')->where(DB::raw('BINARY `hashid`'),$request->setmoneyintaskid)->update(array('moneyin'=>$request->moneyin,));
            
            return redirect()->back();

        }

    }

    public function inflassign(Request $request)
    {

        
        $inflassign = DB::table('inflassign')
                    ->where(DB::raw('BINARY `taskid`'),$request->taskid)->pluck('inflid','id')->toArray();
        
// print_r($request->all());die;
        $result=array_diff($request->checkinfl,$inflassign);

        $data = array();
        foreach ($result as $key => $value) {
            $data[] = ['taskid'=>$request->taskid, 'inflid'=> $value , "created_at"=> new \DateTime()];
        }

        // print_r($data);die;

        DB::table('inflassign')->insert($data);


        $task = DB::table('task')->where(DB::raw('BINARY `hashid`'),$request->taskid)->get();
        $task = $task[0];
        if ($task->status == '2') {
            $type = DB::table('task')->where(DB::raw('BINARY `hashid`'),$request->taskid)->update(array('status'=>'3'));
        }

        return redirect()->back();

    }

    public function influencerassign($taskhashid)
    {

        $list = DB::table('task')
                    ->select('Client.name as clientname','Adminuser.name as subadminname', 'task.*')
                    ->where('task.positionname','<>','')
                    ->leftJoin('users as Adminuser', function ($join) {
                        $join->on('task.subadmin', '=', 'Adminuser.id')
                             ->where('Adminuser.role','subadmin');
                    })
                    ->leftJoin('users as Client', function ($join) {
                        $join->on('task.user', '=', 'Client.id')
                             ->where('Client.role','user');
                    })
                    ->where(DB::raw('BINARY `hashid`'),$taskhashid)->get();
        $list = $list[0];

        $limit = 10;
        if (!empty($_GET['kword'])) {
            $kword = $_GET['kword'];
        } else {
            $kword = '';
        }    

        if (!empty($_GET['field'])) {
            $field = $_GET['field'];
        } else {
            $field = '';
        }   

        if (!empty($_GET['infccountry'])) {
            $infccountry = $_GET['infccountry'];
        } else {
            $infccountry = '';
        }

        if (!empty($_GET['infcmedia'])) {
            $infcmedia = $_GET['infcmedia'];
        } else {
            $infcmedia = '';
        }   

        if (!empty($_GET['infcgenre'])) {
            $infcgenre = $_GET['infcgenre'];
        } else {
            $infcgenre = '';
        }

        $influencers = DB::table('users')
                    ->select('U.name as hcompanyname', 'users.*')
                    ->where('users.role','host')
                    ->where(function($query) use ($kword , $field , $infccountry, $infcmedia , $infcgenre){
                         
                        if (!empty($kword)) {
                            $query->where('users.name','LIKE','%'.$kword.'%')->orwhere('users.email','LIKE','%'.$kword.'%')->orwhere('U.name','LIKE','%'.$kword.'%');
                        }                       
                        if (!empty($field)) {
                             $query->where('users.field', $field);
                        }
                        if (!empty($infccountry)) {
                             $query->where('users.infccountry', $infccountry);
                        }
                        if (!empty($infcmedia)) {
                             $query->where('users.infcmedia', $infcmedia);
                        }
                        if (!empty($infcgenre)) {
                             $query->where('users.infcgenre', $infcgenre);
                        }

                     })
                    ->join('users as U', function ($join) {
                        $join->on('users.created_by', '=', 'U.id')
                             ->where('U.role','hcompany');
                    })
                    ->orderBy('users.created_at', 'desc')->get();

        $ttl = $influencers->count();
        // $ttlpage = (ceil($ttl / $limit));
        
        $inflassign = DB::table('inflassign')
                    ->where(DB::raw('BINARY `taskid`'),$taskhashid)->pluck('inflid','id')->toArray();
        // print_r($ttl);die;

        return view('influencerassign',compact('list','taskhashid','influencers','ttl','inflassign'));
    }

    public function hearing(Request $request)
    {

        DB::table('task')->where(DB::raw('BINARY `hashid`'),$request->taskid)->update(array(  'description' => $request->description,
                                                                            // 'infoproduct' => $request->infoproduct,
                                                                            // 'infodetail' => $request->infodetail,
                                                                            // 'infoduration' => $request->infoduration,
                                                                            // 'infokpi' => $request->infokpi,
                                                                            // 'infoconsiderreward' => $request->infoconsiderreward,
                                                                            // 'infoneedreward' => $request->infoneedreward,
                                                                            // 'infobreakdown' => $request->infobreakdown,
                                                                            // 'infosupplement' => $request->infosupplement,
                                                                            // 'infoestimatedtime' => $request->infoestimatedtime,
                                                                            // 'infodeadline' => $request->infodeadline,
                                                                         ));
        return redirect()->back();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function sendmsg(Request $request)
    {

        // print_r($request->all());die;
        if ($request->zoomset) {
            $f = strtotime($request->start);
            $f = gmdate("Y-m-d H:i:s ", $f);
            $f = new DateTime($f);

            $zoom = $this->createZoomMeeting($request->name,
                                             $f->format('Y-m-d\TH:i:s'),
                                             60,
                                             Auth::user()->zoomapi);
            // {"keyone":"iI34Hbz5TYicBxOa77Y1Mg","keytwo":"WvWU62JX67kxUcH7UMmZmLrGzQ3njuhtgEWW"}

            // print_r($zoom);die;

            $data=array('name'=>$request->name,
                        "zoomid"=>$zoom->id,
                        "host"=>Auth::user()->id,
                        "taskhashid"=>$request->taskid,
                        "roomnum"=>$request->roomnum,
                        "joiner"=>'',
                        "start"=>$request->start,
                        "duration"=>'60',
                        "starturl"=>$zoom->start_url,
                        "joinurl"=>$zoom->join_url,
                        "created_at"=> new \DateTime()
                       );
            DB::table('zoom')->insert($data);

            $title = 'ZOOMミーティングが設定されました。';
            $body = 'ミーティング名： '.$request->name.'<br>';
            $body .= 'ミーティング日時： '.$f->format('Y/m/d H:i').'<br>';
            // $body .= '参加リンク： <a href='.$zoom->join_url.'>こちら</a>';
            $body .= '参加リンク： <a class="btnlist btn-primary" style="font-size: 12px !important;" href='.$zoom->join_url.' role="button">ZOOMミーティング開始する</a>';
            $type = 'zoom';

        // } elseif ($request->fileupl) {

            // $valarr = [
            //     'taskid' => 'required',
            //     'roomnum' => 'required',
            //     'name' => 'required',
            //     'files.*' => 'mimes:doc,pdf,docx,zip,jpg,png,gif,jpeg'
            // ];

            // $request->validate($valarr,
            //                     ['name.title' => 'titleを入力してください',
            //                      'body.required' => 'bodyを入力してください']
            //                   );

            // $files = [];
            // if($request->hasfile('attachment'))
            //  {
            //     foreach($request->file('attachment') as $file)
            //     {
            //         // print_r($request->all());
            //         $name = time().rand(1,100).'.'.$file->extension();
            //         $file->move(public_path('images'), $name);  
            //         $files[] = $name;  
            //     }
            //  }

            // $title = $request->name;
            // $body = json_encode($files);
            // $type = 'fileupl';

            // print_r($body);
            // print_r($request->all());
            // die;


        } else {

            $valarr = [
                'taskid' => 'required',
                'roomnum' => 'required',
                'title' => 'required|string|max:255',
                'body' => 'required'
            ];

            $request->validate($valarr,
                                ['name.title' => 'titleを入力してくださいAA',
                                 'body.required' => 'bodyを入力してくださいAA']
                              );

            $type = 'msg';

            if($request->hasfile('attachment'))
            {
                $files = [];
                foreach($request->file('attachment') as $file)
                {
                    // print_r($request->all());
                    $name = time().rand(1,100).'.'.$file->extension();
                    $file->move(public_path('images'), $name);  
                    $files[] = $name;  
                }
                $attachment = json_encode($files);
                $type = 'fileupl';
            }


            $title = $request->title;
            $body = $request->body;
        }

        $task = DB::table('task')->where(DB::raw('BINARY `hashid`'),$request->taskid)->get();
        $task = $task[0];

        $updval = array();
        if ($task->status == '1') {
            $updval['status'] = '2';
        }

        if ( (empty($task->subadmin)) AND (Auth::user()->role == 'admin') ) {
            $updval['subadmin'] = Auth::user()->id;
        }

        // print_r($task->subadmin);die;

        if (!empty($updval)) {
            DB::table('task')->where(DB::raw('BINARY `hashid`'),$request->taskid)->update($updval);
        }

        $roomnum = $request->roomnum;
        if (Auth::user()->role == 'admin') {
            if ($roomnum == 'A') {

                $users = User::find($task->user);
                Notification::send($users, new MsgNotiAdminUser($users));

            } elseif (str_contains($roomnum, 'B')) {

                $inflassignid = str_replace('B','',$roomnum);
                
                $inflassign = DB::table('inflassign')
                            ->select(
                                'Hcompany.name as Hcompanyname',
                                'Hcompany.id as Hcompanyid',
                                'inflassign.*',
                                )
                            ->where('inflassign.id',$inflassignid)
                            ->join('users as Influencer', function ($join) {
                                $join->on('inflassign.inflid', '=', 'Influencer.id')
                                     ->where('Influencer.role','host');
                            })

                            ->join('users as Hcompany', function ($join) {
                                $join->on('Influencer.created_by', '=', 'Hcompany.id')
                                     ->where('Hcompany.role','hcompany');
                            })
                            ->orderBy('inflassign.created_at', 'desc')->get();

                $users = User::find($inflassign[0]->Hcompanyid);
                Notification::send($users, new MsgNotiAdminHcompany($users));

            }
        }

        if (str_contains($roomnum, 'C')) {
            if (Auth::user()->role == 'hcompany') {
                $inflassignid = str_replace('C','',$roomnum);
                
                $inflassign = DB::table('inflassign')
                            ->select('inflassign.*')
                            ->where('inflassign.id',$inflassignid)->get();

                $users = User::find($inflassign[0]->inflid);
                Notification::send($users, new MsgNotiHcompanyHost($users));

            }elseif (Auth::user()->role == 'host') {

                $users = User::find(Auth::user()->created_by);
                Notification::send($users, new MsgNotiHostHcompany($users));

            }

        }


        $this->storemsg($request->taskid,
                        $request->roomnum,
                        $title,
                        $body,
                        $type,
                        $attachment ?? '');

        return redirect()->back();
    }

    public function message($roomnum,$taskhashid)
    {


        //     DB::table('msg')->where('id','20')->update(array('updated_at'=>new \DateTime()));
        //     return response()->json(['success'=>true]);
        
        // if($request->ajax()){
        // }

        // die;


        $list = DB::table('task')
                    ->select('Client.name as clientname','Adminuser.name as subadminname', 'task.*')
                    ->where('task.positionname','<>','')
                    ->leftJoin('users as Adminuser', function ($join) {
                        $join->on('task.subadmin', '=', 'Adminuser.id')
                             ->where('Adminuser.role','admin');
                    })
                    ->leftJoin('users as Client', function ($join) {
                        $join->on('task.user', '=', 'Client.id')
                             ->where('Client.role','user');
                    })
                    ->where(DB::raw('BINARY `hashid`'),$taskhashid)->get();
                    // ->where(DB::raw('BINARY `hashid`'),$taskhashid)->get();
        // ->where(DB::raw('BINARY `hashid`'), "Hardik")
        $list = $list[0];

        // print_r($list);die;

        $totalmoneyout[$taskhashid] = DB::table('inflassign')
                                    ->where('inflassign.taskid',$taskhashid)
                                    ->where('inflassign.moneyout','>',0)
                                    ->sum('moneyout');

        $msgs = DB::table('msg')
                    ->where(DB::raw('BINARY `taskhashid`'),$taskhashid)->where('roomnum',$roomnum)->orderBy('msg.created_at', 'asc')->get();

        // print_r($list);die;
        if ($roomnum == 'A') {
            if (Auth::user()->role == 'admin') {
                $opponent = $list->clientname;
            } else {
                $opponent = $list->subadminname;
            }
        } elseif (str_contains($roomnum, 'B')) {
            if (Auth::user()->role == 'admin') {
                $inflassignid = str_replace('B','',$roomnum);
                
                $inflassign = DB::table('inflassign')
                            ->select(
                                'Hcompany.name as Hcompanyname',
                                // 'Adminuser.name as subadminname', 
                                'inflassign.*',
                                )
                            ->where('inflassign.id',$inflassignid)
                            ->join('users as Influencer', function ($join) {
                                $join->on('inflassign.inflid', '=', 'Influencer.id')
                                     ->where('Influencer.role','host');
                            })

                            ->join('users as Hcompany', function ($join) {
                                $join->on('Influencer.created_by', '=', 'Hcompany.id')
                                     ->where('Hcompany.role','hcompany');
                            })
                            ->orderBy('inflassign.created_at', 'desc')->get();

                            // print_r($inflassign);die;

                $opponent = $inflassign[0]->Hcompanyname;
            } else {
                $opponent = $list->subadminname;
            }
        } elseif (str_contains($roomnum, 'C')) {
                $inflassignid = str_replace('C','',$roomnum);
                
                $inflassign = DB::table('inflassign')
                            ->select(
                                'Hcompany.name as Hcompanyname',
                                'Influencer.name as Influencername', 
                                'inflassign.*',
                                )
                            ->where('inflassign.id',$inflassignid)
                            ->join('users as Influencer', function ($join) {
                                $join->on('inflassign.inflid', '=', 'Influencer.id')
                                     ->where('Influencer.role','host');
                            })

                            ->join('users as Hcompany', function ($join) {
                                $join->on('Influencer.created_by', '=', 'Hcompany.id')
                                     ->where('Hcompany.role','hcompany');
                            })
                            ->orderBy('inflassign.created_at', 'desc')->get();

                            // print_r($inflassign);die;

            if (Auth::user()->role == 'host') {
                $opponent = $inflassign[0]->Hcompanyname;
            } else {
                $opponent = $inflassign[0]->Influencername;
            }
        }

        $adminids = User::where('role','admin')->pluck('name', 'id');

        // print_r($adminids);

        // foreach ($adminids as $key => $value) {
        //     echo $key . ' >>>  '. $value.'<br>';
        // }

        // if (isset($adminids['110']))
        // {
        //     echo "Found the Key";
        // }
        // else
        // {
        //     echo "Key not Found";
        // }

        // die;
        

        return view('message',compact('list','msgs','roomnum','taskhashid','opponent','adminids','totalmoneyout'));
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function setlang(Request $request)
    {  

        // print_r($request->lang);
        // die;
        App::setLocale($request->lang);
        session()->put('locale', $request->lang);
  
        return redirect()->back();
        // print_r($lists[0]);die;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function payreturnget()
    { 

        die('Thank you for your payment. Your transaction has been completed, and a receipt for your purchase has been emailed to you. Log into your PayPal account to view transaction details.');

    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function payreturn($request)
    { 

        die('Thank you for your payment. Your transaction has been completed, and a receipt for your purchase has been emailed to you. Log into your PayPal account to view transaction details...........');

    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function welcome()
    {  

        if (Auth::check()){
            return redirect('/admin/agent');
        }
        return view('auth.loginadmin');

    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function adminlogin($role)
    { 

        if (!empty(Auth::user()->role)) {
            return redirect('/'.Auth::user()->role);
        }
        // die($role);
        $roles = array('admin','hcompany','host');

        
        if (in_array($role, $roles)) {
            return view('auth.login'.$role);
        }

        return abort(404);

    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function aboutus()
    {  

        $hcompany = User::where('role','hcompany')->where('email_verified_at','<>','')->where('profileimg','<>','')
                    ->orderBy('created_at', 'desc')->paginate(6);   


        $hosts = DB::table('users')
                    ->select('U.name as hcompanyname', 'U.profileimg as hcompanylogo', 'U.bunrui as hcompanybunrui', 'users.*')
                    ->where('users.role','host')
                    ->join('users as U', function ($join) {
                        $join->on('users.created_by', '=', 'U.id')
                             ->where('U.role','hcompany');
                    })
                    // ->join('users as u', 'users.created_by', '=', 'u.id')
                    ->orderBy('users.created_at', 'asc')->paginate(8);
   
        $bunruiarr = array( "bunrui1"=>'教育支援',
                            "bunrui2"=>'文化・芸術',
                            "bunrui3"=>'サービス',
                            "bunrui4"=>'製造'
                           );


        foreach ($hosts as $key => $value) {
            
            // echo $value->id."<br>";
            $hostsem = Seminar::orderBy('start')->where('host_id',$value->id)->where('start', '>',date("Y-m-d"))->paginate(2);
         //    print_r($hostsem->all());
            $hosts[$key]->nextsem = $hostsem;
            $hosts[$key]->hcompanybunrui = $bunruiarr[$hosts[$key]->hcompanybunrui];

            // echo "<br>";
            // echo "<br>";
        }

        $setting = DB::table('matters')
                    ->where('title','aboutuspagevideo')
                    ->orwhere('for','aboutusinfottl')
                    ->get();

        $setting = $setting->pluck('value', 'title');
        // print_r($lists[0]);die;

        return view('aboutus',compact('hcompany','hosts','setting'));
        // return view('welcome');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function sponsor()
    {  

        $bunrui1 = User::where('role','hcompany')->where('email_verified_at','<>','')->where('profileimg','<>','')->where('bunrui','bunrui1')
                    ->orderBy('created_at', 'desc')->paginate(4);

        $bunrui2 = User::where('role','hcompany')->where('email_verified_at','<>','')->where('profileimg','<>','')->where('bunrui','bunrui2')
                    ->orderBy('created_at', 'desc')->paginate(4);

        $bunrui3 = User::where('role','hcompany')->where('email_verified_at','<>','')->where('profileimg','<>','')->where('bunrui','bunrui3')
                    ->orderBy('created_at', 'desc')->paginate(4);

        $bunrui4 = User::where('role','hcompany')->where('email_verified_at','<>','')->where('profileimg','<>','')->where('bunrui','bunrui4')
                    ->orderBy('created_at', 'desc')->paginate(4);

        // print_r($bunrui1);die;

        return view('sponsor',compact('bunrui1','bunrui2','bunrui3','bunrui4'));
        // return view('welcome');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function scheduletab()
    {  

        $lists = DB::table('semtype')
                    ->where('name','<>','')
                    ->get();
        $listsarr = $lists->toArray();
        $namebycode = array_column($listsarr, 'name', 'code');

        $seminar = array();
        $ttlpagearr = array();
        $selectpage = array();

        $limit = 6;
        for ($i = 0; $i < 3; ++$i) {
            // echo date("Y-m-01",strtotime("+".$i." month")).'   '.date("Y-m-t",strtotime("+".$i." month"));


            $start = date("Y-m-01",strtotime("+".$i." month"));
            $end = date("Y-m-t 23:59:59",strtotime("+".$i." month"));


            // echo date("Y-m-01",strtotime("+".$i." month")).'   '.date("Y-m-t",strtotime("+".$i." month"));
            // echo $start.' >>>  '.$end;
            // echo "<br>";

            $key = date("m",strtotime("+".$i." month"));

            if ( (date("md") == '0831') AND $i == 1){
                $key = '09';
                $y = date("Y");
                $start = $y.'-09-01'; 
                $end = $y.'-09-30 23:59:59';
            }

            if (!empty($_GET['tab']) AND ($_GET['tab'] == $key) ) {
              $pageNumber = $_GET['page'];
            } else {
              $pageNumber = 1;
            }

            $selectpage[$key] = $pageNumber;

            $list = DB::table('seminars')
                    ->select('U.name as hostname', 'U.profileimg as profileimg', 'seminars.*')
                    ->where('seminars.name','<>','')
                    // ->where('seminars.open','1')
                    ->where(function($query) use ($start , $end ){
                        if (!empty($start)) {
                             $query->where('seminars.start', '>',$start);
                        }
                        if (!empty($end)) {
                             $query->where('seminars.end', '<',$end);
                        }
                     })
                    ->join('users as U', function ($join) {
                        $join->on('seminars.host_id', '=', 'U.id')
                             // ->where('U.role','admin')
                             ;
                    })
                    ->orderBy('seminars.start', 'asc')->paginate($limit , ['*'], 'page', $pageNumber);

            // echo '<br>';
            // print_r($i);
            $ttl = $list->total();
            // $ttlpagearr = (ceil($ttl / $limit));
            // print_r($ttlpagearr);
            // echo '<br>';



            $seminar[$key] = $list;
            // $seminar[$key]['ttlpagearr'] = $list;
            $ttlpagearr[$key] = (ceil($ttl / $limit));


            // echo $ttlpagearr[$key];
            // // print_r($list);
            // echo "<br>";
        
        }

        // print_r($ttlpagearr);die;

        // die;

        return view('scheduletab',compact('seminar','ttlpagearr','selectpage','namebycode'));
        // return view('welcome');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function hostlisting()
    {  
        $limit = 8;
        
        $hosts = DB::table('users')
                    ->select('U.name as hcompanyname', 'U.profileimg as hcompanylogo', 'U.bunrui as hcompanybunrui', 'users.*')
                    ->where('users.role','host')
                    ->join('users as U', function ($join) {
                        $join->on('users.created_by', '=', 'U.id')
                             ->where('U.role','hcompany');
                    })
                    // ->join('users as u', 'users.created_by', '=', 'u.id')
                    ->orderBy('users.created_at', 'asc')->paginate($limit);

        $ttl = $hosts->total();
        $ttlpage = (ceil($ttl / $limit));

        $bunruiarr = array( "bunrui1"=>'教育支援',
                            "bunrui2"=>'文化・芸術',
                            "bunrui3"=>'サービス',
                            "bunrui4"=>'製造'
                           );


        foreach ($hosts as $key => $value) {
            
            // echo $value->id."<br>";
            $hostsem = Seminar::orderBy('start')->where('host_id',$value->id)->where('start', '>',date("Y-m-d"))->paginate(2);
         //    print_r($hostsem->all());
            $hosts[$key]->nextsem = $hostsem;
            // $hosts[$key]->hcompanybunrui = $bunruiarr[$hosts[$key]->hcompanybunrui];

            // echo "<br>";
            // echo "<br>";
        }

        return view('hostlisting',compact('hosts','ttlpage','ttl'));
        // return view('welcome');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function indexuser()
    {
        $limit = 10;
        if (!empty($_GET['kword'])) {
            $kword = $_GET['kword'];
        } else {
            $kword = '';
        } 


        if (!empty($_GET['start'])) {
            $start = $_GET['start'];
            $start = date("Y-m-d 00:00:00",strtotime($start));
        } else {
            $start = '';
        } 

        if (!empty($_GET['end'])) {
            $end = $_GET['end'];
            $end = date("Y-m-d 23:59:59",strtotime($end));
        } else {
            $end = '';
        } 

        $startdate = new DateTime($start);
        $enddate = new DateTime($end);

        if($enddate < $startdate) {
            return back()->with('errorsearch',__('user.datesearcherror'));
        }

        // print_r('azaza');die;   

        $users = User::where('role','user')->where('email_verified_at','<>','')
                    ->where(function($query) use ($kword , $start , $end){
                        if (!empty($kword)) {
                            $query->where('email','LIKE','%'.$kword.'%')->orwhere('compname','LIKE','%'.$kword.'%');
                        }
                        if (!empty($start)) {
                             $query->where('created_at', '>',$start);
                        }
                        if (!empty($end)) {
                             $query->where('created_at', '<',$end);
                        }
                     })
                    ->orderBy('created_at', 'desc')->paginate($limit);


        $ttl = $users->total();
        $ttlpage = (ceil($ttl / $limit));

        return view('admin.indexuser',compact('users','ttlpage','ttl'));
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function indexhcompany()
    {
        $limit = 10;
        if (!empty($_GET['kword'])) {
            $kword = $_GET['kword'];
        } else {
            $kword = '';
        }    


        if (!empty($_GET['start'])) {
            $start = $_GET['start'];
            $start = date("Y-m-d 00:00:00",strtotime($start));
        } else {
            $start = '';
        } 

        if (!empty($_GET['end'])) {
            $end = $_GET['end'];
            $end = date("Y-m-d 23:59:59",strtotime($end));
        } else {
            $end = '';
        } 

        $startdate = new DateTime($start);
        $enddate = new DateTime($end);

        if($enddate < $startdate) {
            return back()->with('errorsearch',__('user.datesearcherror'));
        }

        $hcompanies = DB::table('hcompany')
                    ->where(function($query) use ($kword , $start , $end){
                        if (!empty($kword)) {
                            $query->where('email','LIKE','%'.$kword.'%')->orwhere('name','LIKE','%'.$kword.'%');
                        }
                        if (!empty($start)) {
                             $query->where('created_at', '>=',$start);
                        }
                        if (!empty($end)) {
                             $query->where('created_at', '<',$end);
                        }
                     })
                    ->orderBy('created_at', 'desc')->paginate($limit);


        $ttl = $hcompanies->total();
        $ttlpage = (ceil($ttl / $limit));

        return view('admin.indexhcompany',compact('hcompanies','ttlpage','ttl'));
    }



    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function indexsubadmin()
    {

        if (Auth::user()->id != '1') {
            abort(403, 'Unauthorized action.');
        }

        $limit = 10;
        if (!empty($_GET['kword'])) {
            $kword = $_GET['kword'];
        } else {
            $kword = '';
        }    

        $subadmins = User::where('role','admin')
                    ->where('id', '!=' , 1)
                    ->where(function($query) use ($kword){
                         $query->where('name','LIKE','%'.$kword.'%')->orwhere('email','LIKE','%'.$kword.'%');
                     })
                    ->orderBy('created_at', 'desc')->paginate($limit);

        $ttl = $subadmins->total();
        $ttlpage = (ceil($ttl / $limit));

        return view('admin.indexsubadmin',compact('subadmins','ttlpage','ttl'));
    }

    public function validatehcompany($request, $editpassword = true , $editmode = false, $emailuniquecheck = true) 
    {

        $check = [
            'name' => 'required|string|max:255',
            'postalcode' => 'required|string|max:255',
            'address' => 'required|string|max:255',
            'addressextra' => 'required|string|max:255',
            'phone' => 'required|string|max:255',
            'email' => 'required|string|email|max:255',
            'picname' => 'required|string|max:255',
            'picnamefurigana' => 'required|string|max:255',
            'capital' => 'required|string|max:255',
            'establishdate' => 'required|string|max:255',
            'listed' => 'not_in:0',
            'closemonth' => 'required|string|max:255',
            'compindustry' => 'not_in:0',
            'companycontent' => 'required|string|max:255',
            // 'url' => 'required|string|max:255',
            // 'sns' => 'required|string|max:255',
            // 'remarks' => 'required|string|max:255',

            // 'password' => 'required|string|confirmed|min:6',
            // 'check' => 'required',
            // 'phone' => ['required', 'regex:/^(0([1-9]{1}-?[1-9]\d{3}|[1-9]{2}-?\d{3}|[1-9]{2}\d{1}-?\d{2}|[1-9]{2}\d{2}-?\d{1})-?\d{4}|0[789]0-?\d{4}-?\d{4}|050-?\d{4}-?\d{4})$/'],
            // 'bunrui' => 'not_in:0',
        ];


        if (!$editpassword) {
            unset($check['password']);
        }

        if ($editmode) {
            unset($check['check']);
        }

        if ($emailuniquecheck) {
            $check['email'] .= '|unique:users' ;
        }

        if (!empty($request->image)) {
            $check['image'] = 'mimes:jpeg,png,jpg,gif,svg|max:2048';
        }

        // print_r("$request->check");die;
        $validator = Validator::make($request->all(), $check,
        [
            'check.required' => __('validation.pleasecheck'),
            // 'phone.regex' => '有効な電話番号を入力してください',
            'name.required' => __('validation.hcompanynamepleaseinput'),
            'furiname.required' => __('validation.hcompanyfurinamepleaseinput'),
        ]);

        return $validator;

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function storehcompany(Request $request)
    {

        $validator = $this->validatehcompany($request);

        if($request->ajax()){
        
            if ($validator->passes()) {
                return response()->json(['success'=>'allpasses']);
            }         
            return response()->json(['error'=>$validator->errors()]);
        
        }

        if (empty($request->role)) {
            $role = 'user';
        } else {
            $role = $request->role;
        }

        if (!empty($request->image)) {
            $imageName = time().'.'.$request->image->extension();           
            $request->image->move(public_path('images/avatar'), $imageName);
        } else {
            $imageName = '';
        }


        $data=array('name'=>$request->name,
                    "postalcode"=>$request->postalcode,
                    "address"=>$request->address,
                    "addressextra"=>$request->addressextra,
                    "phone"=>$request->phone,
                    "email"=>$request->email,
                    "picname"=>$request->picname,
                    "picnamefurigana"=>$request->picnamefurigana,
                    "capital"=>$request->capital,
                    "establishdate"=>$request->establishdate,
                    "listed"=>$request->listed,
                    "closemonth"=>$request->closemonth,
                    "compindustry"=>$request->compindustry,
                    "companycontent"=>$request->companycontent,
                    "url"=>$request->url,
                    "sns"=>$request->sns,
                    "remarks"=>$request->remarks,
                    // "created_at"=> new \DateTime(),
                    // 'created_by' => Auth::user()->id,
                );

        if (empty($request->id)) {

            // die('A');
            $data['created_at'] = new \DateTime();
            $data['created_by'] = Auth::user()->id;

            DB::table('hcompany')->insert($data);

            $msg = '「'.$request->name.'」登録されました。';
        } else {
            // die('B');
            # code...
            $data['updated_at'] = new \DateTime();

            $type = DB::table('hcompany')->where('id',$request->id)->update($data);
            $msg = '更新されました。';
        }

        return redirect('/admin/agent')->with('success',$msg);
    }

   /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function indexhosts()
    {
        $limit = 10;
        if (!empty($_GET['kword'])) {
            $kword = $_GET['kword'];
        } else {
            $kword = '';
        }    

        if (!empty($_GET['start'])) {
            $start = $_GET['start'];
            $start = date("Y-m-d 00:00:00",strtotime($start));
        } else {
            $start = '';
        } 

        if (!empty($_GET['end'])) {
            $end = $_GET['end'];
            $end = date("Y-m-d 23:59:59",strtotime($end));
        } else {
            $end = '';
        } 

        if (!empty($_GET['field'])) {
            $field = $_GET['field'];
        } else {
            $field = '';
        }  

        $startdate = new DateTime($start);
        $enddate = new DateTime($end);

        if($enddate < $startdate) {
            return back()->with('errorsearch',__('user.datesearcherror'));
        }


        $lists = DB::table('users')
                    ->select('U.name as hcompanyname', 'users.*')
                    ->whereIn('users.role',['host','idlehost'])
                    ->where(function($query) use ($kword){
                        if (!empty($kword)) {
                            $query->where('users.email','LIKE','%'.$kword.'%')->orwhere('users.name','LIKE','%'.$kword.'%');
                        }
                     })
                    ->where(function($query) use ($start , $end , $field){
                        if (!empty($field)) {
                            // print_r($field);die;
                            $query->where('users.field',$field);
                        }
                        if (!empty($start)) {
                             $query->where('users.created_at', '>',$start);
                        }
                        if (!empty($end)) {
                             $query->where('users.created_at', '<',$end);
                        }
                     })

                    ->join('users as U', function ($join) {
                        $join->on('users.created_by', '=', 'U.id')
                             ->where('U.role','hcompany');
                    })
                    // ->join('users as u', 'users.created_by', '=', 'u.id')
                    ->orderBy('users.created_at', 'desc')->paginate($limit);

        $ttl = $lists->total();
        $ttlpage = (ceil($ttl / $limit));

        // print_r($lists);die;

        return view('admin.indexhost',compact('lists','ttlpage','ttl'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function indexseminars()
    {

        //
        $limit = 10;
        if (!empty($_GET['kword'])) {
            $kword = $_GET['kword'];
        } else {
            $kword = '';
        }    

        if (!empty($_GET['start'])) {
            $start = $_GET['start'];
            $start = date("Y-m-d 00:00:00",strtotime($start));
        } else {
            $start = '';
        } 

        if (!empty($_GET['end'])) {
            $end = $_GET['end'];
            $end = date("Y-m-d 23:59:59",strtotime($end));
        } else {
            $end = '';
        } 

        if (!empty($_GET['positioncategory'])) {
            $positioncategory = $_GET['positioncategory'];
        } else {
            $positioncategory = '';
        }

        if (!empty($_GET['status'])) {
            $statusarr = explode(",",$_GET['status']);
            // print_r($statusarr);die;
        } else {
            $statusarr = '';
        }

        $startdate = new DateTime($start);
        $enddate = new DateTime($end);

        if($enddate < $startdate) {
            return back()->with('errorsearch',__('user.datesearcherror'));
        }

        $lists = DB::table('task')
                    ->select('Client.compname as clientname',
                             'Client.id as clientid', 
                             'Adminuser.name as subadminname', 
                             'task.*')
                    ->where('task.positionname','<>','')

                    ->where(function($query) use ($kword){
                        if (!empty($kword)) {
                             $query->where('task.positionname','LIKE','%'.$kword.'%')->orwhere('Client.compname','LIKE','%'.$kword.'%');
                        }
                     })

                    ->where(function($query) use ($start , $end , $positioncategory , $statusarr){
                        if (!empty($positioncategory)) {
                            $query->where('task.positioncategory',$positioncategory);
                        }                        
                        if (!empty($start)) {
                             $query->where('task.created_at', '>',$start);
                        }
                        if (!empty($end)) {
                             $query->where('task.created_at', '<',$end);
                        }
                        if (!empty($statusarr)) {
                             $query->whereIn('task.status', $statusarr);
                        }
                     })

                    ->leftJoin('users as Adminuser', function ($join) {
                        $join->on('task.subadmin', '=', 'Adminuser.id')
                             ->where('Adminuser.role','admin');
                    })
                    ->leftJoin('users as Client', function ($join) {
                        $join->on('task.user', '=', 'Client.id')
                             ->where('Client.role','user');
                    })
                    ->orderBy('task.created_at', 'desc')->paginate($limit);

        $ttl = $lists->total();
        $ttlpage = (ceil($ttl / $limit));

        // print_r($lists);

        $inflassign = array();
        $totalmoneyout = array();
        $inflids = array();
        $clientids = array();

        if (!empty($_GET['inflstatus'])) {
            $inflstatus = $_GET['inflstatus'];
        } else {
            $inflstatus = '';
        } 

        foreach ($lists as $key => $value) {
            $clientids[] = $value->clientid;
            // echo "<br>";
           $inflassign[$value->hashid] = DB::table('inflassign')
                                        ->select(
                                            'Influencer.name as Influencername',
                                            'Influencer.id as Influencerid',
                                            'Hcompany.name as Hcompanyname',
                                            // 'Adminuser.name as subadminname', 
                                            'inflassign.*',
                                            )
                                        ->where('inflassign.taskid',$value->hashid)
                                        ->where(function($query) use ($inflstatus){
                                            if (!empty($inflstatus)) {
                                                 $query->where('inflassign.inflstatus', $inflstatus);
                                            }
                                         })
                                        ->join('users as Influencer', function ($join) {
                                            $join->on('inflassign.inflid', '=', 'Influencer.id')
                                                 ->where('Influencer.role','host');
                                        })

                                        ->join('users as Hcompany', function ($join) {
                                            $join->on('Influencer.created_by', '=', 'Hcompany.id')
                                                 ->where('Hcompany.role','hcompany');
                                        })

                                        ->orderBy('inflassign.created_at', 'desc')->get();

            // $totalmoneyout = array_sum(array_column(array ($inflassign[$value->hashid]),'moneyout'));
            $sum = 0;
            foreach ($inflassign[$value->hashid] as $item) {
                $sum += $item->moneyout;
                $inflids[] = $item->Influencerid;
            }
            $totalmoneyout[$value->hashid] = $sum;

        }
        $influencers = User::where('role','host')->whereIn('id',array_unique($inflids))->get();

        $clients = User::where('role','user')->whereIn('id',array_unique($clientids))->get();
        // print_r($clientids);
        // die;


        return view('admin.indexseminars',compact('lists','ttlpage','ttl','inflassign','totalmoneyout','influencers','clients'));
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function indexpuchases()
    {
        $limit = 10;
        if (!empty($_GET['kword'])) {
            $kword = $_GET['kword'];
        } else {
            $kword = '';
        }    

        // $users = User::where('role','user')
        //             ->where(function($query) use ($kword){
        //                  $query->where('name','LIKE','%'.$kword.'%')->orwhere('email','LIKE','%'.$kword.'%');
        //              })
        //             ->orderBy('created_at', 'desc')->paginate($limit);

        // $ttl = $users->total();
        // $ttlpage = (ceil($ttl / $limit));

        return view('admin.indexpurchase');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function editdata(Request $request, $role, $id)
    {
        // Default to the authenticated user's role if $role is empty
        if (empty($role)) {
            $role = Auth::user()->role;
        }
    
        // Default to the authenticated user
        $edituser = Auth::user(); 
        $editother = false;
    
        // Check if the ID length is greater than 5
        if (strlen($id) > 5) {
            $id = substr($id, 5);
            $edituser = DB::table('hcompany')
                        ->where('id', $id)
                        ->first(); // Use first() instead of get() for a single record
    
            // If a record is found, convert it to an array
            if ($edituser) {
                $edituser = (array) $edituser;
                $editother = true;
            } else {
                // Handle case when no record is found if necessary
                $edituser = [];
            }
        }
    
        // Process Zoom API keys if the role is 'host', 'hcompany', or 'agent'
        if (in_array($role, ['host', 'hcompany', 'agent'])) {
            if (isset($edituser['zoomapi'])) {
                $keyarr = json_decode($edituser['zoomapi']);
    
                if (!empty($keyarr->keyone)) {
                    $edituser['keyone'] = $keyarr->keyone;
                }
    
                if (!empty($keyarr->keytwo)) {
                    $edituser['keytwo'] = $keyarr->keytwo;
                }
            }
        }
    
        // Determine which view to return based on the role
        $editmode = true;
    
        switch ($role) {
            case 'admin':
                return view('admin.editprofile', compact('editmode', 'editother', 'edituser'));
            case 'hcompany':
            case 'agent':
                return view('admin.registerhcompany', compact('editmode', 'editother', 'edituser'));
            case 'host':
                return view('hcompany.registerhost', compact('editmode', 'editother', 'edituser'));
            default:
                return view('user.editprofile', compact('editmode', 'editother', 'edituser'));
        }
    }
    
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Admin  $admin
     * @return \Illuminate\Http\Response
     */
    public function updateuser(Request $request)
    {
        if (!empty($request->id)) {
           $userprofile = User::find($request->id);
        } else {
           $userprofile = Auth::user(); 
        }

        if ($userprofile->role == 'hcompany') {

            $checkpassword = true;
            if ( empty($request->password) AND empty($request->password_confirmation)) {
                $checkpassword = false;
            }

            if ($userprofile->email == $request->email) {
                $emailuniquecheck = false;
            }else {
                $emailuniquecheck = true;
            }
// return response()->json(['success'=>$checkpassword]);
            $validator = $this->validatehcompany($request,$checkpassword,true,$emailuniquecheck);

        }

        if ($userprofile->role == 'admin') {

            $checkpassword = true;
            if ( empty($request->password) AND empty($request->password_confirmation)) {
                $checkpassword = false;
            }

            if ($userprofile->email == $request->email) {
                $emailuniquecheck = false;
            }else {
                $emailuniquecheck = true;
            }
            $validator = $this->validatesubadmin($request,$checkpassword,true,$emailuniquecheck);

        }


        if ($userprofile->role == 'user') {

            // print_r($request->all());die;
            $checkpassword = true;
            if ( empty($request->password) AND empty($request->password_confirmation)) {
                $checkpassword = false;
            }

            if ($userprofile->email == $request->email) {
                $emailuniquecheck = false;
            }else {
                $emailuniquecheck = true;
            }
// return response()->json(['success'=>$checkpassword]);
            $validator = (new RegisteredUserController)->validateuser($request,$checkpassword,true,$emailuniquecheck);

        }


        if ((in_array($userprofile->role, ["idlehost","host"]))) {

            $checkpassword = true;
            if ( empty($request->password) AND empty($request->password_confirmation)) {
                $checkpassword = false;
            }

            if ($userprofile->email == $request->email) {
                $emailuniquecheck = false;
            }else {
                $emailuniquecheck = true;
            }

            if (empty($userprofile->profileimg)) {
                $needimg = true;
            }else {
                $needimg = false;
            }

// return response()->json(['success'=>$checkpassword]);
            $validator = (new HcompanyController)->validatehost($request,$checkpassword,true,$emailuniquecheck,$needimg);

        }

        if($request->ajax()){

            if ($validator->passes()) {
                return response()->json(['success'=>'allpasses']);
            }         
            return response()->json(['error'=>$validator->errors()]);
        
        }

        // print_r($userprofile);die;


        $newval = array('name' => $request->name,
                    'email' => $request->email,
                    );

        // HOST

        if (!empty($request->country)) {
            $newval['country'] = $request->country;
        }

        if (!empty($request->field)) {
            $newval['field'] = $request->field;
        }

        if (!empty($request->resume)) {
            $resumeName = time().'_resume'.$request->resume->getClientOriginalName();           
            $request->resume->move(public_path('documents'), $resumeName);
            $newval['resume'] = $resumeName;
        } else {
            $resumeName = '';
        }

        if (!empty($request->docone)) {
            $doconeName = time().'_docone'.$request->docone->getClientOriginalName();           
            $request->docone->move(public_path('documents'), $doconeName);
            $newval['docone'] = $doconeName;
        } else {
            $doconeName = '';
        }

        if (!empty($request->doctwo)) {
            $doctwoName = time().'_doctwo'.$request->doctwo->getClientOriginalName();           
            $request->doctwo->move(public_path('documents'), $doctwoName);
            $newval['doctwo'] = $doctwoName;
        } else {
            $doctwoName = '';
        }

        if (!empty($request->companyinfo)) {
            $newval['companyinfo'] = $request->companyinfo;
        }

        // END HOST

        // print_r($newval);
        // die;

        // COMPANY

        if (!empty($request->compname)) {
            $newval['compname'] = $request->compname;
        }

        if (!empty($request->furiname)) {
            $newval['furiname'] = $request->furiname;
        }

        if (!empty($request->address)) {
            $newval['address'] = $request->address;
        }

        if (!empty($request->phone)) {
            $newval['phone'] = $request->phone;
        }

        if (!empty($request->entity)) {
            $newval['entity'] = $request->entity;
        }

        if (!empty($request->purpose)) {
            $newval['purpose'] = $request->purpose;
        }

        if (!empty($request->compindustry)) {
            $newval['compindustry'] = $request->compindustry;
        }

        if (!empty($request->position)) {
            $newval['position'] = $request->position;
        }

        if (!empty($request->url)) {
            $newval['url'] = $request->url;
        }
        //END COMPANY

        //user

        if (!empty($request->entity)) {
            $newval['entity'] = $request->entity;
        }

        if (!empty($request->purpose)) {
            $newval['purpose'] = $request->purpose;
        }

        if (!empty($request->compindustry)) {
            $newval['compindustry'] = $request->compindustry;
        }

        if (!empty($request->position)) {
            $newval['position'] = $request->position;
        }

        if (!empty($request->url)) {
            $newval['url'] = $request->url;
        }

        if (!empty($request->dob)) {
            $newval['dob'] = $request->dob.'-01';
        }

        if (!empty($request->membernumber)) {
            $newval['membernumber'] = $request->membernumber;
        }

        // print_r($newval);
        // die;
        // end user

        // ADMIN

        if (!empty($request->gender)) {
            $newval['gender'] = $request->gender;
        }

        if (!empty($request->agerange)) {
            $newval['agerange'] = $request->agerange;
        }

        // END ADMIN


        if (!empty($request->password)) {
            $newval['password'] = Hash::make($request->password);
        }

        if (!empty($request->image)) {
            $time = new DateTime();
            $imageName = time().'.'.$request->image->extension();           
            $request->image->move(public_path('images/avatar'), $imageName);
            $newval['profileimg'] = $imageName;
        } 


        // print_r($upd);die;
        $upd = $userprofile->update($newval);

        // print_r($userprofile->role);die;
        $msg = __('auth.donechange');

        if (Auth::user()->role == 'admin') {
            if ($userprofile->role == 'user' ) {
                return redirect('/admin')->with('success',$msg);
            } else if ($userprofile->role == 'host' ) {
                return redirect('/admin/hosts')->with('success',$msg);
            } else if ($userprofile->role == 'hcompany' ) {
                return redirect('/admin/agent')->with('success',$msg);
            } else {
                if (Auth::user()->id == '1') {
                    return redirect('/admin/subadmin')->with('success',$msg);
                } else {
                    return back()->with('success',$msg);
                }
            }
        } else if (Auth::user()->role == 'host') {
            return redirect('/host/seminars')->with('success',$msg);
        } else if (Auth::user()->role == 'hcompany') {
            return redirect('/agent')->with('success',$msg);
        } else {
            return redirect('/application')->with('success',$msg);
        }

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Admin  $admin
     * @return \Illuminate\Http\Response
     */
    public function deleteuser(Request $request)
    {

        $userprofile = User::find($request->id);
        $userprofile->delete();
        // print_r(Auth::user()->role);die;
        if (Auth::user()->role == 'admin') {

            if ($userprofile->role == 'user' ) {
                return redirect('/admin')->with('success','削除されました。');
            } else if ($userprofile->role == 'host' ) {
                return redirect('/admin/hosts')->with('success','削除されました。');
            } else {
                return redirect('/admin/agent')->with('success','削除されました。');
            }
        } else if (Auth::user()->role == 'host') {
            return redirect('/host')->with('success','削除されました。');
        } else {
            return redirect('/agent')->with('success','削除されました。');
        }
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function indextypes()
    {
        $limit = 10;
        if (!empty($_GET['kword'])) {
            $kword = $_GET['kword'];
        } else {
            $kword = '';
        }    

        $lists = DB::table('semtype')
                    ->where('name','<>','')
                    ->get();
        $listsarr = $lists->toArray();
        $namebycode = array_column($listsarr, 'name', 'code');
        // print_r($namebycode);die;

        $lists = DB::table('semtype')
                    ->where('size','<>','b')
                    ->where(function($query) use ($kword){
                         $query->where('name','LIKE','%'.$kword.'%');
                     })
                    ->orderBy('created_at', 'desc')->paginate($limit);


        $ttl = $lists->total();
        $ttlpage = (ceil($ttl / $limit));

        // $hcompanies = array();
        return view('admin.indextypes',compact('lists','namebycode','ttlpage','ttl'));
    }



    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function edittype(Request $request, $id)
    {

        $lists = DB::table('semtype')
                    ->where('name','<>','')
                    ->get();
        $listsarr = $lists->toArray();
        $namebycode = array_column($listsarr, 'name', 'code');
        // print_r($namebycode);die;

        $editdata = DB::table('semtype')
                    ->find($id);

        // print_r($editdata);

        $editmode = true;
        // die;
        // $hcompanies = array();
        return view('admin.registertypes',compact('editdata','namebycode','editmode'));
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function storetypes(Request $request)
    {

        // if($request->ajax()){
        
        //         return response()->json(['success'=>'allpasses']);
        // }
        // print_r($request->all());

        // die;


        $valarr = array('name' => 'required|unique:semtype|max:255',
                        'types' => 'not_in:0',    
                        'b_type' => 'not_in:0',    
                        // 'm_type' => 'not_in:0',    
                    );

        if ($request->types == 's') {
            $valarr['m_type'] = 'not_in:0';
        }

        // print_r("$request->check");die;
        $validator = Validator::make($request->all(), $valarr,
        [
            'phone.required' => '電話番号を入力してください',
            'phone.regex' => '有効な電話番号を入力してください',
        ]);

        if($request->ajax()){
        
            if ($validator->passes()) {
                return response()->json(['success'=>'allpasses']);
            }         
            return response()->json(['error'=>$validator->errors()]);
        
        }

        if (empty($request->id)) {

        

            $last = DB::table('semtype')->latest('id')->first();

            if (empty($last->id)) {
                    $next_id = 1;
            } else {
                    $next_id = $last->id+1;
            }
            // print_r($next_id);die;
            if ($request->types == 'm') {
                $code = $request->b_type.".m".$next_id;
            } else {
                $code = $request->m_type.".s".$next_id;
            }


            $data=array('size'=>$request->types,
                        "name"=>$request->name,
                        "code"=>$code,
                        "created_at"=> new \DateTime(),
                    );
            DB::table('semtype')->insert($data);

            $msg = '「'.$request->name.'」登録されました。';
        } else {
            # code...
            $type = DB::table('semtype')->where('id',$request->id)->update(array('name'=>$request->name,));
            $msg = '更新されました。';
        }
        // die;

        // }

        return redirect('/admin/types')->with('success',$msg);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function gettypechild(Request $request)
    {

        if($request->ajax()){

                $parentcode = $request->parentcode;
                if(strpos($parentcode, '.m') !== false){
                    $childcode = 's';
                } else {
                    $childcode = 'm';
                }
        
                $semtype = DB::table('semtype')
                            ->where('code','LIKE','%'.$parentcode.'%')
                            ->where('size',$childcode)
                            ->get();
                return response()->json(['success'=>$semtype]);
        }

        return response()->json(['error'=>'allpasses']);


    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getnoti(Request $request)
    {

        if($request->ajax()){


                return response()->json(['success'=>Auth::user()->noti]);
        }

        return response()->json(['error'=>'failed']);


    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function markread(Request $request)
    {

        if($request->ajax()){

           $notiarr = json_decode(Auth::user()->noti , true);
            foreach ($notiarr as $key => $value) {
                $valarr = json_decode($value,true);
                // echo $key." >>".$valarr['title']."<br>";

                if ($request->readnoti['title'] == $valarr['title']) {
                    $valarr['doneread'] = 1 ;
                    $notiarr[$key] = json_encode($valarr);
                }
            }

            $newnotistrdb = json_encode($notiarr);

            Auth::user()->update(array('noti'=>$newnotistrdb,));
            // return response()->json($newnotistrdb); 
            return response()->json(['success'=>$newnotistrdb]);

        }

        return response()->json(['error'=>'failed']);


    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function takeremote(Request $request, $id)
    {
        $adminid = Auth::user()->id;
        $adminrole = Auth::user()->role;

        if (strlen($id) > 5) {

            // print_r(substr($id, 5));die;
            $id = substr($id, 5);
            $edituser = User::find($id);
            $editother = true;

        }

        // $user = User::find($id);
        // die(url()->previous());
        Auth::loginUsingId($id);
        session(['isadmincontrol' => $adminid , 'rolecontrol' => $adminrole , 'returnurl' => url()->previous()]);
        print_r(session()->all());
        // print_r(Auth::user()->role);die;
        // print_r(Auth::user()->role);die();
        if (Auth::user()->role == 'admin') {
            return redirect()->intended(RouteServiceProvider::ADMIN);
        } else if (Auth::user()->role == 'hcompany') {
            return redirect()->intended(RouteServiceProvider::HCOMPANY);
        } else if (Auth::user()->role == 'host') {
            return redirect()->intended(RouteServiceProvider::HOST);
        } else {
            return redirect()->intended(RouteServiceProvider::HOME);
        }

        // die($id);

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function returnadmin(Request $request)
    {
        // print_r($request->all());

        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        Auth::loginUsingId($request->adminid);

        if (!empty($request->returnurl)) {
            return redirect($request->returnurl);
        } else {
            // return redirect('/');
            return redirect()->intended(RouteServiceProvider::ADMIN);
        }

    }

   /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function indexpayment()
    {
        //
        $limit = 10;
        if (!empty($_GET['kword'])) {
            $kword = $_GET['kword'];
        } else {
            $kword = '';
        }    

        if (!empty($_GET['start'])) {
            $start = $_GET['start'];
            $start = date("Y-m-d 00:00:00",strtotime($start));
        } else {
            $start = '';
        } 

        if (!empty($_GET['end'])) {
            $end = $_GET['end'];
            $end = date("Y-m-d 23:59:59",strtotime($end));
        } else {
            $end = '';
        } 

        $startdate = new DateTime($start);
        $enddate = new DateTime($end);

        if($enddate < $startdate) {
            return back()->with('errorsearch',__('user.datesearcherror'));
        }

        $lists = DB::table('task')
                    ->select('Client.name as clientname','Adminuser.name as subadminname', 'task.*')
                    ->where('task.positionname','<>','')
                    ->where('task.status','10')

                    ->where(function($query) use ($kword , $start , $end){
                        if (!empty($kword)) {
                             $query->where('task.name','LIKE','%'.$kword.'%')->orwhere('Client.name','LIKE','%'.$kword.'%')->orwhere('Adminuser.name','LIKE','%'.$kword.'%');
                        }
                        if (!empty($start)) {
                             $query->where('task.created_at', '>',$start);
                        }
                        if (!empty($end)) {
                             $query->where('task.created_at', '<',$end);
                        }
                     })
                    ->leftJoin('users as Adminuser', function ($join) {
                        $join->on('task.subadmin', '=', 'Adminuser.id')
                             ->where('Adminuser.role','subadmin');
                    })
                    ->leftJoin('users as Client', function ($join) {
                        $join->on('task.user', '=', 'Client.id')
                             ->where('Client.role','user');
                    })
                    ->orderBy('task.created_at', 'desc')->paginate($limit);

        $ttl = $lists->total();
        $ttlpage = (ceil($ttl / $limit));

        // print_r($lists);

        $inflassign = array();
        foreach ($lists as $key => $value) {
            // echo $value->hashid;
            // echo "<br>";
           $inflassign[$value->hashid] = DB::table('inflassign')
                                        ->select(
                                            'Influencer.name as Influencername',
                                            'Hcompany.name as Hcompanyname',
                                            // 'Adminuser.name as subadminname', 
                                            'inflassign.*',
                                            )
                                        ->where('inflassign.taskid',$value->hashid)
                                        ->where('inflassign.inflstatus','>=',8)
                                        ->join('users as Influencer', function ($join) {
                                            $join->on('inflassign.inflid', '=', 'Influencer.id')
                                                 ->where('Influencer.role','host');
                                        })

                                        ->join('users as Hcompany', function ($join) {
                                            $join->on('Influencer.created_by', '=', 'Hcompany.id')
                                                 ->where('Hcompany.role','hcompany');
                                        })

                                        ->orderBy('inflassign.created_at', 'desc')->get();

        }

        return view('admin.indexpayment',compact('lists','ttlpage','ttl','inflassign'));
    }

   /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function indexbill()
    {
        //
        $limit = 99999;
        if (!empty($_GET['kword'])) {
            $kword = $_GET['kword'];
        } else {
            $kword = '';
        }    

        if (!empty($_GET['start'])) {
            $start = $_GET['start'];
            $start = date("Y-m-d 00:00:00",strtotime($start));
        } else {
            $start = '';
        } 

        if (!empty($_GET['end'])) {
            $end = $_GET['end'];
            $end = date("Y-m-d 23:59:59",strtotime($end));
        } else {
            $end = '';
        } 

        $startdate = new DateTime($start);
        $enddate = new DateTime($end);

        if($enddate < $startdate) {
            return back()->with('errorsearch',__('user.datesearcherror'));
        }

        $listsmain = DB::table('invoice')
                    ->select('H.name as hcompanyname', 'invoice.*')
                    ->where(function($query) use ($kword , $start , $end){
                        if (!empty($kword)) {
                            $query->where('H.name','LIKE','%'.$kword.'%')
                            // ->orwhere('invoice.label','LIKE','%'.$kword.'%')
                            ;
                        }
                        if (!empty($start)) {
                             $query->where('invoice.date', '>=',$start);
                        }
                        if (!empty($end)) {
                             $query->where('invoice.date', '<',$end);
                        }
                     })
                    ->join('hcompany as H', function ($join) {
                        $join->on('invoice.hcompany', '=', 'H.id');
                    })
                    ->orderBy('invoice.date', 'asc')->paginate($limit);

        foreach ($listsmain as $key => $value) {

            $labelarr = json_decode($value->label, true);

            foreach ($labelarr as $k => $v) {
                // code...
                $lists[$value->timeid.$k]['date'] = $value->date;
                $lists[$value->timeid.$k]['hcompanyname'] = $value->hcompanyname;
                $lists[$value->timeid.$k]['label'] = $v;

            }

            $quantityarr = json_decode($value->quantity, true);

            foreach ($quantityarr as $k => $v) {
                $lists[$value->timeid.$k]['quantity'] = $v;
            }

            $unitarr = json_decode($value->unit, true);

            foreach ($unitarr as $k => $v) {
                $lists[$value->timeid.$k]['unit'] = $v;
            }

            $totalrowarr = json_decode($value->totalrow, true);

            foreach ($totalrowarr as $k => $v) {
                $lists[$value->timeid.$k]['totalrow'] = $v*1.1;
            }

        }

        if (!empty($lists)) {
            $ttl = count($lists);
            $ttlpage = (ceil($ttl / $limit));
            $lists = (object) $lists; 
        } else {
            $lists = [];
            $ttlpage = 0;
            $ttl = 0;
        }





        $listsmain = DB::table('invoice')
          ->select('*',DB::raw('DATE(date) as date'))->orderBy('date', 'asc')
          ->get()->groupBy('date');

          $start = 0 ;
          $monthlyarr = array();
          $yearlyarr = array();
          $yeartotalarr = array();

          $month = $_GET['monthsearch'] ?? date('Y-m');

          foreach ($listsmain as $key => $value) {
              // code...
            // print_r($key);
            $monthkey = date("Y-m",strtotime($key));
            if (empty($yearlyarr[$monthkey])) {
                $yearlyarr[$monthkey] = 0;
            }
            $yearkey = date("Y",strtotime($key));
            // print_r($monthkey);
            $total = 0;   
            foreach ($value as $k => $v) {
                $totalrowarr = json_decode($v->totalrow, true);
                $total = $total + array_sum($totalrowarr);
            }
            // print_r(" == ".$total." == ".$yearlyarr[$monthkey]);
            
            if (str_contains($key, $month)) {
                $monthlyarr[$key] = $total*1.1;
            }

            $yearlyarr[$monthkey] = $yearlyarr[$monthkey] + ($total*1.1);
            // print_r($yearlyarr);
            $yeartotalarr[$yearkey][] = $total*1.1;
            // echo "<br>";   

          }

        // print_r(array_sum($yeartotalarr[$yearkey]));          
        //     echo "<br>";      
        //     echo "<br>";         
        // print_r($monthlyarr);          
        // die;

        return view('admin.indexbill',compact('lists','ttlpage','ttl','monthlyarr','yearlyarr','yeartotalarr'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Admin  $admin
     * @return \Illuminate\Http\Response
     */
    public function contact(Request $request)
    {
        //
        // print_r($request->all());die;

        if (empty($request->from)) {


            $request->validate(['name' => 'required|string|max:255',
                            'furiname' => 'required|string|max:255',
                            'email' => 'required|string|email|max:255',
                            'subject' => 'not_in:0',
                            'message' => 'required',
                                ],
            [
                'phone.required' => '電話番号を入力してください',
                'phone.regex' => '有効な電話番号を入力してください',
            ]);

            // die('asasas');
            $inquiry_email = 'info@rm-support.jp';
                // $inquiry_email = 'ulhakim@yahoo.com';

              $data = array('name'=>$request->name);
              if (!empty($request->email)) {
                $mail = Mail::send([], $data, function($message) use ($request, $inquiry_email) {
                   $message->to($inquiry_email, 'BEFAMOUS事務局')->subject($request->subject);
                   $message->from($request->email,$request->name);
                   $message->setBody("BEFAMOUS事務局公式サイトから、以下の問い合わせがありました。
                   \r\n＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝
                   \r\n名前：　".$request->name."
                   \r\n名前(フリガナ)：　".$request->furiname."
                   \r\n"."メールアドレス：　".$request->email."
                   \r\n
                   \r\n"."お問い合わせ内容：　
                   \r\n".$request->message."
                   \r\n
                   \r\n＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝");
                });
              }

              // print_r($mail);die;
              $msg = __('contact.donesend');
              return redirect('/contact#contact-form')->with('success',$msg);

        } else {


            $request->validate(['name' => 'required|string|max:255',
                            'email' => 'required|string|email|max:255',
                            'message' => 'required',
                                ]);

            // die('asasas');
            $inquiry_email = 'info@rm-support.jp';
                // $inquiry_email = 'ulhakim@yahoo.com';

              $data = array('name'=>$request->name);
              if (!empty($request->email)) {
                $mail = Mail::send([], $data, function($message) use ($request, $inquiry_email) {
                   $message->to($inquiry_email, 'BEFAMOUS事務局')->subject($request->name.'からの質問');
                   $message->from($request->email,$request->name);
                   $message->setBody("BEFAMOUS事務局公式サイトから、以下の問い合わせがありました。
                   \r\n＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝
                   \r\n名前：　".$request->name."
                   \r\n"."メールアドレス：　".$request->email."
                   \r\n
                   \r\n"."お問い合わせ内容：　
                   \r\n".$request->message."
                   \r\n
                   \r\n＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝");
                });
              }

              // print_r($mail);die;
              // echo "Basic Email Sent. Check your inbox.";
              $msg = __('contact.donesendquestion');
              if ($request->from == 'privacy') {
                  return redirect('/privacy#ts-form')->with('success',$msg);
              } else {
                  return redirect('/faq#ts-form')->with('success',$msg);
              }
              



        }
        // return back()->with('success','お問い合わせ内容は送信されました。');
    }



    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function indexblog()
    {
        $limit = 10;
        if (!empty($_GET['kword'])) {
            $kword = $_GET['kword'];
        } else {
            $kword = '';
        } 

        $lists = DB::table('blog')
                    ->where(function($query) use ($kword){
                         $query->where('title','LIKE','%'.$kword.'%');
                     })
                    ->orderBy('created_at', 'desc')->paginate($limit);


        $ttl = $lists->total();
        $ttlpage = (ceil($ttl / $limit));

        // $hcompanies = array();
        // print_r($lists);die;

        return view('admin.indexblog',compact('lists','ttlpage','ttl'));
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function blog()
    {  

        $limit = 10;
        if (!empty($_GET['kword'])) {
            $kword = $_GET['kword'];
        } else {
            $kword = '';
        } 

        $lists = DB::table('blog')
                    ->where(function($query) use ($kword){
                         $query->where('title','LIKE','%'.$kword.'%');
                     })
                    ->orderBy('created_at', 'desc')->paginate($limit);


        $ttl = $lists->total();
        $ttlpage = (ceil($ttl / $limit));

        // $hcompanies = array();
        return view('blogs',compact('lists','ttlpage','ttl'));
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function blogdetail($id)
    {
        $blog = DB::table('blog')
                    ->find($id);
        $blognext = DB::table('blog')->where('created_at','>',$blog->created_at)
            ->paginate(1);
        $blognext = $blognext[0];
        // print_r($blognext);die;

        $blogbefo = DB::table('blog')->where('created_at','<',$blog->created_at)
            ->paginate(1);
        $blogbefo = $blogbefo[0];
        
        // $hcompanies = array();
        return view('blogdetail',compact('blog','blognext','blogbefo'));
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function editblog($id)
    {
        $blog = DB::table('blog')
                    ->find($id);
        // print_r($blog);die;
        $editmode = true;
        // $hcompanies = array();
        return view('admin.registerblog',compact('blog','editmode'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function storeblog(Request $request)
    {

// print_r($request->all());die;


        $request->validate(['title' => 'required|string|max:255',
                            'content' => 'required|string|max:255',
                            'image' => 'required|mimes:jpeg,png,jpg,gif,svg|max:2048',
                            'category' => 'not_in:0',
                            // 'message' => 'required',
                            ]);


        if (!empty($request->image)) {
            $imageName = time().'.'.$request->image->extension();           
            $request->image->move(public_path('images'), $imageName);
        } else {
            $imageName = '';
        }


        $time = new DateTime();

        if (empty($request->id)) {



            DB::table('blog')->insert([
                'title' => $request->title,
                'content' => $request->content,
                'category' => $request->category,
                'headimg' => $imageName,
                'created_by' => Auth::user()->id,
                'author' => Auth::user()->name,
                'created_at' => $time->format('Y-m-d H:i:s'),
                'updated_at' => $time->format('Y-m-d H:i:s')
            ]);

            return redirect('/admin/news')->with('success','「'.$request->title.'」登録されました。');
        } else {
            
            $updval = array('title' => $request->title,
                            'content' => $request->content,
                            'category' => $request->category,
                            'updated_at' => $time->format('Y-m-d H:i:s')
                            );

            if (!empty($request->image)) {
                $updval['headimg'] = $imageName; 
            }

            DB::table('blog')->where('id',$request->id)->update($updval);

            return redirect('/admin/news')->with('success','「'.$request->title.'」更新されました。');

        }


    }

   /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function indexgallery()
    {
        $limit = 10;
        if (!empty($_GET['kword'])) {
            $kword = $_GET['kword'];
        } else {
            $kword = '';
        } 

        $lists = DB::table('matters')
                    ->select( 'U.name as uploadername', 'matters.*')
                    ->where(function($query) use ($kword){
                         $query->where('title','LIKE','%'.$kword.'%');
                     })
                    ->where('for','gallery')
                    ->join('users as U', function ($join) {
                        $join->on('matters.created_by', '=', 'U.id');
                    })
                    ->orderBy('created_at', 'desc')->paginate($limit);


        $ttl = $lists->total();
        $ttlpage = (ceil($ttl / $limit));

        // $hcompanies = array();
        // print_r($lists);die;

        return view('admin.indexgallery',compact('lists','ttlpage','ttl'));
    }


   /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function indextopsetting()
    {

        $lists = DB::table('matters')
                    ->where('for','companyinfo')
                    // ->orwhere('for','aboutusinfottl')
                    // ->orwhere('for','adminzoomkey')
                    ->get();



        $lists = $lists->pluck('value', 'title');


        // $keyarr = json_decode($lists['adminzoomkey']);

        // if (!empty($keyarr->keyone)) {
        //     $lists['keyone'] = $keyarr->keyone;
        //     $lists = (object)$lists;
        // }

        // if (!empty($keyarr->keytwo)) {
        //     $lists['keytwo'] = $keyarr->keytwo;
        //     $lists = (object)$lists;
        // }


        // $lists[0];

        return view('admin.topsetting',compact('lists'));
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function storetopsetting(Request $request)
    {



        $check = [

            'companyname' => 'required',
            'postalcode' => 'required',
            'address' => 'required',
            'addressextra' => 'required',
            'ceoname' => 'required',
            'phone' => 'required',
            'picname' => 'required',
        ];


        $validator = Validator::make($request->all(), $check,
        [
            'addressextra.required' => '住所2を入力してください',
            'ceoname.required' => '代表者名を入力してください',
        ]);

        if($request->ajax()){
        
            if ($validator->passes()) {
                return response()->json(['success'=>'allpasses']);
            }         
            return response()->json(['error'=>$validator->errors()]);
        
        }


        foreach ($request->all() as $key => $value) {
            print_r($key);

            $currentvalue = DB::table('matters')->where('title',$key)->first();

            DB::table('matters')
                ->updateOrInsert(
                    ['title' => $key],
                    ['value' => $value , 'created_by' => Auth::user()->id ,'for' => 'companyinfo']
                );

        }

        return redirect('/admin/topsetting')->with('success','設定されました。');
        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function registershowseminar(Request $request)
    {

        $check = [
            'id' => 'required',
        ];


        // print_r("$request->check");die;
        $validator = Validator::make($request->all(), $check);

        if($request->ajax()){
        
            if ($validator->passes()) {
                return response()->json(['success'=>'allpasses']);
            }         
            return response()->json(['error'=>$validator->errors()]);
        
        }

        if(!empty($request->id)){

            $seminar = Seminar::find($request->id);
            // if (!$seminar->open) {
            //     return redirect('/admin/seminars')->with('error','保留中なので、設定できません。');
            // }

            DB::table('matters')->where('title','toppageseminar')->update(array('value'=>$request->id,));
        }

        return redirect('/admin/events')->with('success','設定されました。');
        // die('sasas');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function hideseminar(Request $request)
    {

        $check = [
            'id' => 'required',
        ];


        // print_r("$request->check");die;
        $validator = Validator::make($request->all(), $check);

        if($request->ajax()){
        
            if ($validator->passes()) {
                return response()->json(['success'=>'allpasses']);
            }         
            return response()->json(['error'=>$validator->errors()]);
        
        }

        if(!empty($request->id)){

            $topapageseminar = DB::table('matters')->where('title','toppageseminar')->get();

            if ($topapageseminar[0]->value == $request->id) {
                return redirect('/admin/seminars')->with('error','TOPページに表示されているセミナーなので、保留できません。');
            }

            $seminar = Seminar::find($request->id);
            // print_r($seminar->open);
            // print_r(!$seminar->open);
            // die;
             $upd = $seminar->update(array('open' => !$seminar->open ));
            // DB::table('matters')->where('title','toppageseminar')->update(array('value'=>$request->id,));
        }

        return redirect('/admin/seminars')->with('success','設定されました。');
        // die('sasas');
    }

   /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function gallery()
    {
        $limit = 6;
        if (!empty($_GET['kword'])) {
            $kword = $_GET['kword'];
        } else {
            $kword = '';
        } 

        $gallery = array();

        foreach (array( 'all' => '',
                        'bunrui1' => 'bunrui1',
                        'bunrui2' => 'bunrui2',
                        'bunrui3' => 'bunrui3',
                        'bunrui4' => 'bunrui4'
                         ) as $key => &$value) {


            if (!empty($_GET['page'])) {
              $pageNumber = $_GET['page'];
            } else {
              $pageNumber = 1;
            }


            $lists = DB::table('matters')
                        ->where('for','gallery')
                        ->where(function($query) use ($value){
                            if (!empty($value)) {
                               $query->where('type','LIKE','%'.$value.'%');
                            }
                        })
                        ->orderBy('created_at', 'desc')->paginate($limit , ['*'], 'page', $pageNumber);


            $ttl = $lists->total();
            $ttlpage = (ceil($ttl / $limit));

            $gallery[$key] = array('lists' => $lists,
                                    'ttl' => $ttl,
                                    'ttlpage' => $ttlpage
                                     );

            // print_r($gallery[$key]);
            // echo "<br>";
            // echo "<br>";

        }

        // die;
        // $hcompanies = array();
        // print_r($lists);die;

        return view('gallery',compact('gallery'));
    }

   /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function gallery1()
    {
        $limit = 9;
        if (!empty($_GET['kword'])) {
            $kword = $_GET['kword'];
        } else {
            $kword = '';
        } 

        $lists = DB::table('matters')
                    ->where(function($query) use ($kword){
                         $query->where('title','LIKE','%'.$kword.'%');
                     })
                    ->where('for','gallery')
                    ->orderBy('created_at', 'desc')->paginate($limit);


        $ttl = $lists->total();
        $ttlpage = (ceil($ttl / $limit));

        // $hcompanies = array();
        // print_r($lists);die;

        return view('gallery',compact('lists','ttlpage','ttl'));
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function editgallery($id)
    {
        $data = DB::table('matters')
                    ->find($id);
        // print_r($gallery);die;
        $editmode = true;
        // $hcompanies = array();
        return view('admin.registergallery',compact('data','editmode'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Admin  $admin
     * @return \Illuminate\Http\Response
     */
    public function deletematters(Request $request)
    {
        $data = DB::table('matters')
                    ->delete($request->id);
        // print_r($gallery);die;
        // $hcompanies = array();
        return redirect('/'.Auth::user()->role.'/gallery')->with('success','削除されました。');
        // return view('admin.registergallery',compact('data','editmode'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function storegallery(Request $request)
    {

// print_r($request->all());die;
        $valarr = array('title' => 'required|string|max:255',
                        'bunrui' => 'not_in:0'
                            );
        if (empty($request->id)) {
            $valarr['image'] = 'required|mimes:jpeg,png,jpg,gif,svg|max:2048';
        }


        $request->validate($valarr);


        if (!empty($request->image)) {
            $imageName = time().'.'.$request->image->extension();           
            $request->image->move(public_path('images'), $imageName);
        } else {
            $imageName = '';
        }

        // print_r($request->all());die;

        $time = new DateTime();

        if (empty($request->id)) {


            $newval = array('title' => $request->title,
                            'for' => 'gallery',
                            'value' => $imageName,
                            'type' => $request->bunrui,
                            'created_by' => Auth::user()->id,
                            'created_at' => $time->format('Y-m-d H:i:s'),
                            'updated_at' => $time->format('Y-m-d H:i:s')
                        );

                // $newval['type'] = $request->bunrui; 
            // if (Auth::user()->role == 'hcompany') {
            //     $newval['type'] = Auth::user()->bunrui; 
            // } else if (Auth::user()->role == 'admin') {
            // }

            // print_r($newval);
            // die;
            DB::table('matters')->insert($newval);

            return redirect('/'.Auth::user()->role.'/gallery')->with('success','「'.$request->title.'」登録されました。');
        } else {
            
            $updval = array('title' => $request->title,
                            'type' => $request->bunrui,
                            'updated_at' => $time->format('Y-m-d H:i:s')
                            );

            if (!empty($request->image)) {
                $updval['value'] = $imageName; 
            }

            DB::table('matters')->where('id',$request->id)->update($updval);

            return redirect('/'.Auth::user()->role.'/gallery')->with('success','「'.$request->title.'」更新されました。');

        }


    }


   /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function indexresult()
    {

        $lists = DB::table('semtype')
                    ->where('name','<>','')
                    ->get();
        $listsarr = $lists->toArray();
        $namebycode = array_column($listsarr, 'name', 'code');

        $limit = 10;
        if (!empty($_GET['kword'])) {
            $kword = $_GET['kword'];
        } else {
            $kword = '';
        }    

        if (!empty($_GET['start'])) {
            $start = $_GET['start'];
            $start = date("Y-m-d 00:00:00",strtotime($start));
        } else {
            $start = '';
        } 

        if (!empty($_GET['end'])) {
            $end = $_GET['end'];
            $end = date("Y-m-d 23:59:59",strtotime($end));
        } else {
            $end = '';
        } 


        $startdate = new DateTime($start);
        $enddate = new DateTime($end);

        if($enddate < $startdate) {
            return back()->with('errorsearch',__('user.datesearcherror'));
        }

        $lists = DB::table('test')
                    ->select('answerer.name as answerername',
                             'answerer.gender as answerergender',
                             'answerer.agerange as answereragerange',
                             'sem.name as testname',
                             'sem.start as teststart',
                             'sem.semtype_id as testsemtype_id',
                             'host.name as hostname',
                             'hcompany.name as hcompanyname',
                             'test.*')
                    ->whereNotNull('test.getmark')
                    ->whereNotNull('test.fullmark')

                    ->where(function($query) use ($kword){
                        if (!empty($kword)) {
                             $query->where('answerer.name','LIKE','%'.$kword.'%')
                                   ->orwhere('sem.name','LIKE','%'.$kword.'%')
                                   ->orwhere('host.name','LIKE','%'.$kword.'%')
                                   ->orwhere('hcompany.name','LIKE','%'.$kword.'%');
                        }
                     })

                    ->where(function($query) use ($start , $end){
                        if (!empty($start)) {
                             $query->where('sem.start', '>',$start);
                        }
                        if (!empty($end)) {
                             $query->where('sem.start', '<',$end);
                        }
                     })  
                    // ->where('sem.host_id', Auth::user()->id)
                    ->join('seminars as sem', function ($join) {
                        $join->on('test.testid', '=', 'sem.id')
                             // ->where('sem.host_id', Auth::user()->id)
                        ;
                    })
                    ->join('users as answerer', function ($join) {
                        $join->on('test.tester', '=', 'answerer.id')
                             ->where('answerer.role','user');
                    })
                    ->join('users as host', function ($join) {
                        $join->on('sem.host_id', '=', 'host.id')
                             ->where('host.role','host');
                    })
                    ->join('users as hcompany', function ($join) {
                        $join->on('host.created_by', '=', 'hcompany.id')
                             ->where('hcompany.role','hcompany');
                    })
                    ->orderBy('sem.start', 'desc')->paginate($limit);

        $ttl = $lists->total();
        $ttlpage = (ceil($ttl / $limit));

        // print_r($lists);
        // die;

        return view('admin.indexresult',compact('lists','ttlpage','ttl','namebycode'));
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function indexsales()
    {
        //
        $limit = 10;
        if (!empty($_GET['kword'])) {
            $kword = $_GET['kword'];
        } else {
            $kword = '';
        }    

        if (!empty($_GET['start'])) {
            $start = $_GET['start'];
            $start = date("Y-m-d 00:00:00",strtotime($start));
        } else {
            $start = '';
        } 

        if (!empty($_GET['end'])) {
            $end = $_GET['end'];
            $end = date("Y-m-d 23:59:59",strtotime($end));
        } else {
            $end = '';
        } 

        $startdate = new DateTime($start);
        $enddate = new DateTime($end);

        if($enddate < $startdate) {
            return back()->with('errorsearch',__('user.datesearcherror'));
        }

        $lists = DB::table('seminars')
                    ->select('company.name as companyname','U.name as hostname', 'seminars.*')
                    ->where('seminars.name','<>','')
                    ->where('seminars.joinlist','<>','')
                    ->where('seminars.fee','>',0)
                    ->where(function($query) use ($kword , $start , $end){
                        if (!empty($kword)) {
                             $query->where('seminars.name','LIKE','%'.$kword.'%')->orwhere('U.name','LIKE','%'.$kword.'%')->orwhere('company.name','LIKE','%'.$kword.'%');
                        }
                        if (!empty($start)) {
                             $query->where('seminars.start', '>',$start);
                        }
                        if (!empty($end)) {
                             $query->where('seminars.end', '<',$end);
                        }
                     })
                    ->join('users as U', function ($join) {
                        $join->on('seminars.host_id', '=', 'U.id')
                             ->where('U.role','host');
                    })
                    ->join('users as company', function ($join) {
                        $join->on('U.created_by', '=', 'company.id')
                             ->where('company.role','hcompany');
                    })
                    ->orderBy('seminars.start', 'desc')->paginate($limit);

        $ttl = $lists->total();
        $ttlpage = (ceil($ttl / $limit));

        foreach ($lists as $key => $value) {
            $lists[$key]->joincount = count(array_filter(explode('.', $value->joinlist)));
            $lists[$key]->ttlper = ($lists[$key]->joincount)*($value->fee);
        }
        return view('admin.indexsales',compact('lists','ttlpage','ttl'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function indexanalayticmarketing()
    {
        //
        $limit = 10;
        if (!empty($_GET['kword'])) {
            $kword = $_GET['kword'];
        } else {
            $kword = '';
        }    

        if (!empty($_GET['start'])) {
            $start = $_GET['start'];
            $start = date("Y-m-d 00:00:00",strtotime($start));
        } else {
            $start = '';
        } 

        if (!empty($_GET['end'])) {
            $end = $_GET['end'];
            $end = date("Y-m-d 23:59:59",strtotime($end));
        } else {
            $end = '';
        } 

        if (!empty($_GET['fee'])) {
            $fee = $_GET['fee'];
        } else {
            $fee = '';
        } 


        if (!empty($_GET['s_type'])) {
            $semtype_id = $_GET['s_type'];
        } else if (!empty($_GET['m_type'])) {
            $semtype_id = $_GET['m_type'];
        } else if (!empty($_GET['b_type'])) {
            $semtype_id = $_GET['b_type'];
        } else {
            $semtype_id = '';
        } 


        $startdate = new DateTime($start);
        $enddate = new DateTime($end);

        if($enddate < $startdate) {
            return back()->with('errorsearch',__('user.datesearcherror'));
        }
        // print_r($start);
        $role = Auth::user()->role;

        $lists = DB::table('seminars')
                    ->select(
                            // 'company.name as companyname',
                             // 'U.name as hostname',
                             'seminars.*')
                    ->where('seminars.name','<>','')
                    ->where('seminars.open','1')
                    ->where('seminars.semtype_id','LIKE','%b3%')
                    // ->where(function($query) use ($fee){
                    //         if (empty($fee)) {
                    //             $query->where('seminars.fee','0');
                    //         }
                    //  })

                    ->where(function($query) use ($kword , $start , $end , $semtype_id , $fee){
                        if (!empty($kword)) {
                             $query->where('seminars.name','LIKE','%'.$kword.'%')->orwhere('U.name','LIKE','%'.$kword.'%')->orwhere('company.name','LIKE','%'.$kword.'%');
                        }
                        if (!empty($semtype_id)) {
                             $query->where('seminars.semtype_id','LIKE','%'.$semtype_id.'%');
                        }
                        if (!empty($start)) {
                             $query->where('seminars.start', '>',$start);
                        }
                        if (!empty($end)) {
                             $query->where('seminars.end', '<',$end);
                        }
                        if (!empty($fee)) {
                            if ($fee == '1') {
                                //無料
                                $query->where('seminars.fee','0');
                            } else {
                                //有料
                                $query->where('seminars.fee','<>','0');
                            }
                        }
                     })
                    ->join('users as U', function ($join) use ($role) {

                        if ($role == 'hcompany') {
                            $join->on('seminars.host_id', '=', 'U.id')
                                 ->where('U.created_by',Auth::user()->id)
                                 ->where('U.role','host');
                        } else if ($role == 'host') {
                            $join->on('seminars.host_id', '=', 'U.id')
                                 ->where('seminars.host_id',Auth::user()->id)
                                 ->where('U.role','host');
                        } else {
                            $join->on('seminars.host_id', '=', 'U.id')
                                 ->where('U.role','host');
                        }

                    })
                    ->join('users as company', function ($join) {
                        $join->on('U.created_by', '=', 'company.id')
                             ->where('company.role','hcompany');
                    })
                    ->orderBy('seminars.start', 'desc')->paginate($limit);

        $ttl = $lists->total();
        $ttlpage = (ceil($ttl / $limit));

        // print_r($toppageseminar);die;
        $idarr = array();
        $array2 = array(1 => "data");
        $result = array_merge($idarr, $array2);

        foreach ($lists as $key => $value) {
            $joinarr = array_filter(explode('.', $value->joinlist));
            $idarr = array_merge($idarr, $joinarr);
            $lists[$key]->joincount = count($joinarr);
        }

        foreach ($idarr as $key => $value) {
            $idarr[$key] = +$value;
        }
        $idarr = array_unique($idarr);
        // print_r($idarr);

        $joiner = DB::table('users')->whereIn('users.id', $idarr)
                    ->get()->keyBy('id')
                    ;

                    // print_r($joiner);die;
        foreach ($lists as $key => $value) {
            $joinarr = array_filter(explode('.', $value->joinlist));
            // $idarr = array_merge($idarr, $joinarr);
                $men = 0 ;
                $women = 0 ;
                $age10 = 0 ;
                $age20 = 0 ;
                $age30 = 0 ;
                $age40 = 0 ;
                $age50 = 0 ;
                $age60 = 0 ;
                foreach ($joinarr as $k => $value) {
                    if ($joiner[+$value]->gender) {
                        ++$men;
                    } else {
                        ++$women;
                    }


                    if ($joiner[+$value]->agerange == '10') {
                        ++$age10;
                    } else if ($joiner[+$value]->agerange == '20') {
                        ++$age20;
                    } else if ($joiner[+$value]->agerange == '30') {
                        ++$age30;
                    } else if ($joiner[+$value]->agerange == '40') {
                        ++$age40;
                    } else if ($joiner[+$value]->agerange == '50') {
                        ++$age50; 
                    } else if ($joiner[+$value]->agerange == '60') {
                        ++$age60; 
                    } 

                }

                    $lists[$key]->men = $men;
                    $lists[$key]->women = $women;
                    $lists[$key]->age10 = $age10;
                    $lists[$key]->age20 = $age20;
                    $lists[$key]->age30 = $age30;
                    $lists[$key]->age40 = $age40;
                    $lists[$key]->age50 = $age50;
                    $lists[$key]->age60 = $age60;
                // print_r($joinarr);
                // echo "<br>";
                // echo "<br>";
        }

        // print_r($lists);
        // die;


        return view('admin.indexanalayticmarketing',compact('lists','ttlpage','ttl'));
    }

   /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function indexanalayticexam()
    {

        $limit = 10;
        if (!empty($_GET['kword'])) {
            $kword = $_GET['kword'];
        } else {
            $kword = '';
        }    

        if (!empty($_GET['start'])) {
            $start = $_GET['start'];
            $start = date("Y-m-d 00:00:00",strtotime($start));
        } else {
            $start = '';
        } 

        if (!empty($_GET['end'])) {
            $end = $_GET['end'];
            $end = date("Y-m-d 23:59:59",strtotime($end));
        } else {
            $end = '';
        } 


        if (!empty($_GET['fee'])) {
            $fee = $_GET['fee'];
        } else {
            $fee = '';
        } 


        if (!empty($_GET['s_type'])) {
            $semtype_id = $_GET['s_type'];
        } else if (!empty($_GET['m_type'])) {
            $semtype_id = $_GET['m_type'];
        } else if (!empty($_GET['b_type'])) {
            $semtype_id = $_GET['b_type'];
        } else {
            $semtype_id = '';
        } 

        $startdate = new DateTime($start);
        $enddate = new DateTime($end);

        if($enddate < $startdate) {
            return back()->with('errorsearch',__('user.datesearcherror'));
        }

        $role = Auth::user()->role;

        $lists = DB::table('test')
                    ->select('answerer.name as answerername',
                             'sem.name as testname',
                             'sem.start as teststart',
                             'host.name as hostname',
                             'hcompany.name as hcompanyname',
                             'test.*')
                    ->whereNotNull('test.getmark')
                    ->whereNotNull('test.fullmark')

                    ->where(function($query) use ($kword , $start , $end , $semtype_id , $fee){
                        if (!empty($kword)) {
                             $query->where('answerer.name','LIKE','%'.$kword.'%')
                                   ->orwhere('sem.name','LIKE','%'.$kword.'%')
                                   ->orwhere('host.name','LIKE','%'.$kword.'%')
                                   ->orwhere('hcompany.name','LIKE','%'.$kword.'%');
                        }
                        if (!empty($semtype_id)) {
                             $query->where('sem.semtype_id','LIKE','%'.$semtype_id.'%');
                        }
                        if (!empty($start)) {
                             $query->where('sem.start', '>',$start);
                        }
                        if (!empty($end)) {
                             $query->where('sem.end', '<',$end);
                        }
                        if (!empty($fee)) {
                            if ($fee == '1') {
                                //無料
                                $query->where('sem.fee','0');
                            } else {
                                //有料
                                $query->where('sem.fee','<>','0');
                            }
                        }
                     })

                    // ->where('sem.host_id', Auth::user()->id)
                    ->join('seminars as sem', function ($join) {
                        $join->on('test.testid', '=', 'sem.id')
                             // ->where('sem.host_id', Auth::user()->id)
                        ;
                    })
                    ->join('users as answerer', function ($join) {
                        $join->on('test.tester', '=', 'answerer.id')
                             ->where('answerer.role','user');
                    })


                    ->join('users as U', function ($join) use ($role) {

                        if ($role == 'hcompany') {
                            $join->on('sem.host_id', '=', 'U.id')
                                 ->where('U.created_by',Auth::user()->id)
                                 ->where('U.role','host');
                        } else if ($role == 'host') {
                            $join->on('sem.host_id', '=', 'U.id')
                                 ->where('sem.host_id',Auth::user()->id)
                                 ->where('U.role','host');
                        } else {
                            $join->on('sem.host_id', '=', 'U.id')
                                 ->where('U.role','host');
                        }

                    })

                    ->join('users as host', function ($join) {
                        $join->on('sem.host_id', '=', 'host.id')
                             ->where('host.role','host');
                    })
                    ->join('users as hcompany', function ($join) {
                        $join->on('host.created_by', '=', 'hcompany.id')
                             ->where('hcompany.role','hcompany');
                    })
                    ->orderBy('sem.start', 'desc')->paginate($limit);

        $ttl = $lists->total();
        $ttlpage = (ceil($ttl / $limit));

        foreach ($lists as $key => $value) {
            $ques = DB::table('fixques')
                        ->whereIn('id',array_keys( (array) json_decode($value->checklog)))
                        ->where('testid',$value->testid)
                        ->get()->keyBy('id');



            $checklog = json_decode($value->checklog , true);

            // print_r(gettype($checklog));
            // die;
            if (!empty($checklog)) {
                foreach ($checklog as $k => $v) {
                    if ($v) {
                        $checklog[$k] = $ques[$k]->mark;
                    } else {
                        $checklog[$k] = 0;
                    }
                }
            }

            $lists[$key]->checklog = $checklog;
        }

        return view('admin.indexanalayticexam',compact('lists','ttlpage','ttl'));
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function indexanalayticdifficulty()
    {
        //
        $limit = 10;
        if (!empty($_GET['kword'])) {
            $kword = $_GET['kword'];
        } else {
            $kword = '';
        }    

        if (!empty($_GET['start'])) {
            $start = $_GET['start'];
            $start = date("Y-m-d 00:00:00",strtotime($start));
        } else {
            $start = '';
        } 

        if (!empty($_GET['end'])) {
            $end = $_GET['end'];
            $end = date("Y-m-d 23:59:59",strtotime($end));
        } else {
            $end = '';
        } 

        if (!empty($_GET['fee'])) {
            $fee = $_GET['fee'];
        } else {
            $fee = '';
        } 


        if (!empty($_GET['s_type'])) {
            $semtype_id = $_GET['s_type'];
        } else if (!empty($_GET['m_type'])) {
            $semtype_id = $_GET['m_type'];
        } else if (!empty($_GET['b_type'])) {
            $semtype_id = $_GET['b_type'];
        } else {
            $semtype_id = '';
        } 


        $startdate = new DateTime($start);
        $enddate = new DateTime($end);

        if($enddate < $startdate) {
            return back()->with('errorsearch',__('user.datesearcherror'));
        }
        // print_r($start);
        $role = Auth::user()->role;

        $lists = DB::table('seminars')
                    ->select(
                            // 'company.name as companyname',
                             // 'U.name as hostname',
                             'seminars.*')
                    ->where('seminars.name','<>','')
                    ->where('seminars.open','1')
                    ->where('seminars.semtype_id','LIKE','%b3%')
                    // ->where(function($query) use ($fee){
                    //         if (empty($fee)) {
                    //             $query->where('seminars.fee','0');
                    //         }
                    //  })

                    ->where(function($query) use ($kword , $start , $end , $semtype_id , $fee){
                        if (!empty($kword)) {
                             $query->where('seminars.name','LIKE','%'.$kword.'%')->orwhere('U.name','LIKE','%'.$kword.'%')->orwhere('company.name','LIKE','%'.$kword.'%');
                        }
                        if (!empty($semtype_id)) {
                             $query->where('seminars.semtype_id','LIKE','%'.$semtype_id.'%');
                        }
                        if (!empty($start)) {
                             $query->where('seminars.start', '>',$start);
                        }
                        if (!empty($end)) {
                             $query->where('seminars.end', '<',$end);
                        }
                        if (!empty($fee)) {
                            if ($fee == '1') {
                                //無料
                                $query->where('seminars.fee','0');
                            } else {
                                //有料
                                $query->where('seminars.fee','<>','0');
                            }
                        }
                     })
                    ->join('users as U', function ($join) use ($role) {

                        if ($role == 'hcompany') {
                            $join->on('seminars.host_id', '=', 'U.id')
                                 ->where('U.created_by',Auth::user()->id)
                                 ->where('U.role','host');
                        } else if ($role == 'host') {
                            $join->on('seminars.host_id', '=', 'U.id')
                                 ->where('seminars.host_id',Auth::user()->id)
                                 ->where('U.role','host');
                        } else {
                            $join->on('seminars.host_id', '=', 'U.id')
                                 ->where('U.role','host');
                        }

                    })
                    ->join('users as company', function ($join) {
                        $join->on('U.created_by', '=', 'company.id')
                             ->where('company.role','hcompany');
                    })
                    ->orderBy('seminars.start', 'desc')->paginate($limit);

        $ttl = $lists->total();
        $ttlpage = (ceil($ttl / $limit));


        foreach ($lists as $key => $value) {

            $tests = DB::table('test')
                        ->where('testid',$value->id)
                        ->whereNotNull('getmark')
                        ->whereNotNull('fullmark')
                        ->get();

            $lists[$key]->totaljoined = count($tests);

            $ques = DB::table('fixques')
                        ->where('testid',$value->id)
                        ->get();

            $lists[$key]->queanalytic = $ques;
        }

        // print_r($lists);
        // die;


        return view('admin.indexanalayticdifficulty',compact('lists','ttlpage','ttl'));
    }


}
