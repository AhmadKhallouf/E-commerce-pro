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
   </head>
   <body>
         <!-- header section strats -->
         @include('home.header')
         <!-- end header section -->
     
      <div class="col-sm-6 col-md-4 col-lg-4" style="margin: auto; padding:30px; width:50%">
        <div class="box">
           <div class="img-box">
              <img src="/ProductImage/{{ $product->image }}" alt="">
           </div>
           <div class="detail-box">
              <h6 style="font-size:40px">
                 {{ $product->title }}
              </h6>
              @if ($product->discount_price != null)
                 <h4 style="color: blue">
                 Product discount price :  {{ $product->discount_price }}$
                 </h4>
                 <h4 style="text-decoration: line-through; color:red">
                 Product price : {{ $product->price }}$
                </h4>
              @else
              <h4 style="color: blue">
                Product price :  {{ $product->price }}$
              </h4>
              @endif
              <h4>
                Prouduct category : {{ $product->category }}
              </h4>
              <h4>
                Product details : {{ $product->description }}
              </h4>
              <h4>
                Product Quantity : {{ $product->quantity }}
              </h4>
              <form action="{{ route('add_to_cart',$product->id) }}" method="POST">
               @csrf

               <div class="row">
                  <div class="col-md-4">
                     <input type="number" name="quantity" value="1" min="1" style="width:100px">
                  </div>
                  <div class="col-md-4">
                     <input type="submit" value="Add to Cart">
                  </div>
               </div>
   
             </form>

           </div>
           
        </div>
        
     </div>







      <!-- footer start -->
      @include('home.footer')
      <!-- footer end -->
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