<!DOCTYPE html>
<html lang="en">
  <head>
    @include('admin.css')

    <style>
         .table_center{
            margin-left: 2px;
            margin-right: 2px;
            width:70%;
            border: 2px solid white;
            text-align: center;
            margin-top: 40px;
        }
        .title_center{
            text-align: center;
            font-size: 40px;
            padding-top: 20px;
        }
        .img_size{
            width: 100px;
            height: 100px;
            margin-bottom: 10px;
        }
        .the_deg{
            padding:20px;
        }
    </style>
  </head>
  <body>
    <div class="container-scroller">
      <!-- partial:partials/_sidebar.html -->
      @include('admin.sidebar')
      <!-- partial -->
        @include('admin.header')
        <!-- partial -->
        <div class="main-panel">
            <div class="content-wrapper">

              @if (session()->has('message'))
              <div class="alert alert-success">

                <button class="close" type="button" data-dismiss="alert" aria-hidden="true">x</button>

                {{ session()->get('message') }}

              </div>
              @endif
 
              <h2 class="title_center">All Orders</h2>

            <div style="padding-left:450px; padding-bottom:15px; padding-top:25px;">
              <form action="{{ route('search_on_data') }}" method="get">

                @csrf

                <input type="text" style="color: black" name="search" placeholder="Search for something">

                <input type="submit" value="Search" class="btn btn-outline-primary">

              </form>
            </div>
                <table class="table_center">
                    <tr style="background: skyblue;">
                        <th class="the_deg" style="padding: 25px">User name</th>
                        <th class="the_deg">User email</th>
                        <th class="the_deg" style="padding: 40px;">User phone</th>
                        <th class="the_deg" style="padding: 40px;">User address</th>    
                        <th class="the_deg">product_title</th>
                        <th class="the_deg" style="padding: 10px;">quantity</th>
                        <th class="the_deg" style="padding: 10px;">price</th>
                        <th class="the_deg" style="padding: 10px;">payment_status</th>
                        <th class="the_deg" style="padding: 10px;">delivery_status</th>
                        <th class="the_deg">image</th>
                        <th class="the_deg" >Delivered</th>
                        <th class="the_deg" >Print</th>
                    </tr>

                    @forelse ($orders as $order )
                    <tr>
                        <td>{{ $order->name}}</td>
                        <td>{{ $order->email }}</td>
                        <td>{{ $order->phone }}</td>
                        <td>{{ $order->address }}</td>
                        <td>{{ $order->product_title }}</td>
                        <td>{{ $order->quantity }}</td>
                        <td>{{ $order->price }}</td>
                        <td>{{ $order->payment_status }}</td>
                        <td>{{ $order->delivery_status }}</td>
                        <td>
                            <img src="/ProductImage/{{ $order->image }}" class="img_size">
                        </td>

                        @if ($order->delivery_status == 'pending')
                        <td><a onclick="return confirm('Are you sure that the order has delivered!!!!!')" class="btn btn-primary" href="{{ route('delivered',$order->id) }}" >delivered</a></td>
                        @else
                            <td style="color: green;">delivered</td>
                        @endif
                        <td><a class="btn btn-secondary" href="{{ route('print_pdf',$order->id) }}">print PDF</a></td>
                        
                    </tr>

                    @empty
                    <tr>
                      <td clospan="16">
                        No Data Found
                      </td>
                    </tr>
                    @endforelse

                </table>


      
    </div>
    <!-- container-scroller -->
    <!-- plugins:js -->
    @include('admin.script')
    <!-- End custom js for this page -->
  </body>
</html>