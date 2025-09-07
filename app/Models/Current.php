<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Facades\DB;

class Current extends Model
{
    use HasFactory;
    protected $guarded = [];

    public static function getVehicleList($filter)
    {
        $currents = Current::from('currents as C')
            ->join('employees AS E', 'E.id', '=', 'C.emp_id')
            ->join('products AS P', 'P.id', '=', 'C.product_id')
            ->join('portfolios AS Port', 'Port.id', '=', 'C.portfolio_id')
            ->where(function($query) use ($filter) {
                $query->where('E.name', 'like', '%'.$filter.'%')
                    ->orWhere('P.brand', 'like', '%'.$filter.'%')
                    ->orWhere('P.model', 'like', '%'.$filter.'%')
                    ->orWhere('C.portfolio_id', 'like', '%'.$filter.'%')
                    ->orWhere('C.location', 'like', '%'.$filter.'%');
            })
            ->orderBy('C.id', 'desc')
            ->where('C.status', 0)
            ->paginate(5, [
                'C.*',
                'E.name as emp_name',
                'P.brand as brand_name',
                'P.model as model_name',
                'P.eng_no as eng_no',
                'P.chassis_no as chassis_no',
                'P.registration_number as registration_number',
                'Port.name as portfolio_name',
                'P.registration_date as reg_date',
                'C.receive_date',
            ]);

            // Add duration for each row
            foreach ($currents as $current) {
                $receive_date = \Carbon\Carbon::parse($current->receive_date);
                $registration_date = \Carbon\Carbon::parse($current->reg_date);
                $end = now();

                if ($end && $receive_date) {
                    $diff = $receive_date->diff($end);
                    $current->total_receive_duration = $diff->y . ' years '.',' . $diff->m . ' months ' .','. $diff->d . ' days';
                } else {
                    $current->total_receive_duration = null; 
                }

                if ($end && $registration_date) {
                    $diff = $registration_date->diff($end);
                    $current->total_reg_duration = $diff->y . ' years '.',' . $diff->m . ' months ' .','. $diff->d . ' days';
                } else {
                    $current->total_reg_duration = null; 
                }
            }

        return $currents;
    }

    public static function getTransferList($filter)
    {
        $currents = Current::from('currents as C')
            ->join('employees AS E', 'E.id', '=', 'C.emp_id')
            ->join('products AS P', 'P.id', '=', 'C.product_id')
            ->join('portfolios AS Port', 'Port.id', '=', 'C.portfolio_id')
            ->where(function($query) use ($filter) {
                $query->where('E.name', 'like', '%'.$filter.'%')
                    ->orWhere('P.brand', 'like', '%'.$filter.'%')
                    ->orWhere('P.model', 'like', '%'.$filter.'%')
                    ->orWhere('C.portfolio_id', 'like', '%'.$filter.'%')
                    ->orWhere('C.location', 'like', '%'.$filter.'%');
            })
            ->orderBy('C.id', 'desc')
            ->where('C.status', 1)
            ->paginate(5, [
                'C.*',
                'E.name as emp_name',
                'P.brand as brand_name',
                'P.model as model_name',
                'P.eng_no as eng_no',
                'P.chassis_no as chassis_no',
                'P.registration_number as registration_number',
                'Port.name as portfolio_name',
                'P.registration_date as reg_date',
                'C.receive_date',
            ]);

            // Add duration for each row
            foreach ($currents as $current) {
                $receive_date = \Carbon\Carbon::parse($current->receive_date);
                $registration_date = \Carbon\Carbon::parse($current->reg_date);
                $end = now();

                if ($end && $receive_date) {
                    $diff = $receive_date->diff($end);
                    $current->total_receive_duration = $diff->y . ' years '.',' . $diff->m . ' months ' .','. $diff->d . ' days';
                } else {
                    $current->total_receive_duration = null; 
                }

                if ($end && $registration_date) {
                    $diff = $registration_date->diff($end);
                    $current->total_reg_duration = $diff->y . ' years '.',' . $diff->m . ' months ' .','. $diff->d . ' days';
                } else {
                    $current->total_reg_duration = null; 
                }
            }

        return $currents;
    }

