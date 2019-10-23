<?php
/**
 *
 * @link https://www.rossicampos.com.br
 */
namespace rossicampos\fiscal;

/**
 * Cpf é a classe responsável do CPF
 *
 * @author braulio
 */
class Cpf extends BaseObject
{
    use NumeroTrait;

    const BLACK_LIST = [
        '00000000000',
        '11111111111',
        '22222222222',
        '33333333333',
        '44444444444',
        '55555555555',
        '66666666666',
        '77777777777',
        '88888888888',
        '99999999999'
    ];

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
        $numero = str_pad(substr($numero, 0, 11), 11, '0', STR_PAD_LEFT);
        if (in_array($numero, self::BLACK_LIST)) {
            return false;
        }
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
}