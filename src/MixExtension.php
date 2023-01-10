<?php

/*
 * (c) Anas Mazouni <hello@stormix.co>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Yakovlev\Twig\Extension;

/**
 * Twig extension for the Laravel Mix component.
 * @author Anas Mazouni <hello@stormix.co>
 */
class MixExtension extends \Twig\Extension\AbstractExtension
{
    /**
     * @var string
     */
    protected string $publicDir;

    /**
     * @var string
     */
    protected string $manifestName;

    /**
     * @var string
     */
    protected array $manifest = [];

    /**
     * @param string $publicDir
     * @param string $manifestName
     */
    public function __construct(string $publicDir = "public", string $manifestName = 'mix-manifest.json')
    {
        $this->publicDir = rtrim($publicDir, '/');
        $this->manifestName = $manifestName;
    }

    /**
     * @return TwigFunction
     */
    public function getFunctions(): array
    {
        return [
            new \Twig\TwigFunction('mix', [$this, 'getVersionedFilePath']),
        ];
    }

    /**
     * Gets the public url/path to a versioned Mix file.
     * @param string $file
     * @return string
     * @throws \InvalidArgumentException
     */
    public function getVersionedFilePath(string $file)
    {
        $manifest = $this->getManifest();

        if (!isset($manifest[$file])) {
            throw new \InvalidArgumentException("File {$file} not defined in asset manifest.");
        }
        //Only return the file path relative to the public folder (e.g css/style.css) and not (/public/css/style)
        return $manifest[$file];
    }

    /**
     * Returns the manifest file content as array.
     * @return array
     */
    protected function getManifest(): array
    {
        if (empty($this->manifest)) {
            $manifestPath = $this->publicDir . '/' . $this->manifestName;
            $this->manifest = json_decode(file_get_contents($manifestPath), true);
        }

        return $this->manifest;
    }

    public function getName(): string
    {
        return 'mix';
    }
}
