<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Register - Interview App</title>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
</head>
<body>
    <div class="container"><br>
        <div class="col-md-4 col-md-offset-4">
            <h2 class="text-center">App</h3>
            <hr>
            <form>
            @csrf
                <input id="_token" type="hidden" name="_token" value="FYSVH7mg0J5Z8BZZLMd4fQr7ghnIKNKOGChW2EmU">
                <div class="form-group">
                    <label>Name</label>
                    <input id="name" type="text" name="name" class="form-control @error('name') is-invalid @enderror" placeholder="Name" required="">
                    @error('name')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="form-group">
                    <label>Email</label>
                    <input id="email" type="email" name="email" class="form-control  @error('email') is-invalid @enderror" placeholder="Email" required>
                    @error('email')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="form-group">
                    <label>Password</label>
                    <input id="password" type="password" name="password" class="form-control  @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">
                </div>
                <button type="button" class="btn btn-primary btn-block">Register</button>
                {{-- <hr> --}}
                {{-- <p class="text-center">Belum punya akun? <a href="#">Register</a> sekarang!</p> --}}
            </form>
        </div>
    </div>
    <script>
        $(document).ready(function(){
            $("#submit").click(function(){
                let dataForm = {
                    _token: $("#_token").val(),
                    email: $("#email").val(),
                    password: $("#password").val()
                }
                console.log(dataForm);
                $.ajax({
                    url: 'api/register',
                    headers: {
                        'Accept': 'application/json',
                    },
                    method: 'POST',
                    dataType: 'json',
                    data: dataForm,
                    success: function(data){
                        console.log('succes: '+data);
                    }
                });
            })
        })
    </script>
</body>
</html>