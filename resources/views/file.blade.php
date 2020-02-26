<html>
    <head>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
        <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
    </head>
    <body>
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    @if(isset($message) && $message === "success!")
                    <div class="alert alert-success">
                        <strong>Upload Thành Công</strong>
                      </div>
                    @else
                    <div class="alert alert-warning">
                        <strong>Upload Thất bại!</strong> 
                      </div>
                    @endif
                <form action="{{route('post.file')}}" enctype="multipart/form-data" method="post">
                    @csrf
                        <div class="form-group">
                            <label for="email">File:</label>
                            <input type="file" name="fileFacebook" class="form-control" id="email">
                          </div>
                          <button type="submit" class="btn btn-default btn-primary">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </body>
</html>