<?php

namespace webignition\HtmlValidationErrorLinkifier\Tests\webignition\HtmlValidationLinkifier;

use webignition\HtmlValidationErrorLinkifier\HtmlValidationErrorLinkifier;

class ReplaceAmpersandTest extends \PHPUnit_Framework_TestCase {    

    public function testReplaceAmpersandEntity() {
        $linkifier = new HtmlValidationErrorLinkifier();
        $linkified = $linkifier->linkify('foo &amp; bar');
        
        $this->assertEquals('foo-amp-bar', $linkified);
    }   
    
}