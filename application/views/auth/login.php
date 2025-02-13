<!-- application/views/auth/login.php -->
<!DOCTYPE html>
<html>
<head>
    <title>Sahyadri Farm Machinery - Login</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            margin: 0;
            padding: 0;
            font-family: 'Arial', sans-serif;
            background: linear-gradient(135deg,rgb(56, 151, 247) 0%,rgb(166, 49, 202) 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        
        .login-container {
            width: 90%;
            max-width: 400px;
            background: white;
            border-radius: 20px;
            box-shadow: 0 10px 25px rgba(0,0,0,0.1);
            padding: 40px;
            margin: 20px;
            animation: fadeInUp 0.8s ease-out;
            transition: width 0.6s ease, height 0.6s ease;        }
        
        .logo-container {
            text-align: center;
            margin-bottom: 30px;
            animation: fadeIn 1s ease-out;
        }
        
        .logo-container img {
            max-width: 80%;
            height: auto;
            margin-bottom: 20px;
            animation: pulse 2s infinite;
        }

        .welcome-text {
            text-align: center;
            margin-bottom: 30px;
            animation: fadeIn 1s ease-out 0.5s both;
        }

        .welcome-text h2 {
            color: #333;
            font-size: 24px;
            margin-bottom: 10px;
        }

        .welcome-text p {
            color: #666;
            font-size: 16px;
        }
        
        .input-group {
            position: relative;
            margin-bottom: 30px;
            animation: slideInRight 0.5s ease-out;
        }
        
        .input-group input {
            width: 100%;
            padding: 15px 20px 15px 40px;
            font-size: 16px;
            border: 2px solid #eee;
            border-radius: 10px;
            background: transparent;
            transition: all 0.3s ease;
        }
        
        .input-group input:focus {
            outline: none;
            border-color: #ff0000;
            box-shadow: 0 0 10px rgba(255,0,0,0.1);
        }
        
        .input-group i {
            position: absolute;
            left: 15px;
            top: 50%;
            transform: translateY(-50%);
            color: #7f8c8d;
            transition: all 0.3s ease;
        }

        .input-group input:focus + i {
            color: #ff0000;
        }
        
        .btn-login {
            width: 100%;
            padding: 15px;
            background: #ff0000;
            border: none;
            border-radius: 10px;
            color: white;
            font-size: 16px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            animation: fadeIn 1s ease-out 1s both;
            position: relative;
            overflow: hidden;
        }
        
        .btn-login:hover {
            background: #cc0000;
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(255,0,0,0.2);
        }

        .btn-login::after {
            content: '';
            position: absolute;
            top: 50%;
            left: 50%;
            width: 0;
            height: 0;
            background: rgba(255,255,255,0.2);
            border-radius: 50%;
            transform: translate(-50%, -50%);
            transition: width 0.6s ease, height 0.6s ease;
        }

        .btn-login:active::after {
            width: 300px;
            height: 300px;
        }
        
        .error-msg {
            background: #ff6b6b;
            color: white;
            padding: 15px;
            border-radius: 10px;
            margin-bottom: 20px;
            text-align: center;
            animation: shake 0.5s ease;
            box-shadow: 0 3px 10px rgba(255,107,107,0.2);
        }

        /* Animations */
        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
        
        @keyframes fadeIn {
            from { opacity: 0; }
            to { opacity: 1; }
        }
        
        /* @keyframes shake {
            0%, 100% { transform: translateX(0); }
            25% { transform: translateX(-10px); }
            75% { transform: translateX(10px); }
        } */

        @keyframes slideInRight {
            from {
                opacity: 0;
                transform: translateX(20px);
            }
            to {
                opacity: 1;
                transform: translateX(0);
            }
        }

        /* @keyframes pulse {
            0% { transform: scale(1); }
            50% { transform: scale(1.05); }
            100% { transform: scale(1); }
        } */

        /* Responsive Design */
        @media (max-width: 480px) {
            .login-container {
                padding: 30px;
                margin: 15px;
            }

            .welcome-text h2 {
                font-size: 20px;
            }

            .welcome-text p {
                font-size: 14px;
            }

            .input-group input {
                /* padding: 12px 35px 12px 15px; */
                font-size: 14px;
            }

            .btn-login {
                padding: 12px;
                font-size: 14px;
            }
        }
        @keyframes fadeIn {
            from { opacity: 0; }
            to { opacity: 1; }
        }
    </style>
</head>
<body>
    <div class="login-container">
        <div class="logo-container">
            <img src="<?php echo base_url('assets/images/logo.png'); ?>" alt="Sahyadri Farm Machinery">
        </div>
        
        <div class="welcome-text">
            <h2>Welcome Back!</h2>
            <p>Please enter your username and password to login.</p>
        </div>

        <?php if($this->session->flashdata('error')): ?>
            <div class="error-msg">
                <?= $this->session->flashdata('error') ?>
            </div>
        <?php endif; ?>

        <form action="<?= site_url('auth/login') ?>" method="post">
            <div class="input-group">
                <input type="text" name="username" placeholder="Username" required>
                <i class="fas fa-user"></i>
            </div>
            <div class="input-group">
                <input type="password" name="password" placeholder="Password" required>
                <i class="fas fa-lock"></i>
            </div>
            <button type="submit" class="btn-login">LOGIN</button>.
            <div class="back-to-login">
    <a href="<?= site_url('auth/forgot_password') ?>">Forgot Password?</a>
</div>
        </form>
    </div>
</body>
</html>