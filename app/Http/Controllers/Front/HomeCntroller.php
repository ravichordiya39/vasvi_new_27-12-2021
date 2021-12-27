<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Attribute;
use Illuminate\Http\Request;
use App\Models\Slider;
use App\Models\Category;
use App\Models\Color;
use App\Models\Product;
use App\Models\ProductAttribute;
use App\Models\ProductVariation;
use App\Models\Size;
use App\Models\ProductReview;
use App\Models\NewArrivalBanner;
use App\Models\LatestBanner;
use App\Models\BestSellerBanner;
use DB, Auth;
class HomeCntroller extends Controller
{
    public function index() {
        $i = 0;
        $trending = [];
        $banners = Slider::whereStatus('1')->latest()->get();
        $products = Product::where('is_exclusive',1)
                           ->where('status',1)
                           ->orderBy('created_at', 'desc')
                           ->paginate(20);

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
            $trending[$i]['reviews'] = $pro->reviews;
            $trending[$i]['rating'] =   count($pro->reviews) > 0  ?
                           ProductReview::where('product_id', $pro->id)->avg('rating')
                           : 0;
            $proimages = $pro->productProductImages;
            $variations = $pro->productProductVariations;
            $images = [];
            $sizes = [];
            $colors = [];
            // $tax_rate = "";
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


        // $newarrivals = DB::table('banners_bestsellers')->where('type',1)->limit(3)->get();
        // $bestsellers = DB::table('banners_bestsellers')->where('type',0)->limit(3)->get();

        $newarrivals = NewArrivalBanner::limit(3)->get();
        $bestsellers = BestSellerBanner::limit(3)->get();
        $latestbanner = LatestBanner::first();


        $j = 0;
        $hotesale = [];
        $hproducts = Product::where('is_featured',1)
                           ->where('status',1)
                           ->orderBy('created_at', 'desc')
                           ->paginate(20);

            foreach($hproducts as $pro){
            $i++;
            $hotesale[$i]['id'] = $pro->id;
            $hotesale[$i]['category'] = $pro->category->name;
            $hotesale[$i]['sub_category'] = $pro->sub_category->name;
            $hotesale[$i]['child_category'] = $pro->child_category !== null ?? $pro->child_category->name ;
            $hotesale[$i]['name'] = $pro->name;
            $hotesale[$i]['desc'] = $pro->description;
            $hotesale[$i]['detail'] = $pro->details;
            $hotesale[$i]['slug'] = $pro->slug;
            $hotesale[$i]['sku'] = $pro->sku_code;
            $hotesale[$i]['in_stock'] = $pro->in_stock;
            $hotesale[$i]['is_exclusive'] = $pro->is_exclusive;
            $hotesale[$i]['is_featured'] = $pro->is_featured;
            $hotesale[$i]['is_new'] = $pro->is_new;
            $hotesale[$i]['is_bulk'] = $pro->is_bulk;
            $hotesale[$i]['view_count'] = $pro->view_count;
            $hotesale[$i]['discount_type'] = $pro->discount_type;
            $hotesale[$i]['discount'] = $pro->discount;
            $hotesale[$i]['tax_rate'] = $pro->tax_rate;
            $hotesale[$i]['status'] = $pro->status;
            $hotesale[$i]['reviews'] = $pro->reviews;
            $hotesale[$i]['rating'] =   count($pro->reviews) > 0  ?
                           ProductReview::where('product_id', $pro->id)->avg('rating')
                           : 0;
            $proimages = $pro->productProductImages;
            $variations = $pro->productProductVariations;
            $images = [];
            $sizes = [];
            $colors = [];
            // $tax_rate = "";
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

            $hotesale[$i]['images'] =  array_unique($sortimages);
            $hotesale[$i]['sizes'] = $sizes;
            $hotesale[$i]['colors'] = $colors;
            $hotesale[$i]['single_mrp_price'] =$mrp_price;
            $hotesale[$i]['single_sales_price'] = $sale_price;
            $hotesale[$i]['wholesale_mrp_price'] =$wholesale_price;
            $hotesale[$i]['wholesale_sales_price'] = $wholesale_price;
            $hotesale[$i]['wholesale_qty'] = $wholesale_qty;

        }


        $latest = [];
        $lproducts = Product::where('is_new',1)
                           ->where('status',1)
                           ->orderBy('created_at', 'desc')
                           ->paginate(20);

            foreach($lproducts as $pro){
            $latest[$i]['id'] = $pro->id;
            $latest[$i]['category'] = $pro->category->name;
            $latest[$i]['sub_category'] = $pro->sub_category->name;
            $latest[$i]['child_category'] = $pro->child_category !== null ?? $pro->child_category->name ;
            $latest[$i]['name'] = $pro->name;
            $latest[$i]['desc'] = $pro->description;
            $latest[$i]['detail'] = $pro->details;
            $latest[$i]['slug'] = $pro->slug;
            $latest[$i]['sku'] = $pro->sku_code;
            $latest[$i]['in_stock'] = $pro->in_stock;
            $latest[$i]['is_exclusive'] = $pro->is_exclusive;
            $latest[$i]['is_featured'] = $pro->is_featured;
            $latest[$i]['is_new'] = $pro->is_new;
            $latest[$i]['is_bulk'] = $pro->is_bulk;
            $latest[$i]['view_count'] = $pro->view_count;
            $latest[$i]['discount_type'] = $pro->discount_type;
            $latest[$i]['discount'] = $pro->discount;
            $latest[$i]['tax_rate'] = $pro->tax_rate;
            $latest[$i]['status'] = $pro->status;
            $latest[$i]['reviews'] = $pro->reviews;
            $latest[$i]['rating'] =   count($pro->reviews) > 0  ?
                           ProductReview::where('product_id', $pro->id)->avg('rating')
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

            $latest[$i]['images'] =  array_unique($sortimages);
            $latest[$i]['sizes'] = $sizes;
            $latest[$i]['colors'] = $colors;
            $latest[$i]['single_mrp_price'] =$mrp_price;
            $latest[$i]['single_sales_price'] = $sale_price;
            $latest[$i]['wholesale_mrp_price'] =$wholesale_price;
            $latest[$i]['wholesale_sales_price'] = $wholesale_price;
            $latest[$i]['wholesale_qty'] = $wholesale_qty;

        }

        return view('store.index',compact('banners','trending','hotesale','latest','newarrivals','bestsellers','latestbanner'));
    }


