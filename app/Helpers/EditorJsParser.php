<?php

namespace App\Helpers;

class EditorJsParser
{
    /**
     * Parse EditorJS content to HTML
     */
    public static function parse(array $block): string
    {
        $type = $block['type'] ?? null;
        $data = $block['data'] ?? [];

        return match ($type) {
            'paragraph' => self::parseParagraph($data),
            'header' => self::parseHeader($data),
            'list' => self::parseList($data),
            'quote' => self::parseQuote($data),
            'code' => self::parseCode($data),
            'image' => self::parseImage($data),
            'delimiter' => self::parseDelimiter(),
            default => '',
        };
    }

    /**
     * Parse paragraph with inline formatting
     */
    private static function parseParagraph(array $data): string
    {
        $text = $data['text'] ?? '';

        // Decode HTML entities first
        $text = html_entity_decode($text, ENT_QUOTES | ENT_HTML5, 'UTF-8');

        // If text already contains HTML (links, bold, code, etc.), render it directly
        // This handles EditorJS output with inline HTML
        if (self::containsHtml($text)) {
            // Make sure to clean and enhance the HTML
            $content = self::cleanHtmlContent($text);
            return '<p class="text-white/80 leading-relaxed text-lg">' . $content . '</p>';
        }

        // If there are inline marks/formatting via spans
        if (isset($data['spans']) && is_array($data['spans'])) {
            return '<p class="text-white/80 leading-relaxed text-lg">' . self::applyInlineFormatting($text, $data['spans']) . '</p>';
        }

        // Otherwise just render plain text
        return '<p class="text-white/80 leading-relaxed text-lg">' . nl2br(htmlspecialchars($text)) . '</p>';
    }

    /**
     * Parse heading with inline formatting
     */
    private static function parseHeader(array $data): string
    {
        $text = $data['text'] ?? '';

        // Decode HTML entities first
        $text = html_entity_decode($text, ENT_QUOTES | ENT_HTML5, 'UTF-8');

        $level = $data['level'] ?? 2;

        $headingClass = match ($level) {
            1 => 'text-4xl font-bold',
            2 => 'text-3xl font-bold',
            3 => 'text-2xl font-bold',
            4 => 'text-xl font-bold',
            default => 'text-lg font-bold'
        };

        // Check if text contains HTML
        if (self::containsHtml($text)) {
            $content = self::cleanHtmlContent($text);
        } elseif (isset($data['spans']) && is_array($data['spans'])) {
            $content = self::applyInlineFormatting($text, $data['spans']);
        } else {
            $content = htmlspecialchars($text);
        }

        return "<h{$level} class=\"text-white {$headingClass} mt-8 mb-4\">{$content}</h{$level}>";
    }

    /**
     * Parse list (ordered or unordered)
     */
    private static function parseList(array $data): string
    {
        $items = $data['items'] ?? [];
        $style = $data['style'] ?? 'unordered';

        if (empty($items)) {
            return '';
        }

        $tag = $style === 'ordered' ? 'ol' : 'ul';
        $listClass = $style === 'ordered' ? 'list-decimal' : 'list-disc';

        $html = "<{$tag} class=\"{$listClass} list-inside text-white/80 space-y-2\">";

        foreach ($items as $item) {
            $content = '';

            if (is_array($item)) {
                $text = $item['content'] ?? '';
                // Decode HTML entities
                $text = html_entity_decode($text, ENT_QUOTES | ENT_HTML5, 'UTF-8');
                $spans = $item['spans'] ?? [];

                // Check if text contains HTML (includes inline code)
                if (self::containsHtml($text)) {
                    $content = self::cleanHtmlContent($text);
                } elseif (!empty($spans)) {
                    $content = self::applyInlineFormatting($text, $spans);
                } else {
                    $content = htmlspecialchars($text);
                }
            } else {
                // Check if item is string with HTML
                $item = html_entity_decode($item, ENT_QUOTES | ENT_HTML5, 'UTF-8');
                if (self::containsHtml($item)) {
                    $content = self::cleanHtmlContent($item);
                } else {
                    $content = htmlspecialchars($item);
                }
            }

            $html .= "<li class=\"ml-4\">{$content}</li>";
        }

        $html .= "</{$tag}>";
        return $html;
    }

    /**
     * Parse quote
     */
    private static function parseQuote(array $data): string
    {
        $text = $data['text'] ?? '';
        $caption = $data['caption'] ?? '';

        // Decode HTML entities
        $text = html_entity_decode($text, ENT_QUOTES | ENT_HTML5, 'UTF-8');

        // Check if text contains HTML
        if (self::containsHtml($text)) {
            $content = self::cleanHtmlContent($text);
        } elseif (isset($data['spans']) && is_array($data['spans'])) {
            $content = self::applyInlineFormatting($text, $data['spans']);
        } else {
            $content = htmlspecialchars($text);
        }

        $html = '<blockquote class="border-l-4 border-primary pl-6 py-2 my-6 text-white/80 italic">';
        $html .= $content;

        if ($caption) {
            $html .= '<footer class="text-sm text-textMuted mt-2 not-italic">— ' . htmlspecialchars($caption) . '</footer>';
        }

        $html .= '</blockquote>';
        return $html;
    }

