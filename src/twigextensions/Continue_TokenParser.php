<?php
namespace marionnewlevant\twigperversion\twigextensions;

use marionnewlevant\twigperversion\twigextensions\Continue_Node;

/**
 * Twig Perversion
 *
 * @package   TwigPerversion
 * @author    Marion Newlevant
 * @copyright Copyright (c) 2014, Marion Newlevant
 * @license   MIT
 * @link      https://github.com/marionnewlevant/craft-twig_perversion
 */

class Continue_TokenParser extends \Twig_TokenParser
{

	public function parse(\Twig_Token $token)
	{
		$this->parser->getStream()->expect(\Twig_Token::BLOCK_END_TYPE);

		return new Continue_Node(array(), array(), $token->getLine(), $this->getTag());
	}

	public function getTag()
	{
		return 'continue';
	}

}

