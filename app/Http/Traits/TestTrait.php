<?php

namespace App\Http\Traits;
use App\Models\Seminar;

use Illuminate\Support\Facades\DB;

use DateTime;

trait TestTrait {
    

    public function semortest($semtype_id = ''){
        
        if (str_contains($semtype_id, 'b3')) {
            $type = '試験';
        } else {
            $type = 'セミナー';
        }
        
        return $type;
    }
    
    public function calcumark($answerarr = array() , $testid){


        // return true;
        $checklog = array();
        $truechck = array();
        if (!is_null($answerarr)) {
            # code...
            $ques = DB::table('fixques')
                        ->whereIn('id',array_keys( (array) $answerarr))
                        ->where('testid',$testid)
                        ->get()->keyBy('id');


            $getmark = 0;
            foreach ($answerarr as $key => $value) {
                // echo $value." ".$ques[$key]->correctans." ".$ques[$key]->mark;

                if ($value == $ques[$key]->correctans) {
                    $getmark += $ques[$key]->mark;
                    $checklog[$key] = true;
                    $truechck[] = $key;
                } else {
                    $checklog[$key] = false;
                }
                // echo "<br>";
            }



            DB::table('fixques')
            ->whereIn('id',array_keys($checklog))
            ->where('testid',$testid)
            ->Increment('answcount');

            if (!empty($truechck)) {
                DB::table('fixques')
                ->whereIn('id',$truechck)
                ->where('testid',$testid)
                ->Increment('truecount');
            }

        } else {
            $getmark = 0;
        }

        

        $test = Seminar::find($testid);
        
        $testquestion = json_decode($test->testquestion);
        $fullmark = DB::table('fixques')
                    ->whereIn('fid',$testquestion)
                    ->where('testid',$test->id)
                    ->sum('mark');

        $mark = array('getmark' => $getmark , 'fullmark' => $fullmark , 'checklog' => json_encode($checklog) );

        return $mark;
    }


    public function calculatetest() {

        $lists = DB::table('test')
                    ->whereNull('test.submittime')
                    ->whereNull('test.getmark')
                    ->whereNull('test.fullmark')
                    ->orderBy('test.end', 'desc')->paginate(99999);

        // print_r($lists);
        $timenow = strtotime(date("Y-m-d H:i:s"));
                    
        foreach ($lists as $key => $value) {
        	
        	$testend = strtotime(date($value->end));

            if ($timenow > $testend) {

        	// echo $value->id."     ".$value->testid."     ".$timenow." : ".$testend;
                // if (empty($value->answer)) {
                //     $data = array('getmark' => 0 , 'getmark' => 100);
                // } else {

                // }

                $mark = $this->calcumark(json_decode($value->answer, true)
                                         , $value->testid );
                
                // print_r($mark);

                // echo "<br>";

                DB::table('test')->where('id',$value->id)->update($mark);
            }
        }



        // print_r('aa');
        // die;
    }
     
}