    public static function getEmployeeList(){
        
         $currents = Current::from('currents as C')
                    ->join('employees AS E', 'E.id', '=', 'C.emp_id')
                    ->where('C.status', 0)
                    ->get(['E.*']);
        return $currents;
    }

    public static function getEmpWiseVehicleList($empName = null)
    {
        $currents = Current::from('currents as C')
            ->join('employees AS E', 'E.id', '=', 'C.emp_id')
            ->join('products AS P', 'P.id', '=', 'C.product_id')
            ->join('portfolios AS Port', 'Port.id', '=', 'C.portfolio_id')
            ->when($empName, function ($query, $empName) {
                return $query->where('C.emp_id', $empName); 
            })
            ->where('C.emp_id', $empName)
            ->paginate(5, [
                'C.*',
                'E.name as emp_name',
                'P.brand as brand_name',
                'P.model as model_name',
                'P.eng_no as eng_no',
                'P.chassis_no as chassis_no',
                'P.registration_number as registration_number',
                'Port.name as portfolio_name',
                'P.registration_date as reg_date',
                'C.receive_date',
            ]);

        foreach ($currents as $current) {
            $receive_date = \Carbon\Carbon::parse($current->receive_date);
            $registration_date = \Carbon\Carbon::parse($current->reg_date);
            $end = now();

            if ($end && $receive_date) {
                $diff = $receive_date->diff($end);
                $current->total_receive_duration = $diff->y . ' years '.',' . $diff->m . ' months ' .','. $diff->d . ' days';
            } else {
                $current->total_receive_duration = null; 
            }

            if ($end && $registration_date) {
                $diff = $registration_date->diff($end);
                $current->total_reg_duration = $diff->y . ' years '.',' . $diff->m . ' months ' .','. $diff->d . ' days';
            } else {
                $current->total_reg_duration = null; 
            }
        }

        return $currents;
    }
    
    public static function chassisWiseVehicleList($product)
    {
        $currents = Current::from('currents as C')
            ->join('employees AS E', 'E.id', '=', 'C.emp_id')
            ->join('products AS P', 'P.id', '=', 'C.product_id')
            ->join('portfolios AS Port', 'Port.id', '=', 'C.portfolio_id')
            ->when($product, function ($query, $product) {
                if (is_numeric($product)) {
                    return $query->where('C.emp_id', $product);
                }
                return $query->where('E.name', 'like', '%' . $product . '%');
            })
            ->where('C.product_id', $product)
            ->paginate(5, [
                'C.*',
                'E.name as emp_name',
                'P.brand as brand_name',
                'P.model as model_name',
                'P.eng_no as eng_no',
                'P.chassis_no as chassis_no',
                'P.registration_number as registration_number',
                'Port.name as portfolio_name',
                'P.registration_date as reg_date',
                'C.receive_date',
            ]);

        foreach ($currents as $current) {
            $receive_date = \Carbon\Carbon::parse($current->receive_date);
            $registration_date = \Carbon\Carbon::parse($current->reg_date);
            $end = now();

            if ($end && $receive_date) {
                $diff = $receive_date->diff($end);
                $current->total_receive_duration = $diff->y . ' years '.',' . $diff->m . ' months ' .','. $diff->d . ' days';
            } else {
                $current->total_receive_duration = null; 
            }

            if ($end && $registration_date) {
                $diff = $registration_date->diff($end);
                $current->total_reg_duration = $diff->y . ' years '.',' . $diff->m . ' months ' .','. $diff->d . ' days';
            } else {
                $current->total_reg_duration = null; 
            }
        }

        return $currents;
    }

