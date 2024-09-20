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

                    <div class="modal fade" id="registerModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                    <div class="modal-content">
                    <div class="modal-header">
                        <h4><i class="bi bi-stars"></i> Register a wisher!</h4>

                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>

                    <div style="text-align: left" class="modal-body">
                    <form method="POST" action="{{route('createUser')}}">
                        @csrf

                        <div class="mb-3">
                            <label for="exampleInputName1" class="form-label"><i class="bi bi-person-fill"></i> Name</label>
                            <input name="name" type="text" class="form-control" id="exampleInputName1" aria-describedby="namelHelp" required>

                            @error('name')
                                <div class="alert alert-danger" role="alert">
                                    name invalido!
                                </div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="exampleInputEmail1" class="form-label"><i class="bi bi-envelope-fill"></i>  Email</label>
                            <input name="email" type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" required>
                            @error('email')
                                <div class="alert alert-danger" role="alert">
                                    email invalido!
                                </div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="exampleInputPassword1" class="form-label"><i class="bi bi-lock-fill"></i>  Password</label>
                            <input name="password" type="password" class="form-control" id="exampleInputPassword1" required>
                            @error('password')
                                <div class="alert alert-danger" role="alert">
                                    email invalido!
                                </div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="exampleInputAddress1" class="form-label"><i class="bi bi-geo-alt-fill"></i>  Address</label>
                            <input name="address" type="address" class="form-control" id="exampleInputAdrress1">
                        </div>
                        <div class="mb-3">
                            <label for="exampleInputPhone1" class="form-label"><i class="bi bi-telephone-fill"></i>  Phone</label>
                            <input name="phone" type="text" class="form-control" id="exampleInputPhone1">
                        </div>
                        <button type="submit" class="btn btn-primary mb-3">Submit</button>
                    </form>
                    </div>
                    </div>
                    </div>
                    </div>
                </div>

                <div style="text-align: left" class="makeModal">
                    <button type="button" class="" data-bs-toggle="modal" data-bs-target="#makeModal">
                        TO WISH <i class="bi bi-stars"></i>
                    </button>

                    <div class="modal fade" id="makeModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                    <div class="modal-content">
                    <div class="modal-header">
                        <h4><i class="bi bi-stars"></i> Make a wish!</h4>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>

                    <div class="modal-body">
                    <form method="POST" action="{{route('createGift')}}">
                    @csrf

                    <div class="mb-3">
                        <label for="exampleInputName1" class="form-label"><i class="bi bi-gift-fill"></i>  Name</label>
                        <input name="name" type="text" class="form-control" id="exampleInputName1" aria-describedby="namelHelp" required>
                        @error('name')
                            <div class="alert alert-danger" role="alert">
                                name invalid!
                            </div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="exampleInputValue_to_pay" class="form-label"><i class="bi bi-cash"></i>   Value to pay</label>
                        <input name="value_to_pay" type="text" class="form-control" id="exampleInputValue_to_pay" aria-describedby="value_to_pay_Help" required>
                        @error('value_to_pay')
                            <div class="alert alert-danger" role="alert">
                                value to pay invalid!
                            </div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="exampleInputValue_paid" class="form-label"><i class="bi bi-cash"></i>   Value paid </label>
                        <input name="value_paid" type="text" class="form-control" id="exampleInputaValue_paid">
                        @error('value_paid')
                            <div class="alert alert-danger" role="alert">
                                value paid invalid!
                            </div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="exampleInputUser_id1" class="form-label"><i class="bi bi-star-fill"></i> Select Whiser</label>
                        <select name="user_id" class="form-select" aria-label="Default select example">
                            @foreach ($users as $item )
                                <option value="{{$item ->id}}">{{$item ->name}}</option>
                            @endforeach
                        </select>
                    </div>

                    <button type="submit" class="btn btn-primary mb-3">Submit</button>
                    </form>
                    </div>

                    </div>
                    </div>
                    </div>
                </div>
            </div>

        <div>

    </div>
@endsection
