<?php

namespace App\Http\Controllers;

use App\Models\Seminar;
use Illuminate\Http\Request;

use App\Http\Traits\ZoomTrait;

use Illuminate\Support\Facades\DB;

use Illuminate\Support\Facades\Auth;

use App\Models\User;

class SeminarController extends Controller
{
    use ZoomTrait;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Seminar::latest()->paginate(5);
    
        return view('seminar.index',compact('data'))
            ->with('i', (request()->input('page', 1) - 1) * 5);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('seminar.create');
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
        $this->createZoomMeeting($request->title);
        die();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Seminar  $seminar
     * @return \Illuminate\Http\Response
     */
    public function seminardetail(Request $request, $seminarid)
    {
        //
        if (strlen($seminarid) > 5) {

            // print_r(substr($id, 5));die;
            $seminarid = substr($seminarid, 5);

        }

        $lists = DB::table('semtype')
                    ->where('name','<>','')
                    ->get();
        $listsarr = $lists->toArray();
        $namebycode = array_column($listsarr, 'name', 'code');

        $data = DB::table('seminars')
                    ->select('U.name as adminname', 'U.profileimg as profileimg', 'U.profile as profile', 'seminars.*')
                    ->where('seminars.id',$seminarid)
                    ->join('users as U', function ($join) {
                        $join->on('seminars.host_id', '=', 'U.id')
                             ->where('U.role','admin');
                    })
                    ->get();
        $data = $data[0];    
        
        return view('seminar.seminardetail',compact('data'));

        // die($seminarid);
    }


    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Seminar  $seminar
     * @return \Illuminate\Http\Response
     */
    public function seminaredit(Request $request, $seminarid)
    {
        //
        if (strlen($seminarid) > 5) {

            // print_r(substr($id, 5));die;
            $seminarid = substr($seminarid, 5);

        }

        $data = DB::table('seminars')
                    ->select('U.name as adminname', 'U.profileimg as profileimg', 'U.profile as profile', 'seminars.*')
                    ->where('seminars.id',$seminarid)
                    ->join('users as U', function ($join) {
                        $join->on('seminars.host_id', '=', 'U.id')
                             ->where('U.role','admin');
                    })
                    ->get();
        $data = $data[0]; 


        return view('host.registerseminar',compact('data'));
    }



    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Seminar  $seminar
     * @return \Illuminate\Http\Response
     */
    public function edit(Seminar $seminar)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Seminar  $seminar
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Seminar $seminar)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Seminar  $seminar
     * @return \Illuminate\Http\Response
     */
    public function destroy(Seminar $seminar)
    {
        //
    }

}
