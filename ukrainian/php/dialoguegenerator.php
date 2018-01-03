<?php

///////////////////////////////////////////////////////////
//
//  INITIALIZE DIALOGUE VARIABLE
//
////////////////////////////////////////////////////////////




$dialogue_number = 1;

// Set the $dialogue_number variable to the value passed through the URL.  If no value is set, use the default value =1 from above.
if(isset($_GET["dialogue"]))
{
	$dialogue_number_try = $_GET["dialogue"];
}

if(isset($dialogue_number_try))
{
	$dialogue_number = $dialogue_number_try;
} 


$dialogue_next   = $dialogue_number + 1;


// Appends a zero "0" before the dialogue number if it's less than 10.  For example, "5" => "05", etc.
if($dialogue_number > 9)
{
	$dialogue_index  = $dialogue_number;
}

else 
{
	$dialogue_index  = "0".$dialogue_number;
}


if($dialogue_next > 9)
{
	$dialogue_next_index  = $dialogue_next;
}

else 
{
	$dialogue_next_index  = "0".$dialogue_next;
}



$audio_path	 = "audio/dialogue-uk-".$dialogue_index;
$pics_path	 = "img/".$dialogue_index.".png";
$texts_path	 = $_SERVER['DOCUMENT_ROOT']."/ukrainian/texts/";


$english_path      =$texts_path."englishphrases".$dialogue_index.".txt";
$french_path    =$texts_path."ukrainianphrases".$dialogue_index.".txt";
$speaker_path      =$texts_path."speaker".$dialogue_index.".txt";
$grammar_path 	= $texts_path."grammarexplanation".$dialogue_index.".txt";

$literal_path = $texts_path."literaldefinitions".$dialogue_index.".txt";



/////////////////////////////////////////////////////
//
//	ENGLISH
//
///////////////////////////////////////////////////////

$phrases_english       = file_get_contents($english_path,true);
$phrases_english_total = explode("\n", $phrases_english);


////////////////////////////////////////////////////////
//
//	FRENCH
//
/////////////////////////////////////////////////////////

$phrases_french       = file_get_contents($french_path,true);
$phrases_french_total = explode("\n", $phrases_french);


/////////////////////////////////////////////////////
//
//	SPEAKER
//
///////////////////////////////////////////////////////

$speaker         = file_get_contents($speaker_path,true);
$speaker_total = explode("\n", $speaker);



/////////////////////////////////////////////////////
//
//	GRAMMAR
//
///////////////////////////////////////////////////////

if (file_exists($grammar_path)) {
    $grammar         = file_get_contents($grammar_path,true);
}
else {
	$grammar ="<i>No grammar notes for this lesson.</i>";
} 


/////////////////////////////////////////////////////
//
//	LITERAL DEFINITIONS
//
///////////////////////////////////////////////////////

$literal         = file_get_contents($literal_path,true);
$phrases_literal_definitions_total = explode("\n", $literal);


//////////////////////////////////////////////////////
//
//  TRANSLITERATION
//
//////////////////////////////////////////////////////


//Transliteration of the dialogue table text
$phrase_transliteration = new TranslitUk();

$phrases_french_transliterated_total = []; 

foreach ($phrases_french_total as $value) 
{
	$phrases_french_transliterated_total[] = $phrase_transliteration->convert($value);
} 


//Transliteration of the grammar text
$grammar_transliteration = new TranslitUk();
$grammar_transliterated = $grammar_transliteration->convert($grammar);


///////////////////////////////////////////////////////
//
//  TRANSLITERATOR CODE
//
///////////////////////////////////////////////////////

class TranslitUk
{
    public $alphabet = array (
        // upper case
        'А' => 'A',     'Б' => 'B',     'В' => 'V',     'Г' => 'H',
        'ЗГ' => 'Zgh',  'Зг' => 'Zgh',  'Ґ' => 'G',     'Д' => 'D',
        'Е' => 'E',     'Є' => 'Ye',    'Ж' => 'Zh',    'З' => 'Z',
        'И' => 'Y',     'І' => 'I',     'Ї' => 'Yi',     'Й' => 'Y',
        'К' => 'K',     'Л' => 'L',     'М' => 'M',     'Н' => 'N',
        'О' => 'O',     'П' => 'P',     'Р' => 'R',     'С' => 'S',
        'Т' => 'T',     'У' => 'U',     'Ф' => 'F',     'Х' => 'X',
        'Ц' => 'Ts',    'Ч' => 'Ch',    'Ш' => 'Sh',    'Щ' => 'Shch',
        'Ь' => '',      'Ю' => 'Yu',    'Я' => 'Ya',    '’' => '',
        // lower case
        'а' => 'a',     'б' => 'b',     'в' => 'v',     'г' => 'h',
        'зг' => 'zgh',  'ґ' => 'g',     'д' => 'd',     'е' => 'e',
        'є' => 'ye',    'ж' => 'zh',    'з' => 'z',     'и' => 'y',
        'і' => 'i',     'ї' => 'yi',     'й' => 'y',     'к' => 'k',
        'л' => 'l',     'м' => 'm',     'н' => 'n',     'о' => 'o',
        'п' => 'p',     'р' => 'r',     'с' => 's',     'т' => 't',
        'у' => 'u',     'ф' => 'f',     'х' => 'x',    'ц' => 'ts',
        'ч' => 'ch',    'ш' => 'sh',    'щ' => 'shch',  'ь' => '',
        'ю' => 'yu',    'я' => 'ya',    '\'' => '',
    );
    public function convert($text)
    {
        return str_replace(
            array_keys($this->alphabet),
            array_values($this->alphabet),
            preg_replace(
                // use alternative variant at the beginning of a word
                array (
                    '/(?<=^|\s)Є/', '/(?<=^|\s)Ї/', '/(?<=^|\s)Й/',
                    '/(?<=^|\s)Ю/', '/(?<=^|\s)Я/', '/(?<=^|\s)є/',
                    '/(?<=^|\s)ї/', '/(?<=^|\s)й/', '/(?<=^|\s)ю/',
                    '/(?<=^|\s)я/',
                ),
                array (
                    'Ye', 'Yi', 'Y', 'Yu', 'Ya', 'ye', 'yi', 'y', 'yu', 'ya',
                ),
                $text)
        );
    }
}

