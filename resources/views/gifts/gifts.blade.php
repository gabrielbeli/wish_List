@extends('layout.welcome')

@section('content')

    @if(session('message'))
        <div class="alert alert-success">
        {{session('message')}}
        </div>
    @endif

    <div style="margin-top: 10%; display:flex; flex-direction:column; gap: 15px" class="Container">

        @if($gifts->isEmpty())
            <h1 style="margin-top: 10%">Still nothing here!!</h1>
        @else

        <div style="display: flex; justify-content: space-between">

        <h2><i style="color: lightCoral; font-size: 2rem" class="bi bi-gift-fill"></i></i> Gifts</h2>

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

        <table class="table-custom" style="background-color: rgba(255, 255, 255, 0.3); backdrop-filter: blur(10px);">
            <thead>
                <tr>
                    <th scope="col">id</th>
                    <th scope="col">Name</th>
                    <th scope="col">Value To Pay</th>
                    <th scope="col">Value Paid</th>
                    @if($gifts->contains(fn($item) => isset($item->difference)))
                        <th scope="col">Difference Value</th>
                    @endif
                    <th scope="col">Wisher</th>
                    @if(Auth::user()->user_type == 1)
                    <th style="text-align: center;" scope="col">Action</th>
                    @endif
                </tr>
            </thead>
            <tbody>
                @foreach ($gifts as $item)
                    <tr>
                        <th scope="row">{{$item->id}}</th>
                        <td>{{$item->name}}</td>
                        <td>{{$item->value_to_pay}}</td>
                        <td>{{$item->value_paid}}</td>
                        @if($gifts->contains(fn($item) => isset($item->difference)))
                            @if(isset($item->difference))
                                @php $sign = $item->difference > 0 ? '+' : '-' @endphp
                                <td>{{$sign}}{{ abs($item->difference) }}</td>
                            @else
                                <td>| |</td>
                            @endif
                        @endif
                        <td>{{$item->usname}}</td>
                        @if(Auth::user()->user_type == 1)
                        <td>
                            <div class="updateGiftModal" style="text-align: center;">
                                <a type="button" class="btn btn-light" data-bs-toggle="modal" data-bs-target="#updateGiftModal{{$item->id}}">
                                    SEE | EDIT
                                </a>
                                <a href="{{route('deleteGift', $item->id)}}" class="btn btn-info">Delete</a>
                            </div>
                        </td>
                        @endif
                    </tr>
                @endforeach
            </tbody>
        </table>

        @foreach ($gifts as $item)
            <div class="modal fade" id="updateGiftModal{{$item->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4><i class="bi bi-stars"></i> Wish</h4>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form method="POST" action="{{route('createGift')}}">
                                @csrf
                                <div class="mb-3">
                                    <label for="exampleInputName1" class="form-label"><i class="bi bi-gift-fill"></i>  Name</label>
                                    <input name="name" value="{{$item->name}}" type="text" class="form-control" id="exampleInputName1" required>
                                    @error('name')
                                        <div class="alert alert-danger" role="alert">name invalid!</div>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="exampleInputValue_to_pay" class="form-label"><i class="bi bi-cash"></i>  Value to pay</label>
                                    <input name="value_to_pay" value="{{$item->value_to_pay}}" type="text" class="form-control" id="exampleInputValue_to_pay" required>
                                    @error('value_to_pay')
                                        <div class="alert alert-danger" role="alert">value to pay invalid!</div>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="exampleInputValue_paid" class="form-label"><i class="bi bi-cash"></i>  Value paid</label>
                                    <input name="value_paid" value="{{$item->value_paid}}" type="text" class="form-control" id="exampleInputValue_paid">
                                    @error('value_paid')
                                        <div class="alert alert-danger" role="alert">value paid invalid!</div>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="exampleInputUser_id1" class="form-label"><i class="bi bi-person-fill"></i> Wisher</label>
                                    <select name="user_id" class="form-select" aria-label="Default select example">
                                        @foreach ($users as $user)
                                            <option value="{{$user->id}}" {{ $user->id == $item->user_id ? 'selected' : '' }}>{{$user->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <input type="hidden" name="id" value="{{$item->id}}">
                                <button type="submit" class="btn btn-info mb-3">Submit</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach

    @endif

    <div style="display: flex; justify-content: space-between">

        <a style="text-decoration: none; font-weight:bold; background:transparent; text-align: center" href="{{route('home')}}"><i style="color: blue" class="bi bi-arrow-left-square-fill"></i> Voltar</a>

        <div class="makeModal">
            <button type="button" class="" data-bs-toggle="modal" data-bs-target="#makeModal">
                TO WISH <i class="bi bi-stars"></i>
            </button>
        </div>
    </div>

    @include('components.modal-wish')

    </div>
@endsection
