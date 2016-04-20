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

require_once('Return_Node.php');

class Return_TokenParser extends \Twig_TokenParser
{

    public function parse(\Twig_Token $token)
    {
        $expr = $this->parser->getExpressionParser()->parseExpression();

        $this->parser->getStream()->expect(\Twig_Token::BLOCK_END_TYPE);

        return new Return_Node($expr, $token->getLine(), $this->getTag());
    }

    public function getTag()
    {
        return 'return';
    }

}

