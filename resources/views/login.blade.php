<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - LokalFreelancer</title>

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: Arial, sans-serif;
            background-color: #fafafa;
            color: #333;
        }
        .page-title {
            padding: 35px 45px;
            font-size: 18px;
            color: #999;
        }

        /* ===== KOTAK LOGIN ===== */
        .login-container {
            width: 480px;
            margin: 0 auto;
            padding: 20px;
        }

        .login-box {
            border: 1px solid #bbb;
            background-color: white;
            padding: 35px 20px;
            text-align: center;
        }
        .logo {
            font-size: 16px;
            margin-bottom: 10px;
        }

        /* ===== JUDUL ===== */
        .login-box h2 {
            font-size: 16px;
            font-weight: normal;
            margin-bottom: 5px;
        }

        .login-box p {
            font-size: 13px;
            margin-bottom: 28px;
        }

        /* ===== INPUT ===== */
        .input-group {
            margin-bottom: 17px;
        }

        .input-group input {
            width: 100%;
            height: 40px;
            padding: 10px 20px;
            border: 1px solid #aaa;
            font-size: 14px;
            outline: none;
        }

        /* ===== CHECKBOX ===== */
        .remember {
            text-align: left;
            margin-bottom: 20px;
        }

        .remember input {
            width: 15px;
            height: 15px;
        }

        /* ===== BUTTON LOGIN ===== */
        .login-button {
            width: 100%;
            height: 35px;
            background-color: white;
            border: 1px solid #aaa;
            font-weight: bold;
            cursor: pointer;
        }

        /* ===== FORGOT PASSWORD ===== */
        .forgot {
            margin-top: 25px;
            font-size: 10px;
        }

        .forgot a {
            color: #333;
            text-decoration: none;
        }

        /* ===== REGISTER ===== */
        .register {
            margin-top: 15px;
            font-size: 10px;
        }

        .register a {
            color: #333;
            font-weight: bold;
            text-decoration: none;
        }
    </style>
</head>

<body>
    <div class="page-title">
        Login
    </div>

    <!-- LOGIN -->
    <div class="login-container">
        <div class="login-box">
            <div class="logo">
                [logo]
            </div>
            <h2>
                Welcome Back!
            </h2>
            <p>
                Login to your account
            </p>

            <!-- USERNAME -->
            <div class="input-group">
                <input
                    type="text"
                    placeholder="username"
                >
            </div>

            <!-- PASSWORD -->
            <div class="input-group">
                <input
                    type="password"
                    placeholder="password"
                >
            </div>

            <!-- REMEMBER -->
            <div class="remember">
                <input type="checkbox">
            </div>

            <button class="login-button">
                Login
            </button>

            <!-- FORGOT PASSWORD -->
            <div class="forgot">
                <a href="#">
                    Forgot password?
                </a>
            </div>

            <!-- REGISTER -->
            <div class="register">
                Don't have an account?
                <a href="#">
                    Register
                </a>
            </div>
        </div>
    </div>
</body>
</html>