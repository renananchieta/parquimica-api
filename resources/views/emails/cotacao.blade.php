@component('mail::message')
# Uma nova mensagem foi enviada pelo **Faça sua Cotação** do site Parquimica Indústria.

## - Seguem abaixo os dados do remetente:

**Nome**: {{ $details['body']['nome'] }}

**Telefone**: {{ $details['body']['telefone'] }}

**E-mail**: {{ $details['body']['email'] }}

## - Dados da Empresa:

**Nome da Empresa**: {{ $details['body']['empresa'] }}

**CNPJ**: {{ $details['body']['cnpj'] }}

## - Cotação:

**Linha**: {{ $details['body']['linhas'] }}

**Produto**: {{ $details['body']['produtos'] }}

**Volume**: {{ $details['body']['volume'] }}

**Finalidade**:
{{ $details['body']['finalidade'] }}

@endcomponent
