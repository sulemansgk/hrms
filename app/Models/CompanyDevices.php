<?php 
namespace App\Models;
use Illuminate\Support\Facades\Input;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class CompanyDevices extends Model
{
    protected $table = 'company_devices';
    protected $fillable = [
        'id','company_device_id','created_by','updated_at'
    ];

    
    public function scopeCompany($query, $id)
    {
        return $query->where('company_devices.id', '=', $id);
    }
}

?>