<?php
 
namespace App\Http\Controllers;
 
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Session;
use Excel;
use File;


 
class import_export_controller extends Controller
{
    public function index()
    {
        return view('NMS_tools');
    }
 
    public function import(Request $request){
        //validate the xls file
        $this->validate($request, array(
            'file'      => 'required'
        ));
      
        if($request->hasFile('file')){
           
            $extension = File::extension($request->file->getClientOriginalName());
            if ($extension == "xlsx" || $extension == "xls" || $extension == "csv") {

                $request->file->storeAs('logos','new.csv');
                //shell_exec('C:\WINDOWS\system32\cmd.exe /c batch_file');
                //system('cmd.exe /c C:\xampp\htdocs\qa\public\batch_file.bat');
                system('c:\\WINDOWS\\system32\\cmd.exe /c C:\xampp\mysql\bin\mysql.exe -u root -q qa_tool_db <C:\xampp\htdocs\qa\input_given.sql');
                return "sagora";
                ////these lines of codes were written for the small sets of csv file to upload in to the database using oop concept.

                // $path = $request->file->getRealPath();
                // $data = Excel::load($path, function($reader) {
                // })->get();
                // if(!empty($data) && $data->count()){
 
                //     // foreach ($data as $key => $value) {
                //     //   //return $value;
                //     //     $dump=$value['95th_percentile'];
                //     //     //return $dump;
                //     //      //return $value['alias'];
                //     //     $insert[] = [
                //     //         'host_name' => $value->host_name,
                //     //         'resource_name' => $value->resource_name,
                //     //         'description' => $value->description,
                //     //         'model' => $value->model,
                //     //         'ip_address' => $value->ip_address,
                //     //         'alias' => $value->alias,
                //     //         'bandwidth' => $value->bandwidth,
                //     //         'resource' => $value->resource,
                //     //         'average' => $value->average,
                //     //         'minimum' => $value->minimum,
                //     //         'maximum' => $value->maximum,
                //     //         '95th_percentile' => $dump,
                //     //         //'what' => $value->what,
                            
                //     //     ];
                //     // }
 
                //     if(!empty($insert)){
                //         //return $insert;
                //         $insertData = DB::table('input_xcls')->insert($insert);
                //         //return $insert;
                //         if ($insertData) {
                //             Session::flash('success', 'Your Data has successfully imported');
                //         }else {                        
                //             Session::flash('error', 'Error inserting the data..');
                //             return back();
                //         }
                //     }
                // }
 //////////////////here these codes are ended........
                return back();
 
            }else {
                Session::flash('error', 'File is a '.$extension.' file.!! Please upload a valid xls/csv file..!!');
                return back();
            }
        }
    }

    function excel()
    {
        $query = "insert into processed_table (host_name,resource_name,description,model,ip_address,alias,bandwidth,resource,average,minimum,maximum,95th_percentile) 
                    select host_name,resource_name,description,model,ip_address,alias,bandwidth,resource,average,minimum,maximum,95th_percentile 
                      from qa_tool_db.input_xcls where check_bit = 0 && description not like '%.%' && ( (resource like 'ge%' && maximum>=800.00) || 
                         (resource like 'gig%' && maximum>=800.00  && bandwidth= '1.00 Gbps') || (resource like 'gig%' && maximum>=8000.00 && bandwidth= '10.00 Gbps') ||
                          (resource like 'xe%' && maximum>=8000.00 && bandwidth= '10.00 Gbps') )";
        $users= DB::select($query);
        
        $query1= "update qa_tool_db.input_xcls set check_bit=1 where check_bit=0";
        $user1= DB::select($query1);
        //DB::insert(DB::raw($users));

       // $query2 = "delete from qa_tool_db.processed_table where resource not like 'ge%' ";
        //$user2= DB::select($query2);
        //return $users;

        $customer_data = DB::table('input_xcls')->get()->toArray();
        $customer_array[] = array('Host Name', 'Resource Name', 'Description', 'Model', 'IP Adress','Alias','Bandwidth','Resource','Average','Minimum','Maximum','95th Percentile');
        foreach($customer_data as $customer)
        {
           // return $customer_data;
            $damp='95th_percentile';
            $damp=$customer->$damp;
            //return $damp;
         $customer_array[] = array(
          'Host Name'  => $customer->host_name,
          'Resource Name'   => $customer->resource_name,
          'Description'    => $customer->description,
          'Model'  => $customer->model,
          'IP Adress'   => $customer->ip_address,
          'Alias'  => $customer->alias,
          'Bandwidth'   => $customer->bandwidth,
          'Resource'  => $customer->resource,
          'Average'   => $customer->average,
          'Minimum'  => $customer->minimum,
          'Maximum'   => $customer->maximum,
          '95th Percentile'  =>$damp
         );
        }
        //return $customer_array;
        Excel::create('Processed Data', function($excel) use ($customer_array){
         $excel->setTitle('Processed Data');
         $excel->sheet('Processed Data', function($sheet) use ($customer_array){
          $sheet->fromArray($customer_array, null, 'A1', false, false);
         });
        })->download('xlsx');
    }
 
     
}