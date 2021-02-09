<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AccessLog extends Model
{
    use HasFactory;

    protected $table = 'access_logs';
    protected $primaryKey = 'id';
    protected $connection = 'mysql';
    public $incrementing = true;

    /**
     * insertAccessLogs
     *
     * @param array $request
     * @return void
     */
    public function insertAccessLogs($request)
    {
        
    }

    /**
     * getAccessLogs
     *
     * @param array $request
     * @return void
     */
    public function getAccessLogs($request)
    {
        # code...
    }
}
