<?php

use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

function isImagePrefixedWithNumbers($filename) {
    // Verifica se o nome do arquivo começa com números seguidos de um hífen
    return preg_match('/^\d+-/', $filename);
}

function renameProductImages($slug, $productCode)
{
    // Define os diretórios onde as imagens serão buscadas
    $directories = ['img/catalogo', 'img/catalogo/variacoes'];

    // Extrai o nome do produto a partir do slug (primeira parte antes do hífen)
    $productName = explode('-', $slug)[0];

    $count = 0;

    foreach ($directories as $directory) {
        // Caminho completo do diretório
        $fullDirectoryPath = public_path($directory);

        // Verifica se o diretório existe
        if (File::exists($fullDirectoryPath)) {
            // Obtem todos os arquivos do diretório
            $files = File::files($fullDirectoryPath);

            foreach ($files as $file) {
                $filename = $file->getFilename();

                // Verifica se o nome do produto está no nome do arquivo e se o código já não está presente no início
                if (Str::contains($filename, $productName) && !Str::startsWith($filename, $productCode . '-') && !isImagePrefixedWithNumbers($filename)) {
                    // Cria o novo nome do arquivo incluindo o código do produto
                    $newFilename = $productCode . '-' . $filename;

                    // Caminho completo para o arquivo atual e o novo caminho com o nome renomeado
                    $currentPath = $file->getPathname();
                    $newPath = $file->getPath() . '/' . $newFilename;

                    // Renomeia o arquivo
                    File::move($currentPath, $newPath);

                    $count++;

                    echo "Arquivo renomeado para: $count => $newFilename\n";
                }
            }
        } else {
            echo "Diretório não encontrado: $directory\n";
        }
    }
}

function getImagePath($productCode) {

    $directory = public_path('img/catalogo/');
    
    $imagePath = null;

    // Verifica se o diretório existe
    if (file_exists($directory)) {
        // Busca arquivos que começam com o código do produto seguido de um hífen e o nome do produto seguro
        $files = glob($directory . $productCode . '-*.webp');
        
        // Se encontrar pelo menos um arquivo correspondente, define o caminho da imagem
        if (!empty($files)) {
            $imagePath = 'img/catalogo/' . basename($files[0]);
        }
    }

    if (!$imagePath) {
        $imagePath = 'img/embalagem.jpg';
    }

    return asset($imagePath);
}

function allImageProduct($produto)
{
    // Defina o caminho onde as imagens do produto estão armazenadas
    $caminho = public_path('img/catalogo/variacoes');
    
    // Cria um padrão de busca, por exemplo, 'acetilpoll-*'
    $padraoBusca = $caminho . '/' . $produto . '-*';
    
    // Busca todas as imagens no diretório que correspondem ao padrão
    $imagens = glob($padraoBusca);

    // Caso queira retornar apenas os nomes dos arquivos (sem o caminho completo)
    $imagens = array_map(function($imagem) {
        return basename($imagem);  // Retorna apenas o nome do arquivo
    }, $imagens);

    return $imagens;
}

