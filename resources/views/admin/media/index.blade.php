@extends('layouts.admin')
@push('stylesheet')


<style>
    #toast-container{
        margin-top : 20px;
    }

    #toast-container > .toast {
    width: 370px !important;
    }

    .thumbnail-imges{
        height : 130px !important;
        vertical-align: middle;
        border : 1px solid lightgray;
        border-radius : 5px 5px 0px 0px !important;

    }
    .margin-bottomset:hover{
        transform: scale(1.05);
    }

    .box-image{
        padding : auto;
        width : 100%;
        height : 100px;
        max-height : 100px;

    }
    .img-thubnail img{
        vertical-align: middle;
    }

    #add-image-body{
        /* min-height : 300px;
        max-height : auto; */
    }

    input[type="checkbox"][id^="myCheckbox"] {
     display: none;
    }

    #mychklabel{
    border: 1px solid #fff;
    padding: 2px;
    display: block;
    position: relative;
    margin: 2px;
    cursor: pointer;
    }

    #mychklabel:before {
    background-color: white;
    color: white;
    content: " ";
    display: block;
    border-radius: 50%;
    border: 1px solid grey;
    position: absolute;
    top: -5px;
    left: -5px;
    width: 25px;
    height: 25px;
    text-align: center;
    line-height: 28px;
    transition-duration: 0.4s;
    transform: scale(0);
    }

    #mychklabel img {
        transition-duration: 0.2s;
        transform-origin: 50% 50%;
    }

    input[type="checkbox"][id^="myCheckbox"]:checked + #mychklabel {
    border-color: #ddd;
    }

    input[type="checkbox"][id^="myCheckbox"]:checked + #mychklabel:before {
        content: "✓";
        background-color: grey;
        transform: scale(1);
    }

    input[type="checkbox"][id^="myCheckbox"]:checked + #mychklabel img {
    transform: scale(0.9);
    /* box-shadow: 0 0 5px #333; */
    z-index: -1;
    }
</style>
@endpush

@section('content')
<section class="content" style="padding-top: 20px">
    <div class="content">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header">
                      Listing all images
                      <div class="float-right inline-block">
                         <button class="btn btn-secondary" id="unselect-all"><i class="fa fa-times"></i>&nbsp;Unselect All</button>
                         <button class="btn btn-dark" id="select-all"><i class="fa fa-check"></i>&nbsp;Select All</button>
                         <button class="btn btn-danger" id="btn-delete"><i class="fa fa-trash"></i>&nbsp;Delete</button>
                         <button class="btn btn-primary" data-toggle="modal" data-target=".add-image-modal"><i class="fa fa-plus"></i>&nbsp;Add New</button>
                      </div>
                    </div>

                    <div class="card-body">
                        <div class="row">
                            @foreach($images as $image)
                            <div class="col-xs-4 col-md-2 margin-bottomset py-2">
                                <div class="img-thumbnail thumbnail-imges  ">
                                    <input type="checkbox" id="myCheckbox{{$image->id}}" data-id="{{$image->id}}"/>
                                      <label for="myCheckbox{{$image->id}}" id="mychklabel">
                                        <img class="box-image px-2 py-2" image_id="" src="{{asset("file")}}/{{$image->name}}" alt="..." >
                                    </label>
                                </div>
                                <button class="btn btn-block btn-secondary" id="view-btn" style="border : 2px solid #5A6268;border-radius: 0px 0px 5px 5px !important;" data-id="{{$image->id}}"> View Detail</button>
                            </div>
                            @endforeach
                        </div>
                        <div class="row text-center mt-5">
                            <div class="col-3 mx-auto">
                                {!! $images->links() !!}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<div class="modal fade add-image-modal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
      <div class="modal-content" id="add-image-body">
         <div class="modal-header text-center">
            <h4 class="modal-title w-100">
              Drag & Drop images to upload
              <span class="font-weight-bold text-warning d-block" style="padding :0; margin:0; font-size:14px;">Please upload images with max size 200px because it affects on  website speed.</span>
            </h4>

            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <div class="upload-box h-100" >
                <form action="{{ route('admin.media.store') }}" method="POST" enctype="multipart/form-data" class="dropzone w-100" id='image-upload'>
                    @csrf
                    <div class="w-100">
                        <h3 class="text-center">Upload Multiple Image By Click On Box</h3>
                    </div>
                </form>
            </div>
          </div>
      </div>
    </div>
</div>

<div class="modal fade view-image-modal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog   modal-dialog-centered">
      <div class="modal-content" id="add-image-body">
         <div class="modal-header text-center">
            <h5 class="modal-title w-100">Image Information</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body" id="image-view">

          </div>
      </div>
    </div>
</div>
@endsection

@section('scripts')

<script>
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    Dropzone.options.imageUpload ={
        maxFilesize:50,
        acceptedFiles: ".jpeg,.jpg,.png,.gif",
        timeout: 60000,
        addRemoveLinks: true,
    };


    $('.add-image-modal').on('hidden.bs.modal', function () {
     location.reload();
    });

    $(document).on('click','#view-btn',function(e){
        e.preventDefault();
        var id = $(this).attr('data-id');
        $.ajax({
           type:'GET',
           url:"{{ url('backoffice/media/view') }}"+"/"+id,
           data:{},
           success:function(data){
              var img = new Image();
              img.src = "{{asset('file')}}"+ "/" + data.data.name;

              var imgwidth = img.width;
              var imgheight = img.height;
              console.log(img.width);
              var html = "";
              $('#image-view').html(`
                     <img src="${img.src}"  class="w-100"/>
                     <h4 class="text-center my-1">Name - ${data.data.name}</h4>
                     <h6 class="text-center my-1">Diamension - ${imgwidth}/${imgheight}</h6>
              `);

              $('.view-image-modal').modal('show');
           }
        });
    });


    $(document).on('click','#select-all', function(){
        $(document).find('input:checkbox').prop('checked', true);
    });

    $(document).on('click','#unselect-all', function(){
        $(document).find('input:checkbox').prop('checked', false);
    });

    $(document).on('click','#btn-delete', function(){
        var error = true;
        var image_ids = [];
        $(document).find('input[type=checkbox]').each(function () {
           var id = $(this).attr('data-id');
           if ($(this).is(':checked'))
           {
               error = false;
               image_ids.push(id);
           }
        });
        console.log(image_ids);
        if(error){
            toastr.error('error', 'Plz select atleast one image to delete.',{
                      positionClass: 'toast-top-center',
            });
            return;
        }
        else{
            $.ajax({
                type:'POST',
                url:"{{ url('backoffice/media/delete') }}",
                data:{image_ids : image_ids},
                success:function(data){
                    toastr.success('Success', data.message,{
                      positionClass: 'toast-top-center',
                    });
                    location.reload();
                },
                error : function(err){
                    toastr.error('error', 'Internal server Error!',{
                      positionClass: 'toast-top-center',
                    });
                }
            });
        }
    });
</script>
@endsection
