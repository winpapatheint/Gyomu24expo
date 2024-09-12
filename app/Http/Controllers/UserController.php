<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

use App\Http\Traits\ZoomTrait;
use App\Http\Traits\TestTrait;

use App\Models\Seminar;

use Illuminate\Support\Facades\DB;

use Illuminate\Support\Facades\Auth;

use Carbon\Carbon;

use DateTime;

use Hashids\Hashids;

use Validator;

use Illuminate\Support\Facades\Notification;
use App\Notifications\NewTaskApply;

class UserController extends Controller
{
    use ZoomTrait;
    use TestTrait;

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function setmoneyinpaiddate(Request $request)
    {

        // print_r($request->all());die;
        $vallarr = [
            'setmoneyinpaiddateid' => 'required|string|max:255',
        ];

        if ($request->moneyinpaiddate != '0') { //  allow 0 to submit
            $vallarr['moneyinpaiddate'] = 'required';
        } 

        $validator = Validator::make($request->all(), $vallarr,
        [
            'moneyinpaiddate.required' => '支払日を入力してください',
        ]);

        if($request->ajax()){
        
            if ($validator->passes()) {
                return response()->json(['success'=>'allpasses']);
            }         
            return response()->json(['error'=>$validator->errors()]);
        
        } 
        
        // die('2121');
        DB::table('inflassign')->where('id',$request->setmoneyinpaiddateid)->update(array('moneyinpaiddate'=>$request->moneyinpaiddate));
        
        return redirect()->back()->with('success','更新されました。');


    }

