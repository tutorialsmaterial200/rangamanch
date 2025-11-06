<?php

use App\Models\Language;
use App\Models\Setting;
use Illuminate\Support\Str;
use Carbon\Carbon;
use PhpParser\Node\Expr\Cast\String_;

/** format news tags */

function formatTags(array $tags): String
{
   return implode(',', $tags);
}

/** get selected language from session */
function getLangauge(): string
{
    if(session()->has('language')){
        return session('language');
    }else {
        try {
            $language = Language::where('default', 1)->first();
            setLanguage($language->lang);

            return $language->lang;
        } catch (\Throwable $th) {
            setLanguage('en');

            return 'en';
        }
    }
}

/** set language code in session */
function setLanguage(string $code): void
{
    session(['language' => $code]);
}

/** Truncate text */

function truncate(string $text, int $limit = 45): String
{
    return Str::limit($text, $limit, '...');
}

/** Convert a number in K format */

function convertToKFormat(int $number): String
{
    if($number < 1000){
        return $number;
    }elseif($number < 1000000){
        return round($number / 1000, 1) . 'K';
    }else {
        return round($number / 1000000, 1). 'M';
    }
}

/** Make Sidebar Active */

function setSidebarActive(array $routes): ?string
{
    foreach($routes as $route){
        if(request()->routeIs($route)){
            return 'active';
        }
    }
    return '';
}

/** get Setting */

function getSetting($key){
    $data = Setting::where('key', $key)->first();
    return $data->value;
}

/** check permission */

function canAccess(array $permissions){
   /** @var \App\Models\Admin|null $user */
   $user = auth()->guard('admin')->user();
   
   if (!$user) {
       return false;
   }

   $permission = $user->hasAnyPermission($permissions);
   $superAdmin = $user->hasRole('Super Admin');

   if($permission || $superAdmin){
    return true;
   }else {
    return false;
   }

}

/** get admin role */

function getRole(){
    /** @var \App\Models\Admin|null $user */
    $user = auth()->guard('admin')->user();
    
    if (!$user) {
        return null;
    }
    
    $role = $user->getRoleNames();
    return $role->first();
}

/** check user permission */

function checkPermission(string $permission){
    /** @var \App\Models\Admin|null $user */
    $user = auth()->guard('admin')->user();
    
    if (!$user) {
        return false;
    }
    
    return $user->hasPermissionTo($permission);
}

/** Convert English date to Nepali Bikram Sambat date */
function getNepaliDate($date = null): string
{
    if ($date === null) {
        $date = now();
    }
    
    if (is_string($date)) {
        $date = Carbon::parse($date);
    }
    
    // English to Nepali day names mapping
    $nepaliDays = [
        'Sunday' => 'आइतबार',
        'Monday' => 'सोमबार',
        'Tuesday' => 'मंगलबार',
        'Wednesday' => 'बुधबार',
        'Thursday' => 'बिहीबार',
        'Friday' => 'शुक्रबार',
        'Saturday' => 'शनिबार'
    ];
    
    $dayName = $nepaliDays[$date->format('l')];
    
    // Convert to Nepali Bikram Sambat date with Nepali numerals
    try {
        $nepaliDateObj = \Anuzpandey\LaravelNepaliDate\LaravelNepaliDate::from($date->format('Y-m-d'));
        
        // Try to get Nepali date string
        $nepaliDateStr = $nepaliDateObj->toNepaliDate('j F Y', 'np');
        
        // Force conversion of all English numerals to Nepali numerals
        $nepaliDateStr = str_replace(
            ['0', '1', '2', '3', '4', '5', '6', '7', '8', '9'],
            ['०', '१', '२', '३', '४', '५', '६', '७', '८', '९'],
            $nepaliDateStr
        );
        
        return $nepaliDateStr . ', ' . $dayName;
    } catch (\Exception $e) {
        // Fallback to basic conversion with Nepali numerals
        $nepaliMonths = [
            'बैशाख', 'जेष्ठ', 'असार', 'सावन', 'भदौ', 'असोज',
            'कार्तिक', 'मंसिर', 'पुस', 'माघ', 'फागुन', 'चैत्र'
        ];
        
        $day = str_replace(['0', '1', '2', '3', '4', '5', '6', '7', '8', '9'], ['०', '१', '२', '३', '४', '५', '६', '७', '८', '९'], $date->format('j'));
        $year = str_replace(['0', '1', '2', '3', '4', '5', '6', '7', '8', '9'], ['०', '१', '२', '३', '४', '५', '६', '७', '८', '९'], $date->format('Y'));
        $month = $nepaliMonths[$date->format('n') - 1] ?? 'असोज';
        
        return $day . ' ' . $month . ' ' . $year . ', ' . $dayName;
    }
}

