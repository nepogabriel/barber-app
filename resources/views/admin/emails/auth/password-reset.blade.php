<x-mail::message>
# Olá!

Você está recebendo este e-mail porque recebemos um pedido de redefinição de senha para sua conta.

<x-mail::button :url="$resetUrl">
Redefinir Senha
</x-mail::button>

Este link de redefinição de senha irá expirar em {{ config('auth.passwords.'.config('auth.defaults.passwords').'.expire') }} minutos.

Se você não solicitou uma redefinição de senha, nenhuma ação adicional é necessária.

Obrigado,<br>
{{ config('app.name') }}
</x-mail::message>