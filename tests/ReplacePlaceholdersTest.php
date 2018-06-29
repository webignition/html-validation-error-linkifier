<?php

namespace webignition\HtmlValidationErrorLinkifier\Tests\webignition\HtmlValidationLinkifier;

use webignition\HtmlValidationErrorLinkifier\HtmlValidationErrorLinkifier;

class ReplacePlaceholdersTest extends \PHPUnit_Framework_TestCase {    

    public function testReplacePlaceholdersWithLetters() {
        $linkifier = new HtmlValidationErrorLinkifier();
        $linkified = $linkifier->linkify('Foo %0 not allowed in bar %1');
        
        $this->assertEquals('foo-x-not-allowed-in-bar-y', $linkified);
    }   
    
}