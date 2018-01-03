<?php 



$texts_path	 = $_SERVER['DOCUMENT_ROOT']."/ukrainian/texts/";


$lesson_topic_path = $texts_path."topics.txt";

$lesson_topics       = file_get_contents($lesson_topic_path,true);
$lesson_topics_total = explode("\n", $lesson_topics);


		echo "<div class='lessons-links-nav column'>";	

			echo "<div class='lessons-links-nav-container'>";
		
			$number_of_dialogues = 25;
			
			echo "<div class='lesson-links-header'><b>Lessons</b></div><p>";

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
		
		echo "</div>";
?>