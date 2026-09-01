<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register - LokalFreelancer</title>
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

        .register-container {
            width: 480px;
            margin: 0 auto;
            padding: 20px;
        }

        .register-box {
            background-color: white;
            padding: 35px 25px 20px;
            border: 1px solid #eee;
            text-align: center;
        }
        .logo {
            font-size: 16px;
            font-weight: bold;
            margin-bottom: 25px;
        }

        .register-box h2 {
            font-size: 16px;
            margin-bottom: 10px;
        }

        .register-box p {
            font-size: 13px;
            margin-bottom: 25px;
        }

        .input-group {
            margin-bottom: 13px;
        }

        .input-group input {
            width: 100%;
            height: 37px;
            padding: 10px 20px;
            border: 1px solid #aaa;
            outline: none;
        }

        .role-title {
            margin-top: 8px;
            margin-bottom: 18px;
            font-size: 13px;
            font-weight: bold;
        }

        .role {
            display: flex;
            justify-content: center;
            gap: 50px;
            margin-bottom: 20px;
        }

        .role label {
            display: flex;
            align-items: center;
            gap: 8px;
            font-size: 13px;
            font-weight: bold;
        }

        .role input {
            width: 15px;
            height: 15px;
        }

        .register-button {
            width: 80%;
            height: 39px;
            background-color: white;
            border: 1px solid #999;
            font-weight: bold;
            cursor: pointer;
        }

        .login-link {
            margin-top: 18px;
            font-size: 11px;
        }

        .login-link a {
            color: #333;
            font-weight: bold;
            text-decoration: none;
        }
    </style>
</head>

<body>
    <div class="page-title">
        Register
    </div>

    <!-- REGISTER -->
    <div class="register-container">
        <div class="register-box">
            <div class="logo">
                [logo]
            </div>

            <h2>
                CREATE YOUR ACCOUNT
            </h2>
            <p>
                Join our platform today
            </p>

            <div class="input-group">
                <input
                    type="text"
                    placeholder="Full name"
                >
            </div>

            <div class="input-group">
                <input
                    type="email"
                    placeholder="email"
                >
            </div>

            <div class="input-group">
                <input
                    type="password"
                    placeholder="Password"
                >
            </div>

            <!-- CONFIRM PASSWORD -->
            <div class="input-group">
                <input
                    type="password"
                    placeholder="confirm password"
                >
            </div>

            <!-- PILIH ROLE -->
            <div class="role-title">
                I am a
            </div>

            <div class="role">
                <label>
                    <input
                        type="radio"
                        name="role"
                    >
                    Freelancer
                </label>

                <label>
                    <input
                        type="radio"
                        name="role"
                    >
                    Client
                </label>
            </div>

            <!-- BUTTON REGISTER -->
            <button class="register-button">
                Register
            </button>

            <!-- LOGIN -->
            <div class="login-link">
                Already have an account?
                <a href="#">
                    Login
                </a>
            </div>
        </div>
    </div>
</body>
</html>