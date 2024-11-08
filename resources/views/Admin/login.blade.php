<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bot Rental Apps</title>
    <link rel="shortcut icon" href="{{ asset('/public/') }}/logo2.png" />
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Outfit:ital,wght@0,100;0,300;0,400;0,700;0,900;1,100;1,300;1,400;1,700;1,900&display=swap"
        rel="stylesheet">

    <style>
        body {
            font-family: 'Questrial', sans-serif;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
            background-color: #f8f9fa;
        }

        .container {
            display: flex;
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
            overflow: hidden;
            width: 80%;
            max-width: 900px;
            background-color: white;
        }

        .left-section,
        .right-section {
            flex: 1;
            padding: 40px;
        }

        .left-section {
            background-color: #1F2CFB;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            position: relative;
        }

        .logo {
            max-width: 150px;
            margin-bottom: 20px;
        }

        .phone-image img {
            max-width: 100%;
            height: auto;
        }

        .right-section {
            display: flex;
            flex-direction: column;
            justify-content: center;
        }

        h2 {
            margin-bottom: 20px;
        }

        .input-group {
            margin-bottom: 20px;
        }

        label {
            display: block;
            margin-bottom: 5px;
            color: #555;
        }

        input {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
        }

        button {
            width: 100%;
            padding: 10px;
            background-color: #007bff;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 16px;
        }

        button:hover {
            background-color: #0056b3;
        }

        .text-danger {
            color: #d63031;
        }

        @media (max-width: 768px) {
            .container {
                flex-direction: column;
                width: 90%;
            }

            .left-section,
            .right-section {
                padding: 20px;
            }

            .logo {
                max-width: 100px;
            }

            .phone-image img {
                display: none;
            }
        }

        @media (max-width: 480px) {
            .container {
                width: 100%;
            }

            .left-section,
            .right-section {
                padding: 15px;
            }

            h2 {
                font-size: 1.5em;
            }

            input,
            button {
                font-size: 14px;
            }


        }
    </style>



    <style>
        h1,
        h2,
        h3,
        h4,
        h5,
        h6,
        div,
        span,
        p,
        html,
        body,
        table,
        tr,
        td,
        th,
        ul,
        li,
        ol,
        input,
        button,
        label {
            font-family: 'Questrial', sans-serif;

        }
    </style>



    <style>
        h1,
        h2,
        h3,
        h4,
        h5,
        h6,
        div,
        span,
        p,
        html,
        body,
        table,
        tr,
        td,
        th,
        ul,
        li,
        ol,
        input,
        button,
        label {
            font-family: 'Outfit', sans-serif;

        }
    </style>



</head>

<body>

    <div class="container">
        <div class="left-section">
            <div class="phone-image">
                <img src="{{ asset('public/logo.png') }}" alt="Phone" height="200" width="200">
            </div>
        </div>
        <div class="right-section">
            <h2>Bot Rental - Management</h2>

            @if (session()->has('success'))
            <div class="alert alert-success">
                {{ session()->get('success') }}
            </div>
            @endif


            @error('error')
            <div class="alert alert-danger">
                <strong class="text-danger">{{ $message }}</strong>
            </div>
            @enderror


            <form method="POST" action="{{ route('form.post.login') }}">
                @csrf

                <div class="input-group">
                    <label for="email">Email</label>
                    <input type="text" id="email" name="email" value="{{ old('email') }}"
                        placeholder="Enter your email">
                    @if ($errors->has('email'))
                    <span class="text-danger">{{ $errors->first('email') }}</span>
                    @endif
                </div>
                <div class="input-group">
                    <label for="password">Password</label>
                    <input type="password" id="password" name="password" value="{{ old('password') }}"
                        placeholder="Enter your password">
                    @if ($errors->has('password'))
                    <span class="text-danger">{{ $errors->first('password') }}</span>
                    @endif
                </div>
                <button type="submit">Sign In</button>
            </form>
        </div>
    </div>
</body>



</html>
