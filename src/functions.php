<?php 

function dd($d){
    echo "<pre>";
        var_dump($d);
    echo "</pre>";
    die;
}

if(!defined('LECTIONARY_LANG'))
    define('LECTIONARY_LANG','pt_BR');


$translator = new Gettext\Translator();
try {
    $translationFile = 'locales/' . LECTIONARY_LANG .'/lectionary.po';
    if (!file_exists($translationFile)) {
        if (file_exists(dirname(__FILE__) . '/../' . $translationFile)) {
            $translationFile = dirname(__FILE__) . '/../' . $translationFile;
        }
    }
    
    $translations = Gettext\Translations::fromPoFile($translationFile);
} catch (\Exception $e) {
    $translations = new Gettext\Translations();
}

$translator->loadTranslations($translations);
$translator->register();

function translateBooks($text){
    $text = str_replace(['or', 'and'], [__('or'),__('and')], $text);
    
    $textRe = str_replace(booksBible(), booksBibleTranslate(), $text);
    // foreach (booksBible() as $book) {
    //     $textRe = str_replace($book, __($book), $text);
    //     if($textRe != $text)
    //         return $textRe;
    // }
    
    return $textRe;
}

function booksBible(){
    return $booksBible = [
        'Genesis',
        'Exodus',
        'Leviticus',
        'Numbers',
        'Deuteronomy',
        'Joshua',
        'Judges',
        'Ruth',
        '1 Samuel',
        '2 Samuel',
        '1 Kings',
        '2 Kings',
        '1 Chronicles',
        '2 Chronicles',
        'Ezra',
        'Nehemiah',
        'Esther',
        'Job',
        'Psalm',
        'Psalms',
        'Proverbs',
        'Ecclesiastes',
        'Song of Solomon',
        'Isaiah',
        'Jeremiah',
        'Lamentations',
        'Ezekiel',
        'Daniel',
        'Hosea',
        'Joel',
        'Amos',
        'Obadiah',
        'Jonah',
        'Micah',
        'Nahum',
        'Habakkuk',
        'Zephaniah',
        'Haggai',
        'Zechariah',
        'Malachi',
        'Matthew',
        'Mark',
        'Luke',
        'John',
        'Acts',
        'Romans',
        '1 Corinthians',
        '2 Corinthians',
        'Galatians',
        'Ephesians',
        'Philippians',
        'Colossians',
        '1 Thessalonians',
        '2 Thessalonians',
        '1 Timothy',
        '2 Timothy',
        'Titus',
        'Philemon',
        'Hebrews',
        'James',
        '1 Peter',
        '2 Peter',
        '1 John',
        '2 John',
        '3 John',
        'Jude',
        'Revelation'
    ];
}

function booksBibleTranslate(){
    return $booksBibleTranslate = [
        __('Genesis'),
        __('Exodus'),
        __('Leviticus'),
        __('Numbers'),
        __('Deuteronomy'),
        __('Joshua'),
        __('Judges'),
        __('Ruth'),
        __('1 Samuel'),
        __('2 Samuel'),
        __('1 Kings'),
        __('2 Kings'),
        __('1 Chronicles'),
        __('2 Chronicles'),
        __('Ezra'),
        __('Nehemiah'),
        __('Esther'),
        __('Job'),
        __('Psalm'),
        __('Psalms'),
        __('Proverbs'),
        __('Ecclesiastes'),
        __('Song of Solomon'),
        __('Isaiah'),
        __('Jeremiah'),
        __('Lamentations'),
        __('Ezekiel'),
        __('Daniel'),
        __('Hosea'),
        __('Joel'),
        __('Amos'),
        __('Obadiah'),
        __('Jonah'),
        __('Micah'),
        __('Nahum'),
        __('Habakkuk'),
        __('Zephaniah'),
        __('Haggai'),
        __('Zechariah'),
        __('Malachi'),
        __('Matthew'),
        __('Mark'),
        __('Luke'),
        __('John'),
        __('Acts'),
        __('Romans'),
        __('1 Corinthians'),
        __('2 Corinthians'),
        __('Galatians'),
        __('Ephesians'),
        __('Philippians'),
        __('Colossians'),
        __('1 Thessalonians'),
        __('2 Thessalonians'),
        __('1 Timothy'),
        __('2 Timothy'),
        __('Titus'),
        __('Philemon'),
        __('Hebrews'),
        __('James'),
        __('1 Peter'),
        __('2 Peter'),
        __('1 John'),
        __('2 John'),
        __('3 John'),
        __('Jude'),
        __('Revelation')
    ];
}
function booksBibleShort(){
    return $booksBibleShort = [
        'Ge',
        'Ex',
        'Le',
        'Nu',
        'Dt',
        'Jos',
        'Jdg',
        'Ru',
        '1Sa',
        '2Sa',
        '1Ki',
        '2Ki',
        '1Ch',
        '2Ch',
        'Ezr',
        'Ne',
        'Es',
        'Job',
        'Ps',
        'Pr',
        'Ec',
        'So',
        'Is',
        'Je',
        'La',
        'Eze',
        'Da',
        'Ho',
        'Joe',
        'Am',
        'Ob',
        'Jon',
        'Mic',
        'Na',
        'Hab',
        'Zep',
        'Hag',
        'Zec',
        'Mal',
        'Mt',
        'Mk',
        'Lu',
        'Jn',
        'Ac',
        'Ro',
        '1Co',
        '2Co',
        'Ga',
        'Eph',
        'Php',
        'Col',
        '1Th',
        '2Th',
        '1Ti',
        '2Ti',
        'Tit',
        'Phm',
        'Heb',
        'Jas',
        '1Pe',
        '2Pe',
        '1Jn',
        '2Jn',
        '3Jn',
        'Jud',
        'Re'
    ];
}

function booksBibleShortTranslate(){
    return $booksBibleShortTranslate = [
        __('Ge'),
        __('Ex'),
        __('Le'),
        __('Nu'),
        __('Dt'),
        __('Jos'),
        __('Jdg'),
        __('Ru'),
        __('1Sa'),
        __('2Sa'),
        __('1Ki'),
        __('2Ki'),
        __('1Ch'),
        __('2Ch'),
        __('Ezr'),
        __('Ne'),
        __('Es'),
        __('Job'),
        __('Ps'),
        __('Pr'),
        __('Ec'),
        __('So'),
        __('Is'),
        __('Je'),
        __('La'),
        __('Eze'),
        __('Da'),
        __('Ho'),
        __('Joe'),
        __('Am'),
        __('Ob'),
        __('Jon'),
        __('Mic'),
        __('Na'),
        __('Hab'),
        __('Zep'),
        __('Hag'),
        __('Zec'),
        __('Mal'),
        __('Mt'),
        __('Mk'),
        __('Lu'),
        __('Jn'),
        __('Ac'),
        __('Ro'),
        __('1Co'),
        __('2Co'),
        __('Ga'),
        __('Eph'),
        __('Php'),
        __('Col'),
        __('1Th'),
        __('2Th'),
        __('1Ti'),
        __('2Ti'),
        __('Tit'),
        __('Phm'),
        __('Heb'),
        __('Jas'),
        __('1Pe'),
        __('2Pe'),
        __('1Jn'),
        __('2Jn'),
        __('3Jn'),
        __('Jud'),
        __('Re')
    ];
}
?>