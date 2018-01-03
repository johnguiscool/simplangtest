<?php



$texts_path	 = $_SERVER['DOCUMENT_ROOT']."/italian/texts/";


$lesson_topic_path = $texts_path."topics.txt";

$lesson_topics       = file_get_contents($lesson_topic_path,true);
$lesson_topics_total = explode("\n", $lesson_topics);


echo "	<link rel='stylesheet' href='/css/style-lesson-links.css'>";

		echo "<div class='lessons-links-nav column'>";

			echo "<div class='lessons-links-nav-container'>";

			$number_of_dialogues = 25;

			echo "<div class='lesson-links-header lessons-header-in-links' id='lessons-header-in-links'><b>Lessons</b><div class='plus-accordion-links'></div></div><p>";

			echo "<div class='lesson-links-lessons-wrapper'>";

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

			echo "<div class='lesson-links-header grammar-header' id='grammar-header'><b>Grammar<br>Appendix</b><div class='plus-accordion'></div></div><p>";

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
				echo "<span class='lesson-links-topic'><a href='grammar.php?grammarlesson=40'>- Expressing \"is, am, are\"</a></span>";
				echo "<span class='lesson-links-topic'><a href='grammar.php?grammarlesson=42'>- Expressing possession</a></span>";
				echo "<span class='lesson-links-topic'><a href='grammar.php?grammarlesson=43'>- Verbs of motion</a></span>";

				echo "Sentence Types";
				echo "<span class='lesson-links-topic'><a href='grammar.php?grammarlesson=51'>- Indicative Sentences</a></span>";
				echo "<span class='lesson-links-topic'><a href='grammar.php?grammarlesson=52'>- Questions</a></span>";
				echo "<span class='lesson-links-topic'><a href='grammar.php?grammarlesson=53'>- Imperatives</a></span>";

				echo "Adverbs";
				echo "<span class='lesson-links-topic'><a href='#'>- Temporal Adverbs</a></span>";

				echo "Clauses and Connectives";
				echo "<span class='lesson-links-topic'><a href='#'>- \"and\", \"but\", \"so\"</a></span>";
				echo "<span class='lesson-links-topic'><a href='#'>- If..., then...</a></span>";
				echo "<span class='lesson-links-topic'><a href='#'>- ..., because...</a></span>";

				echo "Prepositional Phrases";
				echo "<span class='lesson-links-topic'><a href='#'>- \"and\", \"but\", \"so\"</a></span>";

				echo "Modal Verbs";
				echo "<span class='lesson-links-topic'><a href='#'>- Can</a></span>";
				echo "<span class='lesson-links-topic'><a href='#'>- Should</a></span>";
				echo "<span class='lesson-links-topic'><a href='#'>- Want to</a></span>";
				echo "<span class='lesson-links-topic'><a href='#'>- Like to</a></span>";

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
    });});";



echo "</script>";

?>