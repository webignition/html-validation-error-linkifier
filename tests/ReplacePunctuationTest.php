<?php

namespace webignition\HtmlValidationErrorLinkifier\Tests\webignition\HtmlValidationLinkifier;

use webignition\HtmlValidationErrorLinkifier\HtmlValidationErrorLinkifier;

class ReplacePunctuationTest extends \PHPUnit_Framework_TestCase {    

    public function testReplaceComma() {
        $linkifier = new HtmlValidationErrorLinkifier();
        $linkified = $linkifier->linkify('foo,bar');
        
        $this->assertEquals('foobar', $linkified);
    }   
    
    public function testReplaceDot() {
        $linkifier = new HtmlValidationErrorLinkifier();
        $linkified = $linkifier->linkify('foo.bar');
        
        $this->assertEquals('foobar', $linkified);
    } 
    
    public function testReplaceColon() {
        $linkifier = new HtmlValidationErrorLinkifier();
        $linkified = $linkifier->linkify('foo:bar');
        
        $this->assertEquals('foobar', $linkified);
    } 
    
    public function testReplaceSemiColon() {
        $linkifier = new HtmlValidationErrorLinkifier();
        $linkified = $linkifier->linkify('foo;bar');
        
        $this->assertEquals('foobar', $linkified);
    } 
    
    public function testReplaceDoubleQuote() {
        $linkifier = new HtmlValidationErrorLinkifier();
        $linkified = $linkifier->linkify('foo"bar');
        
        $this->assertEquals('foobar', $linkified);
    } 
    
    public function testReplaceLeftBracket() {
        $linkifier = new HtmlValidationErrorLinkifier();
        $linkified = $linkifier->linkify('foo(bar');
        
        $this->assertEquals('foobar', $linkified);
    } 
    
    public function testReplaceRightBracket() {
        $linkifier = new HtmlValidationErrorLinkifier();
        $linkified = $linkifier->linkify('foo)bar');
        
        $this->assertEquals('foobar', $linkified);
    } 
    
    public function testReplaceSlashAngleBracket() {
        $linkifier = new HtmlValidationErrorLinkifier();
        $linkified = $linkifier->linkify('foo/>bar');
        
        $this->assertEquals('foobar', $linkified);
    }     
    
}