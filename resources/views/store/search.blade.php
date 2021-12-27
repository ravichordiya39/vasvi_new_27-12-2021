<?php use Illuminate\Database\Eloquent\Builder; ?>
@extends('store.layouts.app')
@section('title', 'Vasvi - ' .request()->segment(1). ' with all types of brand and categories')
@section('meta_keywords', 'Vasvi.in, Ecommerce, Shopping, Mens, Woman, Kids, Cloth')
@section('meta_description', 'Ecommerce website to buy a product in quantity or bulk with lots of discount')
@push('styles')
<style>
    .product-card{
        position: relative;
    }

    #fa-heart{
        position: absolute;
        top : 10px;
        right : 10px;

    }



    @media screen and (max-width: 868px) {

        .filter-mb{margin-top :0px;}

    }


</style>
@endpush

@section('content')
<div class="headertopspace"></div>
  <div class="container">
      <ol class="breadcrumb">
          <li><a href="{{url('/')}}">Home</a></li>
          <li><a href="{{url('/clothing/all')}}">Shop</a></li>
          <li class="active">{{$categorysearch !== 'all' ? $categorysearch : 'All Categories'}}</li>
      </ol>
    <div class="row">
      <aside class="col-md-3 fabdesgins-filter" id="column-left">

  <div class="panel-group category_group" id="accordion">
      <div class="panel panel-default ">
          <div class="panel-heading">
            <h4><span class="" data-bind="attr: {id: 'CC-guidedNavigation-dimensionHeader-'+ $index()}, text: displayName" id="CC-guidedNavigation-dimensionHeader-0">Category</span></h4>
          </div>
          <div data-bind="attr: {id: 'CC-guidedNavigation-collapseList-'+ $index()}" class="" id="CC-guidedNavigation-collapseList-0">
          <!--ko if: $parents[1].isCategoryLandingPage -->
            <div class="panel-body category" id="category-panel">
              <!-- ko foreach: refinements.display -->
              @if($categories->count() > 0 && $catid === 0)
                @foreach($categories as $category)
                    <li>
                        <a href="{{url('clothing')}}/{{$category->name}}">
                            <span class="label_txt">{{$category->name}}</span>
                            <span class="count_txt">
                                (
                                <?php
                                $catcount = \App\Models\Product::where('category_id', $category->id)->get();
                                if($catcount){
                                    echo $catcount->count();
                                }
                                else{
                                    echo 0;
                                }
                                ?>
                            )
                            </span>
                        </a>
                    </li>
                @endforeach
              @else
                @foreach($allcategories as $all)
                  @if($all->parent_id === $catid)
                    <li>
                        <a href="{{url('clothing')}}/{{$all->name}}">
                            <span class="label_txt">{{$all->name}}</span>
                            <span class="count_txt">
                                (
                                <?php
                                $catcount = \App\Models\Product::where('sub_category_id', $all->id)->orWhere('sub_category_child_id', $all->id)->get();
                                if($catcount){
                                    echo $catcount->count();
                                }
                                else{
                                    echo 0;
                                }
                                ?>
                            )
                            </span>
                        </a>
                    </li>
                  @endif
                @endforeach
              @endif
            </div>
          </div>
      </div>
    @if($match !== null)
    <div class="panel panel-default">
      <div class="panel-heading">
          <h4 class="panel-title">
              <a data-toggle="collapse" data-parent="#accordion" href="#collapseSize">Size</a>
          </h4>
      </div>
      <div id="collapseSize" class="panel-collapse collapse">
          <div class="panel-body">
              <ul class="lft-list-conent">
                @if($sizes->count() > 0)
                    @foreach($sizes as $size)

                    @if($catid !== 0)

                    @if(in_array($size->id, $match->sizes) && $match->is_size === 1)
                    <li><input type="checkbox" class="filter" id="size-{{$size->id}}" data-name="{{$size->name}}" data-id="{{$size->id}}"><label for="size-{{$size->id}}" style="cursor:pointer">{{$size->name}}<span>
                        (
                            <?php

                                $data = \DB::table('product_variations')->join('products','products.id','product_variations.product_id')->where('product_variations.size_id', $size->id);

                                if($catid !== 0){
                                    $data =
                                        $data->where('products.category_id', $catid)
                                        ->orWhere('products.sub_category_id', $catid)->orWhere('products.sub_category_child_id', $catid);
                                }

                                $sizecount = $data->groupBy('product_variations.product_id')->get();

                                if($sizecount){
                                    echo $sizecount->count();
                                }
                                else{
                                    echo 0;
                                }
                            ?>
                        )</span></label></li>
                        @endif
                    @else
                        <li><input type="checkbox" class="filter" id="size-{{$size->id}}" data-name="{{$size->name}}" data-id="{{$size->id}}"><label for="size-{{$size->id}}" style="cursor:pointer">{{$size->name}}<span>
                        (
                            <?php

                                $data = \DB::table('product_variations')->join('products','products.id','product_variations.product_id')->where('product_variations.size_id', $size->id);

                                if($catid !== 0){
                                    $data =
                                        $data->where('products.category_id', $catid)
                                        ->orWhere('products.sub_category_id', $catid)->orWhere('products.sub_category_child_id', $catid);
                                }

                                $sizecount = $data->groupBy('product_variations.product_id')->get();

                                if($sizecount){
                                    echo $sizecount->count();
                                }
                                else{
                                    echo 0;
                                }
                            ?>
                        )</span></label></li>
                    @endif
                    @endforeach
                @endif
              </ul>
          </div>
      </div>
  </div>
  @endif
  @if($catid !== 0)
    @if($attributes->count() > 0)
        {{-- @foreach($attributes as $attr) --}}
        <?php
           $matches = \App\Models\MapAttribute::where('category_id','like','%'.$catid)->orWhere('sub_category_id','like','%'.$catid)->orWhere('sub_category_child_id','like','%'.$catid)->first();

        ?>
        @foreach($selectedaatrs as $daatr)
          <div class="panel panel-default">
            <div class="panel-heading">
                <h4 class="panel-title">
                <a data-toggle="collapse" data-parent="#accordion" href="#collapse_{{$daatr->id}}">{{$daatr->name}}</a>
                </h4>
            </div>
            <div id="collapse_{{$daatr->id}}" class="panel-collapse collapse">
                <div class="panel-body">
                <ul class="lft-list-conent">
                    @if($daatr->attribute_values)
                    @foreach($daatr->attribute_values as $value)
                        @if(in_array($value->id, $attarr))
                        <li><input type="checkbox" class="filter" id="attribute-{{$daatr->id}}" data-name="{{$daatr->id}}" data-id="{{$value->id}}" > <a href="#">{{$value->value}}
                            <span>
                            (
                                <?php
                                $data = DB::table('product_attributes')->join('products','products.id','product_attributes.product_id')->where('product_attributes.attribute_value_id', $value->id);

                                if($catid !== 0){
                                    $category = \App\Models\Category::where('name',$categorysearch)->first();
                                    ;

                                    $data =
                                        $data->where('products.category_id', $category->id)
                                        ->orWhere('products.sub_category_id', $category->id)->orWhere('products.sub_category_child_id', $category->id);

                                }

                                echo  $data->groupBy('product_attributes.product_id')->get()->count();
                                ?>
                            )
                            </span>
                        </a></li>
                        @endif
                    @endforeach
                    @endif
                </ul>
                </div>
            </div>
          </div>
        @endforeach
        {{-- @endforeach --}}
    @endif
  @else
    @if($attributes->count() > 0)
        @foreach($attributes as $attr)
        <div class="panel panel-default">
        <div class="panel-heading">
            <h4 class="panel-title">
            <a data-toggle="collapse" data-parent="#accordion" href="#collapse_{{$attr->id}}">{{$attr->name}}</a>
            </h4>
        </div>
        <div id="collapse_{{$attr->id}}" class="panel-collapse collapse">
            <div class="panel-body">
            <ul class="lft-list-conent">
                @if($attr->attribute_values)
                @foreach($attr->attribute_values as $value)
                    <li><input type="checkbox" class="filter" id="attribute-{{$attr->id}}" data-name="{{$attr->id}}" data-id="{{$value->id}}" > <a href="#">{{$value->value}}
                        <span>
                        (
                            <?php
                            $data = DB::table('product_attributes')->join('products','products.id','product_attributes.product_id')->where('product_attributes.attribute_value_id', $value->id);

                            if($catid !== 0){
                                $category = \App\Models\Category::where('name',$categorysearch)->first();
                                ;

                                $data =
                                    $data->where('products.category_id', $category->id)
                                    ->orWhere('products.sub_category_id', $category->id)->orWhere('products.sub_category_child_id', $category->id);

                            }

                            echo  $data->groupBy('product_attributes.product_id')->get()->count();
                            ?>
                        )
                        </span>
                    </a></li>
                @endforeach
                @endif
            </ul>
            </div>
        </div>
        </div>
        @endforeach
    @endif
