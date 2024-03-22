<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Resetar Email</title>
</head>
<body>
    <p>Clique no botão Redefinir abaixo e altere sua senha.</p>
    <form method="POST" action="{{ route('reset.password')}}" target="_blank">
        @csrf
        <!-- outros campos do formulário -->
        <input type="hidden" name="user_id" value="{{ $user_id }}">
    <button type="submit">Redefinir</button>
    </form>
</body>
</html>