function createSlug($string)
{
    $table = array(
            'Š'=>'S', 'š'=>'s', 'Đ'=>'Dj', 'đ'=>'dj', 'Ž'=>'Z', 'ž'=>'z', 'Č'=>'C', 'č'=>'c', 'Ć'=>'C', 'ć'=>'c',
            'À'=>'A', 'Á'=>'A', 'Â'=>'A', 'Ã'=>'A', 'Ä'=>'A', 'Å'=>'A', 'Æ'=>'A', 'Ç'=>'C', 'È'=>'E', 'É'=>'E',
            'Ê'=>'E', 'Ë'=>'E', 'Ì'=>'I', 'Í'=>'I', 'Î'=>'I', 'Ï'=>'I', 'Ñ'=>'N', 'Ò'=>'O', 'Ó'=>'O', 'Ô'=>'O',
            'Õ'=>'O', 'Ö'=>'O', 'Ø'=>'O', 'Ù'=>'U', 'Ú'=>'U', 'Û'=>'U', 'Ü'=>'U', 'Ý'=>'Y', 'Þ'=>'B', 'ß'=>'Ss',
            'à'=>'a', 'á'=>'a', 'â'=>'a', 'ã'=>'a', 'ä'=>'a', 'å'=>'a', 'æ'=>'a', 'ç'=>'c', 'è'=>'e', 'é'=>'e',
            'ê'=>'e', 'ë'=>'e', 'ì'=>'i', 'í'=>'i', 'î'=>'i', 'ï'=>'i', 'ð'=>'o', 'ñ'=>'n', 'ò'=>'o', 'ó'=>'o',
            'ô'=>'o', 'õ'=>'o', 'ö'=>'o', 'ø'=>'o', 'ù'=>'u', 'ú'=>'u', 'û'=>'u', 'ý'=>'y', 'ý'=>'y', 'þ'=>'b',
            'ÿ'=>'y', 'Ŕ'=>'R', 'ŕ'=>'r',' ' => '-',
            // '/' => '-', ':' => '-', '.' => '-', '!' => "", '?' => "", '"' => "",
            // "'" => "", '+' => '-', '§' => '-', 'º' => '-',
            // '&' => '-', 'ª' => '-', '(' => '-', ')' => '-', '(' => '-',
            // ')' => '-','\\' => '-', '|' => '-', '_' => '-',  ',' => '-',
            // '~' => '-', '^' => '-', '´' => '-', '`' => '-', ';' => '-',
            // '>' => '-', '<' => '-', '@' => '-', '$' => '-', '%' => '-',
            // '*' => '-', '=' => '-', '[' => '-', ']' => '-', '{' => '-',
            //     '}' => '-',  '°' => '-', '¢' => '-', '¬' => '-', '#' => '-',
    );

    // -- Remove duplicated spaces
    $stripped = preg_replace(array('/\s{2,}/', '/[\t\n]/'), ' ', trim($string));

    $productName = strtolower(strtr(stripslashes($stripped), $table)); // Remove caracteres especiais
    
    // -- Returns the slug
    return preg_replace('/[^a-zA-Z0-9_-]/', '', str_replace(' ', '-', $productName));
}

