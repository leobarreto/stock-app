<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Http\Requests\Functions;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'category_id',
        'description',
        'price',
        'image',
        'expiration_date',
        'sku_product',
    ];

    public function getProduct($search)
    {
        if ($search) {
            $products = $this->where('name', 'LIKE', '%' . $search . '%')->get();
        } else {
            $products = $this->all();
        }

        return $products;
    }

    public function storeProduct($newProduct)
    {
        $function = new Functions;
        $product = $newProduct;

        $product['price'] = floatval(str_replace(',', '.', preg_replace('/[^\d,]/', '', $newProduct['price'])));
        $product['sku_product'] = $newProduct['_token'];

        $product['image'] = $newProduct['image']->store('products');

        $product = $this->create($product);

        $product->sku_product = $function->skugenerate($product['name'], $product['category_id'], $product['id']);

        $product->update();
    }
}
