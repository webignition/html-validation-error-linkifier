<?php

namespace webignition\HtmlValidationErrorLinkifier\Tests\webignition\HtmlValidationLinkifier;

use webignition\HtmlValidationErrorLinkifier\HtmlValidationErrorLinkifier;

class ReplaceSlashesTest extends \PHPUnit_Framework_TestCase {    

    public function testReplaceSlashes() {
        $linkifier = new HtmlValidationErrorLinkifier();
        $linkified = $linkifier->linkify('one/two/three');
        
        $this->assertEquals('one-slash-two-slash-three', $linkified);
    }   
    
}