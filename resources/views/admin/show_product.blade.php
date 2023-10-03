<!DOCTYPE html>
<html lang="en">
  <head>
    @include('admin.css')
    <style>
        .table_center{
            margin: auto;
            width: 50%;
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
            width: 250px;
            height: 250px;
        }
        .the_deg{
            padding: 30px;
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

                <h2 class="title_center">Your Product</h2>
                <table class="table_center">
                    <tr style="background: skyblue;">
                        <th class="the_deg">Product title</th>
                        <th class="the_deg">description</th>
                        <th class="the_deg">price</th>
                        <th class="the_deg">quantity</th>
                        <th class="the_deg">category</th>
                        <th class="the_deg">discount_price</th>
                        <th class="the_deg">Product_Image</th>
                        <th class="the_deg">Delete Product</th>
                        <th class="the_deg">Update Product</th>
                    </tr>

                    @foreach ($product as $product )
                    <tr>
                        <td>{{ $product->title}}</td>
                        <td>{{ $product->description }}</td>
                        <td>{{ $product->price }}</td>
                        <td>{{ $product->quantity }}</td>
                        <td>{{ $product->category }}</td>
                        <td>{{ $product->discount_price }}</td>
                        <td>
                            <img src="/ProductImage/{{ $product->image }}" class="img_size">
                        </td>

                        <td><a class="btn btn-danger" href="{{ route('delete_product',[$product->id,$product->image]) }}">Delete</a></td>
                        <td><a class="btn btn-success" href="{{ route('show_to_update',$product->id) }}">Update</a></td>
                        
                    </tr>
                    @endforeach

                </table>



            </div>
        </div>
      <!-- page-body-wrapper ends -->
    </div>
    <!-- container-scroller -->
    <!-- plugins:js -->
    @include('admin.script')
    <!-- End custom js for this page -->
  </body>
</html>