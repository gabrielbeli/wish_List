@extends('layout.welcome')

@section('content')
    <div style="margin-top: 20%; display:flex; flex-direction:column; gap: 15px" class="Container">

        <h1 style="margin-top: 10%">Page not found...
        Wish again!</h1>

        <a style="text-decoration: none; font-weight:bold; background:transparent; text-align: center" href="{{route('home')}}"><i style="color: blue" class="bi bi-arrow-left-square-fill"></i> Voltar</a>

    </div>
@endsection
