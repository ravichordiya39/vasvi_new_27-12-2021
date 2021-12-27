<?php

namespace App\Imports;

use App\Models\Product;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithStartRow;
use App\Models\ProductVariation;
use App\Models\ProductAttribute;
use App\Models\ProductImage;
use App\Models\Size;



class ProductImport implements ToModel,WithStartRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function startRow(): int
    {
      return 2;
    }
    public function model(array $row)
    {

        $product = new Product;
        $product->user_id = 1;
        $product->category_id = $row[1];
        $product->sub_category_id = $row[2];
        $product->sub_category_child_id = $row[3];
        $product->name = $row[0];
        $product->description = $row[15];
        $product->details = $row[14];
        $product->care_and_disclaimer = $row[13];
        $product->sku_code = $row[4];
        $product->hsn_code = $row[5];
        $product->discount_type = $row[7];
        $product->discount = $row[8];
        $product->in_stock = 1;
        $product->slug = create_slug($row[0]);
        $product->is_exclusive = $row[9];
        $product->is_featured = $row[10];
        $product->is_new = $row[11];
        $product->is_bulk = 0;
        $product->status = $row[12];
        $product->save();

        $discount_type = $row[7];
        $discount = $row[8];

        // colors
        $colors = str_replace('[','',$row[19]);
        $colors = str_replace(']','',$colors);
        $colors = explode(',', $colors);


        // primary
        $primaries = str_replace('[','',$row[18]);
        $primaries = str_replace(']','',$primaries);
        $primaries = explode(',', $primaries);


        // attributes
        $attributes = str_replace('[','',$row[16]);
        $attributes = str_replace(']','',$attributes);
        $attributes = explode(',', $attributes);

        $values = str_replace('[','',$row[17]);
        $values = str_replace(']','',$values);
        $values = explode(',', $values);
        for($k = 0 ; $k < count($attributes) ; $k++){
           $attr = new ProductAttribute;
           $attr->product_id = $product->id;
           $attr->attribute_id = $attributes[$k];
           $attr->attribute_value_id = $values[$k];
           $attr->status = 1;
           $attr->save();
        }


        for($i = 0 ; $i < count($colors); $i++){
          $sizes = $row[20];
          $sizes =  substr($sizes, 1, -1);
          $sizes = explode('],[',$sizes);
          $dsizes = explode(',',$sizes[$i]);


          // single price
          $single_prices = $row[21];
          $single_prices =  substr($single_prices, 1, -1);
          $single_prices = explode('],[',$single_prices);
          $dsingle_prices = explode(',',$single_prices[$i]);


          // single qty price
          $single_qty_prices = $row[22];
          $single_qty_prices =  substr($single_qty_prices, 1, -1);
          $single_qty_prices = explode('],[',$single_qty_prices);
          $dsingle_qty_prices = explode(',',$single_qty_prices[$i]);


          // wholesale_price
          $wholesale_price = $row[23];
          $wholesale_price =  substr($wholesale_price, 1, -1);
          $wholesale_price = explode('],[',$wholesale_price);
          $dwholesale_price = explode(',',$wholesale_price[$i]);



          // wholesale_price_quantity
          $wholesale_price_quantity = $row[24];
          $wholesale_price_quantity =  substr($wholesale_price_quantity, 1, -1);
          $wholesale_price_quantity = explode('],[',$wholesale_price_quantity);
          $dwholesale_price_quantity = explode(',',$wholesale_price_quantity[$i]);


         // in_stock
         $in_stock = $row[25];
         $in_stock =  substr($in_stock, 1, -1);
         $in_stock = explode('],[',$in_stock);
         $din_stock = explode(',',$in_stock[$i]);



           for($j = 0; $j < count($dsizes) ; $j++){
               $size = Size::where('name',$dsizes[$j])->first();
               $var = new ProductVariation;
               $var->product_id = $product->id;
               $var->color_id = $colors[$i];
               $var->size_id = $size->id;
               $var->primary_variation = $primaries[$i];
               $var->single_price = $dsingle_prices[$j];
               if($discount_type == 0){
                 $var->single_sales_price =  $dsingle_prices[$j] - ($dsingle_prices[$j] * ($discount/100)) ;
               }
               else{
                 $var->single_sales_price =  $dsingle_prices[$j] - $discount ;
               }
               $var->single_price_quantity = $dsingle_qty_prices[$j];
               $var->wholesale_price = $dwholesale_price[$j];
               if($discount_type == 0){
                 $var->wholesale_sales_price =  $dwholesale_price[$j] - ($dwholesale_price[$j] * ($discount/100)) ;
               }
               else{
                 $var->wholesale_sales_price =  $dwholesale_price[$j] - $discount ;
               }
               $var->wholesale_price_quantity = $dwholesale_price_quantity[$j];
               $var->size_status = $din_stock[$j];
               $var->status = 1;
               $var->save();
           }

           for($m = 0; $m < 2 ; $m++){
             $img = new ProductImage;
             $img->file_name = "1637635087z74NGu8R.png";
             $img->product_id = $product->id;
             $img->product_color_id = $colors[$i];
             $img->type = 1;
             $img->save();
           }
        }
      return ;
    }
}
