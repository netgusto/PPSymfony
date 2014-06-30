<?php

namespace Pulpy\CoreBundle\Services\TextProcessor\Markdown;

interface MarkdownProcessorInterface {
    public function toHtml($markdown);
    public function toInlineHtml($markdown);
}