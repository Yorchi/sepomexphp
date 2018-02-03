<?php
namespace SepomexPhp;

class Locations implements \IteratorAggregate, \Countable
{
    /** @var Location[] */
    private $collection;

    public function __construct(Location ...$location)
    {
        $this->collection = $location;
    }

    public function getIterator()
    {
        return new \ArrayIterator($this->collection);
    }

    public function count(): int
    {
        return count($this->collection);
    }

    /**
     * @return Cities|City[]
     */
    public function cities(): Cities
    {
        $cities = [];
        foreach ($this->collection as $location) {
            if ($location->hasCity()) {
                $city = $location->city();
                if (! array_key_exists($city->id(), $cities)) {
                    $cities[$city->id()] = $location->city();
                }
            }
        }
        return new Cities(...$cities);
    }

    public function asArray(): array
    {
        $array = [];
        foreach ($this->collection as $location) {
            $array[] = $location->asArray();
        }
        return $array;
    }
}