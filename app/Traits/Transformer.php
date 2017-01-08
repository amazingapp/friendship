<?php
namespace App\Traits;

use Exception;

trait Transformer
{

    /**
     * @param array $items
     * @return array
     */
    public function transformCollection(array $items)
    {
        return collect(array_map([$this, 'transform'], $items));
    }

    /**
     * @param $item
     * @return mixed
     */
    abstract public function transform($item);
}
