<?php
/**
 * -- file description --
 *
 * @author Marko Krüger <plant2code@marko-krueger.de>
 *
 */

namespace Plant2Code;


use Plant2Code\Language\AbstractClass;
use Plant2Code\TemplateEngine\TemplateEngine;

/**
 * Class Writer
 * @package Plant2Code
 */
class Renderer
{
    /**
     * @var AbstractClass
     */
    protected $class;
    /**
     * @var null|string
     */
    protected $outputDir = null;
    /**
     * @var null|string
     */
    protected $templatePath = null;
    /**
     * @var null
     */
    protected $templateEngine = null;

    /**
     * Writer constructor.
     *
     * @param string         $templatePath
     * @param TemplateEngine $templateEngine
     */
    public function __construct(string $templatePath, TemplateEngine $templateEngine)
    {
        $this->templatePath = $templatePath;
        $this->templateEngine = $templateEngine;
    }

    /**
     * @return mixed|string
     */
    public function render()
    {
        /** @var AbstractClass $class */

            return $this->templateEngine->render('class', ['class' => $this->class]);

            /*$namespace = (string)$class->namespace;
            $namespaceDir = str_replace('\\', '/', $namespace);
            $writeDir = $this->outputDir . '/' . $namespaceDir;

            if (!is_dir($writeDir)) {
//                mkdir($writeDir);
            }

            print $this->outputDir . PHP_EOL;
            print $classFile . PHP_EOL;*/
    }

    /**
     * @param AbstractClass $class
     *
     * @return Renderer
     */
    public function setClass(AbstractClass $class): Renderer
    {
        $this->class = $class;

        return $this;
    }

}