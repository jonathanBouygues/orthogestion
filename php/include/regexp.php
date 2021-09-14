<?php

class RegExp {

    // Attributs
    private $_regexpNumTel = '^[0-9]{2}([-]{1}[0-9]{2}){4}$';
    private $_regexpTxtSt = '^[[:alnum:][:space:][:punct:][:blank:]éèëàäöôïîûüñõ]{2,30}$';
    private $_regexpTxtLg = '^[[:alnum:][:space:][:punct:][:blank:]éèëàäöôïîûüñõ]{2,255}$';
    private $_regexpDate = '^([[:digit:]]{4})(([-]([[:digit:]]{2})){2})$';
    private $_regexpInt = '^[[:digit:]]{1,4}$';
    private $_regexpDec = '^-?\d+(.\d+)?$';

    // Methods
    public function checkMail($data) {
        if (((filter_var($data, FILTER_VALIDATE_EMAIL)) && (isset($data))) || (empty($data))) {
            return true;
        }
    }
    
    public function checkTel($data) {
        if (((preg_match('#'.$this -> _regexpNumTel.'#',$data)) && (isset($data))) || (empty($data))) {
            return true;
        }
    }

    public function checkTxtStNn($data) {
        if ((preg_match('#'.$this -> _regexpTxtSt.'#',$data)) && (isset($data)) && (is_string($data))) {
            return true;
        }
    }

    public function checkTxtStNu($data) {
        if (((preg_match('#'.$this -> _regexpTxtSt.'#',$data)) && (isset($data)) && (is_string($data))) || (empty($data))) {
            return true;
        }
    }

    public function checkTxtLgNn($data) {
        if ((preg_match('#'.$this -> _regexpTxtLg.'#',$data)) && (isset($data)) && (is_string($data))) {
            return true;
        }
    }

    public function checkTxtLgNu($data) {
        if (((preg_match('#'.$this -> _regexpTxtLg.'#',$data)) && (isset($data)) && (is_string($data))) || (empty($data))) {
            return true;
        }
    }
    
    public function checkDateNn($data) {
        // return $data;
        if ((preg_match('#'.$this -> _regexpDate.'#',$data)) && (isset($data))) {
            return true;
        }
    }

    public function checkDateNu($data) {
        if (((preg_match('#'.$this -> _regexpDate.'#',$data)) && (isset($data)) && (is_string($data))) || (empty($data))) {
            return true;
        }
    }

    public function checkIntegerNn($data) {
        if ((preg_match('#'.$this -> _regexpInt.'#',$data)) && (isset($data)) && (is_string($data))) {
            return true;
        }
    }

    public function checkIntegerNu($data) {
        if (((preg_match('#'.$this -> _regexpInt.'#',$data)) && (isset($data)) && (is_string($data))) || (empty($data))) {
            return true;
        }
    }

    public function checkDecimalNn($data) {
        if (((preg_match('#'.$this -> _regexpDec.'#',$data)) && (isset($data)) && (is_string($data))) || (empty($data))) {
            return true;
        }
    }

}

// instanciation of the object
$regExp = new RegExp();