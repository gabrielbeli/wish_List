@extends('layout.welcome')

@section('content')

    @if(session('message'))
        <div class="alert alert-success">
        {{session('message')}}
        </div>
    @endif


    <div style="margin-top: 20%; display:flex; flex-direction:column; gap: 15px" class="Container">

        <div class="start">

            <img id="star" src="{{asset('imagens/star.png')}}" alt="">

            <h1>Whats is your wish?</h1>

            <div class="butonsHome">


                @if (Route::has('login'))
                    @auth

                        <div class="registerModal">
                            <button type="button" class="" data-bs-toggle="modal" data-bs-target="#registerModal">
                                <i class="bi bi-stars"></i> REGISTER
                            </button>
                        </div>

                        <form method="post" action="{{route('logout')}}">
                            @csrf
                            <button type="submit">
                                <i class="bi bi-door-open-fill"></i>
                            </button>
                        </form>

                        <div class="makeModal">
                            <button type="button" class="" data-bs-toggle="modal" data-bs-target="#makeModal">
                                TO WISH <i class="bi bi-stars"></i>
                            </button>
                        </div>
                @else
                        <div class="loginModal">
                            <button type="button" class="" data-bs-toggle="modal" data-bs-target="#loginModal">
                                <i class="bi bi-stars"></i> LOGIN
                            </button>
                        </div>

                        @if (Route::has('user.user'))
                            <div class="signUpModal">
                                <button type="button" class="" data-bs-toggle="modal" data-bs-target="#signUpModal">
                                     SIGN UP <i class="bi bi-stars"></i>
                                </button>
                            </div>
                        @endif

                    @endauth

                @endif
            </div>

            @include('auth.signUp')
            @include('auth.login')
            @include('components.modal-register')
            @include('components.modal-wish')

        <div>

    </div>
@endsection
