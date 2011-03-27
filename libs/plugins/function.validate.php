<?
/*
 * Smarty plugin
 * -------------------------------------------------------------
 * File:     function.validate.php
 * Type:     function
 * Name:     validate
 * Purpose:  validate function from Validate.PHP library
 * -------------------------------------------------------------
 */
function smarty_function_validate($params, &$smarty)
{
    extract($params);
    
    if (VALIDATEPHP_LOADED != 1) {
        return;
    }
    
    $tmpFile = "/tmp/validate." . md5($_SERVER['SCRIPT_NAME']);
    
    /* Check for validation file */
    if (!is_file($tmpFile)) {
        touch($tmpFile); // create file
        $validationArray = array();
    } else {
        /* Open validation file */
        $validationArray = unserialize(file_get_contents($tmpFile));
    }
   
    /* Check if field has a failed flag */
    if ($smarty->validationErrors[$name]) {
        echo $message;
        return;
    }
    
    /* Search for current field in validation file */
    if (!array_key_exists($name, $validationArray)) {
        $fileHandle = fopen($tmpFile, "w");
        
        /* Write new serialized array containging check name */
        $validationArray['fields'][$name]['name'] = $name;
        $validationArray['fields'][$name]['check'] = $check;
        
        fwrite($fileHandle, serialize($validationArray));
        fclose($fileHandle);
    }
}
 
?>
 
