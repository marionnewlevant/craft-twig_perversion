<?php

namespace marionnewlevant\twigperversion\twigextensions;

class Expression_Binary_Spaceship extends \Twig_Node_Expression_Binary
{
    public function operator(\Twig_Compiler $compiler)
    {
        return $compiler->raw('<=>');
    }
}