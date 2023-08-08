<!DOCTYPE html>
<html lang="en">
  <head>
  <base href="/public">
    <!-- Required meta tags -->
    @include('admin.meta')
    <style>
        label{
            display:inline-block;
            width:200px;
            font-size:15px;
            font-weight:bold;             
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

        <h1 style="text-align:center;font-size:25px;">Send Email to {{$order->email}}</h1>
        <form action="{{url('/send_user_email',$order->id)}}" method="POST">
            @csrf
            <div style="padding-left:35px;paddin-top:30px;">
                <label for="">Email greetings</label>
                <input type="text" name="greeting">
            </div>

            <div style="padding-left:35px;paddin-top:30px;">
                <label for="">Email header</label>
                <input type="text" name="firstline">
            </div>

            <div style="padding-left:35px;paddin-top:30px;">
                <label for="">Email Body</label>
                <input type="text" name="body">
            </div>

            <div style="padding-left:35px;paddin-top:30px;">
                <label for="">Email button</label>
                <input type="text" name="button">
            </div>

            <div style="padding-left:35px;paddin-top:30px;">
                <label for="">Email url</label>
                <input type="text" name="url">
            </div>

            <div style="padding-left:35px;paddin-top:30px;">
                <label for="">Email last line</label>
                <input type="text" name="lastline">
            </div>

            <div style="padding-left:35px;paddin-top:30px;">
                <input type="submit" value="send Email" class="btn btn-primary">
            </div>
        </form>    
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