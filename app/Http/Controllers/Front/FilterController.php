<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Product;
use App\Models\ProductVariation;
use App\Models\ProductImage;
use App\Models\ProductAttribute;
use App\Models\Size;
use App\Models\Color;
use App\Models\Attribute;
use App\Models\ProductReview;
use App\Models\AttributeValue;
use Illuminate\Database\Eloquent\Builder;

class FilterController extends Controller
{

    public function index(Request $request, $dcat) {
        \Log::info($request->all());

        $prods = Product::first();
        $categoryfilter=[];
        $colorfilter=[];
        $sizes=[];
        $sizefilter=[];
        $attributefilter=[];
        $categorysearch = $dcat;

        $categories = Category::where('parent_id',0)->where('status',1)->get();
        $allcategories = Category::where('status',1)->get();
        $conditions = ['status' => 1];
        $catid = 0;
        $catbanner = 'no';
        $catavail = true;

        if($categorysearch !== 'all'){
             $catban = Category::where('name', $categorysearch)->first();
             if($catban){
                 $catbanner = $catban->image;
             }
             else{
                 $catavail = false;
             }
        }

        if(!$catavail){
            return view('errors.404');
        }

        if ($request->ajax()) {
            $prods = Product::where('status',1);
            $cat = $request->category != '' ? $request->category : '';
            $sortby = $request->sortby;
            $catid = 0;

            // colors
            if($request->has('colors')){
                if(count($request->colors) > 0){
                    $colors = $request->colors;
                    $prods = $prods->whereHas('productProductVariations', function (Builder $query)  use ($colors) {
                        $query->whereIn('color_id', $colors);
                    });
                }
            }

            // sizes
            if($request->has('sizes')){
                if(count($request->sizes) > 0){
                    $sizes = $request->sizes;
                    $prods = $prods->whereHas('productProductVariations', function (Builder $query)  use ($sizes) {
                        $query->whereIn('size_id', $sizes);
                       });
                }
            }

            // attributes
            if($request->has('attributes')){
                $attributes = $request->get('attributes');
                if(count($request->get('attributes')) > 0){
                    $prods = $prods->whereHas('productProductAttributes', function (Builder $query)  use ($attributes) {
                        $query->whereIn('attribute_value_id', $attributes);
                    });
                }
            }

            // price
            if($request->has('prices')){
                $prices = $request->prices;

                if(count($prices) > 0){

                    foreach($prices as $price){
                        if($price === '<700'){
                            $price = 700;
                            $prods = $prods->whereHas('productProductVariations', function (Builder $query)  use ($price) {
                                $query->where('single_sales_price','<', 700);
                               });
                        }
                        elseif($price === '>700<1000'){

                            $prods = $prods->whereHas('productProductVariations', function (Builder $query) {
                                $query->whereBetween('single_sales_price',[700, 1000]);
                               });
                        }
                        elseif($price === '>1000<5000'){
                            $prods = $prods->whereHas('productProductVariations', function (Builder $query) {
                                $query->whereBetween('single_sales_price',[1000, 5000]);
                               });
                        }
                        elseif($price === '>5000'){
                            $prods = $prods->whereHas('productProductVariations', function (Builder $query) {
                                $query->where('single_sales_price','>',5000);
                               });
                        }
                    }
                }
            }

            if($request->has('min_price') && $request->has('max_price') ){
                if($request->min_price !== 'no' && $request->max_price !== 'no'){
                    $above = $request->min_price;
                    $below = $request->max_price;
                    $prods = $prods->whereHas('productProductVariations', function (Builder $query) use ($above, $below){
                        $query->whereBetween('single_sales_price',[$above, $below]);

                    });
                }
                else if($request->min_price !== "no" && $request->max_price === "no"){
                    $above = $request->min_price;
                    $prods = $prods->whereHas('productProductVariations', function (Builder $query) use ($above){
                        $query->where('single_sales_price','>',$above);
                    });
                }
                else if($request->min_price === "no" && $request->max_price !== "no"){
                    $below = $request->max_price;
                    $prods = $prods->whereHas('productProductVariations', function (Builder $query) use ($below){
                        $query->where('single_sales_price','<',$below);
                    });
                }
            }

            // sorting
            if($sortby != 'no'){
                if($sortby == 'pasc'){
                    $prods = $prods->whereHas('productProductVariations', function (Builder $query) {
                        $query->orderBy('single_sales_price','asc')->groupBy('single_sales_price');
                    });
                }
                else if($sortby == 'pdesc'){
                    $prods = $prods->whereHas('productProductVariations', function (Builder $query) {
                        $query->orderBy('single_sales_price','desc')->groupBy('single_sales_price');
                    });
                }
                else if($sortby == 'cs'){
                    $prods = $prods->orderBy('view_count','desc');
                }
                else if($sortby == 'd'){
                    $prods = $prods->orderBy('discount','desc');
                }
                else{
                    $prods = $prods->orderBy('id','desc');
                }
            }

            if($cat != '' && $cat != 'all'){
                $id = Category::where('name',$cat)->first();
                if($id){
                    $cat_id = $id->id;
                    $prods = $prods->where('category_id', $id->id)->orWhere('sub_category_id', $id->id)->orWhere('sub_category_child_id', $id->id);
                }
            }

            if($request->has('search')){
                if($request->search !== 'no'){
                    $prods = $prods->where('name','like','%'.$request->search.'%');
                }
            }

            $prods = $prods->select('products.*')->groupBy('id')->paginate(24);
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
                $mrp_price = "";
                $sale_price = "";
                $wholesale_price = "";
                $wholesale_price = "";
                $wholesale_qty = "";
                $selectedimg = [];

                // foreach($variations as $var){
                //     $in = 0;
                //     if($var->primary_variation === 1){
                //         $in++;
                //         $size = Size::where('id',$var->size_id)->first()->name;
                //         array_push($sizes,$size);

                //         $color = Color::where('id',$var->color_id)->first();
                //         array_push($colors,$color->name);
                //         foreach($proimages as $imgp){
                //             if($imgp->product_color_id === $var->color_id){
                //                 array_push($selectedimg,$imgp->file_name);
                //             }
                //         }
                //         if($in === 1){
                //             $mrp_price = $var->single_price;
                //             $sale_price = $var->single_sales_price;
                //             $wholesale_price = $var->wholesale_price;
                //             $wholesale_price = $var->wholesale_sales_price;
                //             $wholesale_qty = $var->wholesale_price_quantity;
                //         }
                //     }

                    $newvariation = ProductVariation::where('product_id', $pro->id);
                    if($request->has('sizes') && $request->has('colors')){
                        if(count($request->sizes) > 0 && count($request->colors) > 0){
                            $newvariation = $newvariation->whereIn('color_id', $request->colors)->orWhereIn('size_id',$request->sizes);
                        }
                    }

                    elseif($request->has('sizes')){
                        if(count($request->sizes) > 0){
                            $newvariation = $newvariation->whereIn('size_id',$request->sizes);
                        }
                    }
                    elseif($request->has('colors')){
                        if(count($request->colors) > 0){
                            $newvariation = $newvariation->whereIn('color_id',$request->colors);
                        }
                    }

                    if($request->has('prices')){
                        if($request->prices[0] === '<700'){
                            $newvariation = $newvariation->where('single_sales_price','<', 700);
                        }
                        elseif($request->prices[0] === '>700<1000'){
                            $newvariation = $newvariation->whereBetween('single_sales_price',[700, 1000]);
                        }
                        elseif($request->prices[0] === '>1000<5000'){
                            $newvariation = $newvariation->whereBetween('single_sales_price',[1000, 5000]);;
                        }
                        elseif($request->prices[0] === '>5000'){
                            $newvariation = $newvariation->where('single_sales_price','>', 700);
                        }
                    }

                    if($request->has('min_price') && $request->has('max_price') ){
                        if($request->min_price !== 'no' && $request->max_price !== 'no'){
                            $above = $request->min_price;
                            $below = $request->max_price;
                            $newvariation = $newvariation->whereBetween('single_sales_price',[$above, $below]);
                        }
                        else if($request->min_price !== "no" && $request->max_price === "no"){
                            $above = $request->min_price;
                            $newvariation = $newvariation->where('single_sales_price','>',$above);
                        }
                        else if($request->min_price === "no" && $request->max_price !== "no"){
                            $below = $request->max_price;
                            $newvariation = $newvariation->where('single_sales_price','<',$below);
                        }
                    }

                    $newvariation = $newvariation->get();
                    foreach($newvariation as $var){
                        $in = 0;
                        // if($var->primary_variation === 1){
                            $in++;
                            $size = Size::where('id',$var->size_id)->first()->name;
                            array_push($sizes,$size);

                            $color = Color::where('id',$var->color_id)->first();
                            array_push($colors,$color->name);
                            foreach($proimages as $imgp){
                                if($imgp->product_color_id === $var->color_id){
                                    array_push($selectedimg,$imgp->file_name);
                                }
                            }
                            if($in === 1){
                                $mrp_price = $var->single_price;
                                $sale_price = $var->single_sales_price;
                                $wholesale_price = $var->wholesale_price;
                                $wholesale_price = $var->wholesale_sales_price;
                                $wholesale_qty = $var->wholesale_price_quantity;
                            }
                        // }
                    }

                // }
                $searchproducts[$i]['simage'] =  $selectedimg;
                $searchproducts[$i]['images'] =  $proimages;
                $searchproducts[$i]['sizes'] = $sizes;
                $searchproducts[$i]['colors'] = $colors;
                $searchproducts[$i]['single_mrp_price'] =$mrp_price;
                $searchproducts[$i]['single_sales_price'] = $sale_price;
                $searchproducts[$i]['wholesale_mrp_price'] =$wholesale_price;
                $searchproducts[$i]['wholesale_sales_price'] = $wholesale_price;
                $searchproducts[$i]['wholesale_qty'] = $wholesale_qty;
                $searchproducts[$i]['reviews'] = $pro->reviews;
                $searchproducts[$i]['rating'] =   count($pro->reviews) > 0  ?
                           ProductReview::where('product_id', $pro->id)->avg('rating')
                           : 0;
            }

            $html = '';
            foreach($allcategories as $all){
                if($all->parentid === $catid){
                    $html .= '
                    <li>
                        <a href="'.url('shop').'?category='.$all->id.'">
                            <span class="label_txt">'.$all->name.'</span>
                            <span class="count_txt">';

                                $catcount = \App\Models\Product::where('category_id', $all->id)->get();
                                if($catcount){
                                    echo ($catcount->count());
                                }
                                else{
                                    echo (0);
                                }
                    $html .= '
                            </span>
                        </a>
                    </li>
                    ';
                }
            }

            $response = view('store.products.list',compact('searchproducts','prods'))->render();
            $count =  $prods->count();

            return response()->json([
                'success' => true,
                'data' => $response,
                'count' => $count,
                'categories' => $html
            ]);
        }

