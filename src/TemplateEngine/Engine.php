<?php
/**
 * -- file description --
 *
 * @author Marko Krüger <plant2code@marko-krueger.de>
 *
 */

namespace Plant2Code\TemplateEngine;

use Illuminate\Contracts\Filesystem\FileNotFoundException;

/**
 * Class Engine
 * @package Plant2Code\TemplateEngine
 */
abstract class Engine implements TemplateEngine
{
    /**
     * @var string
     */
    protected $templateExtension = '';

    protected $templateDir = '';

    /**
     * Engine constructor.
     *
     * @param array $options
     *
     * @throws \Exception
     */
    public function __construct(array $options)
    {
        if (isset($options['templateDir'])) {
            $this->setTemplateDir($options['templateDir']);
        } else {
            throw new \Exception('A template directory must be specified.');
        }

        if (isset($options['templateExtension'])) {
            $this->setTemplateExtension($options['templateExtension']);
        } else {
            throw new \Exception('Template extension must be specified.');
        }

    }

    /**
     * @param $template
     *
     * @return string
     * @throws FileNotFoundException
     */
    protected function sanitizeTemplateName($template)
    {
        $templateName = $template . '.' . $this->templateExtension;

        if (file_exists($this->templateDir . '/' . $templateName)) {
            return $templateName;
        }

        throw new FileNotFoundException($templateName . ' could not be found in template directory ' . $this->templateDir);
    }

    /**
     * @param $templateDir
     *
     * @return Engine
     */
    public function setTemplateDir(string $templateDir): Engine
    {
        $this->templateDir = $templateDir;

        return $this;
    }

    /**
     * @param string $extension
     *
     * @return Engine
     */
    public function setTemplateExtension(string $extension): Engine
    {
        $this->templateExtension = $extension;

        return $this;
    }
}