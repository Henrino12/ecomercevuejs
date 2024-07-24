<?php

namespace Plugin\Multivendor\Models;

use Carbon\Carbon;
use Core\Models\User;
use Spatie\Sitemap\Tags\Url;
use Illuminate\Database\Eloquent\Model;
use Plugin\CartLooksCore\Models\Product;
use Spatie\Sitemap\Contracts\Sitemapable;
use Plugin\CartLooksCore\Models\ProductReview;
use Plugin\CartLooksCore\Models\OrderHasProducts;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;

class SellerShop extends Model implements Sitemapable
{

    protected $table = "tl_com_seller_shop";


    public function products(): HasMany
    {
        return $this->hasMany(Product::class, 'supplier', 'seller_id');
    }


    public function reviews(): HasManyThrough
    {
        return $this->hasManyThrough(ProductReview::class, Product::class, 'supplier', 'product_id', 'seller_id', 'id');
    }

    public function orders()
    {
        return $this->hasManyThrough(OrderHasProducts::class, Product::class, 'supplier', 'product_id', 'seller_id', 'id');
    }

    public function followers()
    {
        return $this->hasMany(SellerFollowers::class, 'seller_id', 'seller_id');
    }

    public function seller()
    {
        return $this->belongsTo(User::class, 'seller_id');
    }

    public function toSitemapTag(): Url | string | array
    {
        return Url::create('/shop' . '/' . $this->shop_slug)
            ->setLastModificationDate(Carbon::create($this->updated_at))
            ->setPriority(0.1);
    }
}
