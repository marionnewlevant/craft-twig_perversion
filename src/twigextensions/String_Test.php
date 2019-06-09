<?php
namespace marionnewlevant\twigperversion\twigextensions;

class String_Test extends \Twig_Node_Expression_Test
{
  public function compile(\Twig_Compiler $compiler)
  {
    $compiler->raw('is_string(')->subcompile($this->getNode('node'))->raw(')');
  }
}
