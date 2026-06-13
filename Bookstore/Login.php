<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <style>
         :root{
    --primary: #8B5E3C;
    --secondary: #D2B48C;

    --background: #F8F5F0;
    --card: #FFFFFF;
    --text: #3E2C23;

    --hover: #A47149;
    --border: #E5DDD3;
}
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
              background: var(--card);
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
            color: var(--text);
           
        }
        .login-card p {
            margin: 0 0 24px;
            color: var(--text);
           
        }
        .form-group {
            margin-bottom: 18px;
            text-align: left;
        }
        .form-group label {
            display: block;
            margin-bottom: 6px;
            font-size: 0.95rem;
            color: var(--text);
          
        }
        .form-group input {
            width: 92%;
            padding: 12px 14px;
            border: 1px solid  var(--secondary);
            border-radius: 12px;
            font-size: 1rem;
            outline: none;
            transition: border-color 0.2s ease;
        }
        .form-group input:focus {
            border-color: var(--secondary);
            box-shadow: 0 0 0 4px  #d2b48c3e;
        }
        .show-password{
            margin-top: 10px;
            display: flex;
            align-items: center;
            gap: 8px;
            color: var(--text);
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
            background: var(--primary);
            color: #ffffff;
             filter: drop-shadow(5px 5px 10px rgba(0, 0, 0, 0.5));
            font-size: 1rem;
            cursor: pointer;
            transition: background 0.2s ease;
        }
        .login-button:hover {
            transform: translateY(-2px);
            background: var(--hover);
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
                <input type="text" id="username" name="username" placeholder="Enter your username">
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