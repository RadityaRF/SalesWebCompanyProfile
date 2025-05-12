<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Admin Login</title>
  <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
  <div class="container d-flex justify-content-center align-items-center" style="height:100vh">
    <div class="card p-4" style="width: 350px">
      <h4 class="card-title mb-3 text-center">Admin Login</h4>

      <form method="POST" action="{{ route('admin.login.submit') }}">
        @csrf

        <div class="form-group">
          <label>Email</label>
          <input type="email"
                 name="email"
                 class="form-control @error('email') is-invalid @enderror"
                 value="{{ old('email') }}"
                 required autofocus>
          @error('email')
            <span class="invalid-feedback">{{ $message }}</span>
          @enderror
        </div>

        <div class="form-group">
          <label>Password</label>
          <input type="password"
                 name="password"
                 class="form-control @error('password') is-invalid @enderror"
                 required>
          @error('password')
            <span class="invalid-feedback">{{ $message }}</span>
          @enderror
        </div>

        <button type="submit" class="btn btn-primary btn-block">Login</button>
      </form>
    </div>
  </div>
</body>
</html>
