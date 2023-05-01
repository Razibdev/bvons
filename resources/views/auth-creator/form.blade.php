<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Password please</title>
</head>
<body>
    @if($errors->any())
        @foreach ($errors->all() as $error)
            <p style="color: red" class="mb-0">{{ $error }}<a  class="alert-link" href="javascript:void(0)"></a>!</p>
        @endforeach
    @endif
<form action="{{ route('auth-creator-validate') }}" method="post">
    @csrf
    password: <input type="text" name="password">
    <button type="submit">Submit</button>
</form>
</body>
</html>
