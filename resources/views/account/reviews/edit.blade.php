@extends('layout.app')

@section('main')
<div class="container">
    <div class="row my-5">
        <!-- Sidebar Section -->
        <div class="col-md-3">
            @include('layout.sidebar')
        </div>

        <!-- Main Content Section -->
        <div class="col-md-9">
            <div class="card border-0 shadow">
                <div class="card-header text-white">
                    Edit Reviews
                </div>
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
@endsection
