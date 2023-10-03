<section class="product_section layout_padding">
    <div class="container">
       <div style="width: 25%; margin:auto;" >

          <form action="{{ route('search_product') }}" method="POST">
            @csrf
            <input type="text"  name="search" placeholder="Search about something here "    style="margin: auto; padding-top:50px; padding-bottom:30px; height:10px;"> 
            <br>
            <br>
            <input type="submit" class="btn btn-secondary" value="Search" style="margin: auto; padding-top:20px; padding-bottom:20px; ">
          </form>
       </div>
          
       <div class="row">
         @if($data != null)
          @foreach ( $data as $product )
          <div class="col-sm-6 col-md-4 col-lg-4">
             <div class="box">
                <div class="option_container">
                   <div class="options">
                      <a href="{{ route('product_details',$product->id) }}" class="option1">
                      Product Details
                      </a>
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
                <div class="img-box">
                   <img src="ProductImage/{{ $product->image }}" alt="">
                </div>
                <div class="detail-box">
                   <h5>
                      {{ $product->title }}
                   </h5>
                   @if ($product->discount_price != null)
                      <h6>
                        {{ $product->discount_price }}$
                      </h6>
                      <h6 style="text-decoration: line-through;">
                        {{ $product->price }}$
                     </h6>
                   @else
                   <h6>
                      {{ $product->price }}$
                   </h6>
                   @endif
                </div>
                
             </div>
             
          </div>
          @endforeach
          @else

          <h4>No Data Found</h4>

          @endif
          
         </div>
    </div>
</section>