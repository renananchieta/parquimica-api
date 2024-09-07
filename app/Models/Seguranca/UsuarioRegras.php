<?php

namespace App\Models\Seguranca;

use App\Models\Seguranca\Usuario;

class UsuarioRegras
{
    public static function cadastrarUsuario($data)
    {
        //Cadastra Usuário
        $usuario = Usuario::create($data['usuario']);

        //Cadastra os perfis do usuário
        foreach($data['perfil'] as $perfil) {
            $perfilUsuario = new SegPerfilUsuario(); 
            $perfilUsuario->usuario_id = $usuario->id;
            $perfilUsuario->perfil_id = $perfil['id'];
            $perfilUsuario->save();
        }

        return $usuario;
    }

    public static function atualizarUsuario($data, $usuario)
    {
        $p = $data['usuario'];
        $j = $data['perfil'];
        
        //Alterar Usuário
        $usuario->update($p);
        
        //Cadastra os perfis do usuário
        SegPerfilUsuario::where('usuario_id', $usuario->id)->delete();

        foreach($j as $perfil){
            $perfilUsuario = new SegPerfilUsuario(); 
            $perfilUsuario->usuario_id = $usuario->id;
            $perfilUsuario->perfil_id = $perfil['id'];
            $perfilUsuario->save();
        }
        
        $usuario->fresh();

        return $usuario;
    }

    public static function atualizarUsuarioDadosPessoais($data, $usuario)
    {
        $p = $data['usuario'];
        
        //Alterar Usuário
        $usuario->update($p);
        $usuario->fresh();

        return $usuario;
    }
}
