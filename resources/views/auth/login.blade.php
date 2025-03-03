<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - PT. Mandajaya</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
pera    <script src="https://cdnjs.cloudflare.com/ajax/libs/particles.js/2.0.0/particles.min.js"></script>
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

        .splash-screen {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: #1e3c72;
            display: flex;
            justify-content: center;
            align-items: center;
            z-index: 1000;
            animation: splashFadeOut 1.5s cubic-bezier(0.4, 0, 0.2, 1) forwards;
            animation-delay: 1.5s;
            clip-path: circle(150% at 50% 50%);
        }

        .splash-logo {
            font-size: 3rem;
            color: #FFD700;
            font-weight: 700;
            opacity: 0;
            transform: scale(0.5) translateZ(0);
            animation: splashLogoIn 1.2s cubic-bezier(0.34, 1.56, 0.64, 1) forwards;
            text-shadow: 0 0 15px rgba(255, 215, 0, 0.5);
            letter-spacing: 2px;
        }

        @keyframes splashLogoIn {
            to {
                opacity: 1;
                transform: scale(1);
            }
        }

        @keyframes splashFadeOut {
            to {
                opacity: 0;
                visibility: hidden;
            }
        }

        .login-container {
            min-height: 100vh;
            display: flex;
            align-items: center;
            position: relative;
            overflow: hidden;
            z-index: 2;
            opacity: 0;
            animation: contentFadeIn 1s ease forwards;
            animation-delay: 3s;
        }

        @keyframes contentFadeIn {
            to {
                opacity: 1;
            }
        }

        .login-slide {
            position: absolute;
            right: -100%;
            width: 66.666667%;
            height: 100%;
            background: rgba(255, 255, 255, 0.98);
            display: flex;
            justify-content: center;
            align-items: center;
            animation: slideIn 1.2s cubic-bezier(0.34, 1.56, 0.64, 1) forwards;
            animation-delay: 3.2s;
            backdrop-filter: blur(10px);
            box-shadow: -10px 0 30px rgba(0, 0, 0, 0.1);
        }

        @keyframes slideIn {
            to { right: 0; }
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .card {
            border: none;
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.15),
                      0 0 0 1px rgba(255, 255, 255, 0.1),
                      0 0 30px rgba(0, 0, 0, 0.1);
            background: rgba(255, 255, 255, 0.98);
            border-radius: 1.5rem;
            backdrop-filter: blur(10px);
            transform: perspective(1000px) rotateX(0deg);
            transition: transform 0.6s cubic-bezier(0.34, 1.56, 0.64, 1);
            opacity: 0;
            transform: translateY(20px);
            animation: fadeIn 0.8s cubic-bezier(0.4, 0, 0.2, 1) forwards 0.5s;
            padding: 2.5rem !important;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .card h4 {
            color: #2c3e50;
            font-weight: 600;
            margin-bottom: 2rem;
            letter-spacing: -0.5px;
        }

        .form-label {
            color: #2c3e50;
            font-weight: 500;
            margin-bottom: 0.5rem;
        }

        .form-control {
            border-radius: 0.75rem;
            padding: 0.875rem 1.25rem;
            border: 1.5px solid #e0e0e0;
            transition: all 0.3s ease;
            font-size: 0.95rem;
        }

        .form-control:focus {
            box-shadow: 0 0 0 4px rgba(26, 32, 44, 0.1);
            border-color: #2c3e50;
            transform: translateY(-1px);
        }

        .btn-primary {
            background: #2c3e50;
            border: none;
            padding: 0.875rem 1.5rem;
            border-radius: 0.75rem;
            font-weight: 500;
            transition: all 0.3s ease;
            letter-spacing: 0.5px;
        }

        .btn-primary:hover {
            background: #34495e;
            transform: translateY(-2px);
            box-shadow: 0 8px 20px rgba(44, 62, 80, 0.25);
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .form-check-input:checked {
            background-color: #2c3e50;
            border-color: #2c3e50;
        }

        .form-check-label {
            color: #2c3e50;
            font-weight: 400;
        }

        .invalid-feedback {
            font-size: 0.85rem;
            color: #e74c3c;
            margin-top: 0.5rem;
        }
    </style>
</head>
<body>
    <div class="splash-screen">
        <div class="splash-logo">PT. Mandajaya</div>
    </div>
    <div id="particles-js"></div>
    <div class="container-fluid login-container">
        <div class="row w-100">
            <div class="col-md-4 sidebar">
                <h1>PT. Mandajaya</h1>
                <h4>Rekayasa Konstruksi</h4>
                <p>Absensi Karyawan</p>
            </div>

            <div class="login-slide">
                <div class="card" style="width: 100%; max-width: 420px;">
                    <h4 class="text-center">Welcome Back</h4>
                    <form method="POST" action="{{ route('login') }}">
                        @csrf
                        <div class="mb-4">
                            <label for="email" class="form-label">Staff ID</label>
                            <input id="email" type="text" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autofocus placeholder="Enter your Staff ID" pattern="[0-9]{3,6}" title="Please enter a valid Staff ID (3-6 digits)"
                            @error('email')
                            <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="mb-4">
                            <label for="password" class="form-label">Password</label>
                            <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required placeholder="Enter your password">
                            @error('password')
                            <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="mb-4 form-check">
                            <input type="checkbox" class="form-check-input" name="remember" id="remember">
                            <label class="form-check-label" for="remember">Remember Me</label>
                        </div>
                        <div class="d-grid">
                            <button type="submit" class="btn btn-primary">Sign In</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        particlesJS('particles-js', {
            particles: {
                number: { value: 100, density: { enable: true, value_area: 800 } },
                color: { value: ['#ffffff', '#FFD700'] },
                shape: { type: ['circle', 'triangle', 'star'] },
                opacity: { value: 0.6, random: true, anim: { enable: true, speed: 0.5, opacity_min: 0.1, sync: false } },
                size: { value: 4, random: true, anim: { enable: true, speed: 2, size_min: 0.1, sync: false } },
                line_linked: { enable: true, distance: 150, color: '#ffffff', opacity: 0.3, width: 1 },
                move: { enable: true, speed: 3, direction: 'none', random: true, straight: false, out_mode: 'out', bounce: false,
                    attract: { enable: true, rotateX: 600, rotateY: 1200 } }
            },
            interactivity: {
                detect_on: 'canvas',
                events: { onhover: { enable: true, mode: 'grab' }, onclick: { enable: true, mode: 'push' }, resize: true },
                modes: {
                    grab: { distance: 140, line_linked: { opacity: 0.8 } },
                    push: { particles_nb: 6 },
                    remove: { particles_nb: 2 }
                }
            },
            retina_detect: true
        });

        document.querySelector('.card').addEventListener('mousemove', function(e) {
            const rect = this.getBoundingClientRect();
            const x = (e.clientX - rect.left) / rect.width - 0.5;
            const y = (e.clientY - rect.top) / rect.height - 0.5;
            this.style.transform = `perspective(1000px) rotateX(${y * -5}deg) rotateY(${x * 5}deg)`;
        });

        document.querySelector('.card').addEventListener('mouseleave', function() {
            this.style.transform = 'perspective(1000px) rotateX(0deg) rotateY(0deg)';
        });
    </script>
</body>
</html>