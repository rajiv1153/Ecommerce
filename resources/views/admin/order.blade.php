<!DOCTYPE html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    @include('admin.meta')
    <style type="text/css">
    .center{
        margin:auto;
        width:100%;
        border:2px solid white;
        text-align:center;
        margin-top:40px;
    }
    th{
        background:skyblue;
        padding:5px;
    }
    .image_size{
        width:50px;
        height:50px;
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

            <div style="padding-left:400px;padding-bottom:30px;">
              <form action="{{url('/search_order')}}" method="POST">
              @csrf
              <input type="text" name="search" placeholder="search for something">
              <input type="submit" value="search" class="btn btn-primary">
              </form>
            </div>

                    @if(session()->has('message'))
                    <div class="alert alert-success">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">x</button>
                    {{ session('message') }}
                    </div>
                    @endif 

                    <table class="center">
                    <tr>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Phone</th>
                        <th>Address</th>
                        <th>Product Title</th>
                        <th>Quantity</th>
                        <th>Price</th>
                        <th>Payment Status</th>
                        <th>Delivery Status</th>
                        <th>Image</th>
                        <th>Delivered</th>
                        <th>Print</th>
                        <th>Send Email</th>
                    </tr>
                    @forelse($order as $order)
                    <tr>
                    <td>{{$order->name}}</td>
                    <td>{{$order->email}}</td>
                    <td>{{$order->phone}}</td>
                    <td>{{$order->address}}</td>
                    <td>{{$order->product_title}}</td>
                    <td>{{$order->quantity}}</td>
                    <td>{{$order->price}}</td>
                    <td>{{$order->payment_status}}</td>
                    <td>{{$order->delivery_status}}</td>
                    <td><img src="product/{{$order->image}}" class="image_size"></td>
                    <td>
                    @if($order->delivery_status=='processing')
                    
                    <a href="{{url('delivered',$order->id)}}" class="btn btn-primary">Delivered</a></td>
                    @else
                    <p style="color:green;">Delivered</p></td>
                    @endif

                   
                    <td><a href="{{url('print_pdf',$order->id)}}" class="btn btn-secondary">Download PDF</a></td>
                    <td><a href="{{url('send_email',$order->id)}}" class="btn btn-info">Send Email</a></td>

                   
                    </tr>
                    @empty
                    <tr>
                      <td colspan="16">
                      No Data Found
                      </td>
                    </tr>
                   

                    @endforelse
                    </table>
          
              
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