        $products = Product::query();
        $selectedaatrs = [];
        $attarr = [];
        (object)$match = "";

        if($categorysearch != 'all'){
                $id = \App\Models\Category::where('name',$categorysearch)->first();
                if($id){
                    $catid = $id->id;
                    $match = \App\Models\MapAttribute::where('category_id','like','%'.$catid)->orWhere('sub_category_id','like','%'.$catid)->orWhere('sub_category_child_id','like','%'.$catid)->first();
                    if($match){
                        if($match->is_attribute === 1){

                            foreach($match->attributes as $values){
                                array_push($attarr, $values['attributevalues'][0]);
                            }

                          $selattrval = AttributeValue::whereIn('id', $attarr )->pluck('attribute_id')->toArray();

                          $selectedaatrs = Attribute::whereIn('id', $selattrval)->whereHas('attribute_values', function (Builder $query) use ($attarr){
                            $query->whereIn('id',$attarr);
                          })->get();

                        }
                    }
                    $products = $products->where('category_id', $id->id)->orWhere('sub_category_id', $id->id)->orWhere('sub_category_child_id', $id->id);
                    $categories=Category::where('parent_id',$categorysearch)->where('status',1)->get();
                }
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

        $products=$products->distinct();
        $products = $products->paginate(24)->appends(request()->query());

        $categories = Category::where('parent_id',0)->where('status',1)->get();

        return view('store.search', compact('products','categories','categoryfilter','colors','colorfilter','sizes','sizefilter','attributes','attributefilter','catid','allcategories','categorysearch','catbanner','selectedaatrs','attarr','match'));
    }


    public function demo(Request $request){
      $cat = "Men's";
      $products = \DB::table('products');
      if($cat !== ''){
          $category = Category::where('name',$cat)->first();

          $products = $products->where('products.category_id', $category->id)->orWhere('products.sub_category_id', $category->id)->orWhere('products.sub_category_child_id', $category->id);
      }

      $colors = [1,2,3];
      $products = $products->leftJoin('product_variations','product_variations.product_id','products.id')->whereIn('product_variations.color_id', $colors);


      $data = $products->orderBy('products.id','desc')->get();



      $authors = Product::whereHas('productProductVariations', function (Builder $query)  use ($colors) {
        $query->whereIn('color_id', $colors);
       })->get();

    }
}
