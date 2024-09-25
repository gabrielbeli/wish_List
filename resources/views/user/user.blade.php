@extends('layout.welcome')

@section('content')

    @if(session('message'))
        <div class="alert alert-success">
        {{session('message')}}
        </div>
    @endif

    <div style="margin-top: 10%; gap: 15px; display:flex; flex-direction:column" class="Container">

        @if($users->isEmpty())
            <h1 style="margin-top: 10%">Still nothing here!!</h1>
        @else

        <div style="display: flex; justify-content: space-between">

        <h2><i class="bi bi-stars"></i> Wishers</h2>

        <form class="row g-3" action="">
            <div class="col-auto">
              <label for="inputSearch2" class="visually-hidden">Search</label>
              <input type="text" name="search" class="form-control" id="inputSearch2" placeholder="Input name or part of">
            </div>
            <div class="col-auto">
              <button id="btnSearch" type="submit" class="btn mb-3"><i class="bi bi-search-heart"></i> Search</button>
            </div>
        </form>

        </div>

        <table class="table-custom">
            <thead>
                <tr>
                    <th scope="col">id</th>
                    <th scope="col">Name</th>
                    <th scope="col">Password</th>
                    <th scope="col">email</th>
                    @if(Auth::user()->user_type == 1)
                        <th style="text-align: center;" scope="col">Action</th>
                    @endif
                </tr>
            </thead>

            <tbody>
                @foreach ($users as $item)
                    <tr>
                    <th scope="row">{{$item->id}}</th>
                    <td>{{$item->name}}</td>
                    <td>{{$item->password}}</td>
                    <td>{{$item->email}}</td>
                    @if(Auth::user()->user_type == 1)
                        <td style="display: flex; gap: 15px; justify-content: center">

                            <div class="userIDModal">
                                <a type="button" class="btn btn-light" data-bs-toggle="modal" data-bs-target="#userIDModal{{$item->id}}">
                                    SEE | EDIT
                                </a>
                                <a href="{{route('deleteUser', $item->id)}}" class="btn btn-info">Delete</a>
                            </div>
                        </td>
                    @endif
                    </tr>
                @endforeach
            </tbody>

                @foreach ($users as $item)
                    <div class="modal fade" id="userIDModal{{$item->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                    <div class="modal-content">
                    <div class="modal-header">
                        <h4><i class="bi bi-stars"></i> Wisher!</h4>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form method="POST" action="{{route('createUser')}}">
                         @csrf
                            <input type="hidden" name="id" value="{{$item->id}}">
                            <div class="mb-3">
                                <label for="exampleInputName1" class="form-label"><i class="bi bi-person-fill"></i> Name</label>
                                <input name="name" value="{{$item->name}}" type="text" class="form-control" id="exampleInputName1" required>
                                @error('name')
                                    <div class="alert alert-danger" role="alert">name inválido!</div>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="exampleInputEmail1" class="form-label"><i class="bi bi-envelope-fill"></i> Email</label>
                                <input name="email" value="{{$item->email}}" type="email" class="form-control" id="exampleInputEmail1" required disabled>
                                @error('email')
                                    <div class="alert alert-danger" role="alert">email inválido!</div>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="exampleInputAddress1" class="form-label"><i class="bi bi-geo-alt-fill"></i>  Address</label>
                                <input name="address" value="{{$item->address}}" type="text" class="form-control" id="exampleInputAdrress1">
                            </div>
                            <div class="mb-3">
                                <label for="exampleInputPhone1" class="form-label"><i class="bi bi-telephone-fill"></i>  Phone</label>
                                <input name="phone" value="{{$item->phone}}" type="text" class="form-control" id="exampleInputPhone1">
                            </div>
                            <button type="submit" class="btn btn-info mb-3">Submit</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    @endforeach

    </table>
     @endif

        <div style="display: flex; justify-content: space-between">

            <a style="text-decoration: none; font-weight:bold; background:transparent; text-align: center" href="{{route('home')}}"><i style="color: blue" class="bi bi-arrow-left-square-fill"></i> Voltar</a>

            <div class="registerModal">
                <button type="button" class="" data-bs-toggle="modal" data-bs-target="#registerModal">
                    <i class="bi bi-stars"></i> REGISTER
                </button>
            </div>
        </div>

        @include('components.modal-register')

    </div>
@endsection