    /**
     * Parse code block
     */
    private static function parseCode(array $data): string
    {
        $code = $data['code'] ?? '';
        // Decode HTML entities
        $code = html_entity_decode($code, ENT_QUOTES | ENT_HTML5, 'UTF-8');
        return '<pre class="bg-white/5 border border-white/10 rounded-lg p-4 overflow-x-auto my-6">' .
               '<code class="text-primary text-sm font-mono">' . htmlspecialchars($code) . '</code>' .
               '</pre>';
    }

    /**
     * Parse image
     */
    private static function parseImage(array $data): string
    {
        $url = $data['file']['url'] ?? '';
        $caption = $data['caption'] ?? '';

        // Decode HTML entities
        $caption = html_entity_decode($caption, ENT_QUOTES | ENT_HTML5, 'UTF-8');

        if (empty($url)) {
            return '';
        }

        $html = '<figure class="my-8">';
        $html .= '<img src="' . htmlspecialchars($url) . '" class="w-full rounded-lg border border-white/10 shadow-lg" alt="' . htmlspecialchars($caption) . '" loading="lazy">';

        if ($caption) {
            $html .= '<figcaption class="text-center text-sm text-textMuted/60 mt-3 italic">' . htmlspecialchars($caption) . '</figcaption>';
        }

        $html .= '</figure>';
        return $html;
    }

    /**
     * Parse delimiter
     */
    private static function parseDelimiter(): string
    {
        return '<hr class="border-t border-white/10 my-8">';
    }

    /**
     * Apply inline formatting (bold, italic, links, etc.)
     */
    private static function applyInlineFormatting(string $text, array $spans): string
    {
        if (empty($spans)) {
            return htmlspecialchars($text);
        }

        // Decode HTML entities in text first
        $text = html_entity_decode($text, ENT_QUOTES | ENT_HTML5, 'UTF-8');

        // Convert to array for manipulation
        $chars = str_split($text);
        $result = [];
        $i = 0;

        // Sort spans by start position
        usort($spans, fn($a, $b) => ($a['start'] ?? 0) <=> ($b['start'] ?? 0));

        foreach ($spans as $span) {
            $start = $span['start'] ?? 0;
            $end = $span['end'] ?? $start;
            $type = $span['type'] ?? '';
            $data = $span['data'] ?? [];

            // Add text before this span
            while ($i < $start && $i < count($chars)) {
                $result[] = htmlspecialchars($chars[$i]);
                $i++;
            }

            // Get span text
            $spanText = '';
            while ($i < $end && $i < count($chars)) {
                $spanText .= $chars[$i];
                $i++;
            }

            // Apply formatting
            switch ($type) {
                case 'bold':
                    $result[] = '<strong>' . htmlspecialchars($spanText) . '</strong>';
                    break;
                case 'italic':
                    $result[] = '<em>' . htmlspecialchars($spanText) . '</em>';
                    break;
                case 'link':
                    $href = $data['url'] ?? '#';
                    $result[] = '<a href="' . htmlspecialchars($href) . '" class="underline hover:text-primary transition-colors" target="_blank" rel="noopener noreferrer">' . htmlspecialchars($spanText) . '</a>';
                    break;
                case 'code':
                    $result[] = '<code class="font-mono text-sm text-primary bg-white/5 px-1.5 py-0.5 rounded">' . htmlspecialchars($spanText) . '</code>';
                    break;
                default:
                    $result[] = htmlspecialchars($spanText);
            }
        }

        // Add remaining text
        while ($i < count($chars)) {
            $result[] = htmlspecialchars($chars[$i]);
            $i++;
        }

        return implode('', $result);
    }

    /**
     * Check if text contains HTML tags
     */
    private static function containsHtml(string $text): bool
    {
        return preg_match('/<[a-z][\s\S]*>/i', $text) === 1;
    }

    /**
     * Clean and style HTML content
     * Enhance links with proper styling and handle other inline elements
     */
    private static function cleanHtmlContent(string $html): string
    {
        // Decode HTML entities (&nbsp; -> space, &amp; -> &, etc)
        $html = html_entity_decode($html, ENT_QUOTES | ENT_HTML5, 'UTF-8');

        // Style inline code tags
        $html = preg_replace_callback(
            '/<code(?:\s[^>]*)?>([^<]*)<\/code>/i',
            function($matches) {
                $content = $matches[1];
                return '<code class="font-mono text-sm text-primary bg-white/5 px-1.5 py-0.5 rounded">' . htmlspecialchars($content) . '</code>';
            },
            $html
        );

        // Add underline and styling to links
        $html = preg_replace_callback(
            '/<a\s+([^>]*?)href=(["\']?)([^"\'>\s]+)\2([^>]*?)>/i',
            function($matches) {
                $attrs = $matches[1] . ' ' . $matches[4];
                $href = $matches[3];

                // Check if already has class
                if (strpos($attrs, 'class=') !== false) {
                    $attrs = preg_replace('/class=(["\'])([^"\']*)\1/',
                        'class=$1$2 underline hover:text-primary transition-colors$1', $attrs);
                } else {
                    $attrs .= ' class="underline hover:text-primary transition-colors"';
                }

                // Ensure target="_blank" for external links
                if (strpos($attrs, 'target=') === false) {
                    $attrs .= ' target="_blank" rel="noopener noreferrer"';
                }

                return '<a href="' . htmlspecialchars($href) . '" ' . $attrs . '>';
            },
            $html
        );

        return $html;
    }
}
