<?php

require_once __DIR__.'/response.php';

function validate($data, $rules){

    $errors = [];

    foreach($rules as $field => $rule){

        $value = $data[$field] ?? null;

        $ruleList = explode('|', $rule);

        foreach($ruleList as $r){

            if($r === "required" && empty($value)){
                $errors[$field][] = "field $field wajib diisi";
            }

            if($r === "number" && !is_numeric($value)){
                $errors[$field][] = "field $field harus angka";
            }

            if($r === "string" && !is_string($value)){
                $errors[$field][] = "field $field harus string";
            }

        }
    }

    if(!empty($errors)){
        jsonResponse([
            "message" => "validation error",
            "errors" => $errors
        ],422);
    }

}