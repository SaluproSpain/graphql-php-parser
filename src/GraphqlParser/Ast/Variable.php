<?php
/**
 * @author Paweł Dziok <pdziok@gmail.com>
 */

namespace Salupro\GraphqlParser\Ast;

class Variable {

    public $name;

    public function __construct($name)
    {
        $this->name = $name;
    }


}