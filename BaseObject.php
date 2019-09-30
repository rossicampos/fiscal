<?php
/**
 * @link https://www.rossicampos.com.br
 */
namespace rossicampos\fiscal;

/**
 * BaseObject é a classe base que implementa o recurso de propriedade.
 *
 * @author braulio
 */
class BaseObject
{

    /**
     * Retorna o valor da propriedade.
     *
     * @param string $name o nome da propriedade
     * @return mixed o valor da propriedade
     */
    public function __get($name)
    {
        $getter = 'get' . $name;
        if (method_exists($this, $getter)) {
            return $this->$getter();
        }
    }

    /**
     * Define o valor da propriedade.
     *
     * @param string $name o nome da propriedade
     * @param mixed $value o valor da propriedade
     */
    public function __set($name, $value)
    {
        $setter = 'set' . $name;
        if (method_exists($this, $setter)) {
            $this->$setter($value);
        }
    }
}