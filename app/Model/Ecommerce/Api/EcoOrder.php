<?php

namespace App\Model\Ecommerce\Api;
use App\Model\Area\District;
use App\Model\Area\Thana;
use App\Model\Ecommerce\EcoPayment;
use App\User;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class EcoOrder extends Model
{
    protected $guarded = ['id'];
    protected $casts = [
        'created_at'  => 'date:Y-m-d',
        'updated_at' => 'datetime:Y-m-d',
    ];
    public function manyOrders(){
        return $this->hasMany('App\Model\Ecommerce\Api\EcoOrderDetail','order_id','id');
    }

    public function payments()
    {
        return $this->hasMany(EcoPayment::class, 'order_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function districts(){
        return $this->belongsTo(District::class, 'districts');
    }

    public function thana(){
        return $this->belongsTo(Thana::class, 'thana');
    }

    public function orderUser()
    {
        return $this->belongsTo(User::class, 'user_id')->select('id', 'phone', 'name');
    }

    public static function orderWeeklyReportForVendor()
    {
        $auth_id = auth()->id();
        $sql_pending = <<<sql_pending
            SELECT t.d as cday, IFNULL(cnt , 0) as count
            FROM (
                SELECT 'Saturday' AS d UNION ALL
                SELECT 'Sunday' UNION ALL
                SELECT 'Monday' UNION ALL
                SELECT 'Tuesday' UNION ALL
                SELECT 'Wednesday' UNION ALL
                SELECT 'Thursday' UNION ALL
                SELECT 'Friday'
            ) t
            LEFT JOIN (
                SELECT DAYNAME(o.updated_at) AS DAY, COUNT(*) AS cnt FROM eco_orders o
                JOIN  eco_order_details od ON o.id = od.order_id
                JOIN  eco_products p ON od.product_id = p.id
                WHERE p.vendor_id = {$auth_id} AND (o.updated_at >= DATE(NOW()) - INTERVAL 7 DAY) AND (o.order_status = 'pending')
                GROUP BY DAY
            ) t1
                ON t.d = t1.day
sql_pending;
        $sql_complete = <<<sql_complete
            SELECT t.d as cday, IFNULL(cnt , 0) as count
            FROM (
                SELECT 'Saturday' AS d UNION ALL
                SELECT 'Sunday' UNION ALL
                SELECT 'Monday' UNION ALL
                SELECT 'Tuesday' UNION ALL
                SELECT 'Wednesday' UNION ALL
                SELECT 'Thursday' UNION ALL
                SELECT 'Friday'
            ) t
            LEFT JOIN (
                SELECT DAYNAME(o.updated_at) AS DAY, COUNT(*) AS cnt FROM eco_orders o
                JOIN  eco_order_details od ON o.id = od.order_id
                JOIN  eco_products p ON od.product_id = p.id
                WHERE p.vendor_id = {$auth_id} AND (o.updated_at >= DATE(NOW()) - INTERVAL 7 DAY) AND (o.order_status = 'complete')
                GROUP BY DAY
            ) t1
                ON t.d = t1.day
sql_complete;
        $sql_cancel = <<<sql_cancel
            SELECT t.d as cday, IFNULL(cnt , 0) as count
            FROM (
                SELECT 'Saturday' AS d UNION ALL
                SELECT 'Sunday' UNION ALL
                SELECT 'Monday' UNION ALL
                SELECT 'Tuesday' UNION ALL
                SELECT 'Wednesday' UNION ALL
                SELECT 'Thursday' UNION ALL
                SELECT 'Friday'
            ) t
            LEFT JOIN (
                SELECT DAYNAME(o.updated_at) AS DAY, COUNT(*) AS cnt FROM eco_orders o
                JOIN  eco_order_details od ON o.id = od.order_id
                JOIN  eco_products p ON od.product_id = p.id
                WHERE p.vendor_id = {$auth_id} AND (o.updated_at >= DATE(NOW()) - INTERVAL 7 DAY) AND (o.order_status = 'cancel')
                GROUP BY DAY
            ) t1
                ON t.d = t1.day
sql_cancel;


        $pending = DB::select(DB::raw($sql_pending));
        $complete = DB::select(DB::raw($sql_complete));
        $cancel = DB::select(DB::raw($sql_cancel));

        $all = [
            "pending" => collect($pending)->pluck('count', 'cday')->toArray(),
            "complete" => collect($complete)->pluck('count', 'cday')->toArray(),
            "cancel" => collect($cancel)->pluck('count', 'cday')->toArray(),
        ];

        return $all;

    }

    public static function orderWeeklyReport()
    {
        $pending = DB::select(
            DB::raw(
                "
                        select t.d as cday, IFNULL(cnt , 0) as count
                        from (
                            select 'Saturday' as d union all
                            select 'Sunday' union all
                            select 'Monday' union all
                            select 'Tuesday' union all
                            select 'Wednesday' union all
                            select 'Thursday' union all
                            select 'Friday'
                        ) t
                        left join (
                            SELECT DAYNAME(updated_at) AS DAY, COUNT(*) as cnt
                            FROM `eco_orders`
                            WHERE (updated_at >= DATE(NOW()) - INTERVAL 7 DAY) AND order_status = 'pending'
                            GROUP BY DAY
                        ) t1
                            on t.d = t1.day
                     "
            )
        );

        $complete = DB::select(
            DB::raw(
                "
                        select t.d as cday, IFNULL(cnt , 0) as count
                        from (
                            select 'Saturday' as d union all
                            select 'Sunday' union all
                            select 'Monday' union all
                            select 'Tuesday' union all
                            select 'Wednesday' union all
                            select 'Thursday' union all
                            select 'Friday'
                        ) t
                        left join (
                            SELECT DAYNAME(updated_at) AS DAY, COUNT(*) as cnt
                            FROM `eco_orders`
                            WHERE (updated_at >= DATE(NOW()) - INTERVAL 7 DAY) AND order_status = 'complete'
                            GROUP BY DAY
                        ) t1
                            on t.d = t1.day
                     "
            )
        );

        $cancel = DB::select(
            DB::raw(
                "
                        select t.d as cday, IFNULL(cnt , 0) as count
                        from (
                            select 'Saturday' as d union all
                            select 'Sunday' union all
                            select 'Monday' union all
                            select 'Tuesday' union all
                            select 'Wednesday' union all
                            select 'Thursday' union all
                            select 'Friday'
                        ) t
                        left join (
                            SELECT DAYNAME(updated_at) AS DAY, COUNT(*) as cnt
                            FROM `eco_orders`
                            WHERE (updated_at >= DATE(NOW()) - INTERVAL 7 DAY) AND order_status = 'cancel'
                            GROUP BY DAY
                        ) t1
                            on t.d = t1.day
                     "
            )
        );

        $all = [
            "pending" => collect($pending)->pluck('count', 'cday')->toArray(),
            "complete" => collect($complete)->pluck('count', 'cday')->toArray(),
            "cancel" => collect($cancel)->pluck('count', 'cday')->toArray(),
        ];

        return $all;
    }


    public static function orderDateRangeReport($start_date = null, $end_date = null)
    {
        if(is_null($start_date) || $end_date) {
            $start_date = Carbon::now()->subDay(30)->format('Y-m-d');
            $end_date = Carbon::now()->format('Y-m-d');
        }
        $sql_pending = "SELECT DATE_FORMAT(updated_at, '%Y-%m-%d') AS date , COUNT(*) as count FROM `eco_orders` WHERE order_status = 'pending' AND (`updated_at` >= '{$start_date}' <= '{$end_date}') GROUP BY date ORDER BY date ASC";
        $sql_complete = "SELECT DATE_FORMAT(updated_at, '%Y-%m-%d') AS date , COUNT(*) as count FROM `eco_orders` WHERE order_status = 'complete' AND (`updated_at` >= '{$start_date}' <= '{$end_date}') GROUP BY date ORDER BY date ASC";
        $sql_cancel = "SELECT DATE_FORMAT(updated_at, '%Y-%m-%d') AS date , COUNT(*) as count FROM `eco_orders` WHERE order_status = 'cancel' AND (`updated_at` >= '{$start_date}' <= '{$end_date}') GROUP BY date ORDER BY date ASC";

        $pending = DB::select(DB::raw($sql_pending));
        $complete = DB::select(DB::raw($sql_complete));
        $cancel = DB::select(DB::raw($sql_cancel));

        $all = [
            "pending" => collect($pending)->pluck('count', 'date')->toArray(),
            "complete" => collect($complete)->pluck('count', 'date')->toArray(),
            "cancel" => collect($cancel)->pluck('count', 'date')->toArray(),
        ];

        return $all;

    }
}


