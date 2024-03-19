<!doctype html>
<html lang="pt-br" data-bs-theme="auto">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <title>{{ config('app.name', 'Registro de Vendas') }}</title>
    <link rel="icon" type="image/png" href="{{ asset('images/logofundobranco.png') }}">
    <link rel="canonical" href="https://getbootstrap.com/docs/5.3/examples/product/">
    <link href="{{ asset('assets/dist/css/bootstrap.min.css') }}" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@100;400&display=swap" rel="stylesheet">
    @yield('styles')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@docsearch/css@3">
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.5.12/cropper.min.css">
    <link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" />

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.16/jquery.mask.min.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/smooth-scroll@16.1.3/dist/smooth-scroll.polyfills.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

    <script src="{{ asset('assets/dist/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('assets/js/color-modes.js') }}"></script>

</head>


<body>
    @include('partials.navbar')

    <div class="position-fixed end-0 p-3" style="z-index: 11">
        <div id="liveToast" class="toast hide" role="alert" aria-live="assertive" aria-atomic="true">
            <div class="toast-body">
            </div>
        </div>
    </div>
    @yield('main')



    @include('partials.footer')



    <script>
        document.addEventListener('DOMContentLoaded', function() {
            @if (session()->has('success'))
                showToast('success', '{{ session('success') }}');
            @endif

            @if (session()->has('error'))
                showToast('error', '{{ session('error') }}');
            @endif
            function showToast(type, message) {
                var liveToast = new bootstrap.Toast(document.getElementById('liveToast'));
                var toastBody = document.querySelector('.toast-body');
                toastBody.innerHTML = message;
                document.querySelector('.toast').classList.add('bg-' + type, 'text-white');
                liveToast.show();
            }
        });
    </script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var offcanvas = new bootstrap.Offcanvas(document.getElementById('offcanvas'));

            document.getElementById('offcanvas').addEventListener('shown.bs.offcanvas', function() {
                document.getElementById('offcanvas').classList.add('offcanvas-active');
                document.getElementById('offcanvas').classList.remove('offcanvas-inactive');
            });

            document.getElementById('offcanvas').addEventListener('hidden.bs.offcanvas', function() {
                document.getElementById('offcanvas').classList.remove('offcanvas-active');
                document.getElementById('offcanvas').classList.add('offcanvas-inactive');
            });

            document.querySelector('.navbar-toggler').addEventListener('click', function() {
                document.getElementById('offcanvas').classList.add('offcanvas-active');
                document.getElementById('offcanvas').classList.remove('offcanvas-inactive');
            });

            document.getElementById('offcanvas').addEventListener('hide.bs.offcanvas', function() {
                document.getElementById('offcanvas').classList.remove('offcanvas-active');
                document.getElementById('offcanvas').classList.add('offcanvas-inactive');
            });
        });
    </script>



    <script>
        document.documentElement.setAttribute('data-bs-theme', 'light');
    </script>

    @stack('scripts')

</body>
