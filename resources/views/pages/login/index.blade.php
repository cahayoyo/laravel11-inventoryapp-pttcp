<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Login</title>
    <link rel="stylesheet" href="{{ asset('asset/css/styleLogin.css') }}" />
    {{-- sweetalert --}}
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>

<body>
    {{-- sweetalert popup success --}}
    @if (session('success'))
        <script>
            Swal.fire({
                title: "Success",
                text: "{{ session('success') }}",
                icon: "success"
            });
        </script>
    @endif
    {{-- sweetalert popup error --}}
    @if (session('error'))
        <script>
            Swal.fire({
                title: "Error",
                text: "{{ session('error') }}",
                icon: "error"
            });
        </script>
    @endif
    <div class="login-form">
        <h1>Inventory Workshop PT Tri Cipta Patriot</h1>
        <div class="container">
            <div class="main">
                <div class="content">
                    <h2>Log In</h2>
                    <form action="/login" method="post">
                        @csrf
                        @method('POST')
                        <input type="email" name="email" id="email" placeholder="User Email" required
                            autofocus="" class="@error('email') is-invalid @enderror" value="{{ old('email') }}" />
                        @error('email')
                            <span class="invalid-feedback">{{ $message }}</span>
                        @enderror
                        <input type="password" name="password" id="password" placeholder="User Password" required
                            autofocus="" class="@error('email') is-invalid @enderror" value="{{ old('email') }}" />
                        @error('password')
                            <span class="invalid-feedback">{{ $message }}</span>
                        @enderror
                        <button class="btn" type="submit">Login</button>
                    </form>
                    <p class="account">
                        If you face any problem during login, Contact <a href="#"> Super Admin</a>
                    </p>
                </div>
                <div class="form-img">
                    <img src="{{ asset('asset/img/LogoTCPBiru.png') }}" alt="Logo Tri Cipta Patriot Biru" />
                </div>
            </div>
        </div>
    </div>
</body>

</html>
