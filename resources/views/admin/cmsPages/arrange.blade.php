@extends('layouts.admin')

@push('stylesheet')
<style>
    .sbox,.cbox,.pbox{
        border : 1px solid lightgrey;
        padding : 5px;
        padding-left : 10px;
        padding-right : 10px;
        height : 100%;
    }


    .lefth:hover {
       padding :3px;
       background-color: #E36D76;
       color : white;
       cursor: pointer;

    }
    .lefth-hover{
       padding :3px;
       background-color: #E36D76;
       color : white;
    }

    .lefthc:hover{
       padding :3px;
       background-color: #E36D76;
       color : white;
       cursor: pointer;

    }
    .lefthc-hover{
       padding :3px;
       background-color: #E36D76;
       color : white;
    }

    .lefthp:hover{
       padding :3px;
       background-color: #E36D76;
       color : white;
       cursor: pointer;

    }
    .lefthp-hover{
       padding :3px;
       background-color: #E36D76;
       color : white;
    }

    .responsive-table {
  overflow: auto;
}

table {
  width: 100%;
  border-spacing: 0;
  border-collapse: collapse;
  white-space:nowrap;
}

table th {
  background: #BDBDBD;
}

table tr:nth-child(odd) {
  background-color: #F2F2F2;
}
table tr:nth-child(even) {
  background-color: #E6E6E6;
}

th, tr, td {
  text-align: center;
  border: 1px solid #E0E0E0;
  padding: 5px;
}

img {
  font-style: italic;
  font-size: 11px;
}

.fa-bars-shop{
  cursor: move;
}


#toast-container{
margin-top : 20px;
}

#toast-container > .toast {
width: 370px !important;
}


</style>
@endpush
@section('content')

