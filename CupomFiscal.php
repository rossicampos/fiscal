<?php
/**
 * @link https://www.rossicampos.com.br
 */
namespace rossicampos\fiscal;

/**
 * CupomFiscal é a classe responsável do Cupom Fiscal.
 *
 * @author braulio
 */
class CupomFiscal extends AbstractRegistro
{

    /**
     * Formata o número do Cupom Fiscal.
     *
     * @param mixed $numero
     * @return string|NULL
     */
    public static function formata($numero)
    {
        $numero = static::filtra($numero);
        if (static::valida($numero)) {
            return str_pad($numero, 6, '0', STR_PAD_LEFT);
        }
        return null;
    }

    /**
     * Valida o número do Cupom Fiscal.
     *
     * @param mixed $numero o número do Cupom Fiscal
     * @return boolean se o número é válido ou não
     */
    public static function valida($numero)
    {
        $numero = static::filtra($numero);
        if (intval($numero) < 0 || intval($numero) > 999999) {
            return false;
        }
        return true;
    }
}