<?php

$dir = new RecursiveDirectoryIterator('c:/laragon/www/opeshis/resources/views');
$ite = new RecursiveIteratorIterator($dir);
$files = new RegexIterator($ite, '/.*\.blade\.php$/', RegexIterator::GET_MATCH);

$replacements = [
    // Backgrounds and Panels
    'bg-white/5' => 'bg-[#2a2e38]',
    'bg-white/[0.02]' => 'bg-card',
    'bg-[#2a2e38] border border-slate-700/60' => 'bg-card border border-subtle',
    'border-slate-700/60' => 'border-subtle',
    'border-white/10' => 'border-subtle',
    'glass-panel' => 'bg-card',
    
    // Typography 
    'font-black' => 'font-semibold',
    'text-[9px]' => 'text-[10px]',
    'text-[10px]' => 'text-[11px]',
    'text-[11px]' => 'text-[12px]',
    'tracking-[0.2em]' => 'tracking-wider',
    'tracking-widest' => 'tracking-wider',
    'uppercase tracking-wider' => 'font-medium',
    'italic' => '',
    'text-slate-100' => 'text-white',
    
    // Shadows and glows
    'shadow-[0_8px_30px_rgb(0,0,0,0.12)]' => 'shadow-lg',
    'border-amber-500/20 bg-gradient-to-br from-amber-500/5 to-transparent' => 'border-subtle bg-card',
];

$changedFiles = 0;

foreach ($files as $file) {
    $path = $file[0];
    
    // Skip components that might rely on specific formatting, we just want to hit modules
    if (strpos($path, 'components') !== false || strpos($path, 'layouts') !== false) {
        continue;
    }

    $content = file_get_contents($path);
    $original = $content;

    foreach ($replacements as $old => $new) {
        $content = str_replace($old, $new, $content);
    }
    
    // Clean up multiple spaces left by replacing 'italic' with ''
    $content = preg_replace('/ {2,}/', ' ', $content);
    $content = str_replace('class=" ', 'class="', $content);

    if ($original !== $content) {
        file_put_contents($path, $content);
        $changedFiles++;
    }
}

echo "Updated $changedFiles files successfully.\n";

