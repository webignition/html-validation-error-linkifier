<?php

namespace webignition\HtmlValidationErrorLinkifier\Tests\webignition\HtmlValidationLinkifier;

use webignition\HtmlValidationErrorLinkifier\HtmlValidationErrorLinkifier;

class ReplaceDoubleHyphensTest extends \PHPUnit_Framework_TestCase {    

    public function testRepaceDoubleHyphens() {
        $linkifier = new HtmlValidationErrorLinkifier();
        $linkified = $linkifier->linkify('foo--bar---foobar');
        
        $this->assertEquals('foo-bar-foobar', $linkified);
    }   
    
}