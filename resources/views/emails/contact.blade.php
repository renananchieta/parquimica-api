@component('mail::message')
# Uma nova mensagem foi enviada pelo Contato do site Parquimica Indústria.

## - Seguem abaixo os dados do remetente:

**Nome**: {{ $details['body']['nome'] }}

**Telefone**: {{ $details['body']['telefone'] }}

**E-mail**: {{ $details['body']['email'] }}

**Assunto**: {{ $details['body']['assunto'] }}

**Mensagem**:
{{ $details['body']['mensagem'] }}

@endcomponent
