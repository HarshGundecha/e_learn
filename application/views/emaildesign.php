<!DOCTYPE html>
<html lang="en">
    <head>
      <title>Bootstrap Example</title>
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css">
      <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
      <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    </head>
    <body>
        <div class="container">
            <div class="row">
                <div class="col-md-12 col-xs-12 col-sm-12 col-lg-12">
                    <div class="card">
                        <div class="row">
                            <div class="col-md-8 col-md-offset-4" style="box-shadow:0 0 10px rgba(0,0,0,.2);background-color:#e9e9e9;padding:10px;">
                                <div class="heading" style="padding:10px;border-bottom:1px solid #9e9e9e;">
                                    <h3>e_learn</h3>
                                </div>
                                <div class="card" style="background-color:whitesmoke;box-shadow:0 0 10px rgba(0,0,0,.2);padding:10px;">
                                    <br>Your One Time Password(OTP) Is As Below
                                    <br>It Is Case-Sensitive
                                    <center><button style="background-color:#02cbf7;border:none;padding:10px;border-radius:10px;"><?=$otp?></button></center>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>