@endif



    @if($colors->count() > 0 && $match !== null)
        <div class="panel panel-default">
          <div class="panel-heading">
              <h4 class="panel-title">
                  <a data-toggle="collapse" data-parent="#accordion" href="#collapseEight">Color</a>
              </h4>
          </div>
          <div id="collapseEight" class="panel-collapse collapse">
              <div class="panel-body">
                  <div class="color_attributes_valuelist">
                      <ul class="lft-list-conent">
                          @if($match !== null)
                          @foreach($colors as $color)
                          @if($catid !== 0)
                          @if(in_array($color->id, $match->colors) && $match->is_color === 1)
                            <li><input type="checkbox" class="filter" id="color-{{$color->id}}" data-name="{{$color->name}}" data-id="{{$color->id}}"><label for="color-{{$color->id}}" style="cursor:pointer">{{$color->name}} <span>(
                                <?php
                                    $data = DB::table('product_variations')->join('products','products.id','product_variations.product_id')->where('product_variations.color_id', $color->id);
                                    $category = \App\Models\Category::where('name',$categorysearch)->first();
                                    if($catid !== 0){
                                        $data =
                                            $data->where('products.category_id', $category->id)
                                            ->orWhere('products.sub_category_id', $category->id)->orWhere('products.sub_category_child_id', $category->id);
                                    }

                                    echo $data->groupBy('product_variations.product_id')->get()->count();
                                ?>
                                )</span></label></li>
                                @endif
                           @else
                           <li><input type="checkbox" class="filter" id="color-{{$color->id}}" data-name="{{$color->name}}" data-id="{{$color->id}}"><label for="color-{{$color->id}}" style="cursor:pointer">{{$color->name}} <span>(
                            <?php
                                $data = DB::table('product_variations')->join('products','products.id','product_variations.product_id')->where('product_variations.color_id', $color->id);
                                $category = \App\Models\Category::where('name',$categorysearch)->first();
                                if($catid !== 0){
                                    $data =
                                        $data->where('products.category_id', $category->id)
                                        ->orWhere('products.sub_category_id', $category->id)->orWhere('products.sub_category_child_id', $category->id);
                                }

                                echo $data->groupBy('product_variations.product_id')->get()->count();
                            ?>
                            )</span></label></li>
                            @endif
                          @endforeach
                          @endif
                      </ul>
                  </div>
              </div>
          </div>
      </div>
      @endif

     <div class="panel panel-default">
            <div class="panel-heading">
              <h4 class="panel-title">
                <a data-toggle="collapse" data-parent="#accordion" href="#collapseNine">Price</a>
              </h4>
            </div>
            <div id="collapseNine" class="panel-collapse collapse">
              <div class="panel-body">
                 <ul class="lft-list-conent">
                  <li><input type="checkbox" id="price-chk-700" value="<700"> <a href="#"> Below  <i class="fa fa-inr" aria-hidden="true"></i> 700 (
                      <?php
                       $data = DB::table('product_variations')->join('products','products.id','product_variations.product_id')->where('product_variations.single_sales_price','<', 700);
                       if($catid !== 0){
                        $category = \App\Models\Category::where('name',$categorysearch)->first();


                       $data = $data->where('products.category_id', $category->id)
                              ->orWhere('products.sub_category_id', $category->id)->orWhere('products.sub_category_child_id', $category->id);
                       }
                         echo $data->groupBy('product_variations.product_id')->get()->count();
                      ?>
                  )</a></li>
                  <li><input type="checkbox" id="price-chk-700-1000" value=">700<1000"> <a href="#"> <i class="fa fa-inr" aria-hidden="true"></i>700 - 1,000 (

                    <?php
                    $data = DB::table('product_variations')->join('products','products.id','product_variations.product_id')->where('product_variations.single_sales_price','>=', 700)->where('product_variations.single_sales_price','<=', 1000);
                    if($catid !== 0){
                     $category = \App\Models\Category::where('name',$categorysearch)->first();

                    $data = $data->where('products.category_id', $category->id)
                           ->orWhere('products.sub_category_id', $category->id)->orWhere('products.sub_category_child_id', $category->id);
                    }
                      echo $data->groupBy('product_variations.product_id')->get()->count();
                   ?>
                  )</a></li>
                  <li>
                      <input type="checkbox" id="price-chk-1000-5000" value=">1000<5000">
                      <a href="#">
                          1,000 - 5,000
                          (
                            <?php
                            $data = DB::table('product_variations')->join('products','products.id','product_variations.product_id')->where('product_variations.single_sales_price','>=', 1000)->where('product_variations.single_sales_price','<=', 5000);
                            if($catid !== 0){
                             $category = \App\Models\Category::where('name',$categorysearch)->first();

                            $data = $data->where('products.category_id', $category->id)
                                   ->orWhere('products.sub_category_id', $category->id)->orWhere('products.sub_category_child_id', $category->id);
                            }
                              echo $data->groupBy('product_variations.product_id')->get()->count();
                           ?>
                          )
                      </a>
                  </li>
                  <li>
                    <input type="checkbox" id="price-chk-5000" value=">5000">
                    <a href="#">
                        Above 5,000
                        (
                          <?php
                          $data = DB::table('product_variations')->join('products','products.id','product_variations.product_id')->where('product_variations.single_sales_price','>', 5000);
                          if($catid !== 0){
                           $category = \App\Models\Category::where('name',$categorysearch)->first();

                          $data = $data->where('products.category_id', $category->id)
                                 ->orWhere('products.sub_category_id', $category->id)->orWhere('products.sub_category_child_id', $category->id);
                          }
                            echo $data->groupBy('product_variations.product_id')->get()->count();
                         ?>

                        )
                    </a>
                  </li>
                </ul>
               <div class="price-range-block">
              <div id="slider-range" class="price-filter-range" name="rangeInput"></div>
              <div class="price_input">
              <input type="text" min="0" max="9900" id="above-price" oninput="validity.valid||(value='0');"  class="form-control">
              to
              <input type="text" min="1" max="10000" id="below-price" oninput="validity.valid||(value='1000');"  class="form-control">
              <button class="btn pinkBtn btn-price" id="btn-price">GO</button>
              </div>
              </div>
               </div>
            </div>
        </div>
  </div>

      </aside>
      <div class="col-md-9 category-rgt-panel">
         @if($catbanner !== 'no')
            @if($catbanner !== '')
              <div class="w-100 mb-4">
                <img src="{{asset('file')}}/{{$catbanner}}" style="height:150px;width : 100% !important;"  />
              </div>
            @endif
         @endif
         <div class="filter-section category filter-mb">
          <div class="row">
            <div class="col-md-6 col-xs-12 col-sm-12">
                <div class="category_title h2 d-inline " style="overflow-x : auto;">
                    <div class="d-inline" style="overflow-x : auto;">
                        {{$categorysearch !== 'all' ? $categorysearch : 'All Categories'}}

                        <i class="product_counts d-inline">(0)</i>
                        <button class=" btn-success2 btn-sm d-inline" id="filterby">More Filters </button>
                    </div>

                </div>

            </div>
            <div class="col-md-6 text-right">
                <div class="sortby">
                    <select class="sortby-dropdown form-control" id="sortby-drop">
                    <option value="NO">Select..</option>
                    <option value="pasc">Price low to high</option>
                    <option value="pdesc">Price high to low</option>
                    <option value="cs" selected="true">Popularity</option>
                    <option value="d">Discount</option>
                    <option value="rs">Relevance</option>
                    </select>
                    <div class="product-display-mode">
                        <span id="grid_large" class="active"><a href="javascript:void(0);" title="4 Column"><i class="fa fa-th-large"></i></a></span>
                        <span id="grid"><a href="javascript:void(0);" title="3 Column"><i class="fa fa-th"></i></a></span>
                    </div>
                </div>
            </div>
          </div>
        </div>
        <div class="clear"></div>
        <div class="product_list_page">
        </div>
     </div>
   </div>
 </div>
