<?php

namespace App\Http\Controllers;

use App\Models\Hcompany;
use Illuminate\Http\Request;

use App\Models\User;

use Illuminate\Support\Facades\Hash;

use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Auth;

use App\Models\Seminar;

use Validator;

use Illuminate\Support\Facades\DB;

use DateTime;

class HcompanyController extends Controller
{


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function idlehost(Request $request)
    {

        // print_r($request->all());
        // die;
        // User::find($key)->update(array('noti'=>$noti,));
        $host = User::where('id',$request->hostid)->get();
        $host = $host[0];

        if ($host->role == 'idlehost') {
            User::where('id',$request->hostid)->update(array('role'=>'host',));
            return redirect()->back()->with('success','有効に設定されました。');
        } else {
            $inflassign = DB::table('inflassign')
                        ->where('inflassign.inflid',$request->hostid)
                        ->whereIn('inflassign.inflstatus',['6','7','8'])
                        ->count();
        // print_r(count($inflassign));die;

            if (empty($inflassign)) {
                User::where('id',$request->hostid)->update(array('role'=>'idlehost',));
                return redirect()->back()->with('success','無効に設定されました。');
            } else {
                return redirect()->back()->with('error','担当されているタスクありました');
            }
            

        }
                

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function assignrespon(Request $request)
    {
        // print_r($request->all());die;
        if ($request->respon == '2') {
            $inflassign = DB::table('inflassign')
                        ->where('inflassign.id',$request->assignid)
                        ->get();
        
            if ($inflassign[0]->inflstatus == '4') {
                DB::table('inflassign')->where('id',$request->assignid)->update(array('inflstatus'=> 5 ,'applycond'=> 0 ));
            } elseif ($inflassign[0]->inflstatus == '5') {
                DB::table('inflassign')->where('id',$request->assignid)->update(array('inflstatus'=> 6 ,'applycond'=> 0 ));
            } elseif ($inflassign[0]->inflstatus == '6') {
                DB::table('inflassign')->where('id',$request->assignid)->update(array('inflstatus'=> 7 ,'applycond'=> 0 ));
            } elseif ($inflassign[0]->inflstatus == '7') {
                DB::table('inflassign')->where('id',$request->assignid)->update(array('inflstatus'=> 8 ,'applycond'=> 0 ));
            } elseif ($inflassign[0]->inflstatus == '8') {
                DB::table('inflassign')->where('id',$request->assignid)->update(array('inflstatus'=> 9 ,'applycond'=> 0 ));
            }

        }elseif ($request->respon == '3') {
            DB::table('inflassign')->where('id',$request->assignid)->update(array('inflstatus'=> 4 ,'applycond'=> 0 ));
        } else {
            DB::table('inflassign')->where('id',$request->assignid)->update(array('applycond'=>$request->respon,));
        }


        // if ($request->respon == '8') {
        //     $inflassign = DB::table('inflassign')
        //                 ->where('inflassign.id',$request->assignid)
        //                 ->get();
        //     DB::table('task')->where(DB::raw('BINARY `hashid`'),$inflassign[0]->taskid)->update(array('status'=>'10'));
        // }

        return redirect()->back()->with('success','更新されました。');

    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function indexhost()
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

        $lists = User::whereIn('role',['host','idlehost'])
                    ->where('created_by',Auth::user()->id)
                    ->where(function($query) use ($kword){
                        if (!empty($kword)) {
                            $query->where('email','LIKE','%'.$kword.'%')->orwhere('name','LIKE','%'.$kword.'%');
                        }
                     })
                    ->where(function($query) use ($start , $end , $field){
                        if (!empty($field)) {
                            // print_r($field);die;
                            $query->where('field',$field);
                        }
                        if (!empty($start)) {
                             $query->where('created_at', '>',$start);
                        }
                        if (!empty($end)) {
                             $query->where('created_at', '<',$end);
                        }
                     })
                    ->orderBy('created_at', 'desc')->paginate($limit);

        $ttl = $lists->total();
        $ttlpage = (ceil($ttl / $limit));

        return view('hcompany.indexhost',compact('lists','ttlpage','ttl'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function indexjob()
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

        if (!empty($_GET['inflstatus'])) {
            $inflstatus = $_GET['inflstatus'];
        } else {
            $inflstatus = '';
        } 


        $startdate = new DateTime($start);
        $enddate = new DateTime($end);

        if($enddate < $startdate) {
            return back()->with('errorsearch',__('user.datesearcherror'));
        }

        $infl = User::where('role','host')
                    ->where('created_by',Auth::user()->id)->pluck('name', 'id');

        // print_r($infl);die;


        $lists = DB::table('inflassign')
                    ->select(
                        'Influencer.name as Influencername',
                        'Influencer.id as Influencerid',
                        'Influencer.created_by as Influencercreated_by',
                        'Task.hashid as hashid', 
                        'Task.id as taskidno', 
                        'Task.created_at as taskcreated_at', 
                        'Adminuser.name as subadminname',
                        'Task.*',
                        'inflassign.*',
                        )
                    ->where('Task.positionname','<>','')

                    ->where(function($query) use ($kword){
                        if (!empty($kword)) {
                             $query->where('Task.positionname','LIKE','%'.$kword.'%')->orwhere('Task.id','LIKE','%'.$kword.'%');
                        }
                     })

                    ->where(function($query) use ($start , $end , $positioncategory , $statusarr){
                        if (!empty($positioncategory)) {
                            $query->where('Task.positioncategory',$positioncategory);
                        }                        
                        if (!empty($start)) {
                             $query->where('Task.created_at', '>',$start);
                        }
                        if (!empty($end)) {
                             $query->where('Task.created_at', '<',$end);
                        }
                        if (!empty($statusarr)) {
                             $query->whereIn('Task.status', $statusarr);
                        }
                     })
                    ->where(function($query) use ($inflstatus){
                        if (!empty($inflstatus)) {
                             $query->where('inflassign.inflstatus', $inflstatus);
                        }
                     })
                    ->join('task as Task', function ($join) {
                        $join->on('inflassign.taskid', '=', 'Task.hashid')
                             // ->where('Task.status','>=',3)
                             ;
                    })
                    ->join('users as Influencer', function ($join) {
                        $join->on('inflassign.inflid', '=', 'Influencer.id')
                             ->where('Influencer.created_by',Auth::user()->id)->where('Influencer.role','LIKE','%host%');
                    })
                    ->leftJoin('users as Adminuser', function ($join) {
                        $join->on('Task.subadmin', '=', 'Adminuser.id')
                             ->where('Adminuser.role','admin');
                    })
                    ->orderBy('Task.created_at', 'desc')->paginate($limit);

        $ttl = $lists->total();
        $ttlpage = (ceil($ttl / $limit));

        // print_r($lists);die;
        $inflids = array();
        foreach ($lists as $item) {
            $inflids[] = $item->Influencerid;
        }          

        $influencers = User::where('role','host')->whereIn('id',array_unique($inflids))->get();

        return view('hcompany.indexjob',compact('lists','ttlpage','ttl','influencers'));
    }


    public function validatehost($request, $editpassword = true , $editmode = false, $emailuniquecheck = true, $needimg = true) 
    {

        $check = [
            'name' => 'required|string|max:255',
            'gender' => 'required|not_in:0',
            'email' => 'required|string|email|max:255',
            'password' => 'required|string|min:6|confirmed',
            'check' => 'required',
            'dob' => 'required',
            // 'phone' => ['required', 'regex:/^(0([1-9]{1}-?[1-9]\d{3}|[1-9]{2}-?\d{3}|[1-9]{2}\d{1}-?\d{2}|[1-9]{2}\d{2}-?\d{1})-?\d{4}|0[789]0-?\d{4}-?\d{4}|050-?\d{4}-?\d{4})$/'],
            'country' => 'required|not_in:0',
            'address' => 'required|string',
            'field' => 'required|not_in:0',
            'image' => 'required|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'resume' => 'required|mimetypes:application/pdf|max:2048',
            'docone' => 'mimetypes:application/pdf|max:2048',
            'doctwo' => 'mimetypes:application/pdf|max:2048',
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
            unset($check['resume']);
        }
        // print_r("$request->check");die;
        $validator = Validator::make($request->all(), $check,
        [
            'check.required' => __('validation.pleasecheck'),
            'image.mimes' => __('validation.pleaseuploadimgfile'),
            'image.required' => __('validation.pleaseuploadimgfile'),
            'dob.required' => __('生年月日を入力してください'),
            'field.not_in' => __('希望職種を選択してください'),
            'resume.required' => __('履歴書アップロードしてください'),
            'resume.mimetypes' => __('PDFファイルをアップロードしてください'),
            'docone.mimetypes' => __('PDFファイルをアップロードしてください'),
            'doctwo.mimetypes' => __('PDFファイルをアップロードしてください'),
        ]);

        return $validator;

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function storehost(Request $request)
    {

        $validator = $this->validatehost($request);

        if($request->ajax()){
        
            if ($validator->passes()) {
                return response()->json(['success'=>'allpasses']);
            }         
            return response()->json(['error'=>$validator->errors()]);
        
        }

        //*******************************************************

        if (empty($request->role)) {
            $role = 'idlehost';
        } else {
            $role = $request->role;
        }

        if (!empty($request->image)) {
            $imageName = time().'_'.$request->image->getClientOriginalName().'.'.$request->image->extension();           
            $request->image->move(public_path('images/avatar'), $imageName);
        } else {
            $imageName = '';
        }

        if (!empty($request->resume)) {
            $resumeName = time().'_resume'.$request->resume->getClientOriginalName();           
            $request->resume->move(public_path('documents'), $resumeName);
        } else {
            $resumeName = '';
        }

        if (!empty($request->docone)) {
            $doconeName = time().'_docone'.$request->docone->getClientOriginalName();           
            $request->docone->move(public_path('documents'), $doconeName);
        } else {
            $doconeName = '';
        }

        if (!empty($request->doctwo)) {
            $doctwoName = time().'_doctwo'.$request->doctwo->getClientOriginalName();           
            $request->doctwo->move(public_path('documents'), $doctwoName);
        } else {
            $doctwoName = '';
        }

 // print_r($request->->getClientOriginalName()());
 // print_r($request->all());
 // print_r($request->all());
 //        die;

        $user = User::create([
            'role' => $role,
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'gender' => $request->gender,
            'agerange' => $request->agerange,
            'phone' => $request->phone,
            'profileimg' => $imageName,
            'resume' => $resumeName,
            'docone' => $doconeName,
            'doctwo' => $doctwoName,
            'address' => $request->address,
            'country' => $request->country,
            'field' => $request->field,
            'dob' => $request->dob,
            'recommendation' => $request->recommendation,
            'companyinfo' => $request->companyinfo,
        ]);

        $user->markEmailAsVerified();

        event(new Registered($user));

        return redirect('/agent')->with('success', __('auth.doneregister', ['name' => $request->name]));
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function registerfee(Request $request)
    {

        // print_r($request->all());die;
        $vallarr = [
            'setmoneyassignid' => 'required|string|max:255',
        ];

        if ($request->moneyout != '0') { //  allow 0 to submit
            $vallarr['moneyout'] = 'required|numeric';
        } 

        if ($request->moneyin != '0') { //  allow 0 to submit
            $vallarr['moneyin'] = 'required|numeric';
        } 


        $validator = Validator::make($request->all(), $vallarr,
        [
            'moneyin.required' => '発注額を入力してください',
            'moneyin.numeric' => '半角数字を入力してください',
            'moneyout.required' => '発注額を入力してください',
            'moneyout.numeric' => '半角数字を入力してください',
        ]);

        if($request->ajax() && ($request->forvalidate == 1)  ){
        
            if ($validator->passes()) {
                return response()->json(['success'=>'allpasses']);
            }         
            return response()->json(['error'=>$validator->errors()]);
        
        } else {

            DB::table('inflassign')->where('id',$request->setmoneyassignid)->update(array('moneyin'=>$request->moneyin,'moneyout'=>$request->moneyout));
            
            return redirect()->back();

        }

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Hcompany  $hcompany
     * @return \Illuminate\Http\Response
     */
    public function setzoomapi(Request $request)
    {

        if($request->ajax()){
        
            // if ($validator->passes()) {
                return response()->json(['success'=>'allpasses']);
            // }         
            // return response()->json(['error'=>$validator->errors()]);
        
        }

    $data = array('keyone' => $request->keyone, 'keytwo' => $request->keytwo );

        $datastr = json_encode($data);

        $userprofile = Auth::user();

        $userprofile->update(['zoomapi' => $datastr]); 

        return redirect('/agent')->with('success','ZOOM API を更新されました。');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Hcompany  $hcompany
     * @return \Illuminate\Http\Response
     */
    public function indexcalender(Request $request)
    {
        //
        //
        $limit = 1000;
        // print_r($fee);
        // die;

        $lists = DB::table('semtype')
                    ->where('name','<>','')
                    ->get();
        $listsarr = $lists->toArray();
        $namebycode = array_column($listsarr, 'name', 'code');

        $lists = DB::table('seminars')
                    ->select('U.name as hostname','U.profileimg as profileimg', 'seminars.*')
                    ->where('seminars.name','<>','')

                    ->join('users as U', function ($join) {
                        $join->on('seminars.host_id', '=', 'U.id')
                             ->where('U.created_by',Auth::user()->id)
                             ->where('U.role','host');
                    })
                    ->orderBy('seminars.created_at', 'desc')->paginate($limit);

        $ttl = $lists->total();
        $ttlpage = (ceil($ttl / $limit));

        $today = array();
        $tweek = array();
        
        $todaysta = strtotime(date("Y-m-d 00:00:00"));
        $todayend = strtotime(date("Y-m-d 23:59:59"));

        $tweeksta = strtotime(date("Y-m-d 00:00:00", strtotime("+1 day")));
        $tweekend = strtotime(date("Y-m-d 23:59:59", strtotime("+7 day")));

        foreach ($lists as $key => $value) {

                $starttime = strtotime($value->start);

                if ( ($todaysta < $starttime) && ($starttime < $todayend) ) {
                    $today[] = $key;
                } else if ( ($tweeksta < $starttime) && ($starttime < $tweekend) ) {
                    $tweek[] = $key;
                }

        }

        // print_r($lists);die;

        return view('hcompany.indexschedule',compact('lists','namebycode','ttlpage','ttl','today','tweek'));
    }

   /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function indexbill()
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

        $lists = DB::table('inflassign')
                ->select(
                    'Influencer.name as Influencername',
                    'Influencer.id as Influencerid',
                    'Hcompany.name as Hcompanyname',
                    'Task.positionname as Taskname', 
                    'Task.created_at as Taskcreateddate', 
                    'inflassign.*',
                    )
                ->where('inflassign.moneyin','>',0)
                ->whereIn('inflassign.inflstatus',["9"])
                ->where(function($query) use ($kword){
                    if (!empty($kword)) {
                         $query->where('Task.positionname','LIKE','%'.$kword.'%');
                    }
                 })
                ->where(function($query) use ($start , $end){
                    if (!empty($start)) {
                         $query->where('Task.created_at', '>',$start);
                    }
                    if (!empty($end)) {
                         $query->where('Task.created_at', '<',$end);
                    }
                 })
                ->join('users as Influencer', function ($join) {
                    $join->on('inflassign.inflid', '=', 'Influencer.id')
                         ->where('Influencer.role','host')
                         ->where('Influencer.created_by',Auth::user()->id);
                })

                ->join('users as Hcompany', function ($join) {
                    $join->on('Influencer.created_by', '=', 'Hcompany.id')
                         ->where('Hcompany.role','hcompany');
                })
                ->join('task as Task', function ($join) {
                    $join->on('inflassign.taskid', '=', 'Task.hashid');
                })

                ->orderBy('inflassign.created_at', 'desc')->paginate($limit);

        // print_r(auth::user()->id);die;

        $ttl = $lists->total();
        $ttlpage = (ceil($ttl / $limit));

        // print_r($lists);die;

        return view('hcompany.indexbill',compact('lists','ttlpage','ttl'));

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
                    ->where(function($query) use ($kword){
                         $query->where('title','LIKE','%'.$kword.'%');
                     })
                    ->where('created_by',Auth::user()->id)
                    ->where('for','gallery')
                    ->where('type','LIKE','%bunrui%')
                    ->orderBy('created_at', 'desc')->paginate($limit);


        $ttl = $lists->total();
        $ttlpage = (ceil($ttl / $limit));

        // $hcompanies = array();
        // print_r($lists);die;

        return view('hcompany.indexgallery',compact('lists','ttlpage','ttl'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Hcompany  $hcompany
     * @return \Illuminate\Http\Response
     */
    public function registernotify(Request $request , $seminarid)
    {


        // $pusher = event(new NotifyUser('hello world'));
        // echo "21212";
        // print_r($seminarid);
        return view('hcompany.registernotify',compact('seminarid'));

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Hcompany  $hcompany
     * @return \Illuminate\Http\Response
     */
    public function postnotify(Request $request )
    {

        // print_r(date('Y-m-d' , strtotime('-7 days')));
        // // die;
        // echo "<br><br>";

        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required',
        ]);

        $seminarid = substr($request->id, 5);
        $seminar = Seminar::find($seminarid);

        $joinlist = array_filter(explode('.', $seminar->joinlist));

        foreach ($joinlist as $key => $value) {
            $joinlist[$key] = +$value;
        }

        $joinlist[] = $seminar->host_id;

        $adminid = User::where('role', 'admin')
                    ->get();

        foreach ($adminid as $key => $value) {
            $joinlist[] = $value->id;
        }

        $joinlist[] = Auth::user()->id;

        $lists = User::whereIn('users.id', $joinlist)
                    ->get();

        $lists = $lists->pluck('noti', 'id');
        // print_r(date("Y-m-d H:i"));
        $notiarr = array('doneread' => 0, 
                         'time' => date("Y-m-d H:i"), 
                         'title' => $request->title, 
                         'seminarname' => $seminar->name, 
                         'content' => $request->content
                         );
        $notistr = json_encode($notiarr);
        
        // print_r($notiarr);die;
        foreach ($lists as $key => $value) {
            // echo $key."  ".$value."<br>";
            if (empty($value)) {
                $noti = json_encode(array(time() => $notistr));
            } else {
                $dbarr = json_decode($value, true);
                // echo "<br><br>".$key;
                // echo count($dbarr);
                $dbarr[time()] = $notistr;
                foreach ($dbarr as $k => $value) {
                    # code...
                    $value = json_decode($value);
                    if ($value->time < date('Y-m-d' , strtotime('-7 days'))) {
                        unset($dbarr[$k]);
                    } 
                }
                $noti = json_encode($dbarr);
            }
            
            User::find($key)->update(array('noti'=>$noti,));
        }

        // die;
        return redirect('hcompany/seminars')->with('success','送信されました。');
        // return view('hcompany.registernotify',compact('semid'));

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
                             'test.*')
                    ->whereNotNull('test.getmark')
                    ->whereNotNull('test.fullmark')
                    ->where('host.created_by', Auth::user()->id)

                    ->where(function($query) use ($kword){
                        if (!empty($kword)) {
                             $query->where('answerer.name','LIKE','%'.$kword.'%')
                                   ->orwhere('sem.name','LIKE','%'.$kword.'%')
                                   ->orwhere('host.name','LIKE','%'.$kword.'%');
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
                    ->orderBy('sem.start', 'desc')->paginate($limit);

        $ttl = $lists->total();
        $ttlpage = (ceil($ttl / $limit));


            // $table->foreignId('payer_id');
            // $table->foreignId('seminar_id');
            // $table->string('sem_fee')->nullable();
        // print_r($lists);
        // die;

        return view('hcompany.indexresult',compact('lists','ttlpage','ttl','namebycode'));
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
                    ->select('U.name as hostname', 'seminars.*')
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
                             ->where('U.created_by',Auth::user()->id)
                             ->where('U.role','host');
                    })
                    ->orderBy('seminars.start', 'desc')->paginate($limit);

        $ttl = $lists->total();
        $ttlpage = (ceil($ttl / $limit));

        foreach ($lists as $key => $value) {
            $lists[$key]->joincount = count(array_filter(explode('.', $value->joinlist)));
            $lists[$key]->ttlper = ($lists[$key]->joincount)*($value->fee);
        }
        return view('hcompany.indexsales',compact('lists','ttlpage','ttl'));
    }



}
