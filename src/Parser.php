<?php
/**
 * -- file description --
 *
 * @author Marko Krüger <plant2code@marko-krueger.de>
 *
 */

namespace Plant2Code;


use Illuminate\Support\Collection;
use Plant2Code\Language\AbstractClass;
use Plant2Code\Language\AbstractClassMethod;
use Plant2Code\Language\AbstractClassProperty;
use Plant2Code\Language\ComponentBuilder;
use Plant2Code\Language\Factory;

/**
 * Class Parser
 *
 * @package Plant2Code
 */
class Parser
{
    /**
     * @var string
     */
    protected $input;
    /**
     * @var string
     */
    protected $language;
    /**
     * @var string
     */
    protected $rootNS;
    /**
     * @var Collection
     */
    protected $clases;
    /**
     * @var ComponentBuilder
     */
    protected $componentBuilder;

    /**
     * Parser constructor.
     *
     * @param string $input
     * @param string $language
     * @param string $rootNS
     */
    public function __construct(string $input, string $language, string $rootNS = null)
    {
        $this->input = $input;
        $this->language = $language;
        $this->rootNS = $rootNS;

        $this->initComponentBuilder();
    }


    /**
     * @return Parser
     */
    protected function initComponentBuilder(): Parser
    {
        $this->componentBuilder = Factory::create($this->language);

        return $this;
    }

    /**
     * @return Collection
     */
    public function parse(): Collection
    {
        $ext = $this->componentBuilder->getExtension();

        // avoiding namespace shizzle here.
        try {
            $xmi = new \SimpleXMLElement($this->input);
            $xml = dom_import_simplexml($xmi);

            $nodelist = $xml->getElementsByTagName('Class');
            $length = $nodelist->length;

            $this->classes = collect([]);

            for ($i = 0; $i < $length; $i++) {
                $classNode = $nodelist->item($i);
                $clid = $classNode->getAttribute('xmi.id');

                $class = $this->parseClass($classNode);

                $this->classes->put($clid, [
                    'meta'  => [
                        'filename' => $class->name . $ext,
                        'folder'   => $class->namespace->name,
                    ],
                    'class' => $class
                ]);
            }
        } catch (Exception $e) {
            $this->output->error($e->getMessage());
        }

        $this->parseGeneralizations($xml);

        return $this->classes;
    }

    /**
     * @param \DOMNode $classNode
     *
     * @return AbstractClass
     */
    private function parseClass(\DOMNode $classNode): AbstractClass
    {
        $className = $classNode->getAttribute('name');

        $namespace = $this->componentBuilder->createNamespace($classNode->getAttribute('namespace'), $this->rootNS);

        $class = $this->componentBuilder->createClass();
        $class->name = $className;
        $class->namespace = $namespace;
        $class->interface = $classNode->getAttribute('isInterface') ?: false;
        $class->abstract = $classNode->getAttribute('isAbstract') ?: false;

        // class properties
        $classifier = $classNode->getElementsByTagName('Classifier.feature')
                                ->item(0);
        $attributes = $classifier->getElementsByTagName('Attribute');
        foreach ($attributes as $attribute) {
            $property = $this->parseProperty($attribute);

            $class->addProperty($property);
        }
        // class methods + possible arguments
        $methods = $classifier->getElementsByTagName('Operation');
        foreach ($methods as $meth) {
            $method = $this->parseMethod($meth);

            $class->addMethod($method);
        }

        return $class;
    }

    /**
     * @param \DOMElement $element
     *
     * @return Language\AbstractClassProperty
     */
    private function parseProperty(\DOMElement $element): AbstractClassProperty
    {
        $nameAttr = explode(':', $element->getAttribute('name'));
        $visibility = $element->getAttribute('visibility');
        $name = trim($nameAttr[0]);
        $type = null;

        if (count($nameAttr) === 2) {
            $type = trim($nameAttr[1]);
        }

        $property = $this->componentBuilder->createProperty($name, $type, $visibility);

        return $property;
    }

    /**
     * @param \DOMElement $meth
     *
     * @return AbstractClassMethod
     */
    private function parseMethod(\DOMElement $meth): AbstractClassMethod
    {
        $matches = [];
        preg_match('/(\w+)\((.*)\)(\s?:\s?(\w+))?/', $meth->getAttribute('name'), $matches);

        $name = $matches[1];
        $visibility = $meth->getAttribute('visibility');
        $type = null;
        $arguments = [];

        if (isset($matches[2]) && trim($matches[2]) !== "") {

            $args = explode(',', $matches[2]);
            foreach ($args as $arg) {
                list($argName, $argType) = explode(':', $arg);
                $argument = $this->componentBuilder->createMethodArgument(trim($argName), trim($argType));
                $arguments[] = $argument;
            }
        }

        if (isset($matches[4])) {
            $type = $matches[4];
        }

        $method = $this->componentBuilder->createMethod($name, $visibility, $arguments, $type);
        $method->visibility = $meth->getAttribute('visibility');

        return $method;
    }

    /**
     * @param \DOMElement $dom
     */
    private function parseGeneralizations(\DOMElement $dom)
    {
        $generalizations = $dom->getElementsByTagName('Generalization');
        $nsSeparator = $this->componentBuilder->getNsSeparator();

        foreach ($generalizations as $generalization) {
            $child = $generalization->getAttribute('child');
            $parent = $generalization->getAttribute('parent');

            /** @var AbstractClass $childClass */
            $childClass = $this->classes->get($child)['class'];
            /** @var AbstractClass $parentClass */
            $parentClass = $this->classes->get($parent)['class'];

            $ns = null;
            if ($parentClass->namespace->name !== $childClass->namespace->name) {
                $ns = $parentClass->namespace->name . $nsSeparator;
            }

            if ($parentClass->interface) {
                $childClass->addImplement($parentClass);
            } else {
                $childClass->extends = $parentClass;
            }
        }
    }


}
