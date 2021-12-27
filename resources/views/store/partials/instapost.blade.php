{{-- <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" integrity="sha512-SfTiTlX6kk+qitfevl/7LibUOeJWlt9rbyDn92a1DqWOw9vWG2MFoays0sgObmWazO5BQPiFucnnEAjpAB+/Sw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <title>Document</title>
    <style>
        .mp-0{
            margin : 0;
            padding: 0px;
        }
        .insta-box{
            position: relative;
        }
        #feed-box{
            position: absolute;
            bottom : 5px;
            text-align: center;
            left : 30%;
        }
    </style>
</head>
<body>
   <div class="container-fluid">
       <div class="row"> --}}
        @foreach($posts as $post)
        <?php
         $path = $post->imageThumbnailUrl ;
         $type = pathinfo($path, PATHINFO_EXTENSION);
         $data = file_get_contents($path);
         $base64 = 'data:image/' . $type . ';base64,' . base64_encode($data);
         ?>
         <div class="col-md-3" style=" margin : 0;padding: 0px;">
            <div style="margin : 2px;" class="insta-box text-center">
                <a href="{{$post->link}}" target="_blank">
                <img src="{{$base64}}" style="width : 100%; height : 300px;"/>
                </a>
                <div class="text-center" style="color : white; font-size : bold;" id="feed-box">
                    <i class="fa fa-lg fa-heart">&nbsp;{{thousandsCurrencyFormat($post->likesCount)}}</i>&nbsp;&nbsp;
                    <i class="fa fa-lg fa-comment">&nbsp;{{thousandsCurrencyFormat($post->commentsCount)}}</i>
                </div>
            </div>
         </div>
        @endforeach
       </div>
   {{-- </div>

</body>
</html> --}}
