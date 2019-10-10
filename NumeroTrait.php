<?php
/**
 * @link https://www.rossicampos.com.br
 */
namespace rossicampos\fiscal;

/**
 * @author braulio
 */
trait NumeroTrait
{

    /**
     * Filtra e retorna somente os digitos.
     *
     * @param mixed $numero número para filtrar
     * @return string o número com somente os dígitos
     */
    public static function filtra($numero)
    {
        return mb_ereg_replace('(\D)', '', $numero);
    }
}