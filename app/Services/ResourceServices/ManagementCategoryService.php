<?php

namespace App\Services\ResourceServices;

use App\Models\Invoice;
use App\Models\InvoicePosition;
use App\Models\Product;
use App\Models\ProductCategory;
use Carbon\Carbon;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;

class ManagementCategoryService
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

    /*
    |--------------------------------------------------------------------------
    | CATEGORY CREATE
    |--------------------------------------------------------------------------
    */

    public static function createCategory(array $data): ProductCategory
    {
        $filters = self::normalizeFilters(
            $data['filters'] ?? []
        );

        return ProductCategory::create([
            'name' => $data['name'],
            'filters' => $filters,
        ]);
    }

    /*
    |--------------------------------------------------------------------------
    | CATEGORY UPDATE
    |--------------------------------------------------------------------------
    */

    public static function updateCategory(
        ProductCategory $category,
        array $data
    ): ProductCategory {

        DB::transaction(function () use ($category, $data) {
            $oldFilters = $category->filters ?? [];

            $newFilters = self::normalizeFilters(
                $data['filters'] ?? []
            );

            $category->update([
                'name' => $data['name'],
                'filters' => $newFilters,
            ]);

            self::syncProductsWithCategoryFilters(
                $category,
                $oldFilters,
                $newFilters
            );
        });

        return $category->fresh();
    }

    /*
    |--------------------------------------------------------------------------
    | DELETE CATEGORY
    |--------------------------------------------------------------------------
    */

    public static function deleteCategory(ProductCategory $category): void {
        if (Product::where('category_id', $category->category_id)->exists()) {
            throw new \Exception('Diese Kategorie kann nicht gelöscht werden. Entfernen Sie zuerst alle Produkte aus dieser Kategorie');
        }
        $category->delete();
    }

    /*
    |--------------------------------------------------------------------------
    | SYNC PRODUCT ATTRIBUTES
    |--------------------------------------------------------------------------
    */

    private static function syncProductsWithCategoryFilters(
        ProductCategory $category,
        array $oldFilters,
        array $newFilters
    ): void {

        $oldFilterKeys = array_keys($oldFilters);

        $newFilterKeys = array_keys($newFilters);

        $removedFilters = array_diff(
            $oldFilterKeys,
            $newFilterKeys
        );

        $addedFilters = array_diff(
            $newFilterKeys,
            $oldFilterKeys
        );

        $products = Product::where(
            'category_id',
            $category->category_id
        )->get();

        foreach ($products as $product) {

            $attributes = $product->attributes ?? [];

            $properties = $attributes['properties'] ?? [];

            /*
            |--------------------------------------------------------------------------
            | REMOVE FILTERS
            |--------------------------------------------------------------------------
            */

            foreach ($removedFilters as $removedFilter) {

                unset($properties[$removedFilter]);
            }

            /*
            |--------------------------------------------------------------------------
            | ADD FILTERS
            |--------------------------------------------------------------------------
            */

            foreach ($addedFilters as $addedFilter) {

                $filterType = $newFilters[$addedFilter]['type'];

                $properties[$addedFilter] =
                    $filterType === 'color'
                    ? []
                    : [];
            }

            $attributes['properties'] = $properties;

            $product->attributes = $attributes;

            $product->save();
        }
    }

    /*
    |--------------------------------------------------------------------------
    | NORMALIZE FILTERS
    |--------------------------------------------------------------------------
    */

    private static function normalizeFilters(
        array $filters
    ): array {

        $normalized = [];

        foreach ($filters as $filter) {

            if (empty($filter['key'])) {
                continue;
            }

            $key = Str::slug(
                $filter['key'],
                '_'
            );

            /*
            |--------------------------------------------------------------------------
            | PRINT MUST ALWAYS EXIST
            |--------------------------------------------------------------------------
            */

            if ($key === 'print') {

                $normalized['print'] = [
                    'type' => 'select',
                    'displayName' => 'Aufdruck',
                ];

                continue;
            }

            /*
            |--------------------------------------------------------------------------
            | COLOR ALWAYS TYPE COLOR
            |--------------------------------------------------------------------------
            */

            $type =
                $key === 'color'
                ? 'color'
                : 'select';

            $normalized[$key] = [
                'type' => $type,
                'displayName' => $filter['displayName']
                    ?? ucfirst($key),
            ];
        }

        /*
        |--------------------------------------------------------------------------
        | ENSURE PRINT EXISTS
        |--------------------------------------------------------------------------
        */

        if (!isset($normalized['print'])) {

            $normalized['print'] = [
                'type' => 'select',
                'displayName' => 'Aufdruck',
            ];
        }

        return $normalized;
    }
}
