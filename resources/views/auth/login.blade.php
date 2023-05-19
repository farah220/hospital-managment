<!doctype html>
<html lang="en">

<head>
    <title>Login</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{asset('dashboard-assets/css/style.css')}}">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Abril+Fatface&family=Playfair+Display:ital@1&display=swap"
          rel="stylesheet">
</head>

<body>
<div >
    <div>
        <div class="navbar">

            <div class="dropdown">
                <button class="dropbtn">LOGIN AS
                    <i class="fa fa-caret-down"></i>
                </button>
                <div class="dropdown-content">
                    <a href="{{route('admins.login-form')}}">Admin</a>
                    <a href="{{route('doctors.login-form')}}">Doctor</a>
                    <a href="{{route('pharmacist.login-form')}}">Pharmasict</a>
                    <a href="{{route('laboratorist.login-form')}}">Laboratorian</a>
                </div>

            </div>
        </div>

        <div >
            <p class= "centertext ">CLOUD CARE DASHBOARD</p>
            </divclass>
        </div>
    </div>
</div>
</body>

</html>
