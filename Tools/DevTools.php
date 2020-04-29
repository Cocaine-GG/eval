<?php


namespace App\Tools;


class DevTools
{
    public function prettyVarDump($element){
        highlight_string("<?php\n\$elementAsParameter =\n" . var_export($element, true) . ";\n?>");
    }
}