<!DOCTYPE html>
<html lang="en">
  <head>

    <base href="/public">
    <base href="/public/ProductImage"

    @include('admin.css')

<style>
  .div_center{
    text-align: center;
    padding-top: 40px;
  }
  .font_size{
    font-size: 40px;
    padding-bottom: 40px;
  }
  .text_color{
    color: black;
    padding-bottom: 20px;
  }
  label{
    display: inline-block;
    width: 200px;
  }

  .div_design{
    padding-bottom: 15px;
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

                <div class="div_center">

                  <h1 class="font_size">Update Product</h1>

                  <form action="{{ route('update_product',[$data->id,$data->image]) }}" method="post" enctype="multipart/form-data">
                    @csrf
                  <div class="div_design">
                  <label>Product Title :</label>
                  <input type="text" class="text_color" name="title" placeholder="Write a title" required value="{{ $data->title }}">
                  </div>

                  <div class="div_design">
                    <label>Product Description :</label>
                    <input type="text" class="text_color" name="description" placeholder="Write a description" required value="{{ $data->description }}">
                    </div>

                        <div class="div_design">
                          <label>Product Quantity :</label>
                          <input type="text" class="text_color" name="quantity" placeholder="Write a quantity" required value="{{ $data->quantity }}">
                          </div>

                          <div class="div_design">
                            <label>Product Price :</label>
                            <input type="number" class="text_color" name="price" placeholder="Write a price" required value="{{ $data->price }}">
                            </div>

                          <div class="div_design">
                            <label>Product Discount_price :</label>
                            <input type="number" class="text_color" name="discount_price" placeholder="Write a discount_price" value="{{ $data->discount_price }}">
                            </div>

                          <div class="div_design">
                            <label>Product Category :</label>
                            <select class="text_color" name="category" required>
                                      <option value="{{$data->category}}" selected="">{{ $data->category }} </option>
                                      @foreach ($category as $category )
                                      <option value="{{ $category->category_name }}">{{ $category->category_name }}</option>
                                      @endforeach
                            </select>
                            </div>

                            <div class="div_design">
                                <label>Product Image :</label>
                                <img width="100" height="100" style="margin: auto;" src="/ProductImage/{{ $data->image }}">
                                </div>

                              <div class="div_design">
                                <label>Product Image :</label>
                                <input type="file" name="image" class="text_color" >
                                </div>

                                <div class="div_design">
                                  <input type="submit" value="Update product" class="btn btn-primary">
                                  </div>
                                </form>

                </div>



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