<?php

/* STEP 1:  Get files */

$text = "";

for($i=1; $i<=23; $i++)
{
	if($i<10)
	{
		$index = "0" . $i;
	} else
	{
		$index = $i;
	}
		

	$path_schema = "texts/turkishphrases";
	$path        = "texts/turkishphrases" . $index . ".txt"; 

	$str = file_get_contents($path, true);
	
	$text = $text." ".$str;
}

/* STEP 2:  Transliterate files */

//$transliteration = new TranslitUk();
//$transliterated = $transliteration->convert($text);


/* Step 3:  Lowercase files */

//$text = strtolower($transliterated);
//$text = strtolower($text);


$text = mb_convert_case($text, MB_CASE_LOWER, "UTF-8"); 

/* Step 4: Generate an array of all the words */

$words_array = preg_split("/[,.;\[\]!?–«»� ]/",$text);


/* Step 4.1:  Make the array unique and sort */

$unique_words_array = array_unique($words_array);
$unique_words_array = array_values($unique_words_array);
sort($unique_words_array);


/* Step 5:  Display the array */

echo count($unique_words_array);
echo "<br>";

for($i=0; $i<count($unique_words_array);$i++)
{
	echo $unique_words_array[$i];
	echo "<br>";
}

///////////////////////////////////////////////////////
//
//  TRANSLITERATOR
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
