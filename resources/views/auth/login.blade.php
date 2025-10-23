<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BBPP BINUANG</title>
    <!-- Google Fonts: Poppins -->
    <link href="{{url('')}}/favicon32.png" rel="icon">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background-image: url('https://bbppbinuang.my.id/asset/gambar/home_binuang.jpg');
            margin: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            margin-top: 50px;
        }

        .login-container {
            width: 100%;
            max-width: 1000px;
            border-radius: 10px;

        }

        .login-left {
            text-align: center;
            padding: 30px;
            border-radius: 10px;
            background-color: rgba(255, 255, 255, 0.7);
            padding: 30px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
        }

        .login-left img {
            width: 150px;
        }

        .login-left h1 {
            color: #f48023;
            font-size: 2.5rem;
            font-weight: bold;
        }

        .login-left h3 {
            color: #134B70;
        }

        .login-left p {
            color: gray;
        }

        .login-right {
            background-color: rgba(0, 128, 0, 0.7);
            padding: 30px;
            border-radius: 10px;
            color: white;
        }


        .login-right h2 {
            font-size: 2rem;
            margin-bottom: 20px;
        }

        .form-control {
            margin-bottom: 15px;
            padding: 10px;
            border-radius: 5px;
            border: 1px solid #ddd;
        }

        .btn-orange {
            background-color: #f48023;
            border: none;
            color: white;
            width: 40%;
            padding: 8px;
            border-radius: 40px;
            font-size: 1rem;
            margin-top: 10px;
        }

        .btn-orange:hover {
            background-color: #e0671d;
        }

        .forgot-password {
            color: #f4d35e;
            font-size: 0.9rem;
            text-align: right;
        }

        .forgot-password:hover {
            text-decoration: underline;
            color: #e2c83a;
        }
    </style>
</head>

<body>
    <div class="container login-container m-3 shadow-lg">
        <div class="row">
            <div class="col-md-6 login-left pt-5">
                <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/5/54/Logo_of_Ministry_of_Agriculture_of_the_Republic_of_Indonesia.svg/2072px-Logo_of_Ministry_of_Agriculture_of_the_Republic_of_Indonesia.svg.png" alt="Logo" class="p-2">
                <h1 class="mt-2">Selamat Datang</h1>
                <h2 class="mt-2">BBPP BINUANG</h2>
            </div>
            <div class="col-md-6 login-right">
                <h2 class="text-center pb-4 pt-4">Masuk</h2>
                <form method="POST" action="{{url('postlogin') }}">
                    @csrf
                    <div class="mb-3">
                        <label for="inputname">Email</label>
                        <input class="form-control @error('email') is-invalid @enderror" id="inputname" type="text" placeholder="Masukkan Email" name="email" value="{{ old('email') }}" required autocomplete="name">
                        @error('email')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div>
                        <label for="inputPassword">Password</label>
                        <input class="form-control @error('password') is-invalid @enderror" id="inputPassword" type="password" placeholder="Masukkan password Anda" name="password" required autocomplete="current-password">
                        @error('password')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <a href="#" class="forgot-password" style="text-decoration:none">Lupa Password?</a>
                    </div>
                    <div class="d-flex align-items-center justify-content-center mt-4 mb-0">
                        <button type="submit" class="btn btn-orange mt-3 mb-3">Masuk</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>