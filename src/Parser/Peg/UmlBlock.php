<?php


namespace Plant2Code\Parser\Peg;


class UmlBlock
{
    protected $items;
    protected $connections;
    protected $classes;
    protected $namespaces;
    protected $packages;

    public function __construct($filelines)
    {
        $this->items = $filelines;

        $this->handleItems($this);
    }

    protected function handleItems(UmlBlock $item)
    {
        $items = $item->getItems();

        foreach ($items as $item) {
            if ($item instanceof UmlNamespace) {
                $this->namespaces[] = $item;
            } else if ($item instanceof UmlClass) {
                $this->classes[] = $item;
            }
        }
    }

    /**
     * @return mixed
     */
    public function getItems()
    {
        return $this->items;
    }


}
