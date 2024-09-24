@extends('layout.welcome')

@section('content')
    <div style="margin-top: 20%; display:flex; flex-direction:column; gap: 15px" class="Container">

        <div class="start">

            <img id="star" src="{{asset('imagens/star.png')}}" alt="">

            <h1>Whats is your wish?</h1>

            <div class="butonsHome">

                <div class="registerModal">
                    <button type="button" class="" data-bs-toggle="modal" data-bs-target="#registerModal">
                    <i class="bi bi-stars"></i> REGISTER
                    </button>
                </div>

                <div class="makeModal">
                    <button type="button" class="" data-bs-toggle="modal" data-bs-target="#makeModal">
                        TO WISH <i class="bi bi-stars"></i>
                    </button>
                </div>

            </div>

            @include('components.modal-register')
            @include('components.modal-wish')

        <div>

    </div>
@endsection
