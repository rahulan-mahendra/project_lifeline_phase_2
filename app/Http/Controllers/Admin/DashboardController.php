<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Services\ManagerDashboardService;
use App\Services\EmployeeDashboardService;
use App\Services\SuperAdminDashboardService;

class DashboardController extends Controller
{
    public function index(Request $request){
        if(Auth::check()){
            if(Auth::user()->isSuperAdmin())
            {
                // Pending Apponitments
                $pendingApponitments = SuperAdminDashboardService::totalPendingAppointmentCount();

                // Approved Apponitments
                $approvedApponitments = SuperAdminDashboardService::totalApprovedAppointmentCount();

                // Cancelled Apponitments
                $cancelledApponitments = SuperAdminDashboardService::totalCancelledAppointmentCount();

                // New Patient Apponitments
                $newPatientApponitments = SuperAdminDashboardService::totalNewPatientAppointmentsCount();

                // Old Patient Apponitments
                $oldPatientApponitments = SuperAdminDashboardService::totalOldPatientAppointmentsCount();

                // Clinic Apponitment Stats
                $clinicAppointmentStats = SuperAdminDashboardService::clinicAppointmentStats();

                // User Stats
                $userStats = SuperAdminDashboardService::userStats();

                // Clinic Stats
                $clinicStats = SuperAdminDashboardService::clinicStats();

                return view('superadmin-dashboard',
                compact(
                    'pendingApponitments','approvedApponitments','cancelledApponitments','newPatientApponitments','oldPatientApponitments', 'clinicAppointmentStats', 'userStats', 'clinicStats'
                ));
            }
            elseif (Auth::user()->isClinicManager())
            {
                // Pending Apponitments
                $pendingApponitments = ManagerDashboardService::totalPendingAppointmentCount();

                // Approved Apponitments
                $approvedApponitments = ManagerDashboardService::totalApprovedAppointmentCount();

                // Cancelled Apponitments
                $cancelledApponitments = ManagerDashboardService::totalCancelledAppointmentCount();

                // New Patient Apponitments
                $newPatientApponitments = ManagerDashboardService::totalNewPatientAppointmentsCount();

                // Old Patient Apponitments
                $oldPatientApponitments = ManagerDashboardService::totalOldPatientAppointmentsCount();

                // Clinic Apponitment Stats
                $clinicAppointmentStats = ManagerDashboardService::clinicAppointmentStats();

                return view('manager-dashboard',
                compact(
                    'pendingApponitments','approvedApponitments','cancelledApponitments','newPatientApponitments','oldPatientApponitments', 'clinicAppointmentStats'
                ));
            }
            else
            {
                // Pending Apponitments
                $pendingApponitments = EmployeeDashboardService::totalPendingAppointmentCount();

                // Approved Apponitments
                $approvedApponitments = EmployeeDashboardService::totalApprovedAppointmentCount();

                // Cancelled Apponitments
                $cancelledApponitments = EmployeeDashboardService::totalCancelledAppointmentCount();

                // New Patient Apponitments
                $newPatientApponitments = EmployeeDashboardService::totalNewPatientAppointmentsCount();

                // Old Patient Apponitments
                $oldPatientApponitments = EmployeeDashboardService::totalOldPatientAppointmentsCount();

                // Today's Pending Apponitments
                $todayPendingApponitments = EmployeeDashboardService::todayPendingAppointmentsCount();

                return view('employee-dashboard',
                compact(
                    'pendingApponitments','approvedApponitments','cancelledApponitments','newPatientApponitments','oldPatientApponitments','todayPendingApponitments'
                ));
            }
        }
    }
}
