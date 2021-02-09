<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class AccessLog extends Model
{
    use HasFactory;

    protected $table = 'access_logs';
    protected $primaryKey = 'id';
    protected $connection = 'mysql';
    public $incrementing = true;
    protected $fillable = [
        'machine_name',
        'machine_address',
    ];

    /**
     * insertAccessLogs
     *
     * @return void
     */
    public function insertAccessLogs()
    {
        $accessLog = AccessLog::create([
            'machine_name' => gethostname(),
            'machine_address' => $_SERVER['REMOTE_ADDR'],
        ]);

        return $accessLog;
    }

    /**
     * getAccessLogs
     *
     * @param array $request
     * @return void
     */
    public function getAccessLogs()
    {
        $accessLog = AccessLog::select(DB::raw('count(*) as number_of_access'))
            ->select(['machine_name', 'machine_address', 'created_at'])
            ->groupBy('machine_name')
            ->get();

        return $accessLog;
    }
}
