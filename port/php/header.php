<?php

if($logged_in_flag == true)
{
	$login_panel = "Logged in: $username | <a href='/logout.php'>Log out</a>";
	$banner_link = "'/welcome.php'";
	$links = "<a href='lessons.php'>Lessons</a> <a href='quiz.php'>Review</a>";
}

else
{
	$banner_link = "'/index.php'";
	$login_panel = "<a class = 'header-login-link' href='https://simplang.com/login.php'>Login</a>
					<a class = 'header-login-link register-link' href='https://simplang.com/register.php'>Register</a>";
					
	$links ="";
}

?>
	

	<header class="main-header">
	
		<div class="banner-plus-navigation-flexbox">
    		<span class="banner-in-header"> <a href= <?php echo $banner_link; ?> ><img src="/img/logo.png"> </a></span>

			<span class="navigation-only-flexbox">
				<span class="header-login-panel">

					<?php echo $login_panel; ?>
					
				</span>
			
				<span class="header-nav-link"> 
					<?php echo $links; ?>
				</span>
			</span>
    	
		</div>
		


	</header>