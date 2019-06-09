<?php
namespace marionnewlevant\twigperversion\twigextensions;

/**
 * While loop
 *
 * Usage:
 *  {% while <condition> %}
 *     <!-- loop body -->
 *  {% endwhile %}
 *
 * Example:
 *  {% while test_var == 'true' %}
 *  {% endwhile %}
 *
 * @package   TwigPerversion
 * @author    Marion Newlevant
 * @copyright Copyright (c) 2019, Marion Newlevant
 * @license   MIT
 * @link      https://github.com/marionnewlevant/craft-twig_perversion
 *
 */
class While_TokenParser extends \Twig_TokenParser
{
    /**
     * Parses a token and returns a node.
     *
     * @param Twig_Token $token A Twig_Token instance
     *
     * @return Twig_NodeInterface A Twig_NodeInterface instance
     */
    public function parse(\Twig_Token $token)
    {
        $lineno = $token->getLine();
        /** @var Parser $parser */
        $parser = $this->parser;
        $stream = $parser->getStream();
        $condition = $parser->getExpressionParser()->parseExpression();
        $stream->expect(\Twig_Token::BLOCK_END_TYPE);
        $body = $parser->subparse([$this, 'decideWhileEnd']);

        $stream->next();

        $stream->expect(\Twig_Token::BLOCK_END_TYPE);

        return new While_Node($condition, $body, $lineno, $this->getTag());
    }

    /**
     * Block end
     *
     * @param Twig_Token $token
     *
     * @return bool
     */
    public function decideWhileEnd(\Twig_Token $token)
    {
        return $token->test(['endwhile']);
    }

    /**
     * Gets the tag name associated with this token parser.
     *
     * @return string The tag name
     */
    public function getTag()
    {
        return 'while';
    }
}
