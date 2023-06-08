<?php 
namespace App\Models;
use Illuminate\Support\Facades\Input;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Shifts extends Model
{
    protected $table = 'shifts';
    protected $fillable = [
        'id','company_id','time_in','time_out','shift_name','created_by','updated_at'
    ];

    
    public function scopeCompany($query, $id)
    {
        return $query->where('company_devices.id', '=', $id);
    }
}

?>