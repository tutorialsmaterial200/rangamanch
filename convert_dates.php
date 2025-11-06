<?php

// Script to convert English date formats to Nepali date function calls

$files = [
    'resources/views/frontend/news.blade.php',
    'resources/views/frontend/home-components/main-news.blade.php',
    'resources/views/frontend/home-components/breaking-news.blade.php',
    'resources/views/frontend/news-details.blade.php',
    'resources/views/frontend/home-components/hero-slider.blade.php'
];

foreach ($files as $file) {
    if (file_exists($file)) {
        echo "Processing: $file\n";
        
        $content = file_get_contents($file);
        
        // Replace various date formats
        $content = preg_replace(
            '/\{\{\s*date\(\'M d, Y\'\s*,\s*strtotime\(\$([^)]+)->created_at\)\)\s*\}\}/',
            '{{ getNepaliShortDate($\1->created_at) }}',
            $content
        );
        
        $content = preg_replace(
            '/\{\{\s*date\(\'M D, Y\'\s*,\s*strtotime\(\$([^)]+)->created_at\)\)\s*\}\}/',
            '{{ getNepaliShortDate($\1->created_at) }}',
            $content
        );
        
        $content = preg_replace(
            '/\{\{\s*date\(\'M, d, Y H:i\'\s*,\s*strtotime\(\$([^)]+)->created_at\)\)\s*\}\}/',
            '{{ getNepaliDateTime($\1->created_at) }}',
            $content
        );
        
        file_put_contents($file, $content);
        echo "Updated: $file\n";
    }
}

echo "Date conversion completed!\n";
