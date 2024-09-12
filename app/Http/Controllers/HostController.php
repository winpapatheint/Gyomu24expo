<?php

namespace App\Http\Controllers;

use App\Models\Host;
use Illuminate\Http\Request;

use App\Models\Seminar;


use Illuminate\Support\Facades\Auth;

use App\Http\Traits\ZoomTrait;
use App\Http\Traits\TestTrait;
use DateTime;

use Illuminate\Auth\Events\Registered;

use App\Models\User;

use Illuminate\Support\Facades\DB;

use DateInterval;

use Redirect;

use Validator;

use Illuminate\Support\Facades\Storage;


class HostController extends Controller
{
    use ZoomTrait;
    use TestTrait;

    public function downloadguidance()
    {
        // die($_GET['d']);

        $fileName = $_GET['d'];
        $filePath = 'public/'.$fileName;

        $mimeType = Storage::mimeType($filePath);

        $headers = [['Content-Type' => $mimeType]];

        return Storage::download($filePath, $fileName, $headers);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function indexschedule()
    {
        $userid = '.'.sprintf("%05d", Auth::user()->id);
        //
        $limit = 1000;

        $lists = DB::table('semtype')
                    ->where('name','<>','')
                    ->get();
        $listsarr = $lists->toArray();
        $namebycode = array_column($listsarr, 'name', 'code');

        $lists = DB::table('seminars')
                    ->where('seminars.name','<>','')
                    // ->where('seminars.open','1')
                    // ->where('seminars.host_id', Auth::user()->id)
                    ->orderBy('seminars.start', 'asc')
                    ->paginate($limit)
                    ;

        $ttl = $lists->total();
        $ttlpage = (ceil($ttl / $limit));

// print_r($lists);die;


        $today = array();
        $tweek = array();
        
        $todaysta = strtotime(date("Y-m-d 00:00:00"));
        $todayend = strtotime(date("Y-m-d 23:59:59"));

        $tweeksta = strtotime(date("Y-m-d 00:00:00", strtotime("+1 day")));
        $tweekend = strtotime(date("Y-m-d 23:59:59", strtotime("+7 day")));

        foreach ($lists as $key => $value) {
            # code...
                if (is_null($value->joinlist)) {
                    $value->joinlist = '';
                }
                if (!str_contains($value->joinlist, $userid)) {
                    $lists[$key]->joinurl = '';
                }

                $starttime = strtotime($value->start);

                if ( ($todaysta < $starttime) && ($starttime < $todayend) ) {
                    $today[] = $key;
                } else if ( ($tweeksta < $starttime) && ($starttime < $tweekend) ) {
                    $tweek[] = $key;
                }

        }
        return view('host.indexschedule',compact('lists','today','tweek'));
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function indexseminars()
    {
        //
        $limit = 10;
 
        $lists = DB::table('inflassign')
                    ->select(
                        'Influencer.name as Influencername',
                        'Influencer.created_by as Influencercreated_by',
                        'Task.hashid as hashid', 
                        'Task.id as taskidno', 
                        'Task.created_at as taskcreated_at', 
                        'Task.*',
                        'inflassign.*',
                        'Hcompany.name as Hcompanyname',
                        )
                    ->where('Task.positionname','<>','')
                    ->join('task as Task', function ($join) {
                        $join->on('inflassign.taskid', '=', 'Task.hashid')
                             ->where('Task.status','>=',3);
                    })
                    ->join('users as Influencer', function ($join) {
                        $join->on('inflassign.inflid', '=', 'Influencer.id')
                             ->where('Influencer.id',Auth::user()->id)->where('role','host');
                    })
                    ->join('users as Hcompany', function ($join) {
                        $join->on('Influencer.created_by', '=', 'Hcompany.id')
                             ->where('Hcompany.role','hcompany');
                    })
                    ->orderBy('Task.created_at', 'desc')->paginate($limit);

        $ttl = $lists->total();
        $ttlpage = (ceil($ttl / $limit));

        // print_r($lists);die;

        return view('host.indexseminars',compact('lists','ttlpage','ttl'));
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function storeseminar(Request $request)
    {


        $check = [
            'seminar_name' => 'required|string|max:255',
            'startdt' => 'required',
            'enddt' => 'required|after:startdt',
            'description' => 'required',
        ];

        // print_r("$request->check");die;
        $validator = Validator::make($request->all(), $check,
        [
            'seminar_name.required' => '授業名を入力してください',
            'description.required' => '授業内容を入力してください',
        ]);

        if($request->ajax()){
        
            if ($validator->passes()) {
                return response()->json(['success'=>'allpasses']);
            }         
            return response()->json(['error'=>$validator->errors()]);
        
        }



        // print_r("Sasa");die;

        $start = $request->startdt;

        $request->startdt = $request->startdt.'+0000';
        $request->enddt = $request->enddt.'+0000';

        $f = strtotime($request->startdt);
        $t = strtotime($request->enddt);

        $f = gmdate("Y-m-d H:i:s ", $f);
        $t = gmdate("Y-m-d H:i:s ", $t);

        $f = new DateTime($f);
        $t = new DateTime($t);
        $diff = $f->diff($t);

        $minutes = ($diff->days * 24 * 60) +
                   ($diff->h * 60) + $diff->i;

        $host = Auth::user();

        // {"keyone":"o5xbQOVIQdeC1tTY6Em09w","keytwo":"wFGBPuJlIOuenIWTgOQZ4UihXnuTjX7VXn4d"}
        // print_r(Auth::user()->id);die;

        if (!empty(Auth::user()->zoomapi)) {
            $zoomapi = Auth::user()->zoomapi;
        } else {
            $zoomapi = $this->adminzoomkey();
        }
        // die;

        if (empty($request->id)) {

            $params = array($request->seminar_name,
                             $f->format('Y-m-d\TH:i:s'),
                             $minutes,
                             Auth::user()->zoomapi);

            // $zoom = $this->createZoomMeeting($request->seminar_name,
            //                                  $f->format('Y-m-d\TH:i:s'),
            //                                  $minutes,
            //                                  Auth::user()->zoomapi);

            $zoomaccarray = array('0' => 'コンシェルジュ', 
                                  '1' => 'アドミン',
                                );

            $zoomacc = '0';
            $zoomaccname = Auth::user()->name;
            $zoom = call_user_func_array(array($this, "createZoomMeeting"), $params);

            if (!$zoom) {
                $lists = DB::table('matters')->orwhere('for','adminzoomkey')->get();
                $params['3'] = $lists[0]->value;

                $zoomacc = '1';
                $zoom = call_user_func_array(array($this, "createZoomMeeting"), $params);    
                $zoomaccname = 'ADMIN';
            }

            if (!$zoom) {
                $zoomacc = '';
            }

            // print_r($zoom->host_email);
            // print_r($zoomacc);
            // die;


            $seminar = Seminar::create([
                'name' => $request->seminar_name,
                'start' => $f,
                'end' => $t,
                'description' => $request->description,
                'starturl' => $zoom->start_url ?? '',
                'joinurl' => $zoom->join_url ?? '',
                'zoomapi' => $zoom->id ?? '',
                'passcode' => $zoomacc,
                'formurl' => $request->formurl,
                'host_id' => $host->id,
            ]);
            event(new Registered($seminar));
            $msg = '「'.$request->seminar_name.'」登録されました。';
            if (!empty($zoom->host_email)) {
                $msg .= 'イベントは'.$zoomaccarray[$zoomacc].'の「'.$zoomaccname.'」のアカウントのZOOMキーで登録されました。';
            } else {
                // $msg .= 'ミーティングの登録が失敗しました。';
            }

        } else {
            $seminar = Seminar::find($request->id);
            

            // echo $t->format('Y-m-d H:i:s')."<br>";
            // die();
            if ( !($seminar->start == $f->format('Y-m-d H:i:s')) OR !($seminar->end == $t->format('Y-m-d H:i:s')) ) {

                // die('zoom '.Auth::user()->zoomapi);
                $host = User::find($seminar->host_id);
                
                $zoomid = (str_replace('https://us02web.zoom.us/j/', '', $seminar->joinurl));
                if (!empty($zoomid)) {

                    if ($seminar->passcode == '1') {
                        $lists = DB::table('matters')->orwhere('for','adminzoomkey')->get();
                        $zoomapi = $lists[0]->value;

                        // print_r($zoomapi);die;
                    } else {
                        $zoomapi =  Auth::user()->zoomapi;
                    }

                    // print_r($zoomapi);die;
                    

                    $zoomupdate = $this->updateZoomMeeting(  $request->seminar_name,
                                                             $f->format('Y-m-d\TH:i:s'),
                                                             $minutes,
                                                             $zoomapi,
                                                             $zoomid
                                                         );
                    if (!$zoomupdate) {
                        return redirect('/admin/events')->with('error','エラー：zoom API');
                    }
                }
            }
            $seminar->update([
                                'name' => $request->seminar_name,
                                'start' => $f,
                                'end' => $t,
                                'description' => $request->description,
                            ]);
            $msg = 'イベントが更新されました。';
        }

        return redirect('/admin/events')->with('success',$msg);
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

        $lists = DB::table('payment')
                    ->select('host.created_by as companyid',
                             'host.name as hostname',
                             'payer.name as payername',
                             'sem.name as seminarname',
                             'payment.*')
                    // ->where('host.created_by', Auth::user()->id)
                    ->where('host.id', Auth::user()->id)
                    ->join('seminars as sem', function ($join) {
                        $join->on('payment.seminar_id', '=', 'sem.id')
                            // ->where('sem.semtype_id','NOT LIKE','%b3%')
                        ;
                    })

                    ->join('users as payer', function ($join) {
                        $join->on('payment.payer_id', '=', 'payer.id')
                             ->where('payer.role','user');
                    })
                    ->join('users as host', function ($join) {
                        $join->on('sem.host_id', '=', 'host.id')
                             ->where('host.role','host');
                    })
                    ->orderBy('payment.created_at', 'desc')->paginate($limit);

        $ttl = $lists->total();
        $ttlpage = (ceil($ttl / $limit));


            // $table->foreignId('payer_id');
            // $table->foreignId('seminar_id');
            // $table->string('sem_fee')->nullable();
        // print_r($lists);die;

        return view('host.indexpayment',compact('lists','ttlpage','ttl'));
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function registerquestion(Request $request)
    {
        //
        $valarr = [
                    'qname' => 'required|string|max:255',
                    'qid' => 'required|string|max:255',
                    'qtype' => 'required|not_in:0',
                    'ansformat' => 'required|not_in:0',
                    'mark' => 'required|numeric|min:0|not_in:0',
                ];

        $qtype = $request->qtype;

        if (strpos($qtype, 'i') !== false) {
            $valarr['instruction'] = 'required';
        }

        if (strpos($qtype, 'c') !== false) {
            $valarr['content'] = 'required';
        }

        if (strpos($qtype, 'q') !== false) {
            $valarr['question'] = 'required';
        }

        $ansformat = $request->ansformat;

        if ($ansformat == '1') {
            $valarr['anskeyin'] = 'required';
        } else {
            $valarr['correctans'] = 'required';
            for ($i=1; $i <= $ansformat; $i++) { 
                $valarr['ans'.$i] = 'required';
            }
        }
        
        if (!empty($request->contentimg)) {
            $valarr['contentimg'] = 'mimes:jpeg,png,jpg,gif,svg|max:2048';
        }

        if (!empty($request->questionimg)) {
            $valarr['questionimg'] = 'mimes:jpeg,png,jpg,gif,svg|max:2048';
        }

        if (!empty($request->contentmp3)) {
            $valarr['contentmp3'] = 'mimes:application/octet-stream,audio/mpeg,mpga,mp3,wav';
        }

        if (!empty($request->questionmp3)) {
            $valarr['questionmp3'] = 'mimes:application/octet-stream,audio/mpeg,mpga,mp3,wav';
        }
        // print_r($qtype.'   '.strpos($qtype, 'i').'  <br>');
        // print_r($valarr);die;

        $request->validate($valarr
        ,
        [
            'correctans.required' => '正解をチェックしてください',
        ]
        );

        // print_r($request->all());die;
        // $host = Auth::user();

        if (empty($request->id)) {

            $data=array('qid'=>$request->qid,
                        "name"=>$request->qname,
                        "qtype"=>$request->qtype,
                        "ansformat"=>$request->ansformat,
                        "mark"=>$request->mark,
                        "instruction"=>$request->instruction,
                        "content"=>$request->content,
                        "contentimg"=>$request->contentimg,
                        "contentmp3"=>$request->contentmp3,
                        "question"=>$request->question,
                        "questionimg"=>$request->questionimg,
                        "questionmp3"=>$request->questionmp3,
                        "howtowrite"=>$request->howtowrite,
                        "created_by"=>Auth::user()->id,
                        "created_at"=> new \DateTime(),
                    );

            if ($ansformat == '1') {
                $data['correctans'] = $request->anskeyin;
            } else {
                $data['correctans'] = $request->correctans;
                for ($i=1; $i <= $ansformat; $i++) {
                    $ansindex = 'ans'.$i; 
                    $data['ans'.$i] = $request->{$ansindex};
                }
            }

            if (!empty($request->contentimg)) {
                $contentimg = time().'.'.$request->contentimg->extension();           
                $request->contentimg->move(public_path('images'), $contentimg);
                $data['contentimg'] = $contentimg;
            }

            if (!empty($request->questionimg)) {
                $questionimg = time().'.'.$request->questionimg->extension();           
                $request->questionimg->move(public_path('images'), $questionimg);
                $data['questionimg'] = $questionimg;
            }


            if (!empty($request->contentmp3)) {
                $contentmp3 = time().'.'.$request->contentmp3->extension();           
                $request->contentmp3->move(public_path('audio'), $contentmp3);
                $data['contentmp3'] = $contentmp3;
            }

            if (!empty($request->questionmp3)) {
                $questionmp3 = time().'.'.$request->questionmp3->extension();           
                $request->questionmp3->move(public_path('audio'), $questionmp3);
                $data['questionmp3'] = $questionmp3;
            }
            // 'required|mimes:application/octet-stream,audio/mpeg,mpga,mp3,wav'
            // print_r($data);die;

            DB::table('question')->insert($data);


            $msg = '「'.$request->qname.'」登録されました。';

            // die($msg);

        } else {

            $data=array("name"=>$request->qname,
                        "qtype"=>$request->qtype,
                        "ansformat"=>$request->ansformat,
                        "mark"=>$request->mark,
                        "instruction"=>$request->instruction,
                        "content"=>$request->content,
                        "question"=>$request->question,
                        "howtowrite"=>$request->howtowrite,
                        // "updated_at"=> new \DateTime(),
                    );

            if ($ansformat == '1') {
                $data['correctans'] = $request->anskeyin;
            } else {
                $data['correctans'] = $request->correctans;
                for ($i=1; $i <= $ansformat; $i++) {
                    $ansindex = 'ans'.$i; 
                    $data['ans'.$i] = $request->{$ansindex};
                }
            }

            if (!empty($request->contentimg)) {
                $contentimg = time().'.'.$request->contentimg->extension();           
                $request->contentimg->move(public_path('images'), $contentimg);
                $data['contentimg'] = $contentimg;
            }

            if (!empty($request->questionimg)) {
                $questionimg = time().'.'.$request->questionimg->extension();           
                $request->questionimg->move(public_path('images'), $questionimg);
                $data['questionimg'] = $questionimg;
            }

            if (!empty($request->contentmp3)) {
                $contentmp3 = time().'.'.$request->contentmp3->extension();           
                $request->contentmp3->move(public_path('audio'), $contentmp3);
                $data['contentmp3'] = $contentmp3;
            }

            if (!empty($request->questionmp3)) {
                $questionmp3 = time().'.'.$request->questionmp3->extension();           
                $request->questionmp3->move(public_path('audio'), $questionmp3);
                $data['questionmp3'] = $questionmp3;
            }

            // print_r($data);die;
            DB::table('question')->where('id',$request->id)->update($data);

            $msg = '問題が更新されました。';
        }

        return redirect('/'.Auth::user()->role.'/question')->with('success',$msg);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function indexquestion()
    {
        //
        $limit = 10;
        if (!empty($_GET['kword'])) {
            $kword = $_GET['kword'];
        } else {
            $kword = '';
        }    

        $lists = DB::table('question')
                    ->where('del','0')
                    ->where('created_by', Auth::user()->id)
                    ->orderBy('created_at', 'desc')->paginate($limit);

        $ttl = $lists->total();
        $ttlpage = (ceil($ttl / $limit));

        $typearr = array('icq' => "指示文+本文+質問",
                         'cq' => "本文+質問",  
                         'iq' => "指示文+質問",  
                         'q' => "質問", 
                        );

        $ansarr = array('5' => '選択5',                   
                         '4' => '選択4',                                    
                         '2' => '選択2',
                         '1' => '記入式',
                        );

        $tests = DB::table('seminars')
                    ->where('seminars.name','<>','')
                    ->where('seminars.open','0')
                    ->where('seminars.semtype_id','LIKE','%b3%')
                    ->where('seminars.host_id', Auth::user()->id)
                    ->orderBy('seminars.created_at', 'desc')->get();

        // print_r($tests);die;
        return view('host.indexquestion',compact('lists','ttlpage','ttl','typearr','tests','ansarr'));
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function previewquestion($id)
    {

        if (strlen($id) > 5) {

            $id = substr($id, 5);

        } 


        $limit = 1;

        $lists = DB::table('question')
                    ->where('del','0')
                    ->where('id',$id)
                    ->where('created_by', Auth::user()->id)
                    ->orderBy('qid', 'desc')->paginate($limit);

        // print_r($lists);die;
        // print_r($lists);die;
        return view('exam',compact('lists'));
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function previewtest($id)
    {

        if (strlen($id) > 5) {

            $id = substr($id, 5);

        } 


        $test = Seminar::find($id);

        $testquestion = json_decode($test->testquestion);
        if (is_array($testquestion) AND count($testquestion) > 0) {
            
            $ids_ordered = implode(',', $testquestion);

            if ($test->open) {            
                $lists = DB::table('fixques')
                            ->whereIn('fid',$testquestion)
                            ->where('testid',$test->id)
                            ->orderByRaw("FIELD(fixques.id, $ids_ordered)")->get();
            } else {
                $lists = DB::table('question')
                            ->whereIn('id',$testquestion)
                            ->orderByRaw("FIELD(question.id, $ids_ordered)")->get();
            }

        } else {
            die('noqeustion register');
        }

        // print_r($lists);die;
        // print_r($lists);die;
        return view('exam',compact('test','lists'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function registertest(Request $request)
    {
        //

        $valarr = [
            'testname' => 'required|string|max:255',
            'startdt' => 'required',
            'enddt' => 'required|after:startdt',
            'b_type' => 'required|not_in:0',
            'm_type' => 'required|not_in:0',
            's_type' => 'required|not_in:0',
            'participant_limit' => 'required|numeric|min:0|not_in:0',
            'testminute' => 'required|numeric|min:0|not_in:0',
            'passkey' => 'nullable|numeric|max:999999',
            // 'shoubunrui' => 'required',
        ];

        $request->validate($valarr
        ,
        [
            'passkey.max' => '6桁以内に入力してくだい',
        ]
        );
        // print_r($request->all());die;

        $start = $request->startdt;

        $request->startdt = $request->startdt.'+0000';
        $request->enddt = $request->enddt.'+0000';

        $f = strtotime($request->startdt);
        $t = strtotime($request->enddt);

        $f = gmdate("Y-m-d H:i:s ", $f);
        $t = gmdate("Y-m-d H:i:s ", $t);

        $f = new DateTime($f);
        $t = new DateTime($t);

        $host = Auth::user();

        if (empty($request->id) OR $request->makenew ) {



            $createarr = [
                'name' => $request->testname,
                'start' => $f,
                'end' => $t,
                'description' => $request->description,
                'starturl' => '',
                'joinurl' => '',
                'semtype_id' => $request->s_type,
                'open' => '0',
                'fee' => '0',
                'limit' => $request->participant_limit,
                'testminute' => $request->testminute,
                'passcode' => '',
                'passkey' => $request->passkey ,
                'host_id' => $host->id,
            ];

            if (!empty($request->testquestion)) {
                $newtestquestion = array_filter(explode('.', $request->testquestion));
                $newtestquestion = array_values($newtestquestion);
                $createarr['testquestion'] = json_encode($newtestquestion);
            }

        // print_r($createarr);die;

            $seminar = Seminar::create($createarr);
            event(new Registered($seminar));

            $joinurl = url("/exam/".rand ( 10000 , 99999 ).$seminar->id);

            $seminar->update([
                                'joinurl' => $joinurl,
                            ]);

            $msg = '「'.$request->testname.'」登録されました。';

        } else {
            $seminar = Seminar::find($request->id);



            $updatearr = [
                                'name' => $request->testname,
                                'start' => $f,
                                'end' => $t,
                                'description' => $request->description,
                                'semtype_id' => $request->s_type,
                                'limit' => $request->participant_limit,
                                'testminute' => $request->testminute,
                                'passkey' => $request->passkey ,
                            ];

            // if (!empty($request->testquestion)) {
                $newtestquestion = array_filter(explode('.', $request->testquestion));
                $newtestquestion = array_values($newtestquestion);
                $updatearr['testquestion'] = json_encode($newtestquestion);
            // }

            // print_r($updatearr);die;

            $seminar->update($updatearr);
            $msg = '試験が更新されました。';
        }

        return redirect('/'.Auth::user()->role.'/test')->with('success',$msg);
    } 

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function indextest()
    {
        //
        $limit = 10;

        $lists = DB::table('seminars')
                    ->where('seminars.name','<>','')
                    ->where('seminars.semtype_id','LIKE','%b3%')
                    ->where('seminars.host_id', Auth::user()->id)
                    ->orderBy('seminars.start', 'desc')->paginate($limit);

        $ttl = $lists->total();
        $ttlpage = (ceil($ttl / $limit));

        foreach ($lists as $key => $value) {
            if (!empty($value->testquestion)) {
                $totalmarks = DB::table('question')
                             ->whereIn('id',json_decode($value->testquestion))
                             ->sum('mark');
            } else {
                $totalmarks = 0;
            }
            $lists[$key]->totalmarks = $totalmarks;
        }

        // print_r($lists);die;
        return view('host.indextest',compact('lists','ttlpage','ttl'));
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function addquetotest(Request $request)
    {

            $seminar = Seminar::find($request->testid);

            if (!empty($request->addquestion)) {

                // print_r($seminar->testquestion);die;
                if (empty($seminar->testquestion)) {
                    $newarr = $request->addquestion;
                } else {
                    $newarr = array_merge(json_decode($seminar->testquestion),$request->addquestion);
                }
                

                // print_r($newarr);die;
                $seminar->update([
                                    'testquestion' => json_encode($newarr),
                                ]);
                $msg = '試験を更新されました。';
            } else {
                $msg = '失敗しました。';
            }
            

        // print_r($msg);die;
            return redirect('/'.Auth::user()->role.'/question')->with('success',$msg);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Seminar  $seminar
     * @return \Illuminate\Http\Response
     */
    public function testedit(Request $request, $testid)
    {
        //
        if (strlen($testid) > 5) {

            // print_r(substr($id, 5));die;
            $testid = substr($testid, 5);

        }


        $data = DB::table('seminars')
                    ->where('seminars.id',$testid)
                    ->get();
        $data = $data[0];    
        // print_r($data);die;

        $timenow = strtotime(date("Y-m-d H:i:s"));
        $testend = strtotime(date($data->end));

        if ( ($data->open) AND ($testend > $timenow)) {
            return Redirect::back()->with('error','一度配布した試験の修正はできません。');
            // die("cant edit, alrady published");
        }

        // if ($testend < $timenow) {
        //     return Redirect::back()->with('error','終了した試験の修正はできません。');
        //     // die('finished test');
        // }


        if (!empty($data->testquestion)) {
            

            $ids_ordered = implode(',', json_decode($data->testquestion));

            $testquestion = json_decode($data->testquestion);
            if ($data->open) {            
                $lists = DB::table('fixques')
                            ->whereIn('fid',$testquestion)
                            ->where('testid',$data->id)
                            ->orderByRaw("FIELD(fixques.id, $ids_ordered)")->get();
            } else {
                $lists = DB::table('question')
                            ->whereIn('id',$testquestion)
                            ->orderByRaw("FIELD(question.id, $ids_ordered)")->get();
            }
        } else {
            $lists = [];
        }

        // print_r($data);die;
        // $ttl = $lists->total();

        return view('host.registertest',compact('data','lists'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Seminar  $seminar
     * @return \Illuminate\Http\Response
     */
    public function questionedit(Request $request, $questionid)
    {
        //
        if (strlen($questionid) > 5) {

            // print_r(substr($id, 5));die;
            $questionid = substr($questionid, 5);

        }


        $data = DB::table('question')
                    ->where('id',$questionid)
                    ->get();
        $data = $data[0];    
        // print_r($data);die;

        return view('host.registerquestion',compact('data'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Seminar  $seminar
     * @return \Illuminate\Http\Response
     */
    public function questiondel(Request $request, $questionid)
    {
        //
        if (strlen($questionid) > 5) {

            // print_r(substr($id, 5));die;
            $questionid = substr($questionid, 5);

        }

        DB::table('question')->where('id',$questionid)->update(array('del' => '1'));

        return redirect('/'.Auth::user()->role.'/question')->with('success','削除されました。');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function opentest(Request $request)
    {

            $testid = $request->testid;
            $seminar = Seminar::find($request->testid);

            $timenow = strtotime(date("Y-m-d H:i:s"));
            $testend = strtotime(date($seminar->end));

            $type = $this->semortest($seminar->semtype_id);

            if ($testend < $timenow) {
                return Redirect::back()->with('error','終了した'.$type.'の配布はできません。');
                // die('finished test');
            }

            if (str_contains($seminar->semtype_id, 'b3')) {

                    // if (is_countable(json_decode($seminar->testquestion))) {
                        
                    // }
                    $quetotal = count(json_decode($seminar->testquestion));

                    if (empty($quetotal)) {
                        return Redirect::back()->with('error','0件の問題数試験の配布はできません。');
                        // die('please add question');
                    }

                    $fixquearr = array();

                    $quelist = DB::table('question')
                                ->whereIn('id',json_decode($seminar->testquestion))
                                ->get();

                    foreach ($quelist as $key => $value) {
                        $value->testid = $testid;
                        $value->fid = $value->id;
                        unset($value->id);
                        $fixquearr[] = (array) $value;
                    }

                    DB::table('fixques')->insert($fixquearr);

            }

            $seminar->update([
                                'open' => 1,
                            ]);

            // $mark = $this->semortest($seminar->semtype_id);

            $msg = $type.'が配布されました。';
        

        // print_r($seminar);die;
            return Redirect::back()->with('success',$msg);
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function deletetest(Request $request)
    {


            $testid = $request->testid;
            $seminar = Seminar::find($request->testid);

            if ($seminar->open) {
                return Redirect::back()->with('error','配布の試験は削除できません。');
            } else {

                $seminar->delete();
                $msg = $this->semortest($seminar->semtype_id).'が削除されました。';
                return Redirect::back()->with('success',$msg);
            }
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function exam($id)
    {

        if (strlen($id) > 5) {
            $id = substr($id, 5);
        } 
        $test = Seminar::find($id);

        // return Redirect::back()->with('error','一度配布した試験の修正はできません。');
        $timenow = strtotime(date("Y-m-d H:i:s"));
        $teststart = strtotime(date($test->start));
        $testend = strtotime(date($test->end));

        if ($testend < $timenow) {
            return Redirect::back()->with('error','試験が終了しました。');
            // die('finished test');
        }

        if ($timenow < $teststart) {
            return Redirect::back()->with('error','開始時刻に合わせ開始してください。');
            // die('finished test');
        }

        $log = DB::table('test')
                    ->where('testid',$id)
                    ->where('tester',Auth::user()->id)
                    ->get();

        if (count($log) == 0) {

            $s = new \DateTime();
            $e = new \DateTime();
            $e = $e->modify('+'.$test->testminute.' minutes');

            $data=array('testid' => $id,
                        'tester' => Auth::user()->id,
                        'start' => $s,
                        'end' => $e,
                        'answer' => '',
                        'result' => '',
                    );

            DB::table('test')->insert($data);

            $id = DB::getPdo()->lastInsertId();;
            $log = DB::table('test')->find($id);

        } else {
            $log = $log[0];

            $testend = strtotime(date($log->end));

            if ($timenow > $testend) {
                return Redirect::back()->with('error','試験が終了されました。');
                // die('finished test');
            } else if (!empty($log->submittime)) {
                return Redirect::back()->with('error','試験が提出されました。');
            }
        }

        $testquestion = json_decode($test->testquestion);
        if (is_array($testquestion) AND count($testquestion) > 0) {
            
            $ids_ordered = implode(',', $testquestion);

            if ($test->open) {            
                $lists = DB::table('fixques')
                            ->whereIn('fid',$testquestion)
                            ->where('testid',$test->id)
                            ->orderByRaw("FIELD(fixques.id, $ids_ordered)")->get();
            } else {
                $lists = DB::table('question')
                            ->whereIn('id',$testquestion)
                            ->orderByRaw("FIELD(question.id, $ids_ordered)")->get();
            }

        } else {
            die('noqeustion register');
        }

        // echo "Jan 5, 2022 15:37:25<br>";
        // print_r(date(' F j, Y H:i:s', strtotime($log->end)));die;
        // print_r($lists);die;
        return view('exam',compact('test','lists','log'));
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function updatelog(Request $request)
    {



            // print_r($request->all());die;

            $data = array('answer' => json_encode($request->ans));

            if ($request->submitcheck) {

                $mark = $this->calcumark($request->ans, $request->testid);

                // $data['getmark'] = $mark['getmark'];
                // $data['fullmark'] = $mark['fullmark'];
                $data = $mark;

                $data['submittime'] = new \DateTime();

            }

        // print_r($request->all());die;
            
            if (!empty($request->logid)) {
                // $log = DB::table('test')->find($request->logid);
                DB::table('test')->where('id',$request->logid)->update($data);
            } else {
                DB::table('test')
                    ->where('testid',$request->testid)
                    ->where('tester',Auth::user()->id)
                    ->update($data);
            }
            
        if($request->ajax()){
            return response()->json(['success'=>true]);
        }

        if ($request->submitbutton) {
            $msg = "試験が正常に提出されました。";
        } else {
            $msg = "試験が自動的に提出されました。お疲れさまでした。";
        }
        
        return view('examdone',compact('msg'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function submittest(Request $request)
    {

        // print_r($request->all());



        // $test = Seminar::find($request->testid);

        $ques = DB::table('question')
                    ->whereIn('id',array_keys($request->ans))
                    ->get()->keyBy('id');

        // print_r($ques);       $totalmarks = DB::table('question')->whereIn('id',json_decode($value->testquestion))->sum('mark');
        
        $getmark = 0;
        $fullmark = 0;

        foreach ($request->ans as $key => $value) {
            // echo $value." ".$ques[$key]->correctans." ".$ques[$key]->mark;

            $fullmark += $ques[$key]->mark;

            if ($value == $ques[$key]->correctans) {
                $getmark += $ques[$key]->mark;
            }            
            // echo "<br>";
        }

        $data = array('answer' => json_encode($request->ans),
                      'getmark' => $getmark,
                      'fullmark' => $fullmark
                        );
        print_r($getmark.'/'.$fullmark);
        die;
        
        if (!empty($request->logid)) {
            // $log = DB::table('test')->find($request->logid);
            DB::table('test')->where('id',$request->logid)->update($data);
        } else {
            DB::table('test')
                ->where('testid',$request->testid)
                ->where('tester',Auth::user()->id)
                ->update($data);
        }

        
        
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
            return back()->with('errorsearch','終了日を開始日以後の日に設定してください。');
        }

        $lists = DB::table('test')
                    ->select('answerer.name as answerername',
                             'answerer.gender as answerergender',
                             'answerer.agerange as answereragerange',
                             'sem.name as testname',
                             'sem.start as teststart',
                             'sem.semtype_id as testsemtype_id',
                             'test.*')
                    ->whereNotNull('test.getmark')
                    ->whereNotNull('test.fullmark')
                    ->where(function($query) use ($kword){
                        if (!empty($kword)) {
                             $query->where('answerer.name','LIKE','%'.$kword.'%')
                                   ->orwhere('sem.name','LIKE','%'.$kword.'%')
                                   ;
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
                             ->where('sem.host_id', Auth::user()->id)
                        ;
                    })
                    ->join('users as answerer', function ($join) {
                        $join->on('test.tester', '=', 'answerer.id')
                             ->where('answerer.role','user');
                    })
                    ->orderBy('sem.start', 'desc')->paginate($limit);

        $ttl = $lists->total();
        $ttlpage = (ceil($ttl / $limit));


            // $table->foreignId('payer_id');
            // $table->foreignId('seminar_id');
            // $table->string('sem_fee')->nullable();
        // print_r($namebycode);
        // die;

        return view('host.indexresult',compact('lists','ttlpage','ttl','namebycode'));
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function examreview($id)
    {

        if (strlen($id) > 5) {
            $id = substr($id, 5);
        } 

        $log = DB::table('test')
                    ->find($id);

        // print_r($log->testid);
        $test = Seminar::find($log->testid);

        $testquestion = json_decode($test->testquestion);
        if (is_array($testquestion) AND count($testquestion) > 0) {
            
            $ids_ordered = implode(',', $testquestion);

            if ($test->open) {            
                $lists = DB::table('fixques')
                            ->whereIn('fid',$testquestion)
                            ->where('testid',$test->id)
                            ->orderByRaw("FIELD(fixques.id, $ids_ordered)")->get();
            } else {
                $lists = DB::table('question')
                            ->whereIn('id',$testquestion)
                            ->orderByRaw("FIELD(question.id, $ids_ordered)")->get();
            }

        } 

        // print_r($lists);die;
        return view('exam',compact('test','lists','log'));
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
            return back()->with('errorsearch','終了日を開始日以後の日に設定してください。');
        }

        $lists = DB::table('seminars')
                    ->select('U.name as hostname', 'seminars.*')
                    ->where('seminars.name','<>','')
                    ->where('seminars.joinlist','<>','')
                    ->where('seminars.fee','>',0)
                    ->where('seminars.host_id', Auth::user()->id)
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
                    ->orderBy('seminars.start', 'desc')->paginate($limit);

        $ttl = $lists->total();
        $ttlpage = (ceil($ttl / $limit));

        foreach ($lists as $key => $value) {
            $lists[$key]->joincount = count(array_filter(explode('.', $value->joinlist)));
            $lists[$key]->ttlper = ($lists[$key]->joincount)*($value->fee);
        }
        return view('host.indexsales',compact('lists','ttlpage','ttl'));
    }


}