function seoTags($page = null, $data = null, ) {

    // var_dump($data);die;

    switch ($page) {
        case 'empresa':
            $seo = [
                'title' => 'Parquímica | Nossa História e Compromisso com Qualidade',
                'meta_description' => 'Conheça a trajetória da Parquímica desde 1985. Indústria química referência no Brasil, com foco em inovação, sustentabilidade e satisfação dos clientes',
                'meta_keywords' => 'indústria química, produtos químicos, Ananindeua, Pará, região metropolitana de Belém, soluções químicas, produtos biodegradáveis, manutenção industrial, tratamento de água, desengraxantes, desincrustantes, solventes dielétricos, limpeza hospitalar, limpeza naval, tratamento de efluentes, produtos de limpeza geral, produtos automotivos, limpeza de caldeiras, produtos para mineração, reciclagem de embalagens, sustentabilidade industrial, energia renovável, embalagens reduzidas, produtos concentrados, produtos de origem vegetal',
                'url' => env('APP_URL').'/empresa',
                'image' => env('APP_URL').'/img/empresa-parquimica-industria-min.webp',
            ];
            break;
        
        case 'certificacoes':
            $seo = [
                'title' => 'Certificações de Qualidade | Parquímica - Indústria Química Certificada',
                'meta_description' => 'Conheça as certificações que garantem a qualidade e segurança dos produtos da Parquímica. Nossa indústria química é certificada por normas ISO e segue rigorosos padrões ambientais.',
                'meta_keywords' => 'indústria química, produtos químicos, Ananindeua, Pará, região metropolitana de Belém, soluções químicas, produtos biodegradáveis, certificações de produtos químicos, indústria certificada, certificação ISO, segurança em produtos químicos, normas de qualidade, certificações ambientais, certificações industriais',
                'url' => env('APP_URL').'/certificacoes',
                'image' => env('APP_URL').'/img/empresa-parquimica-industria-min.webp',
            ];
            break;

        case 'contato':
            $seo = [
                'title' => 'Entre em Contato com a Parquímica | Soluções Químicas Personalizadas',
                'meta_description' => 'Fale com a Parquímica e conheça nossas soluções químicas. Atendimento personalizado e visitas técnicas em todo o Brasil.',
                'meta_keywords' => 'indústria química, produtos químicos, Ananindeua, Pará, região metropolitana de Belém, soluções químicas, produtos biodegradáveis, manutenção industrial, tratamento de água, desengraxantes, desincrustantes, solventes dielétricos, limpeza hospitalar, limpeza naval, tratamento de efluentes, produtos de limpeza geral, produtos automotivos, limpeza de caldeiras, produtos para mineração, reciclagem de embalagens, sustentabilidade industrial, energia renovável, embalagens reduzidas, produtos concentrados, produtos de origem vegetal, contato',
                'url' => env('APP_URL').'/contato',
                'image' => env('APP_URL').'/img/empresa-parquimica-industria-min.webp',
            ];
            break;

        case 'cotacao':
            $seo = [
                'title' => 'Cotação de Produtos Químicos | Parquímica - Solicite seu Orçamento Online',
                'meta_description' => 'Solicite sua cotação de produtos químicos na Parquímica. Oferecemos cotação rápida e personalizada para indústrias de vários segmentos. Preços competitivos e atendimento especializado.',
                'meta_keywords' => 'indústria química, produtos químicos, Ananindeua, Pará, região metropolitana de Belém, soluções químicas, produtos biodegradáveis, cotação de produtos químicos, solicitar cotação online, pedido de cotação, preço de produtos industriais',
                'url' => env('APP_URL').'/cotacao',
                'image' => env('APP_URL').'/img/empresa-parquimica-industria-min.webp',
            ];
            break;

        case 'produtos':
            $seo = [
                'title' => $data['title'] ?? 'Linhas de Produtos da Parquímica | Soluções Químicas para Diversos Segmentos',
                'meta_description' => $data['description'] ?? 'Descubra as linhas de produtos da Parquímica: Automotiva, Naval, Mineração, Hospitalar, Tratamento de Água, Industrial e mais. Qualidade garantida.',
                'meta_keywords' => $data['meta_keywords'] ?? 'indústria química, produtos químicos, Ananindeua, Pará, região metropolitana de Belém, soluções químicas, produtos biodegradáveis, manutenção industrial, tratamento de água, desengraxantes, desincrustantes, solventes dielétricos, limpeza hospitalar, limpeza naval, tratamento de efluentes, produtos de limpeza geral, produtos automotivos, limpeza de caldeiras, produtos para mineração, reciclagem de embalagens, sustentabilidade industrial, energia renovável, embalagens reduzidas, produtos concentrados, produtos de origem vegetal',
                'url' => $data['url'] ?? env('APP_URL'),
                'image' => env('APP_URL').'/img/industria-min.webp',
            ];
            break;

        case 'produto':
            $seo = [
                'title' => $data['title'] ? $data['title'].' | Parquimica Industria Química' : 'Parquimica Industria Química | Produtos e Soluções Sustentáveis',
                'meta_description' => $data['description'] ? strip_tags($data['description']) : 'Parquímica: Mais de 40 anos de excelência em produtos químicos para os segmentos automotivo, naval, mineração, hospitalar e industrial. Sustentabilidade e qualidade garantida.',
                'meta_keywords' => $data['meta_keywords'] ?? 'indústria química, produtos químicos, Ananindeua, Pará, região metropolitana de Belém, soluções químicas, produtos biodegradáveis, manutenção industrial, tratamento de água, desengraxantes, desincrustantes, solventes dielétricos, limpeza hospitalar, limpeza naval, tratamento de efluentes, produtos de limpeza geral, produtos automotivos, limpeza de caldeiras, produtos para mineração, reciclagem de embalagens, sustentabilidade industrial, energia renovável, embalagens reduzidas, produtos concentrados, produtos de origem vegetal',
                'url' => $data['url'] ?? env('APP_URL'),
                'image' => getImagePath($data['title']),
            ];
            break;
         case 'post':
            $seo = [
                'title' => $data['title'] ? $data['title'].' | Parquimica Industria Química' : 'Parquimica Industria Química | Produtos e Soluções Sustentáveis',
                'meta_description' => $data['description'] ? strip_tags($data['description']) : 'Parquímica: Mais de 40 anos de excelência em produtos químicos para os segmentos automotivo, naval, mineração, hospitalar e industrial. Sustentabilidade e qualidade garantida.',
                'meta_keywords' => $data['meta_keywords'] ?? 'indústria química, produtos químicos, Ananindeua, Pará, região metropolitana de Belém, soluções químicas, produtos biodegradáveis, manutenção industrial, tratamento de água, desengraxantes, desincrustantes, solventes dielétricos, limpeza hospitalar, limpeza naval, tratamento de efluentes, produtos de limpeza geral, produtos automotivos, limpeza de caldeiras, produtos para mineração, reciclagem de embalagens, sustentabilidade industrial, energia renovável, embalagens reduzidas, produtos concentrados, produtos de origem vegetal',
                'url' => $data['url'] ?? env('APP_URL'),
                'image' => env('APP_URL').'/img/industria-min.webp',
            ];
            break;
        
        case 'linha':
            $tags = linha($data['linha']);

            $seo = [
                'title' => $tags['title'],
                'meta_description' => $tags['description'],
                'meta_keywords' => 'indústria química, produtos químicos, Ananindeua, Pará, região metropolitana de Belém, soluções químicas, produtos biodegradáveis, manutenção industrial, tratamento de água, desengraxantes, desincrustantes, solventes dielétricos, limpeza hospitalar, limpeza naval, tratamento de efluentes, produtos de limpeza geral, produtos automotivos, limpeza de caldeiras, produtos para mineração, reciclagem de embalagens, sustentabilidade industrial, energia renovável, embalagens reduzidas, produtos concentrados, produtos de origem vegetal',
                'url' => $data['url'] ?? env('APP_URL'),
                'image' => env('APP_URL').'/img/linhas/'.$data['linha'].'-min.webp',
            ];
            break;
        case 'pesquisa':

            if (@$data['pesquisa']['termo']) {
                $filtro = $data['pesquisa']['termo'];
            } elseif(@$data['pesquisa']['linhas']) {
                $filtro = $data['pesquisa']['linhas'];
            } elseif(@$data['pesquisa']['funcoes']) {
                $filtro = $data['pesquisa']['funcoes'];
            }
            $seo = [
                'title' => 'Produtos Químicos | Filtro por '.$filtro.' | Parquímica',
                'meta_description' => 'Encontre facilmente os produtos químicos da Parquímica. Filtre por nome ou linha para descobrir soluções personalizadas em Limpeza, Manutenção, Automotiva e muito mais.',
                'meta_keywords' => 'indústria química, produtos químicos, Ananindeua, Pará, região metropolitana de Belém, soluções químicas, produtos biodegradáveis, manutenção industrial, tratamento de água, desengraxantes, desincrustantes, solventes dielétricos, limpeza hospitalar, limpeza naval, tratamento de efluentes, produtos de limpeza geral, produtos automotivos, limpeza de caldeiras, produtos para mineração, reciclagem de embalagens, sustentabilidade industrial, energia renovável, embalagens reduzidas, produtos concentrados, produtos de origem vegetal',
                'url' => $data['url'] ?? env('APP_URL'),
                'image' => env('APP_URL').'/img/industria-min.webp',
            ];
            break;
        default:
            $seo = [
                'title' => 'Parquimica Industria Química | Produtos e Soluções Sustentáveis',
                'meta_description' => 'Parquímica: Mais de 40 anos de excelência em produtos químicos para os segmentos automotivo, naval, mineração, hospitalar e industrial. Sustentabilidade e qualidade garantida.',
                'meta_keywords' => 'indústria química, produtos químicos, Ananindeua, Pará, região metropolitana de Belém, soluções químicas, produtos biodegradáveis, manutenção industrial, tratamento de água, desengraxantes, desincrustantes, solventes dielétricos, limpeza hospitalar, limpeza naval, tratamento de efluentes, produtos de limpeza geral, produtos automotivos, limpeza de caldeiras, produtos para mineração, reciclagem de embalagens, sustentabilidade industrial, energia renovável, embalagens reduzidas, produtos concentrados, produtos de origem vegetal',
                'url' => env('APP_URL'),
                'image' => env('APP_URL').'/img/parquimica-favicon.png',
            ];
            break;
    }

    return $seo;
}

