<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>KORINI</title>

@vite('resources/css/app.css')
    <!-- Bootstrap 5 CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

</head>
<body>

    <!-- ══ HEADER + NEWSLETTER ══ -->
    <header class="container mb-5">
        <div class="logo">
            <img src="{{ asset('img/LOGO-PDG.png') }}" alt="logo">
        </div>

        <div class="row">
            <div class="col-12">

                <h1 class="site-title ">
                    Soyez parmi les premières PME financées.
                </h1>

                <div class="orange-line mb-4"></div>

                <!-- Newsletter directement sous le titre -->
                <p class="site-subtitle mb-3">Inscrivez-vous pour obtenir un accès prioritaire dès le lancement.</p>
                <form onsubmit="handleNewsletter(event)" id="nl-form">
                    @csrf
                    <div class="nl-wrap">
                        <input type="email" name="email" id="nl-email" placeholder="Ton adresse e-mail" required>
                        <button type="submit" id="nl-btn">S'inscrire</button>
                    </div>
                </form>
                <p class="nl-success mt-2" id="nl-success" style="display:none;"></p>
            </div>
        </div>
    </header>

    <!-- ══ GRILLE PHOTOS ══ -->
    <main class="container">
        <div class="row ">

            <!-- Contact -->
            <div class=" col-sm-6 col-md-6 col-lg-3">
                <a href="" class="card-photo">
                    <img src="{{ asset('img/1.png') }}" alt="img">
                    <div class="card-info">
                        <span>Contact</span>
                    </div>
                </a>
            </div>

            <!-- Devenir client -->
            <div class=" col-sm-6 col-md-6 col-lg-3">
                <a href="" class="card-photo">
                    <img src="{{ asset('img/2.png') }}  " alt="img">
                    <div class="card-info">
                        <span>Devenir client ?</span>
                    </div>
                </a>
            </div>

            <!-- Solutions PME -->
            <div class="col-sm-6 col-md-6 col-lg-3">
                <a href="" class="card-photo">
                    <img src="{{ asset('img/3.png') }}" alt="img">
                    <div class="card-info">
                        <span>Solutions PME</span>
                    </div>
                </a>
            </div>

            <!-- Solutions -->
            <div class=" col-sm-6 col-md-6 col-lg-3">
                <a href="" class="card-photo">
                    <img src="{{ asset('img/4.png') }}" alt="img">
                    <div class="card-info">
                        <span>Solutions innovantes</span>
                    </div>
                </a>
            </div>

        </div>
    </main>

    <!-- ══ FOOTER ══ -->
    <footer class="site-footer text-center container-xl mt-5">
        <div class="row">
            <div class="col-12">
                <p class="mb-0">contact@korinifinance.com <br> Nous finançons vos idées</p>
            </div>
        </div>
    </footer>

    <!-- Bootstrap 5 JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        async function handleNewsletter(e) {
            e.preventDefault();

            const btn = document.getElementById('nl-btn');
            const msg = document.getElementById('nl-success');
            const email = document.getElementById('nl-email').value;
            const csrf = document.querySelector('input[name="_token"]').value;

            btn.disabled = true;
            btn.textContent = '...';

            try {
                const res = await fetch('{{ route("leads.store") }}', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': csrf,
                        'Accept': 'application/json',
                    },
                    body: JSON.stringify({ email }),
                });

                const data = await res.json();

                document.getElementById('nl-form').style.display = 'none';
                msg.style.display = 'block';
                msg.textContent = data.already
                    ? '✓ Vous êtes déjà inscrit(e) !'
                    : '✓ Merci ! Tu es bien inscrit(e).';
            } catch {
                btn.disabled = false;
                btn.textContent = "S'inscrire";
                msg.style.display = 'block';
                msg.style.color = 'red';
                msg.textContent = 'Une erreur est survenue. Réessaie.';
            }
        }
    </script>

</body>
</html>
