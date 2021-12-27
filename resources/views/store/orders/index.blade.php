@extends('store.layouts.app')

@push('styles')

@endpush


@section('content')
<div class="row mt-5">
    <div class="col-12">
        @if(count($orders) > 0)
          <?php
          $order_id = 0;
          $id = 0;
          ?>
          @foreach($orders as $order)
               <?php
                 echo "<pre>";
                    echo print_r($order);
                 echo "</pre>";
               ?>

          @endforeach
        @endif
    </div>
</div>
@endsection

@push('scripts')

@endpush
