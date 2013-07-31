<?php

namespace webignition\HtmlValidationErrorLinkifier\Tests\webignition\HtmlValidationLinkifier;

use webignition\HtmlValidationErrorLinkifier\HtmlValidationErrorLinkifier;

class ReplaceAmpersandTest extends \PHPUnit_Framework_TestCase {    

    public function testReplaceAmpersandEntity() {
        $linkifier = new HtmlValidationErrorLinkifier();
        $linkified = $linkifier->linkify('foo &amp; bar');
        
        $this->assertEquals('foo-amp-bar', $linkified);
    }  
    
    public function testReplaceAmperandAndAmperandEntity() {
        $linkifier = new HtmlValidationErrorLinkifier();
        $linkified = $linkifier->linkify('& did not start a character reference. (& probably should have been escaped as &amp;.)');
        
        $this->assertEquals('ampersand-did-not-start-a-character-reference-ampersand-probably-should-have-been-escaped-as-amp', $linkified);        
    }
    
}