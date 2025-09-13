<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>KYL Admin - Login</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        :root {
            --bg-glass: rgba(255, 255, 255, 0.08);
            --glass-blur: blur(12px);
            --glass-border: rgba(255, 255, 255, 0.1);
            --glass-shadow: 0 8px 32px rgba(0, 0, 0, 0.1);
            --text-primary: #ffffff;
            --text-secondary: rgba(255, 255, 255, 0.7);
            --accent-color: #f59e0b;
            --error-color: #ef4444;
            --transition-smooth: all 0.3s ease;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Poppins', sans-serif;
            background: linear-gradient(45deg, rgba(0,0,0,0.7), rgba(0,0,0,0.5)), url('../img/kyl.jpg') center/cover no-repeat fixed;
            color: var(--text-primary);
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 20px;
        }

        .login-card {
            width: 100%;
            max-width: 440px;
            background: var(--bg-glass);
            backdrop-filter: var(--glass-blur);
            border: 1px solid var(--glass-border);
            border-radius: 20px;
            padding: 40px;
            box-shadow: var(--glass-shadow);
            color: var(--text-primary);
            animation: fadeIn 0.5s ease-out;
            position: relative;
        }

        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }

        .login-logo {
            text-align: center;
            margin-bottom: 24px;
        }

        .login-logo img {
            max-width: 120px;
            filter: drop-shadow(0 4px 8px rgba(0,0,0,0.2));
        }

        .login-card h2 {
            text-align: center;
            margin-bottom: 12px;
            font-weight: 600;
            font-size: 1.8rem;
            color: #fff;
            text-shadow: 0 2px 4px rgba(0,0,0,0.2);
        }

        .login-note {
            color: var(--text-secondary);
            font-size: 0.95rem;
            margin-bottom: 28px;
            text-align: center;
            line-height: 1.5;
        }

        .form-group {
            margin-bottom: 20px;
            position: relative;
        }

        .form-label {
            display: block;
            margin-bottom: 8px;
            font-weight: 500;
            font-size: 0.95rem;
            color: var(--text-primary);
        }

        .input-with-icon {
            position: relative;
        }

        .input-icon {
            position: absolute;
            left: 14px;
            top: 50%;
            transform: translateY(-50%);
            color: var(--text-secondary);
            font-size: 1rem;
        }

        .form-control {
            width: 100%;
            background: rgba(255, 255, 255, 0.05);
            border: 1px solid rgba(255, 255, 255, 0.1);
            color: var(--text-primary);
            padding: 14px 14px 14px 42px;
            border-radius: 10px;
            transition: var(--transition-smooth);
            box-shadow: inset 0 1px 0 rgba(255, 255, 255, 0.02);
            font-family: 'Poppins', sans-serif;
            font-size: 0.95rem;
        }

        .form-control::placeholder {
            color: var(--text-secondary);
        }

        .form-control:focus {
            outline: none;
            border-color: var(--accent-color);
            box-shadow: 0 0 0 3px rgba(245, 158, 11, 0.2);
            background: rgba(255, 255, 255, 0.08);
        }

        .password-toggle {
            position: absolute;
            right: 14px;
            top: 50%;
            transform: translateY(-50%);
            background: none;
            border: none;
            color: var(--text-secondary);
            cursor: pointer;
            font-size: 1rem;
        }

        .password-toggle:hover {
            color: var(--text-primary);
        }

        .error-message {
            margin: 20px 0;
            padding: 12px 16px;
            background: rgba(239, 68, 68, 0.1);
            border-left: 4px solid var(--error-color);
            color: #ffdddd;
            border-radius: 4px;
            font-size: 0.9rem;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .error-message i {
            font-size: 1.1rem;
        }

        .btn {
            width: 100%;
            background: var(--accent-color);
            color: #000;
            border: none;
            padding: 14px;
            border-radius: 10px;
            font-family: 'Poppins', sans-serif;
            font-weight: 600;
            font-size: 1rem;
            cursor: pointer;
            transition: var(--transition-smooth);
            margin-top: 8px;
        }

        .btn:hover {
            background: #e6900b;
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(245, 158, 11, 0.3);
        }

        .btn:active {
            transform: translateY(0);
        }

        .login-links {
            margin-top: 24px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .login-links a {
            color: var(--text-secondary);
            text-decoration: none;
            font-size: 0.95rem;
            transition: var(--transition-smooth);
        }

        .login-links a:hover {
            color: var(--text-primary);
        }

        @media (max-width: 576px) {
            .login-card {
                padding: 30px 24px;
            }
            
            body {
                padding: 15px;
            }
        }

        .decoration {
            position: absolute;
            width: 180px;
            height: 180px;
            border-radius: 50%;
            background: linear-gradient(45deg, var(--accent-color), transparent);
            filter: blur(60px);
            opacity: 0.15;
            z-index: -1;
        }

        .decoration-1 {
            top: -50px;
            right: -50px;
        }

        .decoration-2 {
            bottom: -50px;
            left: -50px;
            background: linear-gradient(45deg, #3b82f6, transparent);
        }
    </style>
</head>
<body>
    <div class="login-card">
        <!-- Background decorations -->
        <div class="decoration decoration-1"></div>
        <div class="decoration decoration-2"></div>
        
        <div class="login-logo">
            <img src="../img/logo.png" alt="KYL Logo">
        </div>
        <h2>Admin Login</h2>
        <p class="login-note">Sign in with your administrator account to manage the site.</p>
        
        <!-- Error message: shown only when `error` query param is set -->
        <?php if(isset($_GET['error']) && !empty($_GET['error'])): ?>
            <div class="error-message" style="display: flex;">
                <i class="fas fa-exclamation-circle"></i>
                <?php echo htmlspecialchars($_GET['error']); ?>
            </div>
        <?php endif; ?>

        <form action="auth_check.php" method="POST">
            <div class="form-group">
                <label for="email" class="form-label">Email</label>
                <div class="input-with-icon">
                    <i class="fas fa-envelope input-icon"></i>
                    <input type="email" class="form-control" id="email" name="email" placeholder="Enter your email" required>
                </div>
            </div>
            
            <div class="form-group">
                <label for="password" class="form-label">Password</label>
                <div class="input-with-icon">
                    <i class="fas fa-lock input-icon"></i>
                    <input type="password" class="form-control" id="password" name="password" placeholder="Enter your password" required>
                    <button type="button" class="password-toggle" id="passwordToggle">
                        <i class="fas fa-eye"></i>
                    </button>
                </div>
            </div>
            
            <button type="submit" class="btn">Login</button>
        </form>
        
        <div class="login-links">
            <a href="../">Return to main site</a>
            <a href="#">Forgot password?</a>
        </div>
    </div>

    <script>
        // Toggle password visibility
        const passwordToggle = document.getElementById('passwordToggle');
        const passwordInput = document.getElementById('password');
        
        passwordToggle.addEventListener('click', function() {
            const type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
            passwordInput.setAttribute('type', type);
            
            // Toggle eye icon
            const eyeIcon = this.querySelector('i');
            eyeIcon.classList.toggle('fa-eye');
            eyeIcon.classList.toggle('fa-eye-slash');
        });
        
        // Add subtle animation to inputs on focus
        const inputs = document.querySelectorAll('.form-control');
        inputs.forEach(input => {
            input.addEventListener('focus', function() {
                this.parentElement.classList.add('focused');
            });
            
            input.addEventListener('blur', function() {
                this.parentElement.classList.remove('focused');
            });
        });
    </script>
</body>
</html>