<?php

namespace App\Services\ResourceServices;

use App\Models\Invoice;
use App\Models\InvoicePosition;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class ManagementService
{
    public function __construct(){}

    public static function getDashboardDetails():array {
        $orderCount = Invoice::count();
        $soldProductsCount = InvoicePosition::sum('amount');
        $mostSoldProduct = InvoicePosition::select(
                ['product.name',
                DB::raw('SUM(invoice_position.amount) as total_sold')]
            )
            ->join('product', 'invoice_position.product_id', '=', 'product.id')
            ->groupBy('product.id', 'product.name')
            ->orderByDesc('total_sold')
            ->first();
        $mostSoldProductName = $mostSoldProduct ? $mostSoldProduct->name:'-:-';
        $startDate = Carbon::now()->startOfDay()->subDays(6);
        $ordersByDay = Invoice::selectRaw('DATE(order_date) as day')
            ->selectRaw('COUNT(*) as total')
            ->where('order_date', '>=', $startDate)
            ->groupBy('day')
            ->orderBy('day')
            ->get()
            ->keyBy(function ($item) {
                return Carbon::parse($item->day)
                    ->format('l');
            });
        $lastWeekSalesCount = [];
        for ($i = 6; $i >= 0; $i--) {
            $date = Carbon::now()->subDays($i);
            $dayName = strtolower(
                $date->format('l')
            );
            $lastWeekSalesCount[$dayName] = $ordersByDay[$date->format('l')]->total ?? 0;
        }
        return [
            'orderCount' => $orderCount, 
            'soldProductsCount' => $soldProductsCount, 
            'mostSoldProductName' => $mostSoldProductName, 
            'lastWeekSalesCount' => $lastWeekSalesCount,
        ];
    }
}
