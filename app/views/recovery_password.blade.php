<!DOCTYPE html>
<html class="bg-black">
    <head>
        <meta charset="UTF-8">
        <title>Admin BBAds</title>
        <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
        <link rel="shortcut icon" href="../assets/img/icon/advertising.png">
        <!-- bootstrap 3.0.2 -->
        <link href="../assets/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
        <!-- font Awesome -->
        <link href="../assets/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
        <!-- Theme style -->
        <link href="../assets/css/AdminLTE.css" rel="stylesheet" type="text/css" />

        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
          <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
          <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
        <![endif]-->
    </head>
    <body class="bg-black">

        <div class="form-box" id="login-box">
            <div class="header">Enter your Email</div>
            {{Form::open()}}
            <!-- <form action="#" method="post" > -->
                <div class="body btn-default">
                    <div class="form-group">
                        {{$errors->first('email')}}
                    </div>
                    <div class="form-group">
                        <!-- <input type="text" name="userid" class="form-control" placeholder="User ID"/> -->
                        {{Form::text('email',Input::old('email'),['class'=>'form-control','placeholder'=>'E-mail'])}}
                    </div>
                </div>
                <div class="footer">
                    {{Form::submit('Recover Password',['class'=>'btn bg-green btn-block'])}}
                    <a href="register" class="text-center">Register a new membership</a>
                </div>
            <!-- </form> -->
            {{Form::close()}}
            <div class="margin text-center">
                <span>Sign in using social networks</span>
                <br/>
                <button class="btn bg-green btn-circle"><i class="fa fa-facebook"></i></button>
                <button class="btn bg-green btn-circle"><i class="fa fa-twitter"></i></button>
                <button class="btn bg-green btn-circle"><i class="fa fa-google-plus"></i></button>

            </div>
        </div>


        <!-- jQuery 2.0.2
        <script src="http://ajax.googleapis.com/ajax/libs/jquery/2.0.2/jquery.min.js"></script> -->
        <!-- Bootstrap -->
        <script src="../assets/js/bootstrap.min.js" type="text/javascript"></script>

    </body>
</html>