    public function getcomplist(Request $request)
    {


        if($request->ajax()){

        $lists = DB::table('companydetail')
                    ->select('companydetail.*')
                    ->where('companydetail.hcompanyid',Auth::user()->id)
                    ->orderBy('companydetail.created_at', 'desc')->get();

                return response()->json(['success'=>$lists]);
            return response()->json(['error'=>'sasa222']);
        
        }

    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function addcompanydetail(Request $request)
    {

        $validator = $this->validatecompanydetail($request);

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

        DB::table('companydetail')->insert([
            'hcompanyid' => Auth::user()->id ,
            'name' => $request->name ,
            'address' => $request->address ,
            'url' => $request->url ,
            'companyinfo' => $request->companyinfo ,
            'companycontent' => $request->companycontent ,
            'teampax' => $request->teampax ,
            'dob' => date('Y/m/01 00:00', strtotime($request->dob)) ,
            'cate1' => $request->cate1 ,
            'cate2' => $request->cate2 ,
            'cate3' => $request->cate3 ,
            'cate4' => $request->cate4 ,
            'image' => $imageName,
            "created_at" => new \DateTime() 
        ]);

        return redirect('/makeapplication')->with('success', __('auth.doneregister', ['name' => $request->name]));
    }

    public function validatecompanydetail($request) 
    {

        $check = [
            'name' => 'required|string|max:255',
            // 'address' => 'required|string|max:255',
            // 'url' => 'required|string|max:255',
            // 'image' => 'required|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ];

        // print_r("$request->check");die;
        $validator = Validator::make($request->all(), $check);

        return $validator;

    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function edittask($id)
    {
        $task = DB::table('task')
                    ->find($id);
        $editmode = true;

        // die('2121');
        return view('user.makeapplication',compact('task','editmode'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function savetask(Request $request)
    {

        $check = [
            'teamname' => 'required|string|max:255',
            'expireddate' => 'required|string|max:255',
            'positionname' => 'required|string|max:255',
            'openingcount' => 'required|not_in:0',
            'positioncategory' => 'required|not_in:0',
            'positiondivision' => 'required|not_in:0',
            'gender' => 'required|not_in:0',
            'worklocation' => 'required|string|max:255',
            'jobdesp'=>'required|string',
            'requiredskill'=>'required|string',
            'educationlevel' => 'required|not_in:0',
            'startage' => 'required|not_in:0',
            'untilage' => 'required|not_in:0',
            'previouscompanies' => 'required|not_in:0',
            'inexperienced' => 'required|not_in:0',
            'foreign' => 'required|not_in:0',
            'englishlvl' => 'required|not_in:0',
            'drivinglicense' => 'required|not_in:0',
            'divisionname' => 'required|string|max:255',
            'divisiondetails'=>'required|string',
            'salaryfrom' => 'required|not_in:0',
            'salaryto' => 'required|not_in:0',
            'salarysystem' => 'required|not_in:0',
            'annualleave'=>'required|numeric',
            'leavedetails'=>'required|string',
            'welfare'=>'required|string',
            'smoking' => 'required|not_in:0',
        ];

        if ((empty($request->id))  OR $request->makenew ) {

            $check['image'] = 'required|mimes:jpeg,png,jpg,gif,svg|max:3048';
        }

        // print_r("$request->check");die;
        $validator = Validator::make($request->all(), $check,
        [
            'name.required' => __('validation.pleasefilltaskname'),
            'description.required' => __('validation.pleasefilltaskmsg'),
        ]);

        if($request->ajax()){
        
            if ($validator->passes()) {
                return response()->json(['success'=>'allpasses']);
            }         
            return response()->json(['error'=>$validator->errors()]);
        
        }

        // // print_r(new \DateTime());

        // $startdate = new DateTime($request->expireddate);
        // // // echo json_encode($request->checkpoint);


        $data=array(
                //"user"=>Auth::user()->id,
                'teamname' => $request->teamname,
                'expireddate' => new DateTime($request->expireddate),
                'positionname' => $request->positionname,
                'openingcount' => $request->openingcount,
                'positioncategory' => $request->positioncategory,
                'positiondivision' => $request->positiondivision,
                'attractcustomer' => $request->attractcustomer,
                'checkpoint' => json_encode($request->checkpoint),
                'worklocation' => $request->worklocation,
                'jobdesp' => $request->jobdesp,
                'workdetail' => $request->workdetail,
                'workexperience' => $request->workexperience,
                'requiredskill' => $request->requiredskill,
                'educationlevel' => $request->educationlevel,
                'startage' => $request->startage,
                'untilage' => $request->untilage,
                'previouscompanies' => $request->previouscompanies,
                'gender' => $request->gender,
                'inexperienced' => $request->inexperienced,
                'foreign' => $request->foreign,
                'englishlvl' => $request->englishlvl,
                'drivinglicense' => $request->drivinglicense,
                'divisionname' => $request->divisionname,
                'divisiondetails' => $request->divisiondetails,
                'positionoffer' => $request->positionoffer,
                'workinghourtype' => $request->workinghourtype,
                'workinghourreduce' => $request->workinghourreduce,
                'overtime' => $request->overtime,
                'selectiondetails' => $request->selectiondetails,
                'salaryfrom' => $request->salaryfrom,
                'salaryto' => $request->salaryto,
                'probation' => $request->probation,
                'salarysystem' => $request->salarysystem,
                'annualleave' => $request->annualleave,
                'leavedetails' => $request->leavedetails,
                'smoking' => $request->smoking,
                'smokingdetails' => $request->smokingdetails,
                'welfare' => $request->welfare,
                //'image' => $imageName,
                //"created_at"=> new \DateTime(),
                );



        if (!empty($request->image)) {
            $imageName = time().'.'.$request->image->extension();           
            $request->image->move(public_path('images/avatar'), $imageName);
            $data['image'] = $imageName;
        } else {
            $imageName = '';
        }

        if ((empty($request->id))  OR $request->makenew ) {


            

            $hashids = new Hashids();

            $data['user'] = Auth::user()->id;
            $data['created_at'] = new \DateTime();
            $data['hashid'] = $hashids->encode(date("YmdHisu")); 
            DB::table('task')->insert($data);

            // $earlyid = $id = DB::getPdo()->lastInsertId();
            // $goodid = false;
            // do{

            //     $hashid = $id.$hashids->encode($id);

            //     $count = DB::table('task')
            //             ->where('hashid',$hashid)->count();

            //     if (empty($count)) {
            //         $goodid = true;
            //         $updval = array(
            //                         'hashid' => $hashid,
            //                         );
                    
            //         // print_r($hashid . '>>'.$id);
            //     } else {
            //         // print_r($hashid . '<<'.$id);

            //     }
            //     // echo "<br>";
                
            //     $id++;

            // }

            // while($goodid == false);


            // DB::table('task')->where('id',$earlyid)->update(['hashid' => $hashid]);
         // print_r($updval);
         // // print_r($data);
         // die;
            
            // Notification case 1
            $admin = User::where('role','admin')->get();
            Notification::send($admin, new NewTaskApply($admin));

            $msg = __('user.doneapply');




        } else {

            // print_r($request->all());
            // die('12121');
            $data['updated_at'] = new \DateTime();
            DB::table('task')->where('id',$request->id)->update($data);

            $msg = '更新されました。';
        }

        return redirect('/application')->with('success',$msg);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function indextask()
    {

            // $hashids = new Hashids();


            //     $hashid = $hashids->encode(34);

            // print_r($hashid);die;


        $limit = 10;
        if (!empty($_GET['kword'])) {
            $kword = $_GET['kword'];
        } else {
            $kword = '';
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

        $lists = DB::table('task')
                    ->select('Adminuser.name as subadminname','task.*')
                    ->where('task.positionname','<>','')
                    ->where('task.user',Auth::user()->id)
                    ->where(function($query) use ($kword){
                        if (!empty($kword)) {
                             $query->where('task.positionname','LIKE','%'.$kword.'%')
                             ;
                        }
                     })
                    ->where(function($query) use ($positioncategory , $statusarr){
                        if (!empty($positioncategory)) {
                            $query->where('task.positioncategory',$positioncategory);
                        }                        
                        if (!empty($statusarr)) {
                             $query->whereIn('task.status', $statusarr);
                        }
                     })
                    ->leftJoin('users as Adminuser', function ($join) {
                        $join->on('task.subadmin', '=', 'Adminuser.id')
                             ->where('Adminuser.role','admin');
                    })
                    ->orderBy('task.created_at', 'desc')->paginate($limit);

        $ttl = $lists->total();
        $ttlpage = (ceil($ttl / $limit));

        $inflassign = array();
        $inflids = array();

        if (!empty($_GET['inflstatus'])) {
            $inflstatus = $_GET['inflstatus'];
        } else {
            $inflstatus = '';
        }

        foreach ($lists as $key => $value) {
            // echo $value->hashid;
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
                                        ->whereIn('inflassign.inflstatus',["4","5","6","7","8","9"])
                                        ->join('users as Influencer', function ($join) {
                                            $join->on('inflassign.inflid', '=', 'Influencer.id')
                                                 ->where('Influencer.role','host');
                                        })

                                        ->join('users as Hcompany', function ($join) {
                                            $join->on('Influencer.created_by', '=', 'Hcompany.id')
                                                 ->where('Hcompany.role','hcompany');
                                        })
                                        ->join('task as Task', function ($join) {
                                            $join->on('inflassign.taskid', '=', 'Task.hashid')
                                                 ->where('Task.user',Auth::user()->id);
                                        })

                                        ->orderBy('inflassign.created_at', 'desc')->get();
            
            foreach ($inflassign[$value->hashid] as $item) {
                $inflids[] = $item->Influencerid;
            }                           

        }

        $influencers = User::where('role','host')->whereIn('id',array_unique($inflids))->get();
        // print_r($lists);die;

            return view('user.indexjob',compact('lists','ttlpage','ttl','inflassign','influencers'));

        // return view('user.indextask',compact('lists','ttlpage','ttl','inflassign','influencers'));
    }

    public function indexapplyseminars()
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
        } else {
            $start = '';
        } 

        if (!empty($_GET['end'])) {
            $end = $_GET['end'];
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

        // print_r($start." 00:00:00");
        // echo '<br>';
        // print_r($end." 23:59:59");
        // die;

        $startdate = new DateTime($start);
        $enddate = new DateTime($end);

        if($enddate < $startdate) {
            return back()->with('errorsearch',__('user.datesearcherror'));
        }

        $lists = DB::table('semtype')
                    ->where('name','<>','')
                    ->get();
        $listsarr = $lists->toArray();
        $namebycode = array_column($listsarr, 'name', 'code');

        $lists = DB::table('seminars')
                    ->select('Company.name as companyname','U.name as hostname', 'U.profileimg as profileimg', 'U.profile as profile', 'seminars.*')
                    ->where('seminars.name','<>','')
                    ->where('seminars.open','1')
                    // ->where('start', '>', date("Y/m/d H:i:s",strtotime(date("Y/m/d H:i:s")." +10 minutes")))
                    ->where('end', '>', date("Y/m/d H:i:s",strtotime(date("Y/m/d H:i:s"))))
                    ->where('seminars.semtype_id','LIKE','%b3%')
                    // ->whereDate('start', '>', date("Y/m/d 23:59:59"))
                    // ->where(function($query) use ($fee){
                    //         if (empty($fee)) {
                    //             $query->where('seminars.fee','0');
                    //         }
                    //  })

                    ->where(function($query) use ($kword , $start , $end , $semtype_id , $fee){
                        if (!empty($kword)) {
                             $query->where('seminars.name','LIKE','%'.$kword.'%')
                             ->orwhere('seminars.description','LIKE','%'.$kword.'%')
                             ->orwhere('U.name','LIKE','%'.$kword.'%')
                             ->orwhere('Company.name','LIKE','%'.$kword.'%');
                        }
                        if (!empty($semtype_id)) {
                             $query->where('seminars.semtype_id','LIKE','%'.$semtype_id.'%');
                        }
                        if (!empty($start)) {
                             $query->where('seminars.start', '>',$start." 00:00:00");
                        }
                        if (!empty($end)) {
                             $query->where('seminars.end', '<',$end." 23:59:59");
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
                    ->join('users as U', function ($join) {
                        $join->on('seminars.host_id', '=', 'U.id')
                             ->where('U.role','host');
                    })
                    ->join('users as Company', function ($join) {
                        $join->on('U.created_by', '=', 'Company.id')
                             ->where('Company.role','hcompany');
                    })
                    ->orderBy('seminars.start', 'asc')->paginate($limit);

        $ttl = $lists->total();
        $ttlpage = (ceil($ttl / $limit));

        // print_r($lists);die;

        return view('user.indexbooktest',compact('lists','namebycode','ttlpage','ttl'));
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $userid = '.'.sprintf("%05d", Auth::user()->id);

        // print_r($userid);die;
        //
        $limit = 9999;

        $lists = DB::table('exhibit')
                    ->orderBy('taskdate', 'desc')->paginate($limit);

        // print_r($lists);die;
        $ttl = $lists->total();
        $ttlpage = (ceil($ttl / $limit));

        return view('user.indexschedule',compact('lists'));
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function indexjoinedseminars()
    {

        $limit = 10;
        if (!empty($_GET['kword'])) {
            $kword = $_GET['kword'];
        } else {
            $kword = '';
        }    

        if (!empty($_GET['start'])) {
            $start = $_GET['start'];
        } else {
            $start = '';
        } 

        if (!empty($_GET['end'])) {
            $end = $_GET['end'];
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
                ->where('Task.user',auth::user()->id)
                ->whereIn('inflassign.inflstatus',["9"])
                ->where(function($query) use ($kword){
                    if (!empty($kword)) {
                         $query->where('Task.positionname','LIKE','%'.$kword.'%');
                    }
                 })
                ->where(function($query) use ($start , $end){
                    if (!empty($start)) {
                         $query->where('inflassign.moneyinpaiddate', '>',$start);
                    }
                    if (!empty($end)) {
                         $query->where('inflassign.moneyinpaiddate', '<',$end);
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
                ->join('task as Task', function ($join) {
                    $join->on('inflassign.taskid', '=', 'Task.hashid')
                         ->where('Task.user',Auth::user()->id);
                })

                ->orderBy('inflassign.created_at', 'desc')->paginate($limit);

        // print_r(auth::user()->id);die;

        $ttl = $lists->total();
        $ttlpage = (ceil($ttl / $limit));


        return view('user.indexjoinedseminars',compact('lists','ttlpage','ttl'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function applyseminar(Request $request)
    {

        $id = $request->id;

        $dbid = sprintf("%05d", $id);

        $sem = Seminar::find($id);
        

        if (str_contains($sem->semtype_id, 'b3')) {
            $goto = '/booktest';
        } else {
            $goto = '/bookseminars';
        }

        // print_r($sem);die;
        if (!empty($sem->passkey)) {
            if ($request->passkey != $sem->passkey ) {
                return redirect($goto)->with('error','予約が失敗されました。予約するには予約許可番号の入力が必要です。');
            }
        }
 
        // print_r($sem);
        // die('applyseminar');

        $dateTimeObject1 = date_create(date('Y-m-d H:i')); 
        $dateTimeObject2 = date_create($sem->start); 
          
        $difference = date_diff($dateTimeObject1, $dateTimeObject2); 
        $minutes = ($difference->days * 24 * 60)+($difference->h * 60)+($difference->i);

        if($minutes < 10) {
            return redirect($goto)->with('error','開始日時の10分前まで予約可能です。');            
        }

        $userid = '.'.sprintf("%05d", Auth::user()->id);
        if (!empty($sem->joinlist)) {
            if (str_contains($sem->joinlist, $userid)) {
                return redirect($goto)->with('error','重複予約はできません。');
            }
        }

        $joinlist = array_filter(explode('.', $sem->joinlist));
        if (count($joinlist) > $sem->limit) {
            return redirect($goto)->with('error','満席のセミナーです。');   
        }

        if (empty($sem->fee)) {
          
            if ($this->registerjoinseminar($sem)) {
                return redirect('/user')->with('success','予約されました。');
            }
            return redirect($goto)->with('error','重複予約はできません。');

        } else {
            $userprofile = Auth::user();

            if (is_null($userprofile->cartlist)) {
                $userprofile->cartlist = '';
            }

            if (str_contains($userprofile->cartlist, '.'.$dbid)) {
                return redirect($goto)->with('error','カートに追加されたセミナーです。');
            } else {
                $userprofile->update(['cartlist' => $userprofile->cartlist.'.'.$dbid]); 
                return redirect('/cart')->with('success','追加されました。');
            }
        }

    }

    function registerjoinseminar($sem='' , $paypal_id = '')
    {
        $userid = '.'.sprintf("%05d", Auth::user()->id);
        // print_r($userid);die;

        if (empty($sem->joinlist)) {
            $sem->joinlist = '';
        }

        if (str_contains($sem->joinlist, $userid)) {
            return false;
        } else {
            $sem->update(['joinlist' => $sem->joinlist.$userid]);

            $time = new DateTime();

            DB::table('payment')->insert([
                'payer_id' => Auth::user()->id,
                'seminar_id' => $sem->id,
                'sem_fee' => $sem->fee,
                'paypal_id' => $paypal_id,
                'created_at' => $time->format('Y-m-d H:i:s'),
                'updated_at' => $time->format('Y-m-d H:i:s')
            ]);

            return true;
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function indexcart()
    {
        //
        $semids = array_filter(explode('.', auth::user()->cartlist));
        // $lists = DB::table('seminars')->whereIn('id', $semids);
        foreach ($semids as $key => $value) {
            $semids[$key] = +$value;
        }

        // print_r($semids);die;
        $ids_ordered = implode(',', array_reverse($semids));

        $lists = DB::table('seminars')
                    ->select('U.name as hostname', 'seminars.*')
                    ->whereIn('seminars.id', $semids)
                    ->join('users as U', function ($join) {
                        $join->on('seminars.host_id', '=', 'U.id')
                             ->where('U.role','host');
                    })
                    ->orderByRaw("FIELD(seminars.id, $ids_ordered)")
                    ->paginate(1000)
                    ;

        $ttl = $lists->total();

        $listsarr = $lists->map(function ($item, $key) {
            return [
                'id' => $item->id,
                'fee' => $item->fee,
                'name' => $item->name,
                'start' => $item->start,
                'hostname' => $item->hostname
            ];
        });

        $listsarr = json_encode($listsarr->toArray());
        // print_r( json_decode($listsarr));die;

        return view('user.indexcart',compact('lists','ttl','listsarr'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function removefromcart(Request $request)
    {
        $id = $request->id;

        $dbid = sprintf("%05d", $id);

        // print_r($dbid);die;

        $userprofile = Auth::user();

        if (str_contains($userprofile->cartlist, '.'.$dbid)) {
            // print_r($userprofile->cartlist);
            $newcartlist = str_replace('.'.$dbid,"",$userprofile->cartlist);
            // echo '<br>';
            // print_r($newcartlist);
            // die('can remove');
            $userprofile->update(['cartlist' => $newcartlist]); 
            return redirect('/cart')->with('success','削除されました。');
        } else {
            // die('cannot remove');
            return redirect('/cart')->with('error','カートに登録されていないセミナーです。');
        }

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function makepay(Request $request)
    {
        //

// print_r( json_decode($request->listsarr) );
// print_r($request->all());die;

        $listsarr = json_decode($request->listsarr);

        $arrayitem = array();

        foreach ($listsarr as $key => $value) {
            $arrayitem[] = '    {
              "name": "'.$value->name.'",
              "description": "開始日時：'.date('Y/m/d H:i', strtotime($value->start)).' 教師名： '.$value->hostname.'",
              "quantity": "1",
              "unit_amount": {
                "currency_code": "JPY",
                "value": "'.$value->fee.'"
              },
              "tax": {
                "name": "税金",
                "percent": "10"
              },
              "unit_of_measure": "AMOUNT"
            }';
        }


        $itemstr = implode(',', $arrayitem);

        // die;
        $url = "https://api-m.sandbox.paypal.com/v1/oauth2/token";

        $curl = curl_init($url);
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_POST, true);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

        $headers = array(
           "Accept: application/json",
           "Accept-Language: en_US",
           "Content-Type: application/x-www-form-urlencoded",
           "Authorization: Basic QVIybG9rRnFCWGNkX21SZG9hNUxLWUE5THdkQjV4Q04zcGM4dTE1X0ZmNWZkc3YzYWl0TFlUbjhtS1F6LVpKNHlTSE5PS1N4VDJqTlBpYWQ6RUcta2p5YUFCNlE1Z2J3YThZODQxRFYyc1cxOHVSRTFKc1g4bDRrbUhzUF8xc2xGcGdxTUtwV0tqSUNtdkZ1aDhTVW5fRDhOeWczcUFCbkc=",
                );
        curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);

        $data = "grant_type=client_credentials";

        curl_setopt($curl, CURLOPT_POSTFIELDS, $data);

        //for debug only!
        curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);

        $resp = curl_exec($curl);
        curl_close($curl);
        // var_dump($resp);
        $resp = json_decode($resp);

        // print_r($resp->access_token);
        $access_token = $resp->access_token;

$url = "https://api-m.sandbox.paypal.com/v2/invoicing/invoices";

$curl = curl_init($url);
curl_setopt($curl, CURLOPT_URL, $url);
curl_setopt($curl, CURLOPT_POST, true);
curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

$headers = array(
   "Content-Type: application/json",
   "Authorization: Bearer $access_token",
);
curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);

$name  = auth::user()->name;
$email = auth::user()->email;
$phone = auth::user()->phone;
$address = auth::user()->address;
$invoicenumber = time();


$data = <<<DATA
{
  "detail": {
    "invoice_number": "{$invoicenumber}",
    "reference": "deal-ref",
    "invoice_date": "2021-06-29",
    "currency_code": "JPY",
    "note": "よろしくお願いします。",
    "term": "No refunds after 30 days.",
    "memo": "This is a long contract",
    "payment_term": {
      "term_type": "DUE_ON_RECEIPT"
    }
  },
  "invoicer": {
    "name": {
      "given_name": "セミナーナビ",
      "surname": "アジアジンザイHD"
    },
    "address": {
      "address_line_1": "和田ビル502号",
      "address_line_2": "4-27-5",
      "admin_area_1": "東京都豊島区池袋",
      "postal_code": "171-0014"
    },
    "email_address": "sb-h7vok6649676@business.example.com",
    "phones": [
      {
        "country_code": "081",
        "national_number": "{$phone}",
        "phone_type": "HOME"
      }
    ],
    "website": "www.seminar-navi.jp",
    "tax_id": "{$invoicenumber}",
    "logo_url": "https://i.ibb.co/L0p1Rtv/logo-v3.png",
    "additional_notes": "アジア人材開発株式会社"
  },
  "primary_recipients": [
    {
      "billing_info": {
        "name": {
          "given_name": "{$name}",
          "surname": ""
        },
        "address": {
          "address_line_1": "{$address}",
          "country_code": "JP"
        },
        "email_address": "{$email}",
        "phones": [
          {
            "country_code": "001",
            "national_number": "4884551234",
            "phone_type": "HOME"
          }
        ],
        "additional_info_value": ""
      }
    }
  ],
  "items": [ {$itemstr}
  ],
  "configuration": {
    "partial_payment": {
      "allow_partial_payment": false
    },
    "tax_inclusiveboolean": true,
    "allow_tip": false,
    "tax_calculated_after_discount": true,
    "tax_inclusive": true,
    "template_id": ""
  }
}
DATA;

curl_setopt($curl, CURLOPT_POSTFIELDS, $data);

//for debug only!
curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);

$resp = curl_exec($curl);
curl_close($curl);
// var_dump($resp);die;
$resp = json_decode($resp);


$url = $resp->href;

$id = substr($url, strrpos($url, '/') + 1);

// print_r($id);


$url = "https://api-m.sandbox.paypal.com/v2/invoicing/invoices/".$id."/send";

$curl = curl_init($url);
curl_setopt($curl, CURLOPT_URL, $url);
curl_setopt($curl, CURLOPT_POST, true);
curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

$headers = array(
   "Content-Type: application/json",
   "Authorization: Bearer ".$access_token,
   "PayPal-Request-Id: b1d1f06c7246c",
);
curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);

$data = <<<DATA
{
  "send_to_invoicer": true
}
DATA;

curl_setopt($curl, CURLOPT_POSTFIELDS, $data);

//for debug only!
curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);

$resp = curl_exec($curl);
curl_close($curl);

$resp = json_decode($resp);



    return redirect($resp->href); 




        // die('paymentpaypal');


        $semids = array_filter(explode('.', auth::user()->cartlist));
        // $lists = DB::table('seminars')->whereIn('id', $semids);

        if ( 1 == 1) {
        
            foreach ($semids as $key => $value) {
                // remove the initial 0 like 000019 to 19
                $semids[$key] = +$value;

                $sem = Seminar::find(+$value);
                  
                if ($this->registerjoinseminar($sem)) {
                    //do nothibg
                }

            }

            $userprofile = Auth::user();
            $userprofile->update(['cartlist' => '']);
            return redirect('/user')->with('success','payment done'); 

        } else {

            return back()->with('error','paymenterror');
        }
        // print_r($semids);die;
        // $ids_ordered = implode(',', array_reverse($semids));

        // $lists = DB::table('seminars')
        //             ->select('U.name as hostname', 'seminars.*')
        //             ->whereIn('seminars.id', $semids)
        //             ->join('users as U', function ($join) {
        //                 $join->on('seminars.host_id', '=', 'U.id')
        //                      ->where('U.role','host');
        //             })
        //             ->orderByRaw("FIELD(seminars.id, $ids_ordered)")
        //             ->paginate(1000)
        //             ;

        // $ttl = $lists->total();

        // return view('user.indexcart',compact('lists','ttl'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function paymentdone(Request $request)
    {

        if (DB::table('task')->where('hashid',$request->hashid)->update(array('paypal'=>$request->paypalid))) {
            return response()->json(['success'=> true]);
        } else {
            return response()->json(['error'=> false]);
        }


    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function indexbooktest()
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
        } else {
            $start = '';
        } 

        if (!empty($_GET['end'])) {
            $end = $_GET['end'];
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

        // print_r($start." 00:00:00");
        // echo '<br>';
        // print_r($end." 23:59:59");
        // die;

        $startdate = new DateTime($start);
        $enddate = new DateTime($end);

        if($enddate < $startdate) {
            return back()->with('errorsearch',__('user.datesearcherror'));
        }

        $lists = DB::table('semtype')
                    ->where('name','<>','')
                    ->get();
        $listsarr = $lists->toArray();
        $namebycode = array_column($listsarr, 'name', 'code');

        $lists = DB::table('seminars')
                    ->select('Company.name as companyname','U.name as hostname', 'U.profileimg as profileimg', 'U.profile as profile', 'seminars.*')
                    ->where('seminars.name','<>','')
                    ->where('seminars.open','1')
                    // ->where('start', '>', date("Y/m/d H:i:s",strtotime(date("Y/m/d H:i:s")." +10 minutes")))
                    ->where('end', '>', date("Y/m/d H:i:s",strtotime(date("Y/m/d H:i:s"))))
                    ->where('seminars.semtype_id','LIKE','%b3%')
                    // ->whereDate('start', '>', date("Y/m/d 23:59:59"))
                    // ->where(function($query) use ($fee){
                    //         if (empty($fee)) {
                    //             $query->where('seminars.fee','0');
                    //         }
                    //  })

                    ->where(function($query) use ($kword , $start , $end , $semtype_id , $fee){
                        if (!empty($kword)) {
                             $query->where('seminars.name','LIKE','%'.$kword.'%')
                             ->orwhere('seminars.description','LIKE','%'.$kword.'%')
                             ->orwhere('U.name','LIKE','%'.$kword.'%')
                             ->orwhere('Company.name','LIKE','%'.$kword.'%');
                        }
                        if (!empty($semtype_id)) {
                             $query->where('seminars.semtype_id','LIKE','%'.$semtype_id.'%');
                        }
                        if (!empty($start)) {
                             $query->where('seminars.start', '>',$start." 00:00:00");
                        }
                        if (!empty($end)) {
                             $query->where('seminars.end', '<',$end." 23:59:59");
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
                    ->join('users as U', function ($join) {
                        $join->on('seminars.host_id', '=', 'U.id')
                             ->where('U.role','host');
                    })
                    ->join('users as Company', function ($join) {
                        $join->on('U.created_by', '=', 'Company.id')
                             ->where('Company.role','hcompany');
                    })
                    ->orderBy('seminars.start', 'asc')->paginate($limit);

        $ttl = $lists->total();
        $ttlpage = (ceil($ttl / $limit));

        // print_r($lists);die;

        return view('user.indexbooktest',compact('lists','namebycode','ttlpage','ttl'));
    }


   /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function indexresult()
    {

        $this->calculatetest();        

        $lists = DB::table('semtype')
                    ->where('name','<>','')
                    ->get();
        $listsarr = $lists->toArray();
        $namebycode = array_column($listsarr, 'name', 'code');
        //
        $limit = 10;

        $lists = DB::table('test')
                    ->select('sem.name as testname',
                             'sem.start as teststart',
                             'sem.semtype_id as testsemtype_id',
                             'test.*')
                    ->whereNotNull('test.getmark')
                    ->whereNotNull('test.fullmark')
                    ->where('test.tester', Auth::user()->id)
                    ->join('seminars as sem', function ($join) {
                        $join->on('test.testid', '=', 'sem.id')
                        ;
                    })
                    ->orderBy('sem.start', 'desc')->paginate($limit);

        $ttl = $lists->total();
        $ttlpage = (ceil($ttl / $limit));

        return view('user.indexresult',compact('lists','ttlpage','ttl','namebycode'));
    }
}
