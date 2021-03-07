<?php
    function simplexml_append(&$simplexml_to, &$simplexml_from) {
        foreach ($simplexml_from->children() as $simplexml_child) {
            $simplexml_temp = $simplexml_to->addChild($simplexml_child->getName(), (string) $simplexml_child);

            foreach ($simplexml_child->attributes() as $attr_key => $attr_value) {
                $simplexml_temp->addAttribute($attr_key, $attr_value);
            }

            simplexml_append($simplexml_temp, $simplexml_child);
        }
    } 
?>