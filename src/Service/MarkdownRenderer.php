<?php
declare(strict_types=1);

namespace App\Service;

use Knp\Bundle\MarkdownBundle\MarkdownParserInterface;

class MarkdownRenderer
{

    private MarkdownParserInterface $parser;

    public function __construct(MarkdownParserInterface $parser)
    {
        $this->parser = $parser;
    }

    public function render(string $md): string {
        return $this->parser->transformMarkdown($md);
    }
}
