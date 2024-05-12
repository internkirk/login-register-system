<x-mail::message>
# Verify your email

Dear {{ $user->name }} please verify your email.

<x-mail::button :url="$url">
Verify
</x-mail::button>

Thanks,<br>
{{ config('app.name') }}
</x-mail::message>
