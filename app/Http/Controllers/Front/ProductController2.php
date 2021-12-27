<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Size;
use App\Models\Color;
use App\Models\Attribute;
use App\Models\AttributeValue;
use App\Models\ProductVariation;
use App\Models\Category;
use App\Models\ProductImage;
use App\Models\Wishlist;
use App\Models\ProductReview;
use App\Models\Brand;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index(Product $id) {
        $variations=[];
        $product=$id;
        $sizes=Size::all();
        $colors=Color::all();
        $primaryvariation=$product->productProductVariations()->where('primary_variation',1)->first();
        $images=$product->productProductImages()->where('product_color_id',$primaryvariation->color_id)->get();
        $firstimage=$product->productProductImages()->where('product_color_id',$primaryvariation->color_id)->first();
        return view('front.product',compact('product','sizes','colors','primaryvariation','images','firstimage'));
    }

    public function get_product_image(Request $request){
        $images=ProductImage::where('product_id',$request->productId)->where('product_color_id',$request->colorId)->get();
        return response()->json($images,200);
    }

    public function info($id){
      $product = Product::find($id);

      $like = false;
      if(\Auth::check()){
          $like = Wishlist::where('product_id', $product->id)
                          ->where('user_id', \Auth::user()->id)
                          ->first() ? true : false;
      }

      $info = [];
      $info['id'] = $product->id;
      $info['category'] = $product->category->name;
      $info['sub_category'] = $product->sub_category->name;
      $info['subcategory_id'] = $product->sub_category->id;
      $info['child_category'] = $product->child_category !== null ?? $product->child_category->name ;
      $info['name'] = $product->name;
      $info['desc'] = $product->description;
      $info['detail'] = $product->details;
      $info['slug'] = $product->slug;
      $info['sku'] = $product->sku_code;
      $info['in_stock'] = $product->in_stock;
      $info['is_exclusive'] = $product->is_exclusive;
      $info['is_featured'] = $product->is_featured;
      $info['is_new'] = $product->is_new;
      $info['is_bulk'] = $product->is_bulk;
      $info['view_count'] = $product->view_count;
      $info['discount_type'] = $product->discount_type;
      $info['discount'] = $product->discount;
      $info['tax_rate'] = $product->tax_rate;
      $info['status'] = $product->status;
      $info['description'] = $product->description;
      $info['details'] = $product->details;
      $info['slug'] = $product->slug;


      $info['images'] = $product->productProductImages;
      $info['variations'] = $product->productProductVariations;
      $info['attributes'] = $product->productProductAttributes;


      $z = 0;
      $color = [];
      $size = [];
      foreach($info['variations'] as $var){
          if($var['primary_variation'] === 1){
            $z++;
            if($z === 1){
              $size = Size::find($var['size_id']);
              $color = Color::find($var['color_id']);
            }
            else{
                break;
            }
          }
      }


       //   return view('store.popup.product', compact('info'));

      $price = ProductVariation::where('color_id', $color->id)->where('size_id', $size->id)->where('product_id', $info['id'])->first();

      $images = ProductImage::where('product_id', $info['id'])->get();
      return response()->json([
        'success' => true,
        'code' => 200,
        'html' => view('store.popup.product', compact('info','like'))->render(),
        'message' => 'Product info retrieve successfully.',
        'product' => $info,
        'color' => $color,
        'size' => $size,
        'images' => $images,
        'price' => $price
      ]);
    }

    public function detail($slug)
    {
        $sizes = Size::where('status', '1')->get();
        $colors = Color::where('status', '1')->get();
        $attributes=Attribute::where('status',1)->get();
        $attribute_values=AttributeValue::where('status',1)->get();
        $categories = Category::where('status',1)->get();

        $product = Product::where('slug', $slug)->first();
        if(!$product){
            return view('errors.404');
        }
        $like = false;
        if(\Auth::check()){
            $like = Wishlist::where('product_id', $product->id)
                            ->where('user_id', \Auth::user()->id)
                            ->first() ? true : false;
        }

        $category_str = $product->category->name . '  ' .$product->sub_category->name. '  '.$product->child_category;
        $info = [];
        $info['id'] = $product->id;
        $info['category'] = $product->category->name;
        $info['sub_category'] = $product->sub_category->name;
        $info['child_category'] = $product->child_category ? $product->child_category->name : '' ;
        $info['brand'] = Brand::first();
        $info['care'] = $product->care_and_disclaimer !== null ? $product->care_and_disclaimer : '';
        $info['subcategory_id'] = $product->sub_category->id;
        $info['name'] = $product->name;
        $info['hsn'] = $product->hsn_code;
        $info['desc'] = $product->description;
        $info['detail'] = $product->details;
        $info['slug'] = $product->slug;
        $info['sku'] = $product->sku_code;
        $info['in_stock'] = $product->in_stock;
        $info['is_exclusive'] = $product->is_exclusive;
        $info['is_featured'] = $product->is_featured;
        $info['is_new'] = $product->is_new;
        $info['is_bulk'] = $product->is_bulk;
        $info['view_count'] = $product->view_count;
        $info['discount_type'] = $product->discount_type;
        $info['discount'] = $product->discount;
        $info['tax_rate'] = $product->tax_rate;
        $info['status'] = $product->status;
        $info['description'] = $product->description;
        $info['details'] = $product->details;
        $info['slug'] = $product->slug;
        $info['sku_code'] = $product->slug;
        $info['primary_variation'] = $product->primary_variation;
        $info['images'] = $product->productProductImages;
        $info['variations'] = $product->productProductVariations;
        $info['attributes'] = $product->productProductAttributes;
        $info['reviews'] = $product->reviews;
        $info['rating'] =   count($product->reviews) > 0  ?
                           ProductReview::where('product_id', $product->id)->avg('rating')
                           : 0;
        $info['five']  = count($product->reviews) > 0  ?
        ProductReview::where('product_id', $product->id)->where('rating',5)->get()->count()
        : 0;

        $products = Product::where('category_id',$product->category_id)->limit(10)->get();
        $trending = [];
        $i = 0;

        foreach($products as $pro){
            $i++;
            $trending[$i]['id'] = $pro->id;
            $trending[$i]['category'] = $pro->category->name;
            $trending[$i]['sub_category'] = $pro->sub_category->name;
            $trending[$i]['child_category'] = $pro->child_category !== null ?? $pro->child_category->name ;
            $trending[$i]['name'] = $pro->name;
            $trending[$i]['desc'] = $pro->description;
            $trending[$i]['detail'] = $pro->details;
            $trending[$i]['slug'] = $pro->slug;
            $trending[$i]['sku'] = $pro->sku_code;
            $trending[$i]['in_stock'] = $pro->in_stock;
            $trending[$i]['is_exclusive'] = $pro->is_exclusive;
            $trending[$i]['is_featured'] = $pro->is_featured;
            $trending[$i]['is_new'] = $pro->is_new;
            $trending[$i]['is_bulk'] = $pro->is_bulk;
            $trending[$i]['view_count'] = $pro->view_count;
            $trending[$i]['discount_type'] = $pro->discount_type;
            $trending[$i]['discount'] = $pro->discount;
            $trending[$i]['tax_rate'] = $pro->tax_rate;
            $trending[$i]['status'] = $pro->status;
            $trending[$i]['reviews'] = $product->reviews;
            $trending[$i]['rating'] =   count($product->reviews) > 0  ?
                           ProductReview::where('product_id', $product->id)->avg('rating')
                           : 0;
            $proimages = $pro->productProductImages;
            $variations = $pro->productProductVariations;
            $images = [];
            $sizes = [];
            $colors = [];
            $mrp_price = "";
            $sale_price = "";
            $wholesale_price = "";
            $wholesale_price = "";
            $wholesale_qty = "";
            $sortimages = [];


            foreach($variations as $var){
            $in = 0;
                if($var->primary_variation === 1){
                    $in++;
                    $size = Size::where('id',$var->size_id)->first()->name;
                    array_push($sizes,$size);
                    $color = Color::where('id',$var->color_id)->first();
                    array_push($colors,$color->name);

                    foreach($proimages as $pro){
                        if($pro->product_color_id === $color->id){
                            array_push($sortimages, $pro->file_name);
                        }
                    }

                    if($in === 1){
                        $mrp_price = $var->single_price;
                        $sale_price = $var->single_sales_price;
                        $wholesale_price = $var->wholesale_price;
                        $wholesale_price = $var->wholesale_sales_price;
                        $wholesale_qty = $var->wholesale_price_quantity;
                    }

                }
            }

            $trending[$i]['images'] =  array_unique($sortimages);

        

            $trending[$i]['sizes'] = $sizes;
            $trending[$i]['colors'] = $colors;
            $trending[$i]['single_mrp_price'] =$mrp_price;
            $trending[$i]['single_sales_price'] = $sale_price;
            $trending[$i]['wholesale_mrp_price'] =$wholesale_price;
            $trending[$i]['wholesale_sales_price'] = $wholesale_price;
            $trending[$i]['wholesale_qty'] = $wholesale_qty;

        }

      return view('store.products.detail', compact('info','sizes','colors','attributes','categories','category_str','attribute_values','trending','product','like'));
    }
}
