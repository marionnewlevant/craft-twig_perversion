<?php
namespace Craft;

/**
 * MN Twig Perversion
 *
 * @package   MnTwigPerversion
 * @author    Marion Newlevant
 * @copyright Copyright (c) 2016, Marion Newlevant
 * @license   MIT
 * @link      https://github.com/marionnewlevant/craft-twig_perversion
 */

class Return_Node extends \Twig_Node
{
    public function __construct(\Twig_Node_Expression $expr, $lineno, $tag = null)
    {
        parent::__construct(array('expr' => $expr), array(), $lineno, $tag);
    }

    /**
    * Compiles a Return_Node into PHP.
    */
    public function compile(\Twig_Compiler $compiler)
    {
        $compiler
            ->addDebugInfo($this)
            ->write('ob_end_clean();\n')
            ->write('return ')
            ->subcompile($this->getNode('expr'))
            ->raw(";\n")
        ;
    }
}
