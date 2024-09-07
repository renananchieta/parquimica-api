<?php

namespace App\Models\Seguranca;

use App\Models\Seguranca\SegAcao;
use App\Models\Seguranca\SegAcaoDB;
use Illuminate\Support\Facades\Route;
use Symfony\Component\Routing\Exception\RouteNotFoundException;

class AcaoSolicitada
{
    static AcaoSolicitada $instancia;
    private ?SegAcao $acao = null;
//    private ?string $telaSolicitante;
//    private string $metodoSolicitado;

    /**
     * AcaoSolicitada constructor.
     */
    private function __construct()
    {
    }

    /**
     * Verifica se a rota existe no banco de dados e configura o resultado nesta classe
     * Se não existir, verifica se rota existe no Laravel e cria
     * Se não existir nem no banco e nem no laravel gera RouteNotFoundException
     * @param string $rota
     * @param string $metodo
     * @return void
     * @throws \Exception
     */
    public function configurar(string $rota, string $metodo): void
    {
//        $this->metodoSolicitado = $metodo;
//        $this->telaSolicitante = $_SERVER['HTTP_X_SEGURANCA_TELA'];

        $oSegAcao = SegAcaoDB::pesquisarEndereco($rota, $metodo);
        if ($oSegAcao) {//rota cadastrada no banco
            $this->setAcao($oSegAcao);

        } else if ($this->existeRotaNoLaravel($rota)) {//rota somente no laravel

            //Cadastra automaticamente a rota no banco de dados
            $this->setAcao(SegAcao::create([
                'nome' => $rota,
                'method' => $metodo,
                'grupo' => 'GeradoAutomaticamente'
            ]));
        } else {
            throw new RouteNotFoundException();
        }
    }

    public function existeRotaNoLaravel(string $rota): bool
    {
        $routeCollection = Route::getRoutes()->getRoutes();
        foreach ($routeCollection as $value) {
            if ($value->uri === $rota) {
                return true;
            }
        }
        return false;
    }

    /**
     * Retorna uma instância de AcaoSolicitada.
     * @return AcaoSolicitada
     */
    public static function getInstance(): AcaoSolicitada
    {
        if (!isset(self::$instancia)) {
            $c = __CLASS__;
            self::$instancia = new $c;
        }
        return self::$instancia;
    }

    /**
     * @return int|null
     */
    public static function id()
    {
        return self::getInstance()->getAcao()?->id;
    }

    /**
     * @return SegAcao|null
     */
    public function getAcao(): ?SegAcao
    {
        return $this->acao;
    }

    /**
     * @param SegAcao|null $acao
     */
    public function setAcao(?SegAcao $acao): void
    {
        $this->acao = $acao;
    }

    /**
     * @return string|null
     */
    public function getNome(): ?string
    {
        return $this->getAcao()?->nome;
    }
}
