<?php

namespace webignition\HtmlValidationErrorLinkifier;

use webignition\HtmlValidationErrorNormaliser\HtmlValidationErrorNormaliser;

class HtmlValidationErrorLinkifier {
    
    const START_PLACEHOLDER_CHARACTER = 'x';
    
    private $normalForm = '';
    private $linkifiedForm = '';
    
    public function linkify($normalForm, $parameters = null) {
        $this->normalForm = $normalForm;
        $this->linkified = $normalForm;
        
        $this->replacePlaceholders($parameters);
        $this->replaceAmpWithAmpserandPlaceholder();
        $this->removePunctuation();
        $this->replaceSpaces();
        $this->replaceSlashes();        
        $this->replaceAmpersandPlaceholder();
        $this->replaceDoubleHyphens();        
        
        return $this->linkifiedForm;        
    }
    
    private function replaceDoubleHyphens() {
        while (substr_count($this->linkifiedForm, '--') > 0) {
            $this->linkifiedForm = str_replace('--', '-', $this->linkifiedForm);
        }        
    }
    
    private function replaceAmpersandPlaceholder() {
        $this->linkifiedForm = str_replace('ampsersand_placeholder', 'amp', $this->linkifiedForm);
    }    
    
    private function replaceAmpWithAmpserandPlaceholder() {
        $this->linkifiedForm = str_replace('&amp', 'ampsersand_placeholder', $this->linkifiedForm);
    }
    
    
    private function  replacePlaceholders($parameters = null) {
        $placeholders = $this->getPlaceholders();
        $placeholderValues = $this->getPlaceholderValues($parameters);
       
        $this->linkifiedForm = strtolower(str_replace($placeholders, $placeholderValues, $this->normalForm));        
    }

    private function replaceSlashes() {
        $this->linkifiedForm = str_replace('/', '-slash-', $this->linkifiedForm);
    }    
    
    private function replaceSpaces() {
        $this->linkifiedForm = str_replace(' ', '-', $this->linkifiedForm);
    }
    
    private function removePunctuation() {
        $this->linkifiedForm = str_replace(array(
            ',', '.', ':', ';', '"', '(', ')','/>'
        ), '', $this->linkifiedForm);
    }
    
    
    /**
     * 
     * @return array
     */
    private function getPlaceholders() {
        $placeholderMatches = array();        
        
        if (preg_match_all('/%[0-9]/', $this->normalForm, $placeholderMatches) === false) {
            return array();
        }
        
        return $placeholderMatches[0];
    }
    
    
    /**
     * 
     * @return int
     */
    private function getPlaceholderCount() {
        return count($this->getPlaceholders());
    }
    
    private function getPlaceholderValues($parameters = null) {
        $start = ord(self::START_PLACEHOLDER_CHARACTER);
        $placeholderCount = $this->getPlaceholderCount();

        if ($placeholderCount > 3) {
            $start = $start - $placeholderCount + 3;
        }

        $placeholderValues = array();

        for ($index = $start; $index < $start + $placeholderCount; $index++) {
            $placeholderValues[] = chr($index);
        }
        
        if (is_array($parameters)) {
            foreach ($parameters as $key => $value) {
                if (isset($placeholderValues[$key])) {
                    $placeholderValues[$key] = $value;
                }
            }
        }

        return $placeholderValues;     
    }
    
}