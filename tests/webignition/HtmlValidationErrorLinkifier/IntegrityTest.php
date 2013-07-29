<?php

namespace webignition\HtmlValidationErrorLinkifier\Tests\webignition\HtmlValidationLinkifier;

use webignition\HtmlValidationErrorLinkifier\HtmlValidationErrorLinkifier;

class IntegrityTest extends \PHPUnit_Framework_TestCase {    
    
    public function testIntegrity() {
        $errors = file(__DIR__ . '/../../fixtures/normalised-error-strings.txt');        
        $linkifier = new HtmlValidationErrorLinkifier();
        
        foreach ($errors as $error) {
            $error = trim($error);
            $linkifier->linkify($error);
            
//            var_dump($error);
//            var_dump($linkifier->linkify($error));
//            print("\n");            
        }
    }      
    
}