function departamento($id)
{
    switch ($id) {
        case 1:
            $para = 'vendas@parquimica.com.br';
            $departamento = 'Setor Comercial';
            break;
        case 2: // RH
        case 5: // Reclamações
            $para = 'rh@parquimica.com.br';
            $departamento = 'Setor de RH';
            break;
        case 3:
            $para = 'compras@parquimica.com.br';
            $departamento = 'Setor de Compras';
            break;
        case 4:
            $para = 'cobranca@parquimica.com.br';
            $departamento = 'Setor Financeiro';
            break;
        
        default:
            $para = 'site@parquimica.com.br';
            $departamento = 'Site';
            break;
    }

    return array('para' => $para, 'departamento' => $departamento);
}

function linha($linha) {
    $tags = array();
    switch ($linha) {
        case 'naval':
            $tags['title'] = 'Produtos Químicos para Manutenção Naval | Parquímica';
            $tags['description'] = 'A Linha Naval da Parquímica. Soluções químicas de alta eficiência para manutenção, limpeza e proteção de embarcações. Produtos sustentáveis para o setor naval.';
            break;
        
        case 'automotiva':
            $tags['title'] = 'Produtos para Limpeza e Manutenção Automotiva | Parquímica';
            $tags['description'] = 'A Linha Automotiva da Parquímica com produtos de limpeza e manutenção de veículos. Soluções ecológicas e eficientes para cuidar do seu automóvel.';
            break;
        
       case 'manutencao-industrial':
            $tags['title'] = 'Produtos Químicos para Manutenção Industrial | Parquímica';
            $tags['description'] = 'A Linha Manutenção Industrial da Parquímica oferece soluções inovadoras e ecológicas para otimizar processos e preservar o ambiente industrial com segurança.';
            break;
        
       case 'lavanderia':
            $tags['title'] = 'Produtos para Lavanderia Industrial e Comercial | Parquímica';
            $tags['description'] =  'A Linha Lavanderia da Parquímica, com produtos eficientes para limpeza e higienização. Produtos químicos sustentáveis para lavanderias industriais e comerciais.';
            break;
        
       case 'limpeza-geral':
            $tags['title'] = 'Produtos Químicos para Limpeza Geral | Parquímica';
            $tags['description'] =  'A Linha Limpeza Geral da Parquímica, com produtos desenvolvidos para limpeza eficiente e segura em diversos ambientes. Sustentabilidade e eficácia em um só lugar.';
            break;
        
       case 'tratamento-de-agua':
            $tags['title'] = 'Produtos Químicos para Tratamento de Água | Parquímica';
            $tags['description'] =  'A Linha Tratamento de Água da Parquímica. Produtos eficientes e sustentáveis para purificação e controle de qualidade da água em diversos processos industriais e municipais.';
            break;
        
       case 'hospitalar':
            $tags['title'] = 'Produtos Químicos para Higienização Hospitalar | Parquímica';
            $tags['description'] =  'A Linha Hospitalar da Parquímica oferece soluções químicas avançadas para desinfecção e higienização de ambientes médicos, assegurando um padrão de limpeza hospitalar com eficácia.';
            break;
        
       case 'mineracao':
            $tags['title'] = 'Soluções Químicas para Mineração Sustentável | Parquímica';
            $tags['description'] =  'A Linha Mineração da Parquímica, com produtos desenvolvidos para otimizar processos de extração e refino de minerais. Soluções químicas seguras e sustentáveis para a indústria de mineração.';
            break;
        
       default:
            $tags['title'] = 'Linhas de Produtos Químicas Eficientes | Parquímica';
            $tags['description'] =  'As linhas de produtos da Parquímica são soluções ecológicas, inovadoras e sustentáveis, desenvolvidas para atender às necessidades da sua indústria.';
            break;
    }

    return $tags;
}
