<?php
namespace marionnewlevant\twigperversion\twigextensions;

use marionnewlevant\twigperversion\twigextensions\Return_Node;
/**
 * Twig Perversion
 *
 * @package   TwigPerversion
 * @author    Marion Newlevant
 * @copyright Copyright (c) 2016, Marion Newlevant
 * @license   MIT
 * @link      https://github.com/marionnewlevant/craft-twig_perversion
 */

class Return_TokenParser extends \Twig_TokenParser
{

	public function parse(\Twig_Token $token)
	{
		$stream = $this->parser->getStream(); // entire stream of tokens
		$nodes = array();

		if (!$stream->test(\Twig_Token::BLOCK_END_TYPE))
		{
			$nodes['expr'] = $this->parser->getExpressionParser()->parseExpression();
		}

		$stream->expect(\Twig_Token::BLOCK_END_TYPE);

		return new Return_Node($nodes, array(), $token->getLine(), $this->getTag());
	}

	public function getTag()
	{
		return 'return';
	}

}

