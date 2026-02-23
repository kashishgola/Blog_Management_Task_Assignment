<?php
class Helpers {

    public static function generateSlug($text) {
        $slug = strtolower(trim(preg_replace('/[^A-Za-z0-9-]+/', '-', $text)));
        return rtrim($slug, '-');
    }
    // 1. Clean normal text (title, name, etc.)
    public static function cleanText($text) {
        $text = trim($text);                     // Remove spaces
        $text = strip_tags($text);               // Remove HTML tags
        $text = htmlspecialchars($text, ENT_QUOTES, 'UTF-8'); // Prevent XSS
        return $text;
    }

    // 2. Sanitize HTML (for descriptions but allow limited tags)
    public static function sanitizeHTML($html) {
        // Allowed tags: <b>, <i>, <strong>, <em>, <p>, <br>, <ul>, <ol>, <li>, <a>
        $allowed_tags = '<b><i><strong><em><p><br><ul><ol><li><a>';

        $html = strip_tags($html, $allowed_tags); 

        // Prevent dangerous JS inside attributes
        $html = preg_replace('/on\w+="[^"]*"/i', '', $html);   // Remove onclick, onload, etc.
        $html = preg_replace('/javascript:/i', '', $html);     // Remove JS links

        return trim($html);
    }

    // 3. Sanitize URL properly
    public static function sanitizeURL($url) {
        $url = trim($url);
        $url = filter_var($url, FILTER_SANITIZE_URL);
        return $url ?: null;
    }
}