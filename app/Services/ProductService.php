<?php

namespace App\Services;

use App\Models\ProductAssoc;

use Illuminate\Support\Facades\DB;

class ProductService
{
    //We call this function for json data of Product category
    public function getProductJson($productCategoryID)
    {
        $data = [];

        $productAssocData = ProductAssoc::select(
            'product_assoc.PRODUCT_ID AS main_product_id',
            'product_assoc.PRODUCT_ID_TO AS related_product_id',
            'product_feature_appl.PRODUCT_FEATURE_ID AS standard_feature_id',
            'product_assoc.PRODUCT_ID_TO'
        )
            ->leftJoin('product_feature_appl', 'product_assoc.PRODUCT_ID_TO', '=', 'product_feature_appl.PRODUCT_ID')
            ->where('product_assoc.PRODUCT_ID', 'like', $productCategoryID)
            ->get();


        //  using this for laravel eloquent relationship
        // $productAssocData = ProductAssoc::with('productFeatureAppl')
        // ->where('PRODUCT_ID', 'like', $productCategoryID)
        // ->get();

        // Transforming the result into the desired format
        foreach ($productAssocData as $row) {
            $mainProductID = $row->main_product_id;
            $relatedProductID = $row->related_product_id;
            $standardFeatureID = $row->standard_feature_id;

            //Query for standard feature main product 
            $standardFeatureSql = DB::table('product_feature as pf')
                ->select(
                    'p.MEDIUM_IMAGE_URL',
                    'p.PRODUCT_NAME',
                    'p.IS_VIRTUAL',
                    'p.IS_VARIANT',
                    'pf.*',
                    'pp.*'
                )
                ->leftJoin('product_feature_appl as pfa', 'pfa.PRODUCT_FEATURE_ID', '=', 'pf.PRODUCT_FEATURE_ID')
                ->leftJoin('product as p', 'p.PRODUCT_ID', '=', 'pfa.PRODUCT_ID')
                ->leftJoin('product_price as pp', 'pp.PRODUCT_ID', '=', 'pfa.PRODUCT_ID')
                ->where('pfa.PRODUCT_ID', $mainProductID)
                ->get();

            //Query for  related features of main product 
            $featureSql = DB::table('product_feature as pf')
                // ->select('pf.*','p.*')
                ->select(
                    'p.MEDIUM_IMAGE_URL',
                    'p.PRODUCT_NAME',
                    'p.IS_VIRTUAL',
                    'p.IS_VARIANT',
                    'pf.*',
                    'pp.*'
                )
                ->leftJoin('product_feature_appl as pfa', 'pfa.PRODUCT_FEATURE_ID', '=', 'pf.PRODUCT_FEATURE_ID')
                ->leftJoin('product as p', 'p.PRODUCT_ID', '=', 'pfa.PRODUCT_ID')
                ->leftJoin('product_price as pp', 'pp.PRODUCT_ID', '=', 'pfa.PRODUCT_ID')
                ->where('pf.PRODUCT_FEATURE_ID', $standardFeatureID)
                ->get();

            //array where store objects
            $relatedProducts = array();

            foreach ($featureSql as $relatedFeatures) {
                $relatedProducts[] = array( //storing this array related product of standard product
                    "PRODUCT_ID_TO" => $relatedProductID,
                    "PRODUCT_FEATURE_ID" => $relatedFeatures->PRODUCT_FEATURE_ID,
                    "PRODUCT_FEATURE_TYPE_ID" => $relatedFeatures->PRODUCT_FEATURE_TYPE_ID,
                    "PRODUCT_NAME" => $relatedFeatures->PRODUCT_NAME,
                    "PRODUCT_IMAGE" => $relatedFeatures->MEDIUM_IMAGE_URL,
                    "DESCRIPTION" => $relatedFeatures->DESCRIPTION,
                    "DEFAULT_AMOUNT" => $relatedFeatures->DEFAULT_AMOUNT
                );
            }

            //Main product this product has related products
            foreach ($standardFeatureSql as $standardFeature) {
                if (!isset($data[$mainProductID])) {
                    $data[$mainProductID] = collect([
                        "MAIN_PRODUCT_ID" => $mainProductID,
                        "PRODUCT_FEATURE_ID" => $standardFeature->PRODUCT_FEATURE_ID,
                        "PRODUCT_FEATURE_TYPE_ID" => $standardFeature->PRODUCT_FEATURE_TYPE_ID,
                        "PRODUCT_NAME" => $standardFeature->PRODUCT_NAME,
                        "VIRTUAL_PRODUCT" => $standardFeature->IS_VIRTUAL,
                        "PRODUCT_IMAGE" => $standardFeature->MEDIUM_IMAGE_URL,
                        "PRODUCT_PRICE" => $standardFeature->PRICE,
                        "DESCRIPTION" => $standardFeature->DESCRIPTION,
                        "RELATED_PRODUCTS" => $relatedProducts
                    ]);
                } else {
                    // If the main product ID already exists, only add the related product information
                    $data[$mainProductID]["RELATED_PRODUCTS"] = array_merge($data[$mainProductID]["RELATED_PRODUCTS"], $relatedProducts);
                }
            }

        }
        return $data;//return the json data array
    }
}
