<?php

namespace webignition\HtmlValidationErrorLinkifier\Tests\webignition\HtmlValidationLinkifier;

use webignition\HtmlValidationErrorLinkifier\HtmlValidationErrorLinkifier;

class ReplaceParametersTest extends \PHPUnit_Framework_TestCase {    

    public function testReplaceAmpersandEntity() {
        $linkifier = new HtmlValidationErrorLinkifier();
        $linkified = $linkifier->linkify('Required attribute "%0" not specified', array(
            'type'
        ));
        
        $this->assertEquals('required-attribute-type-not-specified', $linkified);
    }   
    
}