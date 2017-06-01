<?php
/*

case "required": 
case "minLength":
case "maxLength":
case "min":
case "max":
case "between":
case "alpha":
case "alphanumeric":
case "int":
case "email":
case "regex":
case "equal":
case "float":
case "file":
case "fileMinSize":
case "fileMaxSize":
case "file_type":
//////////////////////////////////////////ejemplo/////////////////////////////////////////////////////

$rules = array(
            'sucursal' => array(
                array("required" => true, 'msg' => 'El campo name es requerido'),
                array("alpha" => true, 'msg' => 'puras letras porfi'),
                ),
            'usuario' => array(
                array("required" => true, 'msg' => 'El campo name es requerido'),
                ),
            'password' => array(
                array("required" => true, 'msg' => 'El campo name es requerido'),
                ),
            );

        $msg = null;
*/
class formValidate
{
    public $isValid = false;
    public $msg = null;
    
    public function validate($rules)
    {
        foreach($rules as $key => $val)
        {
            $field = $key;
            
            if(isset($_FILES[$key]))
            {
                $value = $_FILES[$key];
            }
            else
            {
                $value = $_REQUEST[$key];  
            }
            
            foreach($rules[$key] as $index => $condition)
            {
                foreach($condition as $k => $v)
                {
                    $this->msg = $rules[$key][$index]["msg"];
                    
                    switch($k)
                    {
                        case "required":
                            if ($v == true)
                            {
                                if (empty($value))
                                {
                                    $this->isValid = false;
                                    return;
                                }
                                else
                                {
                                    $this->isValid = true;
                                }
                            }
                            break;
                         
                        case "minLength":
                            if (strlen($value) < $v)
                            {
                                $this->isValid = false;
                                return;
                            }
                            else
                            {
                                $this->isValid = true;
                            }
                            break;
                            
                        case "maxLength":
                            if (strlen($value) > $v)
                            {
                                $this->isValid = false;
                                return;
                            }
                            else
                            {
                                $this->isValid = true;
                            }
                            break;
                            
                        case "min":
                            if ($value < $v)
                            {
                                $this->isValid = false;
                                return;
                            }
                            else
                            {
                                $this->isValid = true;
                            }
                            break;
                            
                        case "max":
                            if($value > $v)
                            {
                                $this->isValid = false;
                                return;
                            }
                            else
                            {
                                $this->isValid = true;
                            }
                            break;
                            
                        case "between":
                            $v = explode("-", $v);
                            $min = $v[0];
                            $max = $v[1];
                            if (strlen($value) < $min || strlen($value) > $max)
                            {
                                $this->isValid = false;
                                return;
                            }
                            else
                            {
                                $this->isValid = true;
                            }
                            break;
                            
                        case "alpha":
                            if (!preg_match("/^[a-z]+$/i", $value))
                            {
                                $this->isValid = false;
                                return;
                            }
                            else
                            {
                                $this->isValid = true;
                            }
                            break;
                            
                        case "alphanumeric":
                            if (!preg_match("/^[a-z0-9]+$/i", $value))
                            {
                                $this->isValid = false;
                                return;
                            }
                            else
                            {
                                $this->isValid = true;
                            }
                            break;
                            
                        case "int":
                            if (!preg_match("/^[0-9]+$/", $value))
                            {
                                $this->isValid = false;
                                return;
                            }
                            else
                            {
                                $this->isValid = true;
                            }
                            break;
                            
                        case "email":
                            if (!preg_match("/^[a-zA-Z0-9\._-]+@[a-zA-Z0-9-]{2,}[.][a-zA-Z]{2,4}$/", $value))
                            {
                                $this->isValid = false;
                                return;
                            }
                            else
                            {
                                $this->isValid = true;
                            }
                            break;
                            
                        case "regex":
                            if (!preg_match($v, $value))
                            {
                                $this->isValid = false;
                                return;
                            }
                            else
                            {
                                $this->isValid = true;
                            }
                            break;
                            
                        case "equal":
                            if ($value != $_REQUEST[$v])
                            {
                                $this->isValid = false;
                                return;
                            }
                            else
                            {
                                $this->isValid = true;
                            }
                            break;
                            
                        case "float":
                            if (!preg_match("/^([0-9]+\.+[0-9]|[0-9])+$/", $value))
                            {
                                $this->isValid = false;
                                return;
                            }
                            else
                            {
                                $this->isValid = true;
                            }
                            break;
                        
                        case "file":
                            if ($value["size"] == 0)
                            {
                                $this->isValid = false;
                                return;
                            }
                            else
                            {
                                $this->isValid = true;
                            }
                            break;
                            
                        case "fileMinSize":
                            if ($value["size"] < $v)
                            {
                                $this->isValid = false;
                                return;
                            }
                            else
                            {
                                $this->isValid = true;
                            }
                            break;
                            
                        case "fileMaxSize":
                            if ($value["size"] > $v)
                            {
                                $this->isValid = false;
                                return;
                            }
                            else
                            {
                                $this->isValid = true;
                            }
                            break;
                            
                            
                        case "file_type":
                            $types = explode("|", $v);
                            $type = $value["type"];
                            $type = explode("/", $type);
                            $ext = $type[1];
                            $is_allowed = false;
                            foreach ($types as $e)
                            {
                                if ($e == $ext)
                                {
                                    $is_allowed = true;
                                    break;
                                }
                            }
                            if (!$is_allowed)
                            {
                                $this->isValid = false;
                                return;
                            }
                            else
                            {
                                $this->isValid = true;
                            }
                            break;
                            
                    }
                }
            }
        }
    }
}