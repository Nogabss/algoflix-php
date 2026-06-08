<?php

// Mostra uma página de aviso estilizada e encerra a execução.
// Substitui os die() e echo dos controllers por algo bem apresentado.
class Aviso
{
    public static function erro($mensagem, $voltarUrl = null, $voltarTexto = 'Voltar')
    {
        self::mostrar($mensagem, 'erro', $voltarUrl, $voltarTexto);
    }

    public static function sucesso($mensagem, $voltarUrl = null, $voltarTexto = 'Continuar')
    {
        self::mostrar($mensagem, 'sucesso', $voltarUrl, $voltarTexto);
    }

    private static function mostrar($mensagem, $tipo, $voltarUrl, $voltarTexto)
    {
        require __DIR__ . '/../views/aviso.php';
        exit;
    }
}
