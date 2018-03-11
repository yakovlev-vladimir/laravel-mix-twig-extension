<?php

/*
 * (c) Anas Mazouni <hello@stormix.co>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Stormiix\Twig\Extension\tests;

use Stormiix\Twig\Extension\MixExtension;

/**
 * @author Anas Mazouni <hello@stormix.co>
 */
class MixExtensionTest extends \PHPUnit\Framework\TestCase
{
    /**
     * @dataProvider fixtureProvider
     */
    public function testCompile($source, $expected)
    {
        $twig = new \Twig_Environment($this->getMockBuilder('Twig_LoaderInterface')->getMock(), ['cache' => false, 'autoescape' => false, 'optimizations' => 0]);
        $twig->addExtension(new MixExtension('public'));
        $nodes = $twig->parse($twig->tokenize(new \Twig_Source($source,"")));
        $this->assertEquals($expected, $nodes->getNode('body')->getNode(0));
    }

    public function fixtureProvider()
    {
        return array(
            array(
                '{{ Mix("css/all.css") }}',
                new \Twig_Node_Print(
                    new \Twig_Node_Expression_Function(
                        'Mix',
                        new \Twig_Node([
                            new \Twig_Node_Expression_Constant('css/all.css', 1),
                        ]),
                        1
                    ),
                    1
                ),
            ),
        );
    }

    public function testGetVersionedFilePath()
    {
        $mix = new MixExtension(__DIR__.'/fixtures');
        $this->assertSame('/home/travis/build/Stormiix/laravel-mix-twig-extension/tests/fixtures/css/all-294af823e6.css', $mix->getVersionedFilePath('css/all.css'));
    }

    /**
     * @expectedException \InvalidArgumentException
     * @expectedExceptionMessage File css/any.css not defined in asset manifest.
     */
    public function testDoNotAllowUnversionedFile()
    {
        $mix = new MixExtension(__DIR__.'/fixtures');
        $mix->getVersionedFilePath('css/any.css');
    }
}
