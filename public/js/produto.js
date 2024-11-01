// document.addEventListener('DOMContentLoaded', function () {
//     document.getElementById('filtro-produto-form').addEventListener('submit', function(event) {
//         event.preventDefault();

//         // Pega os valores dos campos
//         const termo = document.getElementById('termo').value;
//         const linha = document.getElementById('linhas').value;
//         const funcao = document.getElementById('funcoes').value;

//         let baseUrl = "{{ url('/produtos') }}";

//         // Constrói a URL dinamicamente
//         let url = 'produtos' + (linha ? `/${linha}` : '') + (funcao ? `/${funcao}` : '') + (termo ? `/${termo}` : '') ;

//         // Redireciona para a URL construída
//         window.location.href = url;
//     });
// });