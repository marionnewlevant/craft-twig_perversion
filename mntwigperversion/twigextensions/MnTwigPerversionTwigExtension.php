<?php
/**
 * MN Twig Perversion plugin for Craft CMS
 *
 * MN Twig Perversion Twig Extension
 *
 *
 * @author    Marion Newlevant
 * @copyright Copyright (c) 2016 Marion Newlevant
 * @link      http://marion.newlevant.com
 * @package   MnTwigPerversion
 * @since     1.0.0
 */

namespace Craft;

require_once('Break_TokenParser.php');
require_once('Continue_TokenParser.php');
require_once('Return_TokenParser.php');

class MnTwigPerversionTwigExtension extends \Twig_Extension
{
    /**
     * Returns the name of the extension.
     *
     * @return string The extension name
     */
    public function getName()
    {
        return 'MnTwigPerversion';
    }

    public function getTokenParsers()
    {
        return array(
            new Break_TokenParser(),
            new Continue_TokenParser(),
            new Return_TokenParser(),
        );
    }

}