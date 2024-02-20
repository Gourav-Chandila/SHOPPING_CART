<?php
namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use App\Models\OrderItem;//including model ProductCategory
use App\Models\ProdCatalogCategory;


class WelcomeController extends Controller
{
    public function showCarouselAndCategoriesCollection()
    {
        // Define carousel images array
        $carouselImages = [
            'images/carousel-img/Untitled_1920_x_1080px.webp',
            'images/carousel-img/image_2_e8cd9a28-00d1-4d4f-976c-d95b19ae2a66.webp',
            'images/carousel-img/image_3_15d2914c-cc2e-4b0a-9aa1-fdedc0e01bb6.webp',
            'images/carousel-img/image_4_7f3cc94c-6e7d-4adc-81f0-72ec0871b309.webp',
            'images/carousel-img/image_438dc762-6df4-4318-804b-97c1634f881a.webp'
        ];

        //Join query between product_category and prod_catalog_category
        $catalogId = 'ShoesCatalog';
        $productCategories = ProdCatalogCategory::where('PROD_CATALOG_ID', $catalogId)->get();


        $topSellingItems = OrderItem::select(
            'oi.product_id',
            'p.PRODUCT_NAME',
            'p.MEDIUM_IMAGE_URL',
            DB::raw('SUM(oi.QUANTITY) AS total_quantity_sold')
        )
            ->from('order_item as oi')
            ->join('product AS p', 'p.PRODUCT_ID', '=', 'oi.PRODUCT_ID')
            ->where('oi.ORDER_ID', 'LIKE', 'SH_CT%')
            ->groupBy('oi.product_id', 'p.product_name', 'p.MEDIUM_IMAGE_URL')
            ->orderByDesc('total_quantity_sold')
            ->limit(10)
            ->get();

        // Return the welcome view with both sets of data
        return view('welcome', [
            'carouselImages' => $carouselImages,
            'productCategories' => $productCategories,
            'topSellingItems' => $topSellingItems
        ]);
    }
}