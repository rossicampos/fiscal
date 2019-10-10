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
class CupomFiscal extends BaseObject
{
    use NumeroTrait;

    /** @var string número do registro */
    protected $_numero;

    /**
     * Constructor.
     *
     * @param mixed $numero número do registro
     */
    public function __construct($numero)
    {
        static::setNumero($numero);
    }

    /**
     * Retorna o número de registro.
     *
     * @return string o número do registro
     */
    public function getNumero()
    {
        return $this->_numero;
    }

    /**
     * Define o número de registro.
     *
     * @param mixed $numero
     */
    public function setNumero($numero)
    {
        $numero = static::filtra($numero);
        if (static::valida($numero)) {
            $this->_numero = $numero;
        }
    }

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