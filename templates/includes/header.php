<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
        "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="en">
<head>
	<meta http-equiv="content-type" content="text/html; charset=utf-8" />
	<meta http-equiv="Content-Language" content="en" />


	<!-- JQuery -->
	<script type="text/javascript" src="/<?php echo($this->data['baseurlpath']); ?>js/jquery.js"></script>
	<script type="text/javascript" src="/<?php echo($this->data['baseurlpath']); ?>js/jquery-ui.js"></script>
	<link rel="stylesheet" media="screen" type="text/css" href="/<?php echo($this->data['baseurlpath']); ?>js/uitheme/jquery-ui-themeroller.css" />
	
	<!-- WMD -->
	<script type="text/javascript" src="/<?php echo($this->data['baseurlpath']); ?>js/wmd.js"></script>
	
	
	<!-- Foodle: CSS -->	
	<!-- <link rel="stylesheet" media="screen" type="text/css" href="/<?php echo($this->data['baseurlpath']); ?>css/design.css" /> -->
	<link rel="stylesheet" media="screen" type="text/css" href="/<?php echo($this->data['baseurlpath']); ?>css/foodle.css" /> 
	<link rel="stylesheet" media="screen" type="text/css" href="/<?php echo($this->data['baseurlpath']); ?>css/foodle-layout.css" /> 


	<!-- Foodle: JS -->	
	<script type="text/javascript" src="/<?php echo($this->data['baseurlpath']); ?>js/foodle.js"></script>	

	<script type="text/javascript">
		$(document).ready(function() {
			<?php
				$tab = 0;
				if (isset($this->data['tab'])) $tab = $this->data['tab'];
				echo '$("#foodletabs > ul").tabs({ selected: ' . $tab . ' });';
	
			?>
		});
	
		function showemail(col) {
			$("div#emailbox").hide("fast");
			<?php
			if (isset($_REQUEST['id'])) {
				echo '$("#inneremailbox").load("emailaddr.php", { \'id\': "' . addslashes($_REQUEST['id']) . '", \'col\': col } );'; 
			}
			?>
			$("div#emailbox").show("fast");
		}
	</script>


	<?php
		if (isset($_REQUEST['id'])) {
			echo '<link rel="alternate" type="application/rss+xml" title="' . $this->t('subscribe_rss') . '" href="rss.php?id=' . $_REQUEST['id'] . '" />';
		}
		
	?>

	<title><?php 
		$title = 'Foodle';
		if (isset($this->data['title']))
			$title = $this->data['title']; 
		echo $title;
	?></title> 

	
</head>
<body>

<!-- Red logo header -->
<div id="header">	
	<div id="logo">Foodle <span id="version"><?php echo $this->t('version'); ?> 2.4</span> 
		<a id="news" style="font-size: small; color: white" target="_blank" href="http://rnd.feide.no/category/topics/foodle">
			∘ <?php echo $this->t('read_news'); ?></a>  
		<a id="mailinglist" style="font-size: small; color: white" target="_blank" href="http://rnd.feide.no/content/foodle-users">
			∘ <?php echo $this->t('join_mailinglist'); ?></a>
	</div>
	<a href="http://rnd.feide.no"><img id="ulogo" alt="notes" src="/<?php echo($this->data['baseurlpath']); ?>resources/uninettlogo.gif" /></a>
</div>

























<!-- Grey header bar below -->
<div id="headerbar" style="clear: both">
<?php 

echo '<p id="breadcrumb">';
if (isset($this->data['bread'])) {
	$first = TRUE;
	foreach ($this->data['bread'] AS $item) {
		if (!$first) echo ' » ';		
		if (isset($item['href'])) {
			
			if (strstr($item['title'],'bc_') == $item['title'] ) {
				echo '<a href="' . $item['href'] . '">' . $this->t($item['title']) . '</a>';
			} else {
				echo '<a href="' . $item['href'] . '">' . $item['title'] . '</a>';
			}
		} else {
			if (strstr($item['title'],'bc_') == $item['title'] ) {
				echo $this->t($item['title']);
			} else {
				echo $item['title'];
			}
			
		}
		$first = FALSE;
	}
}
echo '</p>';



	if (isset($this->data['loginurl'])) {
		echo '<a class="button" style="float: right" href="' . htmlentities($this->data['loginurl']) . '"><span>' . $this->t('login') . '</span></a>';
	} elseif(isset($this->data['logouturl'])) {
		echo '<a class="button" style="float: right" href="' . htmlentities($this->data['logouturl']) . '"><span>' . $this->t('logout') . '</span></a>';
	}
	
	if (array_key_exists('facebookshare', $this->data) && $this->data['facebookshare']) {
		echo '<a class="button" style="float: right" onclick="showFacebookShare()"><span>' . $this->t('facebookshare') . '</span></a>';
	}

	echo '<a class="button" style="float: right" title="Share this foodle on Twitter" href="' . 
		htmlspecialchars(
			SimpleSAML_Utilities::addURLparameter('http://twitter.com/home', array(
					'status' => 
						'#foodle ' . $title . ': ' . SimpleSAML_Utilities::addURLparameter(SimpleSAML_Utilities::selfURL(), array('auth' => 'twitter'))
				)
			)
		) . 
		'"><span>Tweet</span></a>';


	if (array_key_exists('owner', $this->data)) {
		echo('<a class="button" href="edit.php?id=' .$this->data['identifier'] . '" style="float: right"><span>' . $this->t('editfoodle') . '</span></a>');
	}

	if (isset($this->data['headbar'])) {
		echo $this->data['headbar'];
	}
?>

<br style="height: 0px; clear: both" />
</div><!-- /#headerbar -->

  




<?php
$languages = $this->getLanguageList();
$langnames = array(
	'no' => 'Bokmål',
	'nn' => 'Nynorsk',
	'se' => 'Sami',
	'da' => 'Dansk',
	'fi' => 'Suomeksi',
	'en' => 'English',
	'de' => 'Deutsch',
	'sv' => 'Svenska',
	'es' => 'Español',
	'fr' => 'Français',
	'nl' => 'Nederlands',
	'lb' => 'Luxembourgish', 
	'sl' => 'Slovenščina', // Slovensk
	'hr' => 'Hrvatski', // Croatian
	'hu' => 'Magyar', // Hungarian
);



echo '<div id="langbar" style="clar: both">';
if (empty($_POST) ) {
	$textarray = array();

/*
	foreach ($languages AS $lang => $current) {

		if ($current) {
			$textarray[] = '<form class="button" method="get" action="' . htmlspecialchars(SimpleSAML_Utilities::addURLparameter(SimpleSAML_Utilities::selfURL(), 'language=' . $lang)) . '"><div class="no"><input type="submit" value="[' . 
				$langnames[$lang] . ']" class="button" /></div></form>';
		} else {
			$textarray[] = '<form class="button" method="get" action="' . htmlspecialchars(SimpleSAML_Utilities::addURLparameter(SimpleSAML_Utilities::selfURL(), 'language=' . $lang)) . '"><div class="no"><input type="submit" value="' . 
				$langnames[$lang] . '" class="button" /></div></form>';
		}
	}
	*/

	foreach ($languages AS $lang => $current) {
		if ($current) {
			$textarray[] = $langnames[$lang];
		} else {
			$textarray[] = '<a href="' . htmlspecialchars(
				SimpleSAML_Utilities::addURLparameter(
						SimpleSAML_Utilities::selfURL(), array(
							'language' => $lang,
						))) . '">' . 
				$langnames[$lang] . '</a>';
		}
	}
	echo '' .  join(' | ', $textarray) . '';

	

}
echo '</div>';
?>










<div id="content">
