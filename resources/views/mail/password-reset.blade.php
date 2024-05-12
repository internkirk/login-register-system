<x-mail::message>
# Reset Password

Dear {{ $user->name }} please press below button for resetting your password

<x-mail::button :url="$url">
Reset Password
</x-mail::button>

Thanks,<br>
{{ config('app.name') }}
</x-mail::message>