<?php namespace App\Traits;

trait convertFlatten{

    /**
     * @param $array
     * @return array
     */
    function flatten($array) {
        $result = [];
        foreach ($array as $item) {
            if (is_array($item)) {
                $result[] = array_filter($item, function($array) {
                    return ! is_array($array);
                });
                $result = array_merge($result, $this->flatten($item));
            }
        }
        return array_filter($result);
    }
}
