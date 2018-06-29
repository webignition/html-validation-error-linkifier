<?php

namespace webignition\HtmlValidationErrorLinkifier\Tests\webignition\HtmlValidationLinkifier;

use webignition\HtmlValidationErrorLinkifier\HtmlValidationErrorLinkifier;

class ReplaceSpacesTest extends \PHPUnit_Framework_TestCase {    

    public function testReplaceSpaces() {
        $linkifier = new HtmlValidationErrorLinkifier();
        $linkified = $linkifier->linkify('one two three');
        
        $this->assertEquals('one-two-three', $linkified);
    }   
    
}