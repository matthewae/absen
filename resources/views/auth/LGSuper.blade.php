<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Supervisor Login - PT. Mandajaya</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/particles.js/2.0.0/particles.min.js"></script>
    <style>
        * {
            font-family: 'Poppins', sans-serif;
        }

        #particles-js {
            position: fixed;
            width: 100%;
            height: 100%;
            top: 0;
            left: 0;
            z-index: 1;
            background: linear-gradient(-45deg, #1e3c72, #2a5298, #2c3e50, #3498db);
            background-size: 400% 400%;
            animation: gradientBG 15s ease infinite;
            perspective: 1000px;
            transform-style: preserve-3d;
        }

        body {
            overflow-x: hidden;
            min-height: 100vh;
            position: relative;
        }

        @keyframes gradientBG {
            0% { background-position: 0% 50%; }
            50% { background-position: 100% 50%; }
            100% { background-position: 0% 50%; }
        }

        .sidebar {
            background: rgba(0, 0, 0, 0.25);
            backdrop-filter: blur(10px);
            color: white;
            min-height: 100vh;
            padding: 3rem 2rem;
            opacity: 0;
            animation: fadeIn 0.8s ease forwards;
            border-right: 1px solid rgba(255, 255, 255, 0.1);
        }

        .sidebar h1 {
            color: #FFD700;
            font-weight: 700;
            margin-bottom: 1.5rem;
            text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.3);
            letter-spacing: -0.5px;
        }

        .sidebar h4 {
            color: #f0f0f0;
            margin-bottom: 0.75rem;
            font-weight: 500;
            letter-spacing: 0.5px;
        }

        .sidebar p {
            color: #e0e0e0;
            font-size: 1.1rem;
            font-weight: 300;
            opacity: 0.9;
        }

        .login-form {
            position: relative;
            z-index: 2;
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(10px);
            padding: 2rem;
            border-radius: 15px;
            box-shadow: 0 8px 32px rgba(0, 0, 0, 0.1);
            border: 1px solid rgba(255, 255, 255, 0.1);
            animation: slideIn 0.8s ease forwards;
        }

        .form-control {
            background: rgba(255, 255, 255, 0.1);
            border: 1px solid rgba(255, 255, 255, 0.2);
            color: white;
            transition: all 0.3s ease;
        }

        .form-control:focus {
            background: rgba(255, 255, 255, 0.15);
            border-color: rgba(255, 255, 255, 0.3);
            box-shadow: 0 0 0 0.2rem rgba(255, 255, 255, 0.1);
            color: white;
        }

        .btn-primary {
            background: #000000;
            border: none;
            color: #ffffff;
            font-weight: 600;
            padding: 0.75rem 2rem;
            transition: all 0.3s ease;
        }

        .btn-primary:hover {
            background: #333333;
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.3);
        }
    </style>
</head>
<body>
    <div id="particles-js"></div>

    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-6 sidebar">
                <h1>PT. Mandajaya</h1>
                <h4>Supervisor Portal</h4>
                <p>Welcome to the supervisor portal. Please log in with your supervisor credentials to access the dashboard.</p>
            </div>

            <div class="col-lg-6 d-flex align-items-center justify-content-center" style="min-height: 100vh;">
                <div class="login-form w-75">
                    <h2 class="text-white mb-4">Supervisor Login</h2>

                    <form method="POST" action="{{ route('login') }}">
                        @csrf
                        <input type="hidden" name="is_supervisor" value="1">

                        <div class="mb-3">
                            <label for="supervisor_id" class="form-label text-white">Supervisor ID</label>
                            <input id="supervisor_id" type="text" class="form-control @error('supervisor_id') is-invalid @enderror" name="supervisor_id" value="{{ old('supervisor_id') }}" required autofocus>
                            @error('supervisor_id')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="password" class="form-label text-white">Password</label>
                            <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">
                            @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                                <label class="form-check-label text-white" for="remember">
                                    Remember Me
                                </label>
                            </div>
                        </div>

                        <div class="d-grid gap-2">
                            <button type="submit" class="btn btn-primary">
                                Login as Supervisor
                            </button>
                        </div>

                        <div class="mt-3 text-center">
                            <a href="{{ route('login') }}" class="text-white text-decoration-none">
                                ← Back to Employee Login
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        particlesJS("particles-js", {
            particles: {
                number: { value: 80, density: { enable: true, value_area: 800 } },
                color: { value: "#ffffff" },
                shape: { type: "circle" },
                opacity: { value: 0.5, random: false },
                size: { value: 3, random: true },
                line_linked: { enable: true, distance: 150, color: "#ffffff", opacity: 0.4, width: 1 },
                move: { enable: true, speed: 6, direction: "none", random: false, straight: false, out_mode: "out", bounce: false }
            },
            interactivity: {
                detect_on: "canvas",
                events: { onhover: { enable: true, mode: "repulse" }, onclick: { enable: true, mode: "push" }, resize: true },
                modes: { repulse: { distance: 100, duration: 0.4 }, push: { particles_nb: 4 } }
            },
            retina_detect: true
        });
    </script>
</body>
</html>