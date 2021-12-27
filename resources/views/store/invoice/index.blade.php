<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <style>
        .text-center{
            text-align: center;
        }
        .w-100{
            width : 100%:
        }
        .half{
            width : 50%;
        }
        .text-right{
            text-align : right;
        }
        .text-left{
            text-align : left;
        }

        .mr-5{
            margin-right : 20px;
        }

        .ml-5{
            margin-left : 40px;
        }
        .bg-grey{
            background-color: lightgrey;
        }
        .font12{
            font-size : 12px !important;
        }

        .font18{
            font-size : 18px !important;
        }

        .font10{
            font-size : 11px !important;
        }

        .pl-5{
            padding-left : 70px;
        }

        table {
          border-collapse: collapse;
        }

        .table, .td, .th {
          border: 1px solid grey;
        }
        .td{
            padding: 3px;
        }
        .mb-200{
            margin-top : 100px !important;;
        }

        .bg-grey{
            background-color: lightgrey;
        }

        .mt-5{
            margin-top : 30px;
        }
        th{
            padding : 3px;
            text-align: center;
        }

        .border-bottom{
            border-bottom : 1px solid grey;
        }

        .thr{
            padding: 3px;
        }

        .bold{
            font-weight : bold;
        }
        .p-3{
            padding: 3px;
        }

        .border-dark{
            border : 1px solid grey;
        }

    </style>
</head>
<body>
   <table class="w-100 font12" >
       <tr class="text-center w-100">
          <td class="text-center" colspan="2">
              <h1 class="font18">
                Tax Invoice
              </h1>
          </td>
       </tr>
       <tr class="w-100">
          <td>
              {{-- <img src="{{asset('store/images/vasvi_logo.jpg')}}"  class="half"/> --}}
              <img src="https://vasvi.in/store/images/vasvi_logo.jpg"  style="width : 150px;"/>
          </td>
          <td class="text-right">
              {{$store->invoice_company_name}}<br>
              {{$store->invoice_address}}<br>
              {{$store->invoice_city}} {{$store->invoice_pincode}}.<br>
              GST NO: {{$store->invoice_gstno}}<br>
          </td>
       </tr>
       <tr>
           <td class="text-left half mr-5 ">
               <p class="half" style="word-break: break-all;">
                <span class="bold">TITLE</span><br>
                 {{$order->address !== null ? $order->address : ''}}
               </p>
           </td>
           <td class="ml-5 half pl-5">
              <table class="w-100 font12 table" style="margin-top :25px;border-collapse: collapse;" >
                   <tr class="w-100 tr">
                        <td class="bg-grey td">
                        PAN No.
                        </td>
                        <td class="text-right td">
                        {{$store->invoice_panno}}
                        </td>
                   </tr>
                   <tr class="w-100 tr">
                            <td class="bg-grey td">
                            GST no.
                            </td>
                            <td class="text-right td">
                            {{$store->invoice_gstno}}
                            </td>
                    </tr>
                    <tr class="w-100 tr">
                            <td class="bg-grey td">
                            Invoice #
                            </td>
                            <td class="text-right td">
                            Vasvi/2021-22/0167
                            </td>
                    </tr>
                    <tr class="w-100 tr">
                            <td class="bg-grey td">
                            Date
                            </td>
                            <td class="text-right td">
                            {{date('Y/m/d', strtotime($order->created_at))}}
                            </td>
                    </tr>
                    <tr class="w-100 tr">
                            <td class="bg-grey td">
                            Amount Due
                            </td>
                            <td class="text-right td">
                            {{$order->amount}}/-
                            </td>
                    </tr>
              </table>
           </td>
       </tr>
       <tr class="w-100">
           <td class="w-100" colspan="2">
              <table class="w-100 mt-5">
                  <tr class="w-100 bg-grey" >
                      <th>
                        SR No.
                      </th>
                      <th>
                        Description
                      </th>
                      <th>
                        CGST(5%)
                      </th>
                      <th>
                        IGST(5%)
                      </th>
                      <th>
                        GST(10%)
                      </th>
                      <th>
                        Quantity
                      </th>
                      <th>
                        Amount
                      </th>
                      <th>
                        Total
                      </th>
                  </tr>
                  <?php
                     $count = 1;
                     $sub_total = 0;
                  ?>
                  @foreach($order->orders as $ord)

                  <tr class="text-center">
                      <td class="thr">
                          {{$count}}
                      </td>
                      <td class="thr">
                          {{$ord->name}}
                      </td>
                      <td class="thr">
                          {{$ord->mrp_price * 0.05}}
                      </td>
                      <td class="thr">
                          {{$ord->mrp_price * 0.05}}
                      </td>
                      <td class="thr">
                          {{$ord->mrp_price * 0.1}}
                      </td>
                      <td class="thr">
                          {{$ord->qty}}
                      </td>
                      <td class="thr">
                          {{$ord->mrp_price - ($ord->mrp_price * 0.1)}}
                      </td>
                      <td class="thr">
                        <?php
                          $total  = $ord->mrp_price * $ord->qty;
                          $sub_total += $total;
                        ?>
                        {{$total}}
                      </td>
                  </tr>
                  <?php $count++; ?>
                  @endforeach

                  <tr class="text-center">
                    <td colspan="5">

                    </td>
                    <td  class="thr border-bottom">
                        Sub Total
                    </td>
                    <td  class="border-bottom">

                    </td>
                    <td class="border-bottom">
                        {{$sub_total}}
                    </td>
                  </tr>
                  <tr class="text-center">
                    <td colspan="5">

                    </td>
                    <td  class="thr border-bottom">
                        Total Discount
                    </td>
                    <td  class="border-bottom">

                    </td>
                    <td class="border-bottom">

                        <?php
                             $discount = $order->order_discount->discount + $order->order_discount->coupon_discount;
                             echo $discount;
                         ?>
                    </td>
                  </tr>


                  <tr class="bg-grey">
                    <td colspan="7" class="thr bold">
                       Grand Total
                    </td>
                    <td colspan="1" class="thr bold text-center">
                       {{$order->amount}}/-
                    </td>
                  </tr>
              </table>
           </td>
       </tr>


       <tr>
        <td colspan="2">
            <p>
                <span class="bold">
                    TERMS & CONDITIONS
                </span><br>
                1.Details Log of above uses can be downloaded from panel with in 30 days.
                2.DD/Cheque must be mad ein favor of Daksha Infosoft Pvt. Ltd. payable at Jaipur.<br>
                3.If any changes in price by operators or TRAI will be applicable on unuse credit of your account<br>
                4.Subject to Jaipur jurisdiction only
            </p>
         </td>
       </tr>
       <tr class="w-100">
           <td colspan="2" class="text-right" >
                 {{-- <img src="{{asset('store/images/stamp.png')}}"> --}}
                 {{-- <img src="https://pml.com.ng/wp-content/uploads/2020/08/Stamp-duty-image-960x540.png" style="width : 120px;" class="mt-5"> --}}
           </td>
       </tr>
   </table>
</body>
</html>