    public static function getEligibleUserList($filter)
    {
        $currents = Current::from('currents as C')
            ->join('employees AS E', 'E.id', '=', 'C.emp_id')
            ->join('products AS P', 'P.id', '=', 'C.product_id')
            ->join('portfolios AS Port', 'Port.id', '=', 'C.portfolio_id')
            ->where(function($query) use ($filter) {
                $query->where('E.name', 'like', '%'.$filter.'%')
                    ->orWhere('P.brand', 'like', '%'.$filter.'%')
                    ->orWhere('P.model', 'like', '%'.$filter.'%')
                    ->orWhere('C.portfolio_id', 'like', '%'.$filter.'%')
                    ->orWhere('C.location', 'like', '%'.$filter.'%');
            })
        ->where('C.is_assign', 0)            
        ->where(function($query) { // loan duration count
                $query->where(function($q) {
                    $q->where('C.is_loan', 1) // Cash
                    ->whereRaw("C.receive_date <= DATE_SUB(C.transfer_at, INTERVAL 6 YEAR)");
                })
                ->orWhere(function($q) {
                    $q->where('C.is_loan', 0) // Loan
                    ->whereRaw("C.receive_date <= DATE_SUB(C.transfer_at, INTERVAL 5 YEAR)");
                });
            })
        ->orderBy('C.id', 'desc')
        ->paginate(5, [
            'C.*',
            'E.name as emp_name',
            'P.brand as brand_name',
            'P.model as model_name',
            'P.eng_no as eng_no',
            'P.chassis_no as chassis_no',
            'P.registration_number as registration_number',
            'Port.name as portfolio_name',
            'P.registration_date as reg_date',
            'C.receive_date',
        ]);

        // Add duration for each row
        foreach ($currents as $current) {
            $receive_date = \Carbon\Carbon::parse($current->receive_date);
            $registration_date = \Carbon\Carbon::parse($current->reg_date);
            $end = now();

            if ($end && $receive_date) {
                $diff = $receive_date->diff($end);
                $current->total_receive_duration = $diff->y . ' years, ' . $diff->m . ' months, ' . $diff->d . ' days';
            } else {
                $current->total_receive_duration = null; 
            }

            if ($end && $registration_date) {
                $diff = $registration_date->diff($end);
                $current->total_reg_duration = $diff->y . ' years, ' . $diff->m . ' months, ' . $diff->d . ' days';
            } else {
                $current->total_reg_duration = null; 
            }
        }

        return $currents;
    }
    public static function getAssignVehicleList($filter)
    {
        $currents = Current::from('currents as C')
            ->join('employees AS E', 'E.id', '=', 'C.emp_id')
            ->join('products AS P', 'P.id', '=', 'C.product_id')
            ->join('portfolios AS Port', 'Port.id', '=', 'C.portfolio_id')
            ->where(function($query) use ($filter) {
                $query->where('E.name', 'like', '%'.$filter.'%')
                    ->orWhere('P.brand', 'like', '%'.$filter.'%')
                    ->orWhere('P.model', 'like', '%'.$filter.'%')
                    ->orWhere('C.portfolio_id', 'like', '%'.$filter.'%')
                    ->orWhere('C.location', 'like', '%'.$filter.'%');
            })
        ->where('C.is_assign', 1)            
        ->where(function($query) { // loan duration count
                $query->where(function($q) {
                    $q->where('C.is_loan', 1) // Cash
                    ->whereRaw("C.receive_date <= DATE_SUB(C.transfer_at, INTERVAL 6 YEAR)");
                })
                ->orWhere(function($q) {
                    $q->where('C.is_loan', 0) // Loan
                    ->whereRaw("C.receive_date <= DATE_SUB(C.transfer_at, INTERVAL 5 YEAR)");
                });
            })
        ->orderBy('C.id', 'desc')
        ->paginate(5, [
            'C.*',
            'E.name as emp_name',
            'P.brand as brand_name',
            'P.model as model_name',
            'P.eng_no as eng_no',
            'P.chassis_no as chassis_no',
            'P.registration_number as registration_number',
            'Port.name as portfolio_name',
            'P.registration_date as reg_date',
            'C.receive_date',
        ]);

        // Add duration for each row
        foreach ($currents as $current) {
            $receive_date = \Carbon\Carbon::parse($current->receive_date);
            $registration_date = \Carbon\Carbon::parse($current->reg_date);
            $end = now();

            if ($end && $receive_date) {
                $diff = $receive_date->diff($end);
                $current->total_receive_duration = $diff->y . ' years, ' . $diff->m . ' months, ' . $diff->d . ' days';
            } else {
                $current->total_receive_duration = null; 
            }

            if ($end && $registration_date) {
                $diff = $registration_date->diff($end);
                $current->total_reg_duration = $diff->y . ' years, ' . $diff->m . ' months, ' . $diff->d . ' days';
            } else {
                $current->total_reg_duration = null; 
            }
        }

        return $currents;
    }

}