/** Convert English numerals to Nepali numerals */
function convertToNepaliNumerals($text): string
{
    $nepaliNumerals = [
        '0' => '०', '1' => '१', '2' => '२', '3' => '३', '4' => '४',
        '5' => '५', '6' => '६', '7' => '७', '8' => '८', '9' => '९'
    ];
    
    // Convert any English digits to Nepali digits in the text
    return strtr((string)$text, $nepaliNumerals);
}

/** Convert number to K format with Nepali numerals */
function convertToNepaliKFormat($number): string
{
    // If it's already a formatted string (like '200k'), just convert numerals
    if (is_string($number) && (strpos($number, 'k') !== false || strpos($number, 'K') !== false)) {
        return convertToNepaliNumerals($number);
    }
    
    // Convert to integer if it's a string number
    if (is_string($number)) {
        $number = (int) $number;
    }
    
    $formatted = convertToKFormat($number);
    return convertToNepaliNumerals($formatted);
}

/** Display any count in Nepali numerals */
function nepaliCount($count): string
{
    return convertToNepaliNumerals($count);
}



/** Convert English date to short Nepali Bikram Sambat date */
function getNepaliShortDate($date = null): string
{
    if ($date === null) {
        $date = now();
    }
    
    if (is_string($date)) {
        $date = Carbon::parse($date);
    }
    
    // Temporary fallback - use simple conversion  
    try {
        $nepaliDateObj = \Anuzpandey\LaravelNepaliDate\LaravelNepaliDate::from($date->format('Y-m-d'));
        return $nepaliDateObj->toNepaliDate('j F Y', 'np');
    } catch (\Exception $e) {
        // Fallback to basic conversion
        return convertToNepaliNumerals($date->format('j')) . ' ' . 
               convertToNepaliNumerals($date->format('m')) . ' ' . 
               convertToNepaliNumerals($date->format('Y'));
    }
}

/** Convert English date to Nepali Bikram Sambat date with time */
function getNepaliDateTime($date = null): string
{
    if ($date === null) {
        $date = now();
    }
    
    if (is_string($date)) {
        $date = Carbon::parse($date);
    }
    
    // English to Nepali numerals mapping
    $nepaliNumerals = [
        '0' => '०', '1' => '१', '2' => '२', '3' => '३', '4' => '४',
        '5' => '५', '6' => '६', '7' => '७', '8' => '८', '9' => '९'
    ];
    
    $time = $date->format('H:i');
    $nepaliTime = strtr($time, $nepaliNumerals);
    
    // Temporary fallback - use simple conversion
    try {
        $nepaliDateObj = \Anuzpandey\LaravelNepaliDate\LaravelNepaliDate::from($date->format('Y-m-d'));
        $nepaliDateStr = $nepaliDateObj->toNepaliDate('j F Y', 'np');
        return $nepaliDateStr . ' ' . $nepaliTime;
    } catch (\Exception $e) {
        // Fallback to basic conversion
        return convertToNepaliNumerals($date->format('j')) . ' ' . 
               convertToNepaliNumerals($date->format('m')) . ' ' . 
               convertToNepaliNumerals($date->format('Y')) . ' ' . $nepaliTime;
    }
}

/** Extract YouTube video ID from various URL formats */
function extractYoutubeId(string $url): string
{
    if (empty($url)) {
        return '';
    }

    try {
        $patterns = [
            '/(?:youtube\.com\/watch\?v=|youtu\.be\/|youtube\.com\/embed\/)([^&?\/\s]{11})/',
            '/^([a-zA-Z0-9_-]{11})$/'
        ];

        foreach ($patterns as $pattern) {
            if (preg_match($pattern, $url, $matches)) {
                return $matches[1] ?? '';
            }
        }
    } catch (\Exception $e) {
        return '';
    }

    return '';
}
