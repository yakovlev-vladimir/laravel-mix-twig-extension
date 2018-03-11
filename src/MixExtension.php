<?php

/*
 * (c) Anas Mazouni <hello@stormix.co>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Stormiix\Twig\Extension;

/**
 * Twig extension for the Laravel Mix component.
 *
 * @author Anas Mazouni <hello@stormix.co>
 */
class MixExtension extends \Twig_Extension
{
    protected $ressourcesAssets;
    protected $publicDir;
    protected $manifestName;
    protected $manifest;

    public function __construct($publicDir = "public", $manifestName = 'mix-manifest.json')
    {
        $this->publicDir = rtrim($publicDir, '/') ;
        $this->manifestName = $manifestName;
    }

    public function getFunctions()
    {
        return [
            new \Twig_SimpleFunction('Mix', [$this, 'getVersionedFilePath']),
        ];
    }

    /**
     * Gets the public url/path to a versioned Mix file.
     *
     * @param string $file
     *
     * @return string
     *
     * @throws \InvalidArgumentException
     */
    public function getVersionedFilePath($file)
    {
        $manifest = $this->getManifest();

        if (!isset($manifest[$file])) {
            throw new \InvalidArgumentException("File {$file} not defined in asset manifest.");
        }

        return $this->publicDir.'/'.$manifest[$file];
    }

    /**
     * Returns the manifest file content as array.
     *
     * @return array
     */
    protected function getManifest()
    {
        if (null === $this->manifest) {
            $manifestPath = $this->publicDir.'/'.$this->manifestName;
            $this->manifest = json_decode(file_get_contents($manifestPath), true);
        }

        return $this->manifest;
    }

    public function getName()
    {
        return 'Mix';
    }
}
