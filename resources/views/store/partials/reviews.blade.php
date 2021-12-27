@if(count($reviews) > 0)
  @foreach($reviews as $review)
    <div class="col-md-12 my-3" id="rec-box">
        @if(\Auth::check())
          @if(\Auth::user()->id === $review->user_id)
             <button class="btn btn-sm btn-danger" id="review-trash" data-id="{{$review->id}}"><i class="fa fa-trash"></i></button>
          @endif
        @endif
        <img src="
        @if($review->users->avatar !== null)
        {{asset('file')}}/{{$review->users->avatar }}
        @else
            {{asset('store/images/user-icon4.png')}}
        @endif

        " style="width : 10%; float:left"/>

        <div class="float-right">
            {{$review->rating}}/5 &nbsp;
            @if($review->rating >= 1)
              <i class="fa fa-star" style="color:#FB8071"></i>
            @else
            <i class="fa fa-star" style="colo : grey"></i>
            @endif
            @if($review->rating >= 2)
              <i class="fa fa-star" style="color:#FB8071"></i>
            @else
            <i class="fa fa-star" style="colo : grey"></i>
            @endif
            @if($review->rating >= 3)
              <i class="fa fa-star" style="color:#FB8071"></i>
            @else
            <i class="fa fa-star" style="colo : grey"></i>
            @endif
            @if($review->rating >= 4)
              <i class="fa fa-star" style="color:#FB8071"></i>
            @else
            <i class="fa fa-star" style="colo : grey"></i>
            @endif
            @if($review->rating >= 5)
              <i class="fa fa-star" style="color:#FB8071"></i>
            @else
            <i class="fa fa-star" style="colo : grey"></i>
            @endif
        </div>

    <div class="comment-box" style="margin-left : 18px;">
        <strong style="font-weight :bold; margin-right : 10px;font-size : 16px;">{{$review->users->name}}</strong> <i class="fa  fa-circle" style="font-size: 10px;color : lightgrey; margin-right : 5px;"></i><span class="text-secondary" style="font-weight : bold; font-size : 12px;">on {{date('d M Y', strtotime($review->updated_at))}}</span>
        @if($review->recommend === 1)
          <span style="color : #FB8071; margin-left 15px;">Recommended</span>
        @endif
        <br>
        <div class="star" style="font-size : 10px; margin-left : 20px;">
            <span style="font-weight:bold; font-size : 14px;">{{$review->title}}</span>
            &nbsp;&nbsp;
        </div>
        <p>
            {{substr($review->comment, 0, 170)}}
            @if(strlen($review->comment) > 170)
              <span class="more"><i class="fa fa-caret-down fa-lg mx-2"></i></span>
              <span class="less">{{substr($review->comment,170)}}<i class="fa fa-caret-up fa-lg mx-2"></i></span>
            @endif
        </p>
    </div>
    </div>
  @endforeach
@else

 <div class="text-center m-5">
     <span style="font-weight : bold;">No comments found</span>
 </div>
@endif

<div class="text-center">
    {{$reviews->links()}}
</div>
