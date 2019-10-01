<?php
/**
 * @link https://www.rossicampos.com.br
 */
namespace rossicampos\fiscal;

/**
 * Cnpj é a classe responsável do CNPJ
 *
 * @author braulio
 */
class Cnpj extends BaseObject
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
     * Formata o número do CNPJ.
     *
     * @param string $numero o número do CNPJ
     * @return string|null o número do CNPJ, formatado
     */
    public static function formata($numero)
    {
        if (static::valida($numero)) {
            $numero = substr_replace($numero, '.', 2, 0);
            $numero = substr_replace($numero, '.', 6, 0);
            $numero = substr_replace($numero, '/', 10, 0);
            return substr_replace($numero, '-', 15, 0);
        }
        return null;
    }

    /**
     * Valida o número do CNPJ.
     *
     * @param string $numero o número do CNPJ
     * @return boolean se o CNPJ é válido ou não
     */
    public static function valida($numero)
    {
        $numero = static::filtra($numero);
        if (strlen($numero) != 14) {
            return false;
        } else {
            $soma1 = ($numero[0] * 5) + ($numero[1] * 4) + ($numero[2] * 3) + ($numero[3] * 2) + ($numero[4] * 9) + ($numero[5] * 8) + ($numero[6] * 7) + ($numero[7] * 6) + ($numero[8] * 5) + ($numero[9] * 4) + ($numero[10] * 3) + ($numero[11] * 2);
            $resto1 = $soma1 % 11;
            $digito1 = ($resto1 < 2) ? 0 : (11 - $resto1);
            $soma2 = ($numero[0] * 6) + ($numero[1] * 5) + ($numero[2] * 4) + ($numero[3] * 3) + ($numero[4] * 2) + ($numero[5] * 9) + ($numero[6] * 8) + ($numero[7] * 7) + ($numero[8] * 6) + ($numero[9] * 5) + ($numero[10] * 4) + ($numero[11] * 3) + ($numero[12] * 2);
            $resto2 = $soma2 % 11;
            $digito2 = ($resto2 < 2) ? 0 : (11 - $resto2);
            if (($numero[12] != $digito1) || ($numero[13] != $digito2)) {
                return false;
            }
        }
        return true;
    }
}