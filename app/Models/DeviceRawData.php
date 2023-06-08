<?php 
namespace App\Models;
use Illuminate\Support\Facades\Input;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class DeviceRawData extends Model
{
    protected $table = 'device_raw_data';
    protected $fillable = [
        'id','data','request_type','created_by','updated_at', 'status'
    ];
}

?>