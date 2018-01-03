<?php



$texts_path	 = $_SERVER['DOCUMENT_ROOT']."/turkish/texts/";


$lesson_topic_path = $texts_path."topics.txt";

$lesson_topics       = file_get_contents($lesson_topic_path,true);
$lesson_topics_total = explode("\n", $lesson_topics);


echo "	<link rel='stylesheet' href='/css/style-lesson-links.css'>";

		echo "<div class='lessons-links-nav column'>";

			echo "<div class='lessons-links-nav-container'>";

			$number_of_dialogues = 23;

			echo "<div class='lesson-links-header lessons-header-in-links' id='lessons-header-in-links'><b>Lessons</b><div class='minus-accordion-links' id='plus-accordion-links'></div></div>";

			echo "<div class='lesson-links-lessons-wrapper' id='lesson-links-lessons-wrapper' >";

			for($i=1; $i<= $number_of_dialogues; $i++)
			{



				echo "<a href=";
				echo "'lessons.php?dialogue=".$i."'>";
				echo "<span class='lesson-links-topic'>";


				if ($i<10)
				{
					echo "<b><span class='hidden'>0</span>".$i.": </b>";
				}
				else
				{
					echo "<b>".$i.": </b>";
				}



				echo $lesson_topics_total[$i-1];
				echo "</span>";
				echo "</a> ";

			}

			echo "</div>";

			echo "<div class='lesson-links-header grammar-header' id='grammar-header'><b>Grammar<br>Appendix</b><div class='plus-accordion-grammar' id='plus-accordion-grammar'></div></div><p>";

			echo "<div id = 'lesson-links-grammer-wrapper' class = 'lesson-links-grammar-wrapper lesson-links-nav'>";

				echo "Verbs<br>";
				echo "<span class='lesson-links-topic'><a href='grammar.php?grammarlesson=1'>- Present Tense</a></span>";
				echo "<span class='lesson-links-topic'><a href='grammar.php?grammarlesson=10'>- Past Tense</a></span>";
				echo "<span class='lesson-links-topic'><a href='grammar.php?grammarlesson=20'>- Future Tense</a></span>";

				echo "Nouns and Adjectives";
				echo "<span class='lesson-links-topic'><a href='grammar.php?grammarlesson=30'>- Plurals</a></span>";
				echo "<span class='lesson-links-topic'><a href='grammar.php?grammarlesson=31'>- \"And\" and \"Or\"</a></span>";
				echo "<span class='lesson-links-topic'><a href='grammar.php?grammarlesson=32'>- Adjectives</a></span>";
				echo "<span class='lesson-links-topic'><a href='grammar.php?grammarlesson=33'>- Indicatives</a></span>";
				echo "<span class='lesson-links-topic'><a href='grammar.php?grammarlesson=34'>- Pronouns</a></span>";
				echo "<span class='lesson-links-topic'><a href='grammar.php?grammarlesson=35'>- Possessives</a></span>";


				echo "Special Verbs";
				echo "<span class='lesson-links-topic'><a href='grammar.php?grammarlesson=40'>- The verb \"to be\" (\"is, am, are\")</a></span>";
				echo "<span class='lesson-links-topic'><a href='grammar.php?grammarlesson=42'>- The verb \"to have\"</a></span>";
				echo "<span class='lesson-links-topic'><a href='grammar.php?grammarlesson=43'>- The verb \"to go\"</a></span>";

				echo "Sentence Types";
				echo "<span class='lesson-links-topic'><a href='grammar.php?grammarlesson=51'>- Indicative Sentences</a></span>";
				echo "<span class='lesson-links-topic'><a href='grammar.php?grammarlesson=52'>- Questions</a></span>";
				echo "<span class='lesson-links-topic'><a href='grammar.php?grammarlesson=53'>- Imperatives</a></span>";

				echo "Adverbs";
				echo "<span class='lesson-links-topic'><a href='grammar.php?grammarlesson=60'>- Temporal Adverbs</a></span>";

				echo "Clauses and Connectives";
				echo "<span class='lesson-links-topic'><a href='grammar.php?grammarlesson=70'>- \"and\", \"but\", \"so\"</a></span>";
				echo "<span class='lesson-links-topic'><a href='#'>- If..., then...</a></span>";
				echo "<span class='lesson-links-topic'><a href='#'>- ..., because...</a></span>";

				echo "Prepositional Phrases";
				echo "<span class='lesson-links-topic'><a href='#'>- \"from\", \"to\", \"at\"</a></span>";
				echo "<span class='lesson-links-topic'><a href='#'>- \"for\", \"about\"</a></span>";


				echo "Modal Verbs";
				echo "<span class='lesson-links-topic'><a href='grammar.php?grammarlesson=90'>- Want to</a></span>";
				echo "<span class='lesson-links-topic'><a href='grammar.php?grammarlesson=91'>- Like to</a></span>";
				echo "<span class='lesson-links-topic'><a href='grammar.php?grammarlesson=92'>- Should</a></span>";
				echo "<span class='lesson-links-topic'><a href='grammar.php?grammarlesson=93'>- Can</a></span>";

			echo "</div>";




			echo "</div>";

		echo "</div>";

echo "

<script>";

echo "$(document).ready(function(){

	$('#grammar-header').css('cursor', 'pointer');

	$('#grammar-header').click(function()
		{
        $('#lesson-links-grammer-wrapper').slideToggle('slow');
				$('#plus-accordion-grammar').toggleClass('plus-accordion-grammar');
				$('#plus-accordion-grammar').toggleClass('minus-accordion-grammar');

    });});";



echo "</script>";

echo "<script>";

echo "$(document).ready(function(){

	$('#lessons-header-in-links').css('cursor', 'pointer');

	$('#lessons-header-in-links').click(function()
		{
        $('#lesson-links-lessons-wrapper').slideToggle('slow');
				$('#plus-accordion-links').toggleClass('plus-accordion-links');
				$('#plus-accordion-links').toggleClass('minus-accordion-links');

    });});";



echo "</script>";

?>