<div class="card">
    <div class="card-header">
        Show/Arrange Cms Pages
    </div>
    <div class="card-body">
        <div class="row">
            <div class="col-8">
               <h3 class="row">
                 @php
                   $stpage = \DB::table('footer_titles')->where('identity','third')->first();
                 @endphp
                 <input type="text" id="third" value="{{$stpage->title}}" style="width : 200px;border: 0px solid red"/>&nbsp;&nbsp;
                 <button class="btn btn-primary btn-sm"  id="third-btn" onclick="saveTitle('third')"style="display:none;">save</button>&nbsp;
                 <button class="btn btn-secondary btn-sm"  id="third-cancel" style="display:none;">cancel</button>
               </h3>
               <div class="row">
                   <div class="col-5">
                       <div class="sbox sbox-left">
                            @foreach($spages as $page)
                                  <div class="lefth" data-id="shop-{{$page->id}}" id="shopl">{{$page->name}}</div>
                            @endforeach
                       </div>
                   </div>
                   <div class="col-1 text-center">
                      <div  style="height : 100%;align-items: center;">
                        <div class="align-middle">
                            <button class="btn btn-sm btn-primary" id="add-btn" disabled>
                                <i class="fa fa-chevron-right"></i>
                              </button><br>
                              <button class="btn btn-sm btn-primary mt-2" id="minus-btn" disabled>
                                <i class="fa fa-chevron-left"></i>
                              </button>
                        </div>

                      </div>
                   </div>
                   <div class="col-5">
                        <div class="sbox sbox-right">
                        @foreach($pages as $page)
                            @if($shops->count() > 0)
                              @foreach($shops as $shop)
                                @if($shop->page_id === $page->id)
                                  <div class="lefth" data-id="shop-{{$page->id}}" id="shopr">{{$page->name}}</div>
                                @endif
                              @endforeach
                            @endif

                        @endforeach
                        </div>
                    </div>
               </div>
            </div>
            <div class="col-4">
                <h3>Page Order</h3>
                <div class="responsive-table">
                    <table id="shoptable" class="w-100">
                            @if($shops->count() > 0)
                            @foreach($shops as $shop)
                            <tr class="ui-state-default">
                                <td><i class="fa-bars-shop"></i>{{$shop->order_no}}</td>
                                <td class="spage  text-left" data-id="{{$shop->id}}" id="spage">{{$shop->pages->name}}</td>
                            <tr>
                            @endforeach
                            @else
                            <tr class="ui-state-default shop-blank">
                                <td colspan="2">
                                    <h5>Pages not found</h5>
                                </td>
                            </tr>
                            @endif
                        </tr>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <div class="card-body">
        <div class="row">
            <div class="col-8">
                <h3 class="col-12">

                  @php
                    $spage = \DB::table('footer_titles')->where('identity','first')->first();
                  @endphp
                  <input type="text" id="first" value="{{$spage->title}}" style="width : 200px;border: 0px solid red"/>&nbsp;&nbsp;
                  <button class="btn btn-primary btn-sm"  id="first-btn" onclick="saveTitle('first')"style="display:none;">save</button>&nbsp;
                  <button class="btn btn-secondary btn-sm"  id="first-cancel" style="display:none;">cancel</button>
                </h3>
               <div class="row">
                   <div class="col-5">
                       <div class="cbox cbox-left">
                            @foreach($cpages as $page)
                                  <div class="lefthc" data-id="cust-{{$page->id}}" id="shoplc">{{$page->name}}</div>
                            @endforeach
                       </div>
                   </div>
                   <div class="col-1 text-center">
                      <div  style="height : 100%;align-items: center;">
                        <div class="align-middle">
                            <button class="btn btn-sm btn-primary" id="addc-btn" disabled>
                                <i class="fa fa-chevron-right"></i>
                              </button><br>
                              <button class="btn btn-sm btn-primary mt-2" id="minusc-btn" disabled>
                                <i class="fa fa-chevron-left"></i>
                              </button>
                        </div>

                      </div>
                   </div>
                   <div class="col-5">
                        <div class="sbox cbox-right">
                        @foreach($pages as $page)
                            @if($customers->count() > 0)
                              @foreach($customers as $customer)
                                @if($customer->page_id === $page->id)
                                  <div class="lefthc" data-id="cust-{{$page->id}}" id="custr">{{$page->name}}</div>
                                @endif
                              @endforeach
                            @endif

                        @endforeach
                        </div>
                    </div>
               </div>
            </div>
            <div class="col-4">
                <h3>Page Order</h3>
                <div class="responsive-table">
                    <table id="custtable" class="w-100">
                            @if($customers->count() > 0)
                            @foreach($customers as $customer)
                            <tr class="ui-state-default">
                                <td><i class="fa-bars-cust"></i>{{$customer->order_no}}</td>
                                <td class="cpage  text-left" data-id="{{$customer->id}}" id="cpage">{{$customer->pages->name}}</td>
                            <tr>
                            @endforeach
                            @else
                            <tr class="ui-state-default cust-blank">
                                <td colspan="2">
                                    <h5>Pages not found</h5>
                                </td>
                            </tr>
                            @endif
                        </tr>
                    </table>
                </div>
            </div>
        </div>
    </div>


    <div class="card-body">
        <div class="row">
            <div class="col-8">
                <h3 class="col-12">
                  @php
                    $scpage = \DB::table('footer_titles')->where('identity','second')->first();
                  @endphp
                  <input type="text" id="second" value="{{$scpage->title}}" style="width : 200px;border: 0px solid red"/>&nbsp;&nbsp;
                  <button class="btn btn-primary btn-sm"  id="second-btn" onclick="saveTitle('second')"style="display:none;">save</button>&nbsp;
                  <button class="btn btn-secondary btn-sm"  id="second-cancel" style="display:none;">cancel</button>
                </h3>
               <div class="row">
                   <div class="col-5">
                       <div class="pbox cbox-left">
                            @foreach($ppages as $page)
                                  <div class="lefthp" data-id="cust-{{$page->id}}" id="shoplp">{{$page->name}}</div>
                            @endforeach
                       </div>
                   </div>
                   <div class="col-1 text-center">
                      <div  style="height : 100%;align-items: center;">
                        <div class="align-middle">
                            <button class="btn btn-sm btn-primary" id="addp-btn" disabled>
                                <i class="fa fa-chevron-right"></i>
                              </button><br>
                              <button class="btn btn-sm btn-primary mt-2" id="minusp-btn" disabled>
                                <i class="fa fa-chevron-left"></i>
                              </button>
                        </div>

                      </div>
                   </div>
                   <div class="col-5">
                        <div class="sbox pbox-right">
                        @foreach($pages as $page)
                            @if($policies->count() > 0)
                              @foreach($policies as $policy)
                                @if($policy->page_id === $page->id)
                                  <div class="lefthp" data-id="pri-{{$page->id}}" id="prir">{{$page->name}}</div>
                                @endif
                              @endforeach
                            @endif

                        @endforeach
                        </div>
                    </div>
               </div>
            </div>
            <div class="col-4">
                <h3>Page Order</h3>
                <div class="responsive-table">
                    <table id="pritable" class="w-100">
                            @if($policies->count() > 0)
                            @foreach($policies as $policy)
                            <tr class="ui-state-default">
                                <td><i class="fa-bars-pri"></i>{{$policy->order_no}}</td>
                                <td class="ppage  text-left" data-id="{{$policy->id}}" id="ppage">{{$policy->pages->name}}</td>
                            <tr>
                            @endforeach
                            @else
                            <tr class="ui-state-default pri-blank">
                                <td colspan="2">
                                    <h5>Pages not found</h5>
                                </td>
                            </tr>
                            @endif
                        </tr>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.11.2/jquery-ui.min.js"></script>
