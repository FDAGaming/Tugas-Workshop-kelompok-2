@extends('home.layout.main')

@section('konten')
    <div class="site-section">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-6">
                    <h2 class="text-center mb-4">Login</h2>
                    @if (session('error'))
                        <div class="alert alert-danger">
                            {{ session('error') }}
                        </div>
                    @endif

                    <form action="{{ route('login') }}" method="POST">
                        @csrf

                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="email" name="email" autocomplete="off" id="email" class="form-control"
                                value="{{ old('email') }}" required>
                            @error('email')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="password">Password</label>
                            <input type="password" name="password" id="password" class="form-control" required>
                            @error('password')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <button type="submit" class="btn btn-primary btn-block">Login</button>
                    </form>

                    <div class="mt-3 text-center">
                        <p>Belum punya akun? <a href="{{ route('register') }}">Daftar Sekarang</a></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
