<?php
/**
 * @link https://www.rossicampos.com.br
 */
namespace rossicampos\fiscal;

/**
 * Cpf é a classe responsável do CPF
 *
 * @author braulio
 */
class Cpf extends AbstractRegistro
{

    /**
     * Forma o número do CPF.
     *
     * @param string $numero o número do CPF
     * @return mixed|NULL o número do CPF, formatado
     */
    public static function formata($numero)
    {
        if (! empty($numero) && strlen($numero) == 11) {
            $numero = substr_replace($numero, '.', 3, 0);
            $numero = substr_replace($numero, '.', 7, 0);
            return substr_replace($numero, '-', 11, 0);
        }
        return null;
    }

    /**
     * Valida o número do CPF.
     *
     * @param string $numero o número do CPF
     * @return boolean se o CPF é válido ou não
     */
    public static function valida($numero)
    {
        $numero = static::filtra($numero);
        if (strlen($numero) == 11) {
            $numeros = substr($numero, 0, 9);
            $digitos = substr($numero, 9);
            $soma = 0;
            for ($i = 10; $i > 1; $i --) {
                $soma += $numeros[10 - $i] * $i;
            }
            $resultado = (($soma % 11) < 2) ? 0 : (11 - ($soma % 11));
            if ($resultado != $digitos[0]) {
                return false;
            }
            $numeros = substr($numero, 0, 10);
            $soma = 0;
            for ($i = 11; $i > 1; $i --) {
                $soma += $numeros[11 - $i] * $i;
            }
            $resultado = (($soma % 11) < 2) ? 0 : (11 - ($soma % 11));
            if ($resultado != $digitos[1]) {
                return false;
            }
            return true;
        }
        return false;
    }
}