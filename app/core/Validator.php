<?php
// app/core/Validator.php

class Validator {
    public static function validate($data, $rules) {
        $errors = [];
        foreach ($rules as $field => $fieldRules) {
            $label = str_replace('_', ' ', ucfirst($field));
            
            foreach ($fieldRules as $rule) {
                if ($rule === 'required') {
                    if (!isset($data[$field]) || empty(trim($data[$field]))) {
                        $errors[$field][] = "$label is required.";
                    }
                }
                
                if (strpos($rule, 'min:') === 0) {
                    $min = (int)substr($rule, 4);
                    if (isset($data[$field]) && strlen($data[$field]) < $min) {
                        $errors[$field][] = "$label must be at least $min characters long.";
                    }
                }

                if ($rule === 'email') {
                    if (isset($data[$field]) && !empty($data[$field]) && !filter_var($data[$field], FILTER_VALIDATE_EMAIL)) {
                        $errors[$field][] = "$label must be a valid email address.";
                    }
                }

                if ($rule === 'url') {
                    if (isset($data[$field]) && !empty($data[$field]) && !filter_var($data[$field], FILTER_VALIDATE_URL)) {
                        $errors[$field][] = "$label must be a valid URL.";
                    }
                }
            }
        }
        return $errors;
    }
}
