@extends('layout.app')

@section('main')
<style>
    .card-header {
        background-color: #6a0dad; /* Violet color */
        color: white;
        font-weight: bold;
    }

    .card-body.sidebar ul.nav {
        list-style: none;
        padding: 0;
        margin: 0;
    }

    .card-body.sidebar ul.nav li.nav-item {
        margin-bottom: 10px;
    }

    .card-body.sidebar ul.nav li.nav-item a {
        text-decoration: none;
        color: white; /* Violet color */
        font-weight: 500;
        display: block;
        padding: 8px;
        border-radius: 4px;
        transition: all 0.3s ease-in-out;
    }

    .card-body.sidebar ul.nav li.nav-item a:hover {
        background-color: #6a0dad; /* Violet hover effect */
        color: white;
    }

    .form-control {
        border: 1px solid #ddd;
        border-radius: 4px;
        padding: 10px;
        font-size: 14px;
    }

    .form-control:focus {
        border-color: #6a0dad; /* Violet border on focus */
        box-shadow: 0 0 5px rgba(106, 13, 173, 0.5);
    }

    button.btn-primary {
        background-color: #6a0dad; /* Violet button */
        border-color: #6a0dad;
        padding: 10px 20px;
        font-size: 16px;
    }

    button.btn-primary:hover {
        background-color: #4a0864; /* Darker violet on hover */
        border-color: #4a0864;
    }

    .img-fluid.rounded-circle {
        width: 100px;
        height: 100px;
        object-fit: cover;
    }

    .card-body img {
        max-width: 150px;
        max-height: 150px;
        object-fit: cover;
        border: 1px solid #ddd;
        border-radius: 8px;
    }

    .btn-primary {
        background-color: #6a0dad;
        color: white;
        border-radius: 4px;
    }

    .btn-primary:hover {
        background-color: #4a0864;
    }

    .text-white {
        background-color: #6a0dad;
        padding: 10px;
        border-radius: 5px;
    }
</style>

<div class="container">
    <div class="row my-5">
        <div class="col-md-3">
            @include('layout.sidebar')
        </div>
        <div class="col-md-9">

            @include('layout.message')

            <div class="card border-0 shadow">
                <div class="card-header text-white">
                    Profile
                </div>
                <div class="card-body">
                    <form action="{{ route('account.updateProfile') }}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="mb-3">
                            <label for="name" class="form-label">Name</label>
                            <input 
                                type="text" 
                                value="{{ old('name', $user->name) }}" 
                                class="form-control @error('name') is-invalid @enderror" 
                                placeholder="Name" 
                                name="name" 
                                id="name"
                            />
                            @error('name')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input 
                                type="text" 
                                value="{{ old('email', $user->email) }}" 
                                class="form-control @error('email') is-invalid @enderror" 
                                placeholder="Email" 
                                name="email" 
                                id="email"
                            />
                            @error('email')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="image" class="form-label">Image</label>
                            <input 
                                type="file" 
                                name="image" 
                                id="image" 
                                class="form-control @error('image') is-invalid @enderror "
                            />
                            @error('image')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror

                            @if(Auth::user()->image != "")
                                <img src="{{ asset('uploads/profile/'.Auth::user()->image) }}" class="img-fluid mt-4" alt="Profile Picture">                            
                            @endif

                        </div>   
                        <button type="submit" class="btn btn-primary mt-2">Update</button>
                    </form>

                </div>
            </div>                
        </div>
    </div>       
</div>
@endsection
