<img src="{{ asset('assets/images/logo-login.png') }}" height="50%" style="opacity: .8">

<p>Buenos días estimado usuario {{ $user->name }}.</p>

<p>La restauración de su contraseña ha sido todo un éxito. Le informamos que su nueva contraseña es
    <b>{{ $password }}</b>
</p>

<p>Por favor es importante que después de una restauración de contraseña, tengan la disposición de cambiarla a
    preferencia.</p>
