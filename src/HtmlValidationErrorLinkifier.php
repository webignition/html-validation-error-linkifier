<?php

namespace webignition\HtmlValidationErrorLinkifier;

class HtmlValidationErrorLinkifier
{
    const START_PLACEHOLDER_CHARACTER = 'x';

    private $normalForm = '';
    private $linkifiedForm = '';

    /**
     * @param string $normalForm
     * @param array $parameters
     * @return string
     */
    public function linkify($normalForm, $parameters = null)
    {
        $this->normalForm = $normalForm;
        $this->linkifiedForm = $normalForm;

        $placeholders = $this->getPlaceholders();

        $this->replacePlaceholders($placeholders, $parameters);
        $this->replaceAmpWithAmpersandPlaceholder();
        $this->removePunctuation();
        $this->replaceSpaces();
        $this->replaceSlashes();
        $this->replaceAmpersandPlaceholder();
        $this->replaceDoubleHyphens();

        return $this->linkifiedForm;
    }

    private function replaceDoubleHyphens()
    {
        while (substr_count($this->linkifiedForm, '--') > 0) {
            $this->linkifiedForm = str_replace('--', '-', $this->linkifiedForm);
        }
    }

    private function replaceAmpersandPlaceholder()
    {
        $this->linkifiedForm = str_replace('&', 'ampersand', $this->linkifiedForm);
        $this->linkifiedForm = str_replace('ampersand_placeholder', 'amp', $this->linkifiedForm);
    }

    private function replaceAmpWithAmpersandPlaceholder()
    {
        $this->linkifiedForm = str_replace('&amp', 'ampersand_placeholder', $this->linkifiedForm);
    }

    /**
     * @param array $placeholders
     * @param array $parameters
     */
    private function replacePlaceholders(array $placeholders, $parameters = null)
    {
        $placeholderValues = $this->getPlaceholderValues(count($placeholders), $parameters);

        $this->linkifiedForm = strtolower(str_replace($placeholders, $placeholderValues, $this->normalForm));
    }

    private function replaceSlashes()
    {
        $this->linkifiedForm = str_replace('/', '-slash-', $this->linkifiedForm);
    }

    private function replaceSpaces()
    {
        $this->linkifiedForm = str_replace(' ', '-', $this->linkifiedForm);
    }

    private function removePunctuation()
    {
        $this->linkifiedForm = str_replace([',', '.', ':', ';', '"', '(', ')','/>'], '', $this->linkifiedForm);
    }

    /**
     * @return string[]
     */
    private function getPlaceholders()
    {
        $placeholderMatches = [];
        preg_match_all('/%[0-9]/', $this->normalForm, $placeholderMatches);

        return $placeholderMatches[0];
    }

    /**
     * @param int $placeholderCount
     * @param array $parameters
     *
     * @return array
     */
    private function getPlaceholderValues($placeholderCount, $parameters = null)
    {
        $start = ord(self::START_PLACEHOLDER_CHARACTER);

        if ($placeholderCount > 3) {
            $start = $start - $placeholderCount + 3;
        }

        $placeholderValues = [];

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
