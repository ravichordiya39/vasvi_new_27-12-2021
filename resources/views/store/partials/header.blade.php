<div class="menu-container">
    <div class="menu">
        <ul>
            <?php
            $categories= DB::table('categories')
            ->where(['status'=>1])
            ->where('deleted_at', NULL)
            ->get();

            $parents =  DB::table('categories')
            ->where(['status'=>1])
            ->where('deleted_at', NULL)
            ->where('parent_id', 0)
            ->pluck('id')->toArray();
        ?>
            <li><a class="menu1" href="{{url('clothing/all')}}">All</a>
                <ul style="display:none;">
                    <div class="row">
                        <div class="col-md-8 col-sm-8">
                            <?php $i =0 ; ?>
                            @foreach($categories as $subcategory)
                                @if($subcategory->parent_id === 0 )
                                <?php
                                $pid = $subcategory->id;
                                $pproductCheck = getCheckProduct($pid);
                                if($pproductCheck > 0) {
                                    if($subcategory->is_home == 1 || $subcategory->is_menu == 1) {
                                ?>
                                <?php $i++; ?>
                                <li>
                                    <ul class="best">
                                        <a href="{{url('clothing')}}/{{$subcategory->name}}" style="cursor: pointer;">
                                            <div class="menu-inner-h" href="{{url('clothing')}}/{{$subcategory->name}}">
                                                {{$subcategory->name}}</div>
                                        </a>
                                        @foreach($categories as $childcategory)
                                            @if($childcategory->parent_id === $subcategory->id)
                                            <?php
                                            $id = $subcategory->id;
                                            $productCheck = getCheckProduct($id);
                                            if($productCheck > 0) {
                                                if($childcategory->is_home == 1 || $childcategory->is_menu == 1) {
                                                ?>
                                                    <li><a
                                                        href="{{url('clothing')}}/{{$childcategory->name}}">{{$childcategory->name}}</a>
                                                    </li>
                                            <?php }
                                            } ?>
                                            @endif
                                        @endforeach
    
                                    </ul>
                                </li>
                                <?php }
                                } ?>
                                @endif
                            @endforeach

                        </div>
                        <div class="col-md-4 col-sm-4">
                            <div class="menu_img">
                                <img src="{{asset('frontend/images/1d.jpg')}}" alt="">
                            </div>
                        </div>
                    </div>

                </ul>
            </li>

            @foreach($categories as $category)
                @if($category->parent_id === 0)
                <?php
                $pcid = $category->id;
                $pcproductCheck = getCheckProduct($pcid);
                if($pcproductCheck > 0) {
                    if($category->is_home == 1 || $category->is_menu == 1) {
                ?>
                <li>
                    <a class="menu2" href="{{url('clothing')}}/{{$category->name}}">{{$category->name}}</a>
                    <ul style="display:none;">
                        <div class="row">
                            <div class="col-md-8">
                                <?php $i =0 ; ?>
                                @foreach($categories as $subcategory)
                                    
                                    @if($subcategory->parent_id !== 0 && $subcategory->parent_id === $pcid)
                                    <?php $i++; ?>
                                    <?php
                                        $cid = $pcid;
                                        $cproductCheck = getCheckProduct($cid);
                                        if($cproductCheck > 0) {
                                           
                                           if($subcategory->is_home == 1 || $subcategory->is_menu == 1) {
                                    ?>
                                    <li class="menures">
                                        <ul class="best">
                                            <a href="{{url('clothing')}}/{{$subcategory->name}}" style="cursor: pointer;">
                                                <div class="menu-inner-h">{{$subcategory->name}}</div>
                                            </a>
                                            @foreach($categories as $childcategory)
                                            
                                            @if($childcategory->parent_id === $subcategory->id)
                                            <?php
                                            
                                                $sid = $subcategory->id;
                                                $sproductCheck = getCheckProduct($sid);
                                                if($sproductCheck > 0) {
                                                   if($subcategory->is_home == 1 || $subcategory->is_menu == 1) {
                                            ?>
                                            <li><a
                                                    href="{{url('clothing')}}/{{$childcategory->name}}">{{$childcategory->name}}</a>
                                            </li>
                                            <?php }
                                            } ?>
                                            @endif
                                            @endforeach
                                        </ul>
                                    </li>
                                    <?php }
                                    } ?>
                                    @endif
                                @endforeach
                            </div>
                            <div class="col-md-4">
                                <div class="menu_img">
                                    <img src="{{asset('file')}}/{{$category->image}}" height="200" alt="">
                                </div>
                            </div>
                        </div>
    
                    </ul>
                </li>
                <?php }
                } ?>
                @endif
            @endforeach
            <li class="text-center " id="seeme">
                <button id="inclwholesale" class="m-3" data-toggle="modal" data-target="#wholesale">Wholesale</button>
            </li>
        </ul>

    </div>
</div>