<div class="clear height60"></div>
@endsection

@push('scripts')
<script>
    var sortby = 'no';
    var colors = [];
    var sizes = [];
    var attributes = [];
    var prices = [];
    var min_price = 'no';
    var max_price = 'no';
    var page = 1;
    var homecategory = "{!!$categorysearch!!}";
    const queryString = window.location.search;
    const urlParams = new URLSearchParams(queryString);
    const search = urlParams.get('q') !== null ? urlParams.get('q') : 'no';


    var category = "";
    //  $(window).on('hashchange',function(){
    //      if (window.location.hash) {
    //          var page = window.location.hash.replace('#', '');
    //          if (page == Number.NaN || page <= 0) {
    //              return false;
    //          } else{
    //              getData(page);
    //          }
    //      }
    //  });

    getData(1);


     $(document).ready(function(){
         $(document).on('click','.pagination a',function(event){
             event.preventDefault();
             $(document).find('li').removeClass('active');
             $(this).parent('li').addClass('active');
             var url = $(this).attr('href');
            //  var page = $(this).attr('href').split('page=')[1];
             page = $(this).attr('href').split('page=')[1];
             getData(page);
         });
     });

     $(document).on('click','#btn-price', function(){
         min_price = $(document).find('#above-price').val();
         max_price = $(document).find('#below-price').val();
         if(min_price === ''){
             min_price = 'no';
         }
         if(max_price === ''){
            max_price = 'no';
         }
         $(document).find('[id^="price-chk-"]').each(function(){
            if($(this).is(':checked')){
                $(this).prop("checked", false);
            }
            prices = [];
         });
         getData(1);
     });

     $(document).on('change','[id^="price-chk-"]', function(){
         prices = [];
         var $this = $(this);
         $(document).find('#above-price').val('');
         $(document).find('#below-price').val('');
         max_price = 'no';
         min_price  = "no";
         $(document).find('[id^="price-chk-"]').each(function(){
              $(this).prop('checked',false);
         });
         if($this.is(':checked')){
             $this.prop('checked',false);
             var value = $(this).val();
             prices = [];
         }
         else{
            $this.prop('checked',true);
            var value = $(this).val();
            prices.push(value);
         }
        //  $(document).find('[id^="price-chk-"]').each(function(){
        //     var $this = $(this);
        //     var value = $(this).val();
        //     prices.push(value);
        //     if($(this).is(':checked')){
        //         var value = $(this).val();
        //         console.log(value);
        //         prices.push(value);
        //     }
        //  });

         getData(1);
     });

     $(document).on('change','#sortby-drop', function(){
        sortby = $(this).val();
        getData(1);
     });

     $(document).on('change','[id^="color-"]', function(){
       colors = [];
       $('[id^="color-"]').each(function(){
          if($(this).is(':checked')){
            var id = $(this).attr('data-id');
            colors.push(id);
            // color_array += `&colors=${id}`;
          }
        });
        getData(1);
     });

     $(document).on('change','[id^="size-"]', function(){
       sizes = [];
       $('[id^="size-"]').each(function(){
          if($(this).is(':checked')){
            var id = $(this).attr('data-id');
            sizes.push(id);
          }
        });
        getData(1);
     });

     $(document).on('change','[id^="attribute-"]', function(){
        attributes = [];
       $('[id^="attribute-"]').each(function(){
          if($(this).is(':checked')){
            var id = $(this).attr('data-id');
            var name = $(this).attr('data-name');
            // attributes.push({attr_id : name, value_id : id});
            attributes.push(id);
          }
        });
        getData(1);
     });

     function convertToSlug(Text) {
        return Text.toLowerCase().replace(/ /g, '-');
     }

     function getData(page) {
        //  var pathArray = window.location.pathname.split('/');
        //  console.log(pathArray[2]);
        //  var queryString = window.location.search;
        //  var urlParams = new URLSearchParams(queryString);
        //  category = urlParams.get('category');
        //  if(category != undefined){
        //      category = category.replace(/\//g, "");
        //  }
        //  else{
        //      category = 'all';
        //  }

        category = homecategory;

        //  var new_url = "{{url('clothing')}}"+'?category=' + category +'&page=' + page + '&sordby='+sortby+'&colors='+colors+'&sizes'+sizes+'&prices='+prices+'&attributes='+attributes+'&min_price='+min_price+'&max_price='+max_price+"#"+page;
        var mystr = (sortby !== 'no' ? '&sordby='+sortby : '' )+(search !== 'no' ? '&q='+search : '')+(colors.length > 0 ? '&colors='+colors : '')+(sizes.length > 0 ? '&sizes='+sizes : '')+(prices.length > 0 ? '&prices='+prices : '')+(attributes.length > 0 ? '&attributes='+attributes : '')+(min_price !==  'no' ? '&min_price='+min_price : '')+(max_price !==  'no' ? '&max_price='+max_price : '');
        if(mystr.length > 0){
            mystr = mystr.substring(1);
        }

        //  var durl = "{{url('clothing')}}"+'/' + convertToSlug(category) + (mystr.length > 0 ? '?'+mystr : '');
         var durl = "{{url('clothing')}}"+'/' + category + (mystr.length > 0 ? '?'+mystr : '');

         history.pushState({}, null, durl);
         new_url = "{{url('clothing')}}"+`/${category}`;
         $.ajax({
             url : new_url,
             type : 'get',
             datatype : 'html',
             data : {category : category, page : page, sortby : sortby, colors : colors, sizes : sizes, attributes : attributes,prices : prices, min_price : min_price, max_price : max_price, search : search},
             beforeSend: function(){
                overlay.addClass('is-active');
             },
             success : function(data){
                $(document).find('.product_counts').html(`(${data.count})`);
                $('.product_list_page').empty().html(data.data);
                // hash page
                // location.hash = page;
                overlay.removeClass('is-active');
             },
             error : function(err){
                 console.log(err);
                 toastr.error('Error', 'Internal server error',{
                        positionClass: 'toast-top-center',
                });
             }
         });
     }