<script>
  let overlay = $(document).find('.loading-overlay');
  $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
  });
  var selected = 0;
  var selecttext = '';
   $(document).on('focus','#first',function(){
      $('#first-btn').show();
      $('#first-cancel').show();
   })

   $(document).on('click','#first-cancel',function(){
      $('#first-btn').hide();
      $('#first-cancel').hide();
   })


   $(document).on('focus','#second',function(){
      $('#second-btn').show();
      $('#second-cancel').show();
   })

   $(document).on('click','#second-cancel',function(){
      $('#second-btn').hide();
      $('#second-cancel').hide();
   })



   $(document).on('focus','#third',function(){
      $('#third-btn').show();
      $('#third-cancel').show();
   })

   $(document).on('click','#third-cancel',function(){
      $('#third-btn').hide();
      $('#third-cancel').hide();
   })

   function saveTitle(identity){
     var title = '';
     var error = false;
     if(identity === 'first'){
       title = $('#first').val();
       if(title === ''){
         error = true;
       }
       else{
         error = false;
       }
     }
     else if(identity === 'second'){
       title = $('#second').val();
       if(title === ''){
         error = true;
       }
       else{
         error = false;
       }
     }
     if(identity === 'third'){
       title = $('#third').val();
       if(title === ''){
         error = true;
       }
       else{
         error = false;
       }
     }
     if(error){
       toastr.warning('Warning!', 'Title must be required, it cannot be blank.',{
           positionClass: 'toast-top-center',
           iconClass:'toast-warning',
       });
     }
     else{
       $.ajax({
           type: "POST",
           url: "{{route('admin.cms-pages.title.update')}}",
           data: {identity : identity, title : title},
           beforeSend : function(){
             overlay.addClass('is-active');
           },
           success: function (response) {
             overlay.removeClass('is-active');
             toastr.success('Success!', response.message,{
                 positionClass: 'toast-top-center',
                 iconClass:'toast-success',
             });
           },
           error : function(err){
             toastr.error('Error!', 'Title not updated',{
                 positionClass: 'toast-top-center',
                 iconClass:'toast-error',
             });
           }
         });
     }
   }

  $(document).on('click','.lefth', function(e){
      $(document).find('.lefth').removeClass('lefth-hover');
      e.preventDefault();
      $(this).addClass('lefth-hover');
      if($(this).attr('id') === 'shopl'){
        $('#add-btn').removeAttr('disabled');
        $('#minus-btn').attr('disabled', true);
      }
      else{
        $('#minus-btn').removeAttr('disabled');
        $('#add-btn').attr('disabled', true);
      }

      selected = $(this).attr('data-id');
      selecttext = $(this).html();
  })

  var selectedc = 0;
  var selecttextc = '';
  $(document).on('click','.lefthc', function(e){
      $(document).find('.lefthc').removeClass('lefthc-hover');
      e.preventDefault();
      $(this).addClass('lefthc-hover');
      if($(this).attr('id') === 'shoplc'){
        $('#addc-btn').removeAttr('disabled');
        $('#minusc-btn').attr('disabled', true);
      }
      else{
        $('#minusc-btn').removeAttr('disabled');
        $('#addc-btn').attr('disabled', true);
      }

      selectedc = $(this).attr('data-id');
      selecttextc = $(this).html();
  })


  var selectedp = 0;
  var selecttextp = '';
  $(document).on('click','.lefthp', function(e){
      $(document).find('.lefthp').removeClass('lefthp-hover');
      e.preventDefault();
      $(this).addClass('lefthp-hover');
      if($(this).attr('id') === 'shoplp'){
        $('#addp-btn').removeAttr('disabled');
        $('#minusp-btn').attr('disabled', true);
      }
      else{
        $('#minusp-btn').removeAttr('disabled');
        $('#addp-btn').attr('disabled', true);
      }

      selectedp = $(this).attr('data-id');
      selecttextp = $(this).html();
  })

  $(document).on('click','#add-btn', function(e){
      $(document).find('.lefth').each(function(){
          var dataid = $(this).attr('data-id');
          if(dataid === selected){
              $(this).remove();
              $(document).find('.sbox-right').append(
                  `<div class="lefth" data-id="${selected}" id="shopr">${selecttext}</div>`
              );

              $.ajax({
                  type: "POST",
                  url: "{{route('admin.shopage.store')}}",
                  data: {id : selected.replace('shop-','')},
                  beforeSend : function(){
                    overlay.addClass('is-active');
                  },
                  success: function (response) {
                    overlay.removeClass('is-active');
                    $(document).find('.shop-blank').remove();
                    var html = '';
                    if(response.length > 0){
                      for(var i = 0; i < response.length; i++){
                          html += ` <tr class="'ui-state-default">
                                        <td class="fa-bars-shop" data-id="${response[i].id}">${i+1}</td>
                                        <td class="spage text-left" data-id="${response[i].id}" id="spage">${response[i].pages.name}</td>
                                    <tr>`;
                      }
                    }
                    else{
                         html += `<tr class="ui-state-default shop-blank">
                                    <td colspan="2">
                                        <h5>Pages not found</h5>
                                    </td>
                                  </tr>`;
                    }
                    $(document).find('#shoptable tbody').html(html);
                  },
                  error : function(err){
                     console.log(err);
                  }
              });
          }
      })
      $(this).attr('disabled','true');
  });

  $(document).on('click','#addc-btn', function(e){
      $(document).find('.lefthc').each(function(){

          var dataid = $(this).attr('data-id');
          if(dataid === selectedc){
              $(this).remove();
              $(document).find('div .cbox-right').append(
                  `<div class="lefthc" data-id="${selectedc}" id="custr">${selecttextc}</div>`
              );

              $.ajax({
                  type: "POST",
                  url: "{{route('admin.customerpage.store')}}",
                  data: {id : selectedc.replace('cust-','')},
                  beforeSend : function(){
                    overlay.addClass('is-active');
                  },
                  success: function (response) {
                    overlay.removeClass('is-active');
                    $(document).find('.cust-blank').remove();
                    var html = '';
                    if(response.length > 0){
                      for(var i = 0; i < response.length; i++){
                          html += ` <tr class="'ui-state-default">
                                        <td class="fa-bars-cust" data-id="${response[i].id}">${i+1}</td>
                                        <td class="cpage text-left" data-id="${response[i].id}" id="cpage">${response[i].pages.name}</td>
                                    <tr>`;
                      }
                    }
                    else{
                         html += `<tr class="ui-state-default shop-blank">
                                    <td colspan="2">
                                        <h5>Pages not found</h5>
                                    </td>
                                  </tr>`;
                    }
                    $(document).find('#custtable tbody').html(html);
                  },
                  error : function(err){
                     console.log(err);
                  }
              });
          }
      })
      $(this).attr('disabled','true');
  });

  $(document).on('click','#addp-btn', function(e){
      $(document).find('.lefthp').each(function(){

          var dataid = $(this).attr('data-id');
          if(dataid === selectedp){
              $(this).remove();
              $(document).find('div .pbox-right').append(
                  `<div class="lefthc" data-id="${selectedp}" id="custr">${selecttextp}</div>`
              );

              $.ajax({
                  type: "POST",
                  url: "{{route('admin.policypage.store')}}",
                  data: {id : selectedp.replace('cust-','')},
                  beforeSend : function(){
                    overlay.addClass('is-active');
                  },
                  success: function (response) {
                    overlay.removeClass('is-active');
                    $(document).find('.pri-blank').remove();
                    var html = '';
                    if(response.length > 0){
                      for(var i = 0; i < response.length; i++){
                          html += ` <tr class="'ui-state-default">
                                        <td class="fa-bars-pri" data-id="${response[i].id}">${i+1}</td>
                                        <td class="ppage text-left" data-id="${response[i].id}" id="ppage">${response[i].pages.name}</td>
                                    <tr>`;
                      }
                    }
                    else{
                         html += `<tr class="ui-state-default pri-blank">
                                    <td colspan="2">
                                        <h5>Pages not found</h5>
                                    </td>
                                  </tr>`;
                    }
                    $(document).find('#pritable tbody').html(html);
                  },
                  error : function(err){
                     console.log(err);
                  }
              });
          }
      })
      $(this).attr('disabled','true');
  });

  $(document).on('click','#minus-btn', function(e){
      $(document).find('.lefth').each(function(){
          var dataid = $(this).attr('data-id');
          if(dataid === selected){
              $(this).remove();
              $(document).find('.sbox-left').append(
                  `<div class="lefth" data-id="${selected}" id="shopl">${selecttext}</div>`
              );

              $.ajax({
                  type: "DELETE",
                  url: "{{route('admin.shopage.delete')}}",
                  data: {id : selected.replace('shop-','')},
                  beforeSend : function(){
                    overlay.addClass('is-active');
                  },
                  success: function (response) {
                    overlay.removeClass('is-active');
                    $(document).find('.shop-blank').remove();
                    var html = '';
                    if(response.length > 0){
                      for(var i = 0; i < response.length; i++){
                          html += ` <tr class="'ui-state-default">
                                        <td class="fa-bars-shop" data-id="${response[i].id}">${i+1}</td>
                                        <td class="spage text-left" data-id="${response[i].id}" id="spage">${response[i].pages.name}</td>
                                    <tr>`;
                      }
                    }
                    else{
                         html += `<tr class="ui-state-default shop-blank">
                                    <td colspan="2">
                                        <h5>Pages not found</h5>
                                    </td>
                                  </tr>`;
                    }
                    $(document).find('#shoptable tbody').html(html);
                  },
                  error : function(err){
                    console.log(err);
                  }
              });
          }
      });
      $(this).attr('disabled','true');
  });


  $(document).on('click','#minusc-btn', function(e){
      $(document).find('.lefthc').each(function(){
          var dataid = $(this).attr('data-id');
          if(dataid === selectedc){
              $(this).remove();
              $(document).find('.cbox-left').append(
                  `<div class="lefthc" data-id="${selectedc}" id="shoplc">${selecttextc}</div>`
              );

              $.ajax({
                  type: "DELETE",
                  url: "{{route('admin.customerpage.delete')}}",
                  data: {id : selectedc.replace('cust-','')},
                  beforeSend : function(){
                    overlay.addClass('is-active');
                  },
                  success: function (response) {
                    overlay.removeClass('is-active');
                    $(document).find('.cust-blank').remove();
                    var html = '';
                    if(response.length > 0){
                      for(var i = 0; i < response.length; i++){
                          html += ` <tr class="'ui-state-default">
                                        <td class="fa-bars-cust" data-id="${response[i].id}">${i+1}</td>
                                        <td class="cpage text-left" data-id="${response[i].id}" id="cpage">${response[i].pages.name}</td>
                                    <tr>`;
                      }
                    }
                    else{
                         html += `<tr class="ui-state-default shop-blank">
                                    <td colspan="2">
                                        <h5>Pages not found</h5>
                                    </td>
                                  </tr>`;
                    }
                    $(document).find('#custtable tbody').html(html);
                  },
                  error : function(err){
                    console.log(err);
                  }
              });
          }
      });
      $(this).attr('disabled','true');
  });

  $(document).on('click','#minusp-btn', function(e){
      $(document).find('.lefthp').each(function(){
          var dataid = $(this).attr('data-id');
          if(dataid === selectedp){
              $(this).remove();
              $(document).find('.cbox-left').append(
                  `<div class="lefthc" data-id="${selectedp}" id="shoplc">${selecttextp}</div>`
              );

              $.ajax({
                  type: "DELETE",
                  url: "{{route('admin.policypage.delete')}}",
                  data: {id : selectedp.replace('pri-','')},
                  beforeSend : function(){
                    overlay.addClass('is-active');
                  },
                  success: function (response) {
                    overlay.removeClass('is-active');
                    $(document).find('.pri-blank').remove();
                    var html = '';
                    if(response.length > 0){
                      for(var i = 0; i < response.length; i++){
                          html += ` <tr class="'ui-state-default">
                                        <td class="fa-bars-pri" data-id="${response[i].id}">${i+1}</td>
                                        <td class="ppage text-left" data-id="${response[i].id}" id="ppage">${response[i].pages.name}</td>
                                    <tr>`;
                      }
                    }
                    else{
                         html += `<tr class="ui-state-default pri-blank">
                                    <td colspan="2">
                                        <h5>Pages not found</h5>
                                    </td>
                                  </tr>`;
                    }
                    $(document).find('#pritable tbody').html(html);
                  },
                  error : function(err){
                    console.log(err);
                  }
              });
          }
      });
      $(this).attr('disabled','true');
  });

    $("#shoptable tbody").sortable({
        cursor: "move",
        placeholder: "sortable-placeholder",
        helper: function(e, tr)
        {
            var $originals = tr.children();
            var $helper = tr.clone();
            $helper.children().each(function(index)
            {
            // Set helper cell sizes to match the original sizes
            $(this).width($originals.eq(index).width());
            });
            return $helper;
        }
        ,
        stop : function(event , ui){
            arrange();
        }
    }).disableSelection();


    $("#custtable tbody").sortable({
        cursor: "move",
        placeholder: "sortable-placeholder",
        helper: function(e, tr)
        {
            var $originals = tr.children();
            var $helper = tr.clone();
            $helper.children().each(function(index)
            {
            // Set helper cell sizes to match the original sizes
            $(this).width($originals.eq(index).width());
            });
            return $helper;
        }
        ,
        stop : function(event , ui){
            arrangec();
        }
    }).disableSelection();

    $("#pritable tbody").sortable({
        cursor: "move",
        placeholder: "sortable-placeholder",
        helper: function(e, tr)
        {
            var $originals = tr.children();
            var $helper = tr.clone();
            $helper.children().each(function(index)
            {
            // Set helper cell sizes to match the original sizes
            $(this).width($originals.eq(index).width());
            });
            return $helper;
        }
        ,
        stop : function(event , ui){
            arrangep();
        }
    }).disableSelection();


    function arrange(){
      var i=1;
      $(document).find('.fa-bars-shop').each(function(){
        var data = $(this).attr('data-id');
        $(this).find('.fa-bars-shop').html(i);
        i++;
      });

      var ids = [];
      $(document).find('tbody #spage').each(function(){
          if($(this).attr('data-id') !== '' || $(this).attr('data-id') !== null || $(this).attr('data-id') !== undefined){
            ids.push($(this).attr('data-id'));
          }

      });


      $.ajax({
          type: "POST",
          url: "{{route('admin.shopage.sequence')}}",
          data: {ids : ids},
          beforeSend : function(){
                    overlay.addClass('is-active');
          },
          success: function (response) {
            overlay.removeClass('is-active');
            $(document).find('.shop-blank').remove();
                    var html = '';
                    if(response.length > 0){
                      for(var i = 0; i < response.length; i++){
                          html += ` <tr class="'ui-state-default">
                                        <td class="fa-bars-shop" data-id="${response[i].id}">${i+1}</td>
                                        <td class="spage text-left" data-id="${response[i].id}" id="spage">${response[i].pages.name}</td>
                                    <tr>`;
                      }
                    }
                    else{
                         html += `<tr class="ui-state-default shop-blank">
                                    <td colspan="2">
                                        <h5>Pages not found</h5>
                                    </td>
                                  </tr>`;
                    }
                    $(document).find('#shoptable tbody').html(html);
          },
          error : function(err){
              console.log(err);
          }
      });
    }


    function arrangec(){
      var i=1;
      $(document).find('.fa-bars-cust').each(function(){
        var data = $(this).attr('data-id');
        $(this).find('.fa-bars-cust').html(i);
        i++;
      });

      var ids = [];
      $(document).find('tbody #cpage').each(function(){
          if($(this).attr('data-id') !== '' || $(this).attr('data-id') !== null || $(this).attr('data-id') !== undefined){
            ids.push($(this).attr('data-id'));
          }

      });


      $.ajax({
          type: "POST",
          url: "{{route('admin.customerpage.sequence')}}",
          data: {ids : ids},
          beforeSend : function(){
                    overlay.addClass('is-active');
          },
          success: function (response) {
            overlay.removeClass('is-active');
            $(document).find('.cust-blank').remove();
                    var html = '';
                    if(response.length > 0){
                      for(var i = 0; i < response.length; i++){
                          html += ` <tr class="'ui-state-default">
                                        <td class="fa-bars-cust" data-id="${response[i].id}">${i+1}</td>
                                        <td class="cpage text-left" data-id="${response[i].id}" id="cpage">${response[i].pages.name}</td>
                                    <tr>`;
                      }
                    }
                    else{
                         html += `<tr class="ui-state-default shop-blank">
                                    <td colspan="2">
                                        <h5>Pages not found</h5>
                                    </td>
                                  </tr>`;
                    }
                    $(document).find('#custtable tbody').html(html);
          },
          error : function(err){
              console.log(err);
          }
      });
    }

    function arrangep(){
      var i=1;
      $(document).find('.fa-bars-pri').each(function(){
        var data = $(this).attr('data-id');
        $(this).find('.fa-bars-pri').html(i);
        i++;
      });

      var ids = [];
      $(document).find('tbody #ppage').each(function(){
          if($(this).attr('data-id') !== '' || $(this).attr('data-id') !== null || $(this).attr('data-id') !== undefined){
            ids.push($(this).attr('data-id'));
          }

      });


      $.ajax({
          type: "POST",
          url: "{{route('admin.policypage.sequence')}}",
          data: {ids : ids},
          beforeSend : function(){
                    overlay.addClass('is-active');
          },
          success: function (response) {
            overlay.removeClass('is-active');
            $(document).find('.pri-blank').remove();
                    var html = '';
                    if(response.length > 0){
                      for(var i = 0; i < response.length; i++){
                          html += ` <tr class="'ui-state-default">
                                        <td class="fa-bars-pri" data-id="${response[i].id}">${i+1}</td>
                                        <td class="ppage text-left" data-id="${response[i].id}" id="ppage">${response[i].pages.name}</td>
                                    <tr>`;
                      }
                    }
                    else{
                         html += `<tr class="ui-state-default pri-blank">
                                    <td colspan="2">
                                        <h5>Pages not found</h5>
                                    </td>
                                  </tr>`;
                    }
                    $(document).find('#pritable tbody').html(html);
          },
          error : function(err){
              console.log(err);
          }
      });
    }

</script>
@endsection
