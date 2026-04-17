<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>KORINI — Administration</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        * { box-sizing: border-box; }
        body {
            min-height: 100vh;
            background: linear-gradient(135deg, #27306c 0%, #27306c 45%, #f29220 100%);
            display: flex;
            align-items: center;
            justify-content: center;
            font-family: 'Segoe UI', sans-serif;
        }
        .login-card {
            background: rgba(255,255,255,0.07);
            border: 1px solid rgba(255,255,255,0.15);
            backdrop-filter: blur(12px);
            border-radius: 20px;
            padding: 48px 40px;
            width: 100%;
            max-width: 420px;
            box-shadow: 0 30px 60px rgba(0,0,0,0.35);
        }
        .login-logo {
            width: 72px;
            height: 72px;
            object-fit: contain;
            display: block;
            margin: 0 auto 24px;
        }
        h1 {
            color: #fff;
            font-size: 1.1rem;
            font-weight: 700;
            letter-spacing: 0.2em;
            text-transform: uppercase;
            text-align: center;
            margin-bottom: 6px;
        }
        .subtitle {
            color: rgba(255,255,255,0.5);
            font-size: 0.72rem;
            letter-spacing: 0.15em;
            text-transform: uppercase;
            text-align: center;
            margin-bottom: 36px;
        }
        .form-label {
            color: rgba(255,255,255,0.7);
            font-size: 0.72rem;
            letter-spacing: 0.12em;
            text-transform: uppercase;
            margin-bottom: 6px;
        }
        .form-control {
            background: rgba(255,255,255,0.1);
            border: 1px solid rgba(255,255,255,0.2);
            border-radius: 10px;
            color: #fff;
            padding: 11px 16px;
            font-size: 0.9rem;
            transition: border-color 0.2s, background 0.2s;
        }
        .form-control:focus {
            background: rgba(255,255,255,0.16);
            border-color: #f29220;
            color: #fff;
            box-shadow: 0 0 0 3px rgba(242,146,32,0.2);
        }
        .form-control::placeholder { color: rgba(255,255,255,0.3); }
        .form-control.is-invalid {
            border-color: #ff6b6b;
            background: rgba(255,107,107,0.08);
        }
        .invalid-feedback { color: #ff9f9f; font-size: 0.78rem; }
        .btn-login {
            width: 100%;
            padding: 12px;
            background: #f29220;
            border: none;
            border-radius: 10px;
            color: #fff;
            font-weight: 700;
            letter-spacing: 0.15em;
            text-transform: uppercase;
            font-size: 0.85rem;
            cursor: pointer;
            margin-top: 8px;
            transition: opacity 0.2s, transform 0.2s;
        }
        .btn-login:hover { opacity: 0.88; transform: translateY(-1px); }
        .form-check-label { color: rgba(255,255,255,0.6); font-size: 0.8rem; }
        .form-check-input:checked { background-color: #f29220; border-color: #f29220; }
    </style>
</head>
<body>
    <div class="login-card">
        <img src="{{ asset('img/LOGO-PDG.png') }}" alt="Korini" class="login-logo">
        <h1>Administration</h1>
        <p class="subtitle">Gestion des leads</p>

        <form method="POST" action="{{ route('admin.login.post') }}">
            @csrf

            <div class="mb-3">
                <label class="form-label">Adresse e-mail</label>
                <input
                    type="email"
                    name="email"
                    class="form-control @error('email') is-invalid @enderror"
                    value="{{ old('email') }}"
                    placeholder="admin@korini.com"
                    autofocus
                    required
                >
                @error('email')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label class="form-label">Mot de passe</label>
                <input
                    type="password"
                    name="password"
                    class="form-control @error('password') is-invalid @enderror"
                    placeholder="••••••••"
                    required
                >
                @error('password')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-4 form-check">
                <input type="checkbox" class="form-check-input" id="remember" name="remember">
                <label class="form-check-label" for="remember">Se souvenir de moi</label>
            </div>

            <button type="submit" class="btn-login">Connexion</button>
        </form>
    </div>
</body>
</html>
