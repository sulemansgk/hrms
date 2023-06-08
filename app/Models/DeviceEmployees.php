<?php 
namespace App\Models;
use Illuminate\Support\Facades\Input;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class DeviceEmployees extends Model
{
    protected $table = 'device_employees';
    protected $fillable = [
        'id','emp_id','device_id','created_by','updated_at','device_name'
    ];
}

?>