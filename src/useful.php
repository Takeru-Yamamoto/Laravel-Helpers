<?php

use Illuminate\Http\JsonResponse;

if (!function_exists('routePrefix')) {

    /**
     * routeのprefixを取得する
     */
    function routePrefix(): ?string
    {
        return request()->route()?->getPrefix();
    }
}


if (!function_exists('___')) {

    /**
     * trans()のwrap
     * pagesディレクトリ配下にも簡単にアクセスできるようにする
     */
    function ___(string $lang, array $replace = []): string
    {
        return $lang === __($lang) ? __("pages/" . $lang, $replace) : __($lang, $replace);
    }
}


if (!function_exists('varDump')) {

    /**
     * var_dump の簡略化
     *
     * @param mixed $any
     */
    function varDump(mixed $any): void
    {
        echo "<pre>";
        var_dump($any);
        echo "</pre>";
    }
}


if (!function_exists('jsonEncode')) {

    /**
     * json_encode の簡略化
     *
     * @param mixed $any
     */
    function jsonEncode(mixed $any): string|false
    {
        return json_encode($any, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE);
    }
}


if (!function_exists('arrayMergeUnique')) {

    /**
     * 配列をユニークにマージする
     *
     * @param array $array1
     * @param array $array2
     */
    function arrayMergeUnique(array $array1, array $array2): array
    {
        $array = array_merge($array1, $array2);
        $array = array_unique($array);
        return array_values($array);
    }
}


if (!function_exists('multiDimensionsArrayMergeUnique')) {

    /**
     * 多次元配列をユニークにマージする
     *
     * @param array $array
     */
    function multiDimensionsArrayMergeUnique(array $array): array
    {
        $merged = [];
        foreach ($array as $value) {
            if (is_array($value)) {
                $merged = arrayMergeUnique($merged, multiDimensionsArrayMergeUnique($value));
            } else {
                $merged[] = $value;
            }
        }
        return $merged;
    }
}


if (!function_exists('arraySearchKey')) {

    /**
     * haystack のうち column が needle なkeyを検索する
     *
     * @param array $haystack
     * @param mixed $column
     * @param mixed $needle
     */
    function arraySearchKey(array $haystack, mixed $column, mixed $needle): mixed
    {
        return array_search($needle, array_column($haystack, $column));
    }
}


if (!function_exists('arraySearchValue')) {

    /**
     * haystack のうち column が needle なvalueを検索する
     *
     * @param array $haystack
     * @param mixed $column
     * @param mixed $needle
     */
    function arraySearchValue(array $haystack, mixed $column, mixed $needle): mixed
    {
        $key = arraySearchKey($haystack, $column, $needle);
        return isset($haystack[$key]) ? $haystack[$key] : null;
    }
}


if (!function_exists('className')) {

    /**
     * object のクラス名を取得する
     *
     * @param object $object
     */
    function className(object $object): string
    {
        $array = explode("\\", get_class($object));
        return end($array);
    }
}


if (!function_exists('responseJson')) {

    /**
     * JsonResponse の簡略化
     *
     * @param mixed $data
     */
    function responseJson(mixed $data = []): JsonResponse
    {
        return response()->json($data);
    }
}


if (!function_exists('removeNullAndEmptyFromArray')) {

    /**
     * 配列から「null」「空文字」「0」「false」「空配列」を取り除く
     *
     * @param array $array
     */
    function removeNullAndEmptyFromArray(array $array): array
    {
        $tmp = [];
        foreach ($array as $item) {
            if (is_array($item)) {
                $tmp[] = removeNullAndEmptyFromArray($item);
            } else if (!empty($item) || $item === '0' || $item === 0) {
                $tmp[] = $item;
            }
        }
        return $tmp;
    }
}


if (!function_exists('convertToObjectFromSerializeArray')) {

    /**
     * formから受け取ったserializeArrayを扱いやすい形でstdClassに格納する
     *
     * @param array $serializeArray
     */
    function convertToObjectFromSerializeArray(array $serializeArray): \stdClass
    {
        $data = new \stdClass();
        foreach ($serializeArray as $element) {
            $name = $element["name"];
            if (isset($data->$name)) {
                if (is_array($data->$name)) {
                    $data->$name[] = $element["value"];
                } else {
                    $array = array(
                        $data->$name,
                        $element["value"]
                    );
                    $data->$name = $array;
                }
            } else {
                $data->$name = $element["value"];
            }
        }
        return $data;
    }
}
