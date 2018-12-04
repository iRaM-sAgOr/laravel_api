<?php
 
namespace App\Http\Controllers;
 
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Session;
use Excel;
use File;

 
class StudentController extends Controller
{
    public function index()
    {
        return view('add-student');
    }
 
    public function import(Request $request){
        //validate the xls file
        $this->validate($request, array(
            'file'      => 'required'
        ));
 
        if($request->hasFile('file')){
            $extension = File::extension($request->file->getClientOriginalName());
            if ($extension == "xlsx" || $extension == "xls" || $extension == "csv") {
 
                $path = $request->file->getRealPath();
                $data = Excel::load($path, function($reader) {
                })->get();
                if(!empty($data) && $data->count()){
 
                    foreach ($data as $key => $value) {
                       //return $value;
                        $dump=$value['95th_percentile'];
                        //return $dump;

                        $insert[] = [
                            'host_name' => $value->host_name,
                            'resource_name' => $value->resource_name,
                            'description' => $value->description,
                            'model' => $value->model,
                            'ip_address' => $value->ip_address,
                            'alias' => $value->alias,
                            'bandwidth' => $value->bandwidth,
                            'resource' => $value->resource,
                            'average' => $value->average,
                            'minimum' => $value->minimum,
                            'maximum' => $value->maximum,
                            '95th_percentile' => $dump,
                            //'what' => $value->what,
                            
                        ];
                    }
 
                    if(!empty($insert)){
                        //return $insert;
                        $insertData = DB::table('input_xcls')->insert($insert);
                        //return $insert;
                        if ($insertData) {
                            Session::flash('success', 'Your Data has successfully imported');
                        }else {                        
                            Session::flash('error', 'Error inserting the data..');
                            return back();
                        }
                    }
                }
 
                return back();
 
            }else {
                Session::flash('error', 'File is a '.$extension.' file.!! Please upload a valid xls/csv file..!!');
                return back();
            }
        }
    }
 
     
}