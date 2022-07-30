<!DOCTYPE html>
<html>
<head>
    <title></title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
</head>
    
<body>
<div class="container">
     
    <div class="panel panel-primary">
      <div class="panel-heading"><h2></h2></div>
      <div class="panel-body">
     
        @if ($message = Session::get('success'))
        

        <div class="alert alert-success alert-dismissible">
    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
    <strong>Success!</strong> {{ $message }}
  </div>
        <img src="{{ Session::get('image') }}"></a>
        @endif
    
        @if (count($errors) > 0)
            <div class="alert alert-danger">
                <strong>Whoops!</strong> There were some problems with your input.
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
    
        <form action="{{ route('image.upload.post') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="row">
    
                <div class="col-md-6">
                    <input type="file" name="image" class="form-control">
                </div>
     
                <div class="col-md-3">
                    <button type="submit" class="btn btn-success">Upload</button>
                </div>
                 <div class="col-md-3">
                    <!-- <button type="button" onclick="window.location='{{ URL::route('logout'); }}'" class="btn btn-danger">Logout</button> -->
                     <a class="btn btn-danger" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                </div>

                <table class="table">
                    
                    <!-- <th>Sr no</th> -->
                    <th>File</th>
                    <th>Action</th>
                    @foreach( $new_array as $data )
    <tr>
        <!-- <td>{{$data['id']}}</td> -->
        <td> <a href="{{$data['image']}}" download>
        <img src="{{$data['image']}}" height="100px" width="100px"></a></td>
        <td style="padding-top: 40px"><a href="{{$data['image']}}" download>Download</a></td>
    </tr> 
@endforeach 
                </table>
     
            </div>
        </form>

          <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
    
      </div>
    </div>
</div>
</body>
  
</html>