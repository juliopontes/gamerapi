<?php
ini_set('display_errors', true);
require_once 'libs/gamer/import.php';
require_once 'libs/xbox/import.php';

$gamertag = $_GET['gamertag'];

if (empty($gamertag))
{
	die('Please type your gamer tag in url: xbox.php?gamertag=julian gregark');
}

$xboxUser = new XboxUser($gamertag);

$profileData = $xboxUser->getProfile();
$gamesList = $xboxUser->getGames();
?>
<h4><?php echo $profileData['gamertag']; ?></h4>

<img src="<?php echo $profileData['images']['gamertile']['small']; ?>" />
<?php if ($profileData['name']): ?>
<br />
Name: <?php echo $profileData['name']; ?> (<?php echo ($profileData['online']) ? 'Online' : $profileData['onlineStatus'] ; ?>)
<?php endif; ?>
<?php if ($profileData['location']): ?>
<br />
Location: <?php echo $profileData['location']; ?>
<?php endif; ?>
<?php if ($profileData['bio']): ?>
<br />
Bio: <?php echo $profileData['bio']; ?>
<?php endif; ?>
<br />
Score: <?php echo $profileData['gamerScore']; ?>
<br />

<h4>Games List</h4>
<ul>
<?php foreach ($gamesList['games'] as $game): ?>
<?php if ($game['gamerID'] == 1110837201 || $game['gamerID'] == 960956369) continue; ?>
<li>
	<img src="<?php echo $game['image']['small']; ?>" />
	<p>
		<?php echo $game['name']; ?>
		<br />
		<?php echo $game['progress']['score']; ?>/<?php echo $game['possibleScore']; ?>
		<br />
		<?php echo $game['progress']['achievements']; ?>/<?php echo $game['possibleAchievements']; ?>
	</p>
</li>
<?php endforeach; ?>
</ul>