<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration Form</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <style>
        /* Custom CSS adjustments here */
    </style>
</head>
<body>
    <nav style="background-color: #f8f9fa; position: relative; top: -100px; width:100%; text-align: center;">
        <a href="{{ route('index') }}" style="font-size: 40px; text-decoration: none; color:#000">Hello</a>
    </nav>

    <div class="profile-container">
        <form method="POST" id="registerForm" action="{{ route('registerr') }}">
            @csrf

            <div class="form-header">
                <h2><i class="fa-solid fa-building"></i> Register</h2>
            </div>

            <div class="form-row">
                <div class="form-group">
                    <label class="form-label">Full Name:</label>
                    <div class="input-group">
                        <span class="input-group-text"><i class="fas fa-user"></i></span>
                        <input name="name" type="text" id="name" class="form-control">
                    </div>
                    @error('name') <small class="text-danger">{{ $message }}</small> @enderror
                </div>

                <div class="form-group">
                    <label class="form-label">Email:</label>
                    <div class="input-group">
                        <span class="input-group-text"><i class="fas fa-envelope"></i></span>
                        <input name="email" type="email" id="email" class="form-control">
                    </div>
                    @error('email') <small class="text-danger">{{ $message }}</small> @enderror
                </div>

                <div class="form-group">
                    <label class="form-label">Phone Number:</label>
                    <div class="input-group">
                        <span class="input-group-text"><i class="fas fa-phone-alt"></i></span>
                        <input name="phone" type="tel" id="phone" class="form-control">
                    </div>
                    @error('phone') <small class="text-danger">{{ $message }}</small> @enderror
                </div>
            </div>

            <div class="form-row">
                <div class="form-group">
                    <label class="form-label">Password:</label>
                    <div class="input-group">
                        <span class="input-group-text"><i class="fas fa-lock"></i></span>
                        <input name="password" type="password" id="password" class="form-control">
                    </div>
                    @error('password') <small class="text-danger">{{ $message }}</small> @enderror
                </div>

                <div class="form-group">
                    <label class="form-label">Confirm Password:</label>
                    <div class="input-group">
                        <span class="input-group-text"><i class="fas fa-lock"></i></span>
                        <input name="password_confirmation" type="password" id="confirmPassword" class="form-control">
                    </div>
                    @error('password_confirmation') <small class="text-danger">{{ $message }}</small> @enderror
                </div>

                <div class="form-group">
                    <label class="form-label">Address:</label>
                    <div class="input-group">
                        <span class="input-group-text"><i class="fas fa-home"></i></span>
                        <input name="address" type="text" id="address" class="form-control">
                    </div>
                    @error('address') <small class="text-danger">{{ $message }}</small> @enderror
                </div>
            </div>

            <div class="input-group mt-3">
                <button style="background-color: #6fa007; color: white;" type="submit" class="btn w-100">
                    <i class="fas fa-user-plus"></i> Register
                </button>
            </div>

            <p class="text-center mt-3">Already have an account? <a href="" class="text-login">Login</a></p>
        </form>
    </div>

    <footer>
        <div class="container grid">
            <div class="box">
                <a href="#">Company History</a>
                <a href="#">About Us</a>
                {{-- <a href="{{ route('contact-us') }}">Contact Us</a> --}}
                <a href="#">Services</a>
                <a href="#">Privacy Policy</a>
            </div>
        </div>
    </footer>

    <script src="{{ asset('js/register/register.js') }}"></script>
</body>
</html>
