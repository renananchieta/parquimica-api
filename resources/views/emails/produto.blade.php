@component('mail::message')
# Uma nova mensagem foi enviada pela **Página do Produto: {{ $details['body']['produto'] }}** do site Parquimica Indústria.

## Seguem abaixo os dados do remetente:

**Nome**: {{ $details['body']['nome'] }}

**Telefone**: {{ $details['body']['telefone'] }}

**E-mail**: {{ $details['body']['email'] }}

**Mensagem**:
{{ $details['body']['mensagem'] }}

**Produto**: {{ $details['body']['produto'] }}

@endcomponent
