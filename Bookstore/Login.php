<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <style>
        body {
            margin: 0;
            font-family: Arial, sans-serif;
           background: linear-gradient(rgba(0,0,0,0.5), rgba(0,0,0,0.5)),
      url('bookss.jpg') center/cover no-repeat;
            color: #111827;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .login-card {
            width: min(380px, 90vw);
              background: rgba(255, 255, 255, 0.49);
                border-radius: 16px;
                box-shadow: 0 4px 30px rgba(0, 0, 0, 0.1);
                backdrop-filter: blur(7px);
                -webkit-backdrop-filter: blur(7px);
                border: 1px solid rgba(255, 255, 255, 0.3);
            border-radius: 24px;
            box-shadow: 0 24px 60px rgba(15, 23, 42, 0.18);
            padding: 32px;
            text-align: center;
        }
        .login-card h1 {
            margin: 0 0 16px;
            font-size: 1.8rem;
            color: white;
             filter: drop-shadow(5px 5px 10px rgba(0, 0, 0, 0.5));
        }
        .login-card p {
            margin: 0 0 24px;
            color: white;
             filter: drop-shadow(5px 5px 10px rgba(0, 0, 0, 0.5));
        }
        .form-group {
            margin-bottom: 18px;
            text-align: left;
        }
        .form-group label {
            display: block;
            margin-bottom: 6px;
            font-size: 0.95rem;
            color:white;
             filter: drop-shadow(5px 5px 10px rgba(0, 0, 0, 0.5));
        }
        .form-group input {
            width: 92%;
            padding: 12px 14px;
            border: 1px solid #d1d5db;
            border-radius: 12px;
            font-size: 1rem;
            outline: none;
            transition: border-color 0.2s ease;
        }
        .form-group input:focus {
            border-color: #0ea5e9;
            box-shadow: 0 0 0 4px rgba(14, 165, 233, 0.12);
        }
        .show-password{
            margin-top: 10px;
            display: flex;
            align-items: center;
            gap: 8px;
            color: white;
            font-size: 14px;
        }

        .show-password input{
            width: auto;
        }
        .login-button {
            width: 100%;
            padding: 14px 16px;
            border: none;
            border-radius: 12px;
            background:#0f172a;
            color: #ffffff;
             filter: drop-shadow(5px 5px 10px rgba(0, 0, 0, 0.5));
            font-size: 1rem;
            cursor: pointer;
            transition: background 0.2s ease;
        }
        .login-button:hover {
            transform: translateY(-2px);
            box-shadow: 0 2px 4px rgba(0, 0, 0, 1);
            background:#0a1626;
             transition: all 0.3s ease;
        }
    </style>
</head>
<body>
    <div class="login-card">
        <h1>Welcome!</h1>
        <p>Sign in to access your inventory.</p>

        <form action="log.php" method="post">
            <div class="form-group">
                <label for="username">Username</label>
                <input type="text" id="username" name="username" placeholder="you123">
            </div>
            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" id="password" name="password" placeholder="Enter your password" required>
                <div class="show-password">
                    <input type="checkbox" onclick="myclasa_nalang_ulit()">
                    <span>Show Password</span>
                </div>
            </div>
            <button type="submit" name="submit" class="login-button">Login</button>
        </form>
    </div>
</body>
    <script>
        function myclasa_nalang_ulit() {
            var x = document.getElementById("password");
            if (x.type === "password") {
                x.type = "text";
            } else {
                x.type = "password";
            }
        }
    </script>
</html>