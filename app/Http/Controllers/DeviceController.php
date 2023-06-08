<?php

namespace App\Http\Controllers;
use App;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Models\DeviceRawData;
use App\Models\CompanyDevices;
use App\Models\Employee;

class DeviceController extends Controller{

public function index(Request $request ){
    $r = $request->toArray();
    Log::info('Log message',[json_encode($request->headers)]);

    $device = CompanyDevices::firstOrCreate([
        'company_device_id' => $r['headers']['dev_id'],
    ], [
        'company_device_id' => $r['headers']['dev_id']
    ]);

        if($device && $r['headers']["request_code"] === 'receive_cmd'){
            $device->touch();
        }else{
            $atData = $this->escapeString($request->body);
            $employee = Employee::where('registered_device',$device->id)->where('device_user_is',$atData->user_id)->first();
            $employee->MarkAttendance($r,$atData);
            DeviceRawData::create(['data' =>json_encode($r),'request_type'=>json_encode($r['headers']['request_code'])]);
        }

    return response()->json($request);
}


 function escapeString($string,$needle = "{" ){
    $string = utf8_encode($string);
  
    
    $strpos = strpos($string, $needle);
    $stringSplit1 = substr($string, 0, $strpos);
    $stringSplit2 = substr($string, ($strpos));

    return json_decode(trim($stringSplit2));
}


public function loopingData(){
    $d = DeviceRawData::where('request_type','LIKE', '%realtime_glog%')->get();

    $d->map(function($e){
    
        $r = json_decode($e->data,true);

        
        $this->processingData($r);
    });
}

function processingData($r){

   
if(!isset($r['headers']['dev_id'])){
    dd($r);
}
    $device = CompanyDevices::firstOrCreate([
        'company_device_id' => $r['headers']['dev_id'],
    ], [
        'company_device_id' => $r['headers']['dev_id']
    ]);

        if($device && $r['headers']["request_code"] === 'receive_cmd'){
            $device->touch();
        }else{
            $atData = $this->escapeString($r['body']);
          
            $employee = Employee::where('registered_device',$device->id)->where('device_user_is',$atData->user_id)->first();

            if($employee){
                $employee->MarkAttendance($r,$atData);
               
            }else{
                echo "<pre>";
                var_dump($atData,$device->id);
            }
          
           // DeviceRawData::create(['data' =>json_encode($r),'request_type'=>json_encode($r['headers']['request_code'])]);
        }

}

}