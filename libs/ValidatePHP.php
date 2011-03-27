<?
 
/*
 * ValidatePHP.php - Smarty Form Validation Engine
 *
 * Purpose: Eliminiate virtually all validation code from PHP and put as much
 * of it into the template as possible.  At the same time attempt to avoid
 * using sessions.  Instead a flat file with a serialized array is used.
 * 
 */
 
class SmartyValidatePHP extends Smarty {
    
    /* Load validation prefilter compiler */
    function enableValidate() {
        $this->register_prefilter('smarty_prefilter_validation_precompiler');
        define('VALIDATEPHP_LOADED', 1);
    }
    
    /* Load validator function into memory */
    function loadValidator($name) {
        require_once(SMARTY_DIR . "validators/validator." . $name . ".php");
    }
    
    /* Run validator function again field */
    function runValidator($field) {
        $validatorFunction = "validatephp_" . $field['check'];
        return $validatorFunction($field);
    }
    
    /* Validates the form */
    function doValidate() {
        $tmpFile = "/tmp/validate." . md5($_SERVER['SCRIPT_NAME']);
        
        /* No validation file found, return true */
        if (!is_file($tmpFile)) {
            return true;
        }
        
        $validationArray = unserialize(file_get_contents($tmpFile)); // get array
        
        //unset($validationArray['errors']); // clear old error triggers
        
        foreach ($validationArray['fields'] as $field) {
            $this->loadValidator($field['check']); // load validator for this check
            
            /* If the validator failed, set flag */
            if ($this->runValidator($field) == false) {
                $flagError++;
                $this->validationErrors[$field['name']] = true;
            }
        }
        
        /* An error was flagged atleast once */
        if ($flagError != 0) {    
            /* Write new serialized array containging changes */
            $fileHandle = fopen($tmpFile, "w");        
            fwrite($fileHandle, serialize($validationArray));
            fclose($fileHandle);
            
            /* Return false */
            return false;
        }
        
        /* No errors, return true! */
        return true;
        
    }
}
 
/*
 * Validation Precompiler
 * 
 * Searches for "validate" in the template file. If found
 * creates a file in the /tmp directory.  Otherwise removes
 * a file with the same name.
 * 
 */
function smarty_prefilter_validation_precompiler($source, &$smarty) {
    /*
     * first time compilation; create validation file in /tmp
     * filename contains validate.[filename_md5]
     */
    $tmpFile = "/tmp/validate." . md5($_SERVER['SCRIPT_NAME']);
    
    /* Check for validate text in source */
    if (preg_match("/validate/i", $source)) {
        unlink($tmpFile); // remove any old files
        touch($tmpFile); // create file
    } else {
        unlink($tmpFile); // delete file
    }
    
    return $source;
 
}
 
 
?>
