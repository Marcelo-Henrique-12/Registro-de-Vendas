@extends('partials.header')
@section('styles')
    <link href="{{ asset('css/form.css') }}" rel="stylesheet">
@endsection
@section('main')
    <main>
        <section class="banner" id="banner">
            <div class="position-relative overflow-hidden text-center banner-custon">
                <div class="container custon-container">

                    <div class="cadastro-section mb-5">
                        <h3 class="mb-3">Vendas</h3>
                    </div>
                    <hr>
                    <h3 class="mt-5 mb-4">Registros</h3>
                    <div class="registros-section d-flex justify-content-center mb-5">


                    </div>

                </div>
            </div>
        </section>
    </main>

    @push('scripts')
    
    @endpush
@endsection
