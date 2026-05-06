<?php
declare (strict_types = 1);
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Product extends Model
{
    public function getProductCards(?int $category_id = null, array ...$filteredAttributes): array {
        return [];
    }

    public function getFeaturedProductCards(): array {
        return [];
    }

    private function deserializeAttributes(array $product): array {
        return [];
    }

    public function getProductByHandle(string $handle): array {
        return [];
    }

    public function getProductById(string $uuid): array {
        return [];
    }
}
