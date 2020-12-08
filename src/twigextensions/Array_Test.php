<?php
namespace marionnewlevant\twigperversion\twigextensions;

class Array_Test extends \Twig_Node_Expression_Test
{
  public function compile(\Twig_Compiler $compiler)
  {
    $compiler->raw('is_array(')->subcompile($this->getNode('node'))->raw(')');
  }
}
