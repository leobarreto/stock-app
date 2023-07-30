<?php

namespace App\Http\Requests;

use App\Models\Category;

class Functions
{
    public function skugenerate($productName, $categoryId, $productId)
    {
        $category = Category::findOrFail($categoryId);
        $categoryName = $category->name;

        // Remover espaços e caracteres especiais do nome do produto e da categoria
        $productName = preg_replace('/[^a-zA-Z0-9]/', '', $productName);
        $categoryId = preg_replace('/[^a-zA-Z0-9]/', '', $categoryId);
        $categoryName = preg_replace('/[^a-zA-Z0-9]/', '', $categoryName);

        // Converter o nome do produto e categoria para letras minúsculas
        $productName = strtoupper($productName);
        $categoryId = strtoupper($categoryId);
        $categoryName = strtoupper($categoryName);

        // Limitar o comprimento do nome do produto e categoria para 3 caracteres cada
        $productName = substr($productName, 0, 3);
        $categoryId = substr($categoryId, 0, 3);
        $categoryName = substr($categoryName, 0, 3);

        // Formar o SKU combinando informações
        $sku = $categoryId . $categoryName . '-' . $productName . '-' . $productId;

        return $sku;
    }
}
