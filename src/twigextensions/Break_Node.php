<?php
namespace marionnewlevant\twigperversion\twigextensions;

/**
 * Twig Perversion
 *
 * @package   TwigPerversion
 * @author    Marion Newlevant
 * @copyright Copyright (c) 2014, Marion Newlevant
 * @license   MIT
 * @link      https://github.com/marionnewlevant/craft-twig_perversion
 */

class Break_Node extends \Twig_Node
{
	/**
	* Compiles a Break_Node into PHP.
	*/
	public function compile(\Twig_Compiler $compiler)
	{
		$compiler
			->addDebugInfo($this)
			->write("break;\n");
	}
}
