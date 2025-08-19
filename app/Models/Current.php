<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use DB;

class Current extends Model
{
    use HasFactory;
    protected $guarded = [];

    public static function getVehicleList($filter)
    {
        $currents = Current::from('currents as C')
            ->join('employees AS E', 'E.id', '=', 'C.emp_id')
            ->join('products AS P', 'P.id', '=', 'C.product_id')
            ->where(function($query) use ($filter) {
                $query->where('E.name', 'like', '%'.$filter.'%')
                    ->orWhere('P.brand', 'like', '%'.$filter.'%')
                    ->orWhere('P.model', 'like', '%'.$filter.'%')
                    ->orWhere('C.portfolio', 'like', '%'.$filter.'%')
                    ->orWhere('C.location', 'like', '%'.$filter.'%');
            })
            ->orderBy('C.id', 'desc')
            ->paginate(5, [
                'C.*',
                'E.name as emp_name',
                'P.brand as brand_name',
                'P.model as model_name',
                'P.registration_date as reg_date',
                'C.receive_date',
            ]);

            // Add duration for each record
            foreach ($currents as $current) {
                $start = \Carbon\Carbon::parse($current->reg_date);
                $end   = \Carbon\Carbon::parse($current->receive_date);

                if ($end && $start) {
                    $diff = $start->diff($end);
                    $current->total_duration = $diff->y . ' years '.',' . $diff->m . ' months ' .','. $diff->d . ' days';
                } else {
                    $current->total_duration = null; 
                }
            }

        return $currents;
    }

    public static function getOldVehicleList($filter)
    {
        $currents = Current::from('currents as C')
            ->join('employees AS E', 'E.id', '=', 'C.emp_id')
            ->join('products AS P', 'P.id', '=', 'C.product_id')
            ->where(function($query) use ($filter) {
                $query->where('E.name', 'like', '%'.$filter.'%')
                    ->orWhere('P.brand', 'like', '%'.$filter.'%')
                    ->orWhere('P.model', 'like', '%'.$filter.'%')
                    ->orWhere('C.portfolio', 'like', '%'.$filter.'%')
                    ->orWhere('C.location', 'like', '%'.$filter.'%');
            })
            ->orderBy('C.id', 'desc')
            ->where('C.mc_status', 'Old')
            ->paginate(5, [
                'C.*',
                'E.name as emp_name',
                'P.brand as brand_name',
                'P.model as model_name',
                'P.registration_date as reg_date',
                'C.receive_date',
            ]);

            // Add duration for each record
            foreach ($currents as $current) {
                $start = \Carbon\Carbon::parse($current->reg_date);
                $end   = \Carbon\Carbon::parse($current->receive_date);

                if ($end && $start) {
                    $diff = $start->diff($end);
                    $current->total_duration = $diff->y . ' years '.',' . $diff->m . ' months ' .','. $diff->d . ' days';
                } else {
                    $current->total_duration = null; 
                }
            }

        return $currents;
    }
    public static function getEmpWiseVehicleList($empName = null)
    {
        $currents = Current::from('currents as C')
            ->join('employees AS E', 'E.id', '=', 'C.emp_id')
            ->join('products AS P', 'P.id', '=', 'C.product_id')
            ->when($empName, function ($query, $empName) {
                if (is_numeric($empName)) {
                    return $query->where('C.emp_id', $empName);
                }
                return $query->where('E.name', 'like', '%' . $empName . '%');
            })
            ->paginate(5, [
                'C.*',
                'E.name as emp_name',
                'P.brand as brand_name',
                'P.model as model_name',
                'P.registration_date as reg_date',
                'C.receive_date',
            ]);

        foreach ($currents as $current) {
            $start = \Carbon\Carbon::parse($current->reg_date);
            $end   = \Carbon\Carbon::parse($current->receive_date);

            if ($end && $start) {
                $diff = $start->diff($end);
                $current->total_duration = $diff->y . ' years, ' . $diff->m . ' months, ' . $diff->d . ' days';
            } else {
                $current->total_duration = null;
            }
        }

        return $currents;
    }

}
