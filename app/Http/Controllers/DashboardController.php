<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Order;
use App\Models\User;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        $user = auth()->user();
        $role = $user->role_id;

        $today = Carbon::today();
        $yesterday = Carbon::yesterday();

        if ($role == 2) {
            $base = DB::table('order_items')->where('vendor_id', $user->id);
        } else {
            $base = Order::query();
        }

        $todayOrders = ($role == 2)
            ? $base->whereDate('created_at', $today)->count()
            : Order::whereDate('created_at', $today)->count();

        $yesterdayOrders = ($role == 2)
            ? DB::table('order_items')->where('vendor_id',$user->id)->whereDate('created_at',$yesterday)->count()
            : Order::whereDate('created_at',$yesterday)->count();

        $thisMonthOrders = ($role == 2)
            ? DB::table('order_items')->where('vendor_id',$user->id)->whereMonth('created_at', now()->month)->count()
            : Order::whereMonth('created_at', now()->month)->count();

        $lastMonthOrders = ($role == 2)
            ? DB::table('order_items')->where('vendor_id',$user->id)->whereMonth('created_at', now()->subMonth()->month)->count()
            : Order::whereMonth('created_at', now()->subMonth()->month)->count();

        // order status
        $statusQuery = ($role == 2)
            ? DB::table('order_items')->where('vendor_id',$user->id)
            : Order::query();

        $totalOrders   = $statusQuery->count();
        $pending       = $statusQuery->clone()->where('status','pending')->count();
        $processing    = $statusQuery->clone()->where('status','processing')->count();
        $delivered     = $statusQuery->clone()->where('status','delivered')->count();

        // monthly sales chart
        if ($role == 2) {
            $monthlySales = DB::table('order_items')
                            ->selectRaw("
                                DATE_FORMAT(created_at, '%b') as month,
                                MONTH(created_at) as month_num,
                                COUNT(DISTINCT order_id) as total_orders
                            ")
                            ->where('vendor_id', $user->id)
                            ->groupBy('month', 'month_num')
                            ->orderBy('month_num', 'asc')
                            ->pluck('total_orders', 'month');
        } else {
            $monthlySales = $monthlySales = Order::selectRaw("
                            DATE_FORMAT(created_at, '%b') as month,
                            MONTH(created_at) as month_num,
                            COUNT(*) as total_orders
                        ")
                        ->groupBy('month', 'month_num')
                        ->orderBy('month_num', 'asc')
                        ->pluck('total_orders', 'month');
        }

        // monthly income 
        if ($role == 2) {
            $monthlyIncome = DB::table('order_items')
                    ->selectRaw("DATE_FORMAT(created_at, '%b') as month, SUM(price) as total_income")
                    ->where('vendor_id', $user->id)
                    ->groupBy('month')
                    ->orderByRaw("MIN(created_at)")
                    ->pluck('total_income', 'month');
        } else {
                $monthlyIncome = Order::selectRaw("DATE_FORMAT(created_at, '%b') as month, SUM(grand_total) as total_income")
                    ->groupBy('month')
                    ->orderByRaw("MIN(created_at)")
                    ->pluck('total_income', 'month');
        }

        if ($role == 2) {
            return view('admin.vendor.vendorDashboard', compact(
                'role',
                'todayOrders',
                'yesterdayOrders',
                'thisMonthOrders',
                'lastMonthOrders',
                'totalOrders',
                'pending',
                'processing',
                'delivered',
                'monthlySales',
                'monthlyIncome'
            ));
        } else {
            return view('admin.pages.dashboard', compact(
                'role',
                'todayOrders',
                'yesterdayOrders',
                'thisMonthOrders',
                'lastMonthOrders',
                'totalOrders',
                'pending',
                'processing',
                'delivered',
                'monthlySales',
                'monthlyIncome'
            ));
        }
    }

   public function reportPage(Request $request)
{
    $user = auth()->user();

    $month = $request->month ?? Carbon::now()->month;
    $year  = $request->year ?? Carbon::now()->year;

    if ($user->role_id == 1) {

        $data = Order::with('user')
            ->whereMonth('created_at', $month)
            ->whereYear('created_at', $year)
            ->latest()
            ->get();

        $type = 'Admin Monthly Report';

    } else {

        $data = DB::table('order_items')
            ->join('orders', 'orders.id', '=', 'order_items.order_id')
            ->where('order_items.vendor_id', $user->id)
            ->whereMonth('orders.created_at', $month)
            ->whereYear('orders.created_at', $year)
            ->select(
                'orders.id',
                'orders.grand_total',
                'order_items.status',
                'orders.created_at'
            )
            ->latest()
            ->get();

        $type = 'Vendor Monthly Report';
    }

    return view('admin.pages.report.index', compact('data', 'type', 'month', 'year'));
}

    // pdf
    public function exportPdf(Request $request)
    {
        $user = auth()->user();

        $month = $request->month ?? Carbon::now()->month;
        $year  = $request->year ?? Carbon::now()->year;

        if ($user->role_id == 1) {

            $data = Order::with('user')
                ->whereMonth('created_at', $month)
                ->whereYear('created_at', $year)
                ->latest()
                ->get();

            $type = 'Admin Monthly Report';

        } else {

            $data = DB::table('order_items')
                ->join('orders', 'orders.id', '=', 'order_items.order_id')
                ->where('order_items.vendor_id', $user->id)
                ->whereMonth('orders.created_at', $month)
                ->whereYear('orders.created_at', $year)
                ->select(
                    'orders.id',
                    'orders.grand_total',
                    'order_items.status',
                    'orders.created_at'
                )
                ->latest()
                ->get();

            $type = 'Vendor Monthly Report';
        }

        $pdf = Pdf::loadView('admin.pages.report.pdf', compact('data', 'type'));

        return $request->view
            ? $pdf->stream('report.pdf')
            : $pdf->download('report.pdf');
    }
}
