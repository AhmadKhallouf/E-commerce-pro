<!DOCTYPE html>
<html>
   <head>
      <!-- Basic -->
      
      <meta charset="utf-8" />
      <meta http-equiv="X-UA-Compatible" content="IE=edge" />
      <!-- Mobile Metas -->
      <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
      <!-- Site Metas -->
      <meta name="keywords" content="" />
      <meta name="description" content="" />
      <meta name="author" content="" />
      <link rel="shortcut icon" href="images/favicon.png" type="">
      <title>Famms - Fashion HTML Template</title>
      <!-- bootstrap core css -->
      <link rel="stylesheet" type="text/css" href="{{asset('/home/css/bootstrap.css')}}" />
      <!-- font awesome style -->
      <link href="{{asset('/home/css/font-awesome.min.css')}}" rel="stylesheet" />
      <!-- Custom styles for this template -->
      <link href="{{asset('/home/css/style.css')}}" rel="stylesheet" />
      <!-- responsive style -->
      <link href="{{asset('/home/css/responsive.css')}}" rel="stylesheet" />
      <style>
        .center{
            margin: auto;
            width: 75%;
            text-align: center;
            padding: 30px;
        }

        table,th,td{
            border: 1px solid grey;
        }

        .th_deg{
            font-size: 30px;
            padding: 5px;
            background: skyblue;
        }



      </style>
   </head>
   <body>
      
         <!-- header section strats -->
         @include('home.header')
         <!-- end header section -->
         @if (session()->has('message'))
         <div class="alert alert-success">

           <button class="close" type="button" data-dismiss="alert" aria-hidden="true">x</button>

           {{ session()->get('message') }}

         </div>
         @endif

      <div class="center">
      <table>
        <tr>
            <th class="th_deg" style="width: 200px;">Product Title</th>
            <th class="th_deg">Quantity</th>
            <th class="th_deg">Price</th>
            <th class="th_deg">Payment Status</th>
            <th class="th_deg">Delivery Status</th>
            <th class="th_deg">Image</th>
            <th class="th_deg" style="width: 150px;">Action</th>
        </tr>
        
        @foreach ($orders as $order )
            
        <tr>
            <td>{{ $order->product_title }}</td>
            <td>{{ $order->quantity }}</td>
            <td>{{ $order->price }}</td>
            <td>{{ $order->payment_status }}</td>
            <td>{{ $order->delivery_status }}</td>
            <td><img src="/ProductImage/{{ $order->image }}"></td>
            @if($order->delivery_status == 'pending')
            <td>
                <a class="btn btn-danger" href="{{ route('cancel_order',$order->id) }}" onclick="return confirm('Are you sure to Cancel this Order')">Cancel Order</a>
            </td>
            @else
            <td>
                <p style="color:darkgreen">Not Action</p>
            </td>
            @endif
        </tr>
        
        @endforeach

      </table>

      
         </div>

         <div class="hero_area"></div>
      
      <div class="cpy_">
         <p class="mx-auto">© 2021 All Rights Reserved By <a href="https://html.design/">Free Html Templates</a><br>
         
            Distributed By <a href="https://themewagon.com/" target="_blank">ThemeWagon</a>
         
         </p>
      </div>
       <!-- jQery -->
       <script src="{{ asset('home/js/jquery-3.4.1.min.js')}}"></script>
       <!-- popper js -->
       <script src="{{ asset('home/js/popper.min.js')}}"></script>
       <!-- bootstrap js -->
       <script src="{{ asset('home/js/bootstrap.js')}}"></script>
       <!-- custom js -->
       <script src="{{ asset('home/js/custom.js')}}"></script>
   </body>
</html>