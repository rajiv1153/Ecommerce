<!DOCTYPE html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    @include('admin.meta')
    <style type="text/css">
    .div_center{
        text-align:center;
        padding-top:40px;

    }
    .font_size{
        font-size:40px;
        padding-bottom:40px;        
         
    }
    .txt_color{
        color:black;
        padding-bottom:20px;

    }
    label{
        display:inline-block;
        width:200px;

    }
    .div_design{
        padding-bottom:15px;

    }

    </style>
  </head>
  <body>
    <div class="container-scroller">
      <!-- partial:partials/_sidebar.html -->
        @include('admin.sidebar')
      <!-- partial -->
      <div class="container-fluid page-body-wrapper">
        <!-- partial:partials/_navbar.html -->
        @include('admin.header')

        <!-- partial -->
        <div class="main-panel">
            <div class="content-wrapper">
            @if(session()->has('message'))
            <div class="alert alert-success">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">x</button>
            {{ session('message') }}
            </div>
            @endif 
            <div class="div_center">
            <h1 class="font_size">Add Product</h1>
            <form action="{{url('/add_product')}}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="div_design">
            <label for="">Prodcut Title:</label>
            <input required type="text" class="txt_color" name="title" placeholder="Write a title">
            </div>

            <div class="div_design">
            <label for="">Prodcut description:</label>
            <input required type="text" class="txt_color" name="description" placeholder="Write a description">
            </div>

            <div class="div_design">
            <label for="">Product Price:</label>
            <input type="number" class="txt_color" name="price" placeholder="price">
            </div>

            <div class="div_design">
            <label for="">Discount Price:</label>
            <input type="number" class="txt_color" name="discount_price" placeholder="Write a discount price">
            </div>

            <div class="div_design">
            <label for="">Product Quantity:</label>
            <input  required type="number" min="0" class="txt_color" name="quantity" placeholder="Write a title">
            </div>

            

            <div class="div_design">
            <label for="">Prodcut Category:</label>
            <select name="category" class="txt_color" required>
            <option value="" selected>Add a category Here</option>
            @foreach($category as $category)
            <option value="{{$category->name}}">{{$category->name}}</option>
             @endforeach   

            </select>
            </div>

            <div class="div_design">
            <label for="">Prodcut Image:</label>
            <input required type="file" class="txt_color" name="image" >
            </div>

            <div class="div_design">
            <input type="submit" value="Add Product" class="btn btn-primary">
            </div>
          
            </form>

     
            </div>
                
              
            </div>
        </div>

        <!-- main-panel ends -->
      </div>
      <!-- page-body-wrapper ends -->
    </div>
    <!-- container-scroller -->
    @include('admin.scripts')

    <!-- End custom js for this page -->
  </body>
</html>