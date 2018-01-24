<?php
/**
 * @author Paweł Dziok <pdziok@gmail.com>
 */

namespace Salupro\GraphqlParser\Ast;


class Field
{
    /** @var string */
    public $name;
    /** @var string */
    public $alias;
    /** @var array  */
    public $params;
    /** @var Field[] */
    public $fields;

    public function __construct($name, $alias = null, $params = [], $fields = [])
    {
        $this->name = $name;
        $this->alias = $alias;
        $this->params = $params;
        $this->fields = $fields;
    }
}