</script>

<script>
    $(document).ready(function(){
      $("#share_icons").click(function(){
        $("#div3").fadeToggle(500);
      });
    });
</script>

<script>
    $('.product-display-mode #grid').click(function(){
    $('.products-list').addClass('columns-3');
    $('.products-list').removeClass('columns-4');
    $('.product-display-mode #grid').toggleClass('active');
    $('.product-display-mode #grid_large').toggleClass('active');
    });
    $('.product-display-mode #grid_large').click(function(){
    $('.products-list').addClass('columns-4');
    $('.products-list').removeClass('columns-3');
    $('.product-display-mode #grid').toggleClass('active');
    $('.product-display-mode #grid_large').toggleClass('active');
    });
</script>

<script>
    $('.search-icon').click(function(){
        $('.search-wrapper').toggleClass('open');
        $('body').toggleClass('search-wrapper-open');
    });
    $('.search-cancel').click(function(){
        $('.search-wrapper').removeClass('open');
        $('body').removeClass('search-wrapper-open');
    });
</script>

<script type="text/javascript">
    $(".circle-size").hide();
    $(".btn-close").click(function(){
       $(".circle-size").hide();
    });

    $(".btnbuynow").click(function(){
       $(".circle-size").show();
    });
</script>

<script>
    $(document).ready(function(){
       $('[data-toggle="tooltip"]').tooltip();
    });
</script>

<script>
    $(document).ready(function(){
        $("#filterby").click(function(){
           $(".panel-group").toggle(1000);
        });
    });
</script>

@endpush