    public function load_featured_section(){
         $products=Product::orderBy('id','DESC')->get();
         $products->load('productProductImages');
        return response()->json($products,200);
    }

    public function load_exclusive_section(){
        $products=Product::orderBy('id','DESC')->get();
        $products->load('productProductImages');
       return response()->json($products,200);
    }

    public function load_bestseller_section(){
    $products=Product::orderBy('id','DESC')->get();
    $products->load('productProductImages');
     return response()->json($products,200);
   }



    public function search(Request $request)
    {
        $categoryfilter=[];
        $colorfilter=[];
        $sizes=[];
        $sizefilter=[];
        $attributefilter=[];
        $query = $request->q;
        $categories = Category::where('parent_id',0)->where('status',1)->get();
        $conditions = ['status' => 1];


        if ($request->ajax()) {

        $prods = Product::query();
        // $prods = Product::where('status',1)
        //                   ->orderBy('created_at', 'desc')
        //                   ->paginate(5);
        $count =  Product::where('status',1)->get()->count();
        $cat = $request->q != '' ? $request->q : '';
        $sortby = $request->sortby;
        if($cat != ''){
            $prods = $prods->Where('category_id', 'like', '%'.$cat.'%')->orWhere('sub_category_id', 'like', '%'.$cat.'%')->orWhere('sub_category_child_id', 'like', '%'.$cat.'%');
        }

        // colors
        if($request->has('colors')){
            foreach($request->colors as $color){
            $prods = $prods->with(['productProductVariations' => function ($query) use ($color){
                $query->where('color_id',$color);
            }]);
            }
        }

        // sizes
        if($request->has('sizes')){
            foreach($request->sizes as $size){
            $prods = $prods->with(['productProductVariations' => function ($query) use ($size) {
                $query->where('size_id',$size);
            }]);
            }
        }

        // sizes
        if($request->has('attributes')){


            foreach($request->attributes as $attribute){

            $prods = $prods->with(['productProductAttributes' => function ($query) use($attribute) {
                $query->where('attribute_id',$attribute['attr_id'])->where('attribute_value_id',$attribute['value_id']);
            }]);
            }
        }

        // sordting
        if($sortby != 'no'){
            if($sortby == 'plth'){
            $prods = $prods->with(['productProductVariations' => function ($query) {
                $query->orderBy('single_sales_price','asc');
            }]);
            }
            else if($sortby == 'phtl'){
            $prods = $prods->with(['productProductVariations' => function ($query) {
                $query->orderBy('single_sales_price','desc');
            }]);
            }
            else if($sortby == 'popular'){
                $prods = $prods->orderBy('view_count','desc');
            }
            else if($sortby == 'discount'){
                $prods = $prods->orderBy('discount','desc');
            }
            else{
                $prods = $prods->orderBy('id','desc');
            }
        }



        $prods = $prods->where('status',1)
                        ->paginate(5);

        $i = 0;
        $searchproducts = [];
        foreach($prods as $pro){

            $i++;
            $searchproducts[$i]['id'] = $pro->id;
            $searchproducts[$i]['category'] = $pro->category->name;
            $searchproducts[$i]['sub_category'] = $pro->sub_category->name;
            $searchproducts[$i]['child_category'] = $pro->child_category !== null ?? $pro->child_category->name ;
            $searchproducts[$i]['name'] = $pro->name;
            $searchproducts[$i]['desc'] = $pro->description;
            $searchproducts[$i]['detail'] = $pro->details;
            $searchproducts[$i]['slug'] = $pro->slug;
            $searchproducts[$i]['sku'] = $pro->sku_code;
            $searchproducts[$i]['in_stock'] = $pro->in_stock;
            $searchproducts[$i]['is_exclusive'] = $pro->is_exclusive;
            $searchproducts[$i]['is_featured'] = $pro->is_featured;
            $searchproducts[$i]['is_new'] = $pro->is_new;
            $searchproducts[$i]['is_bulk'] = $pro->is_bulk;
            $searchproducts[$i]['view_count'] = $pro->view_count;
            $searchproducts[$i]['discount_type'] = $pro->discount_type;
            $searchproducts[$i]['discount'] = $pro->discount;
            $searchproducts[$i]['tax_rate'] = $pro->tax_rate;
            $searchproducts[$i]['status'] = $pro->status;

            $proimages = $pro->productProductImages;
            $variations = $pro->productProductVariations;

            $images = [];
            $sizes = [];
            $colors = [];
            // $tax_rate = "";
            $mrp_price = "";
            $sale_price = "";
            $wholesale_price = "";
            $wholesale_price = "";
            $wholesale_qty = "";


            foreach($variations as $var){
                if($var->primary_variation === 1){
                    $size = Size::where('id',$var->size_id)->first()->name;
                    array_push($sizes,$size);

                    $color = Color::where('id',$var->color_id)->first()->name;
                    array_push($colors,$color);
                    $mrp_price = $var->single_price;
                    $sale_price = $var->single_sales_price;
                    $wholesale_price = $var->wholesale_price;
                    $wholesale_price = $var->wholesale_sales_price;
                    $wholesale_qty = $var->wholesale_price_quantity;
                }
            }

            $searchproducts[$i]['images'] =  $proimages;
            $searchproducts[$i]['sizes'] = $sizes;
            $searchproducts[$i]['colors'] = $colors;
            $searchproducts[$i]['single_mrp_price'] =$mrp_price;
            $searchproducts[$i]['single_sales_price'] = $sale_price;
            $searchproducts[$i]['wholesale_mrp_price'] =$wholesale_price;
            $searchproducts[$i]['wholesale_sales_price'] = $wholesale_price;
            $searchproducts[$i]['wholesale_qty'] = $wholesale_qty;

        }

        return response()->json([
            'success' => true,
            'data' => view('frontend.product_list',compact('searchproducts','prods'))->render(),
            'count' => $count
        ]);
        }
        $products = Product::query();
        if($query != null){
            $products = $products->where('name', 'like', '%'.$query.'%')->orWhere('category_id', 'like', '%'.$query.'%')->orWhere('sub_category_id', 'like', '%'.$query.'%')->orWhere('sub_category_child_id', 'like', '%'.$query.'%');
            $categories=Category::where('parent_id',$query)->where('status',1)->get();
        }
        if (isset($_GET['category_id']) && $_GET['category_id'] != null && $_GET['category_id'] !='undefined') {
            $categoryfilter=explode(",",$_GET['category_id']);
            $products=$products->orWhereIn('category_id',$categoryfilter);
        }
        if (isset($_GET['category_id']) && $_GET['category_id'] != null && $_GET['category_id'] !='undefined') {
            $categoryfilter=explode(",",$_GET['category_id']);
            $products=$products->orWhereIn('sub_category_id',$categoryfilter);
        }

        if (isset($_GET['category_id']) && $_GET['category_id'] != null && $_GET['category_id'] !='undefined') {
            $categoryfilter=explode(",",$_GET['category_id']);
            $products=$products->orWhereIn('sub_category_child_id',$categoryfilter);
        }
        if (isset($_GET['color']) && $_GET['color'] != null && $_GET['color'] !='undefined') {
            $colorfilter=explode(",",$_GET['color']);
            $variations=ProductVariation::whereIn('color_id',$colorfilter)->pluck('product_id');
            $products=$products->orWhereIn('id',$variations);
        }
        if (isset($_GET['size']) && $_GET['size'] != null && $_GET['size'] !='undefined') {
            $sizefilter=explode(",",$_GET['size']);
            $prod_id=array();
            $sizes=DB::table("product_variations")->select('product_id')->whereIn("size_id",$sizefilter)->get();
            foreach($sizes as $sz)
            {
                $prod_id[]=$sz->product_id;
            }

            $products=$products->orWhereIn('id',$prod_id);
        }
        if (isset($_GET['attributes']) && $_GET['attributes'] != null && $_GET['attributes'] !='undefined') {
            $attributefilter=explode(",",$_GET['attributes']);
            $ProductAttributesCustoms=ProductAttribute::whereIn('attribute_value_id',$attributefilter)->pluck('product_id');
            $products=$products->orWhereIn('id',$ProductAttributesCustoms);
        }
        $sizes = Size::where('status', '1')->get();
        $colors = Color::where('status', '1')->get();
        $attributes=Attribute::where('status',1)->get();
        if($query != null){
        $mycat = Category::where('id',$query)->first();

        $child = "";
        $subChild = "";
        $subsubChild = "";
        $parent = "";
        $primary = "";
        if($mycat->parent_id != 0){
            $sub= Category::where('id', $mycat->id)->first();
            $parent = $sub->name;
            if($sub){
            if($sub->parent_id != 0){
                $subsub = Category::where('id', $sub->parent_id)->first();
                if($subsub){
                $subChild = $subsub->name;
                if($subsub->parent_id != 0){
                    $subsubsub = Category::where('id', $subsub->parent_id)->first();
                    if($subsubsub){
                    if($subsubsub->parent_id != 0){
                        $subsubChild = $subsubsub->name;
                    }
                    else{
                        $primary = $subsubsub->name;
                    }
                    }
                }
                else{
                    $primary = $subsub->name;
                }
                }
            }
            else{
                $primary = $sub->name;
            }
            }
        }
        else{
            $primary = $mycat->name;
        }
        $mycat = $subsubChild. '      '.$subChild. '      '.$child. '      '.$parent;
        }
        else{
        $mycat = null;
        }

        $products=$products->distinct();
        $products = $products->paginate(12)->appends(request()->query());

        // return view('front.product_listing', compact('products', 'query','categories','categoryfilter','colors','colorfilter','sizes','sizefilter','attributes','attributefilter','mycat','primary'));

        $categories = Category::where('parent_id',0)->where('status',1)->get();

        return view('frontend.category', compact('products', 'query','categories','categoryfilter','colors','colorfilter','sizes','sizefilter','attributes','attributefilter','mycat','primary'));
    }


}
