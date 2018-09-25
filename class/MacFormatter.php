<?php

class MacFormatter {

    public static function formatMac($mac){

        $bytes = array();

        $i = 2;
        
        while ($i < 6){

            $bytes[] = strtoupper(substr($mac, $i - 2, $i));
            $i = $i + 2;
        }

        return implode(':', $bytes);
    }

}

?>