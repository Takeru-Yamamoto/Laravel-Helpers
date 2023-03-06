<?php

if (!function_exists('formId')) {

    /**
     * 現在のrouteを用いてformに使用するidを取得する
     * form submit btn と併用する
     * num は現在のページにformが複数存在するときの重複回避用
     *
     * @param integer|null $num
     */
    function formId(?int $num = null): string
    {
        return str_replace("/", "-", request()->path()) . "-form" . $num;
    }
}


if (!function_exists('isChecked')) {

    /**
     * radioやcheckboxをcheckedな状態にするかを簡単に記述しやすくする
     *
     * @param boolean $bool
     */
    function isChecked(bool $bool): string
    {
        return $bool ? "checked" : "";
    }
}


if (!function_exists('isSelected')) {

    /**
     * selectのoptionをselectedな状態にするかを簡単に記述しやすくする
     *
     * @param boolean $bool
     */
    function isSelected(bool $bool): string
    {
        return $bool ? "selected" : "";
    }
}
