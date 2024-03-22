<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ResetPassword</title>
</head>
<body>
    <form action="{{ route('update.password') }}" method="post">
        @csrf
        <label for="pass">Nova Senha</label>
        <input type="text" name="password" id="pass">
        <input type="hidden" name="user_id" value="{{ $id }}">
        <input type="submit" value="Salvar">
    </form>
</body>
</html>