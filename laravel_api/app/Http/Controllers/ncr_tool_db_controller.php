<?php


namespace App\Http\Controllers;

use Request;
use App\Http\Requests;
use App\Article;
use DB;
use Post;

class ncr_tool_db_controller extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store()
    {
        $title = Request::get('title');
        $ncr_title= Request::get('ncr_title');
        $justification= Request::get('justification');
        $start_time= Request::get('start_time');
        $end_time= Request::get('end_time');
        $actual_down_start_time= Request::get('actual_down_start_time');
        $actual_down_end_time= Request::get('actual_down_down_time');
        $impact_choose_flag= Request::get('impact_choose_flag');
        $team_id= Request::get('team_id');
        $executor_leader= Request::get('executor_leader');
        $maintenance_type= Request::get('maintenance_type');
        $severity= Request::get('severity');
        $approval_status= Request::get('approval_status');
        $ncr_status= Request::get('ncr_status');
        $pending_at= Request::get('pending_at');
        $rejection_id= Request::get('rejection_id');
        $execution_status= Request::get('execution_status');
        $executor_status= Request::get('executor_status');
        $extension_id= Request::get('extension_id');
        $request_for_closing= Request::get('request_for_closing');
        $remark= Request::get('remark');
        $attachment= Request::get('attachment');
        
        $query="INSERT INTO `ncr_table`(ncr_title,justification,start_time,end_time,actual_down_start_time,actual_down_end_time,
        impact_choose_flag,executor_leader,maintenance_type,severity,approval_status,ncr_status,pending_at,
        rejection_id,execution_status,executor_status,extension_id,request_for_closing,remark,attachment)
         VALUES ('$ncr_title','$justification','$start_time','$end_time','$actual_down_start_time','$actual_down_end_time',
        '$impact_choose_flag','$executor_leader','$maintenance_type','$severity','$approval_status','$ncr_status','$pending_at',
        '$rejection_id','$execution_status','$executor_status','$extension_id','$request_for_closing','$remark','$attachment')";
        \DB::insert(\DB::raw($query));

        $last_id = "SELECT ncr_id FROM `ncr_table` order by ncr_id desc limit 0,1";
        $Lid=\DB::select(\DB::raw($last_id));
        $LID=$Lid[0]->ncr_id;
        $query1 ="INSERT INTO `team_member_table`(ncr_id) VALUES('$LID')";
        \DB::insert(\DB::raw($query1));
        $query2 ="INSERT INTO `impact_table`(ncr_id) VALUES('$LID')";
        \DB::insert(\DB::raw($query2));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
        //$data['data']=DB::table('ncr_table')->get();
        //return $data;
        $items_query='SELECT * FROM `ncr_table`';
        $items= \DB::select(\DB::raw($items_query));
        //return 'sagor kola';
        // return $items;
       // return view('welcome');
        return view('list_view',compact('items'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //id will be given from the html page
        $query= "UPDATE `impact_table` SET `element_type`='kicuna hudai',`element_id`=1 WHERE ncr_id = 29";
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
