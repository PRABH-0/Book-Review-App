<!doctype html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Book Review App</title>
        <link rel="stylesheet" href="https://unpkg.com/bootstrap@5.3.2/dist/css/bootstrap.min.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" integrity="sha512-9usAa10IRO0HhonpyAIVpjrylPvoDwiPUiKdWk5t3PyolY1cOd4DSE0Ga+ri4AuTroPR5aQvXU9xC6qOPnzFeg==" crossorigin="anonymous" referrerpolicy="no-referrer"/>

        <style>
            body {
                background-color: #121212;
                color: #f5f5f5;
            }
            .header {
                background-color: #1c1c1c;
                padding: 1rem 0;
            }
            .header a {
                color: #f5f5f5;
                font-weight: bold;
            }
            .header a:hover {
                text-decoration: underline;
            }
            .card {
                background-color: #1c1c1c;
                color: #f5f5f5;
            }
            .form-control {
                background-color: #2c2c2c;
                color: #f5f5f5;
                border: 1px solid #444;
            }
            .form-control:focus {
                background-color: #2c2c2c;
                color: #f5f5f5;
                border-color: #6200ee;
                box-shadow: 0 0 0 0.25rem rgba(98, 0, 238, 0.25);
            }
            .form-control::placeholder {
                color: #b3b3b3;
            }
            .form-label {
                color: #b3b3b3;
            }
            .btn-primary {
                background-color: #6200ee;
                border-color: #6200ee;
            }
            .btn-primary:hover {
                background-color: #7c4dff;
                border-color: #7c4dff;
            }
            hr {
                border-color: #444;
            }
            .link-secondary {
                color: #b3b3b3;
            }
            .link-secondary:hover {
                color: #fff;
                text-decoration: underline;
            }
        
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
    </head>
    <body>
        <div class="container-fluid shadow-lg header">
            <div class="container">
                <div class="d-flex justify-content-between">
                    <h1 class="text-center"><a href="{{ route('home') }}" class="h3 text-decoration-none">Book Review App</a></h1>
                    <div class="d-flex align-items-center navigation">
                        @if(Auth::check())
                        <a href="{{ route('account.profile') }}" class="text-white">My Account</a>
                        @else
                            <a href="{{ route('account.login') }}" class="text-white">Login</a>
                            <a href="{{ route('account.register') }}" class="ps-2" class="text-white">Register</a>
                        @endif
                        
                    </div>
                </div>
            </div>
        </div>
        @yield('main')
        <script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
        @yield('script')
        
    </body>
</html>
