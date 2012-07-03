<?php
require_once 'libs/gamer/import.php';
require_once 'libs/psn/import.php';

$psnId = $_GET['psnId'];

if (empty($psnId))
{
	die('Please type your psnId in url: psn.php?psnId=guicamillo');
}

$psnUser = new PSNUser($psnId);

$profileData = $psnUser->getPSNID();
$gamesList = $psnUser->getGames();
?>
<h4><?php echo $profileData['id']; ?></h4>
<img src="<?php echo $profileData['avatarSmall']; ?>" />
<br />
Level <?php echo $profileData['level']; ?><?php if ($profileData['aboutme']): ?>
<br />
Status <?php echo $profileData['status']['online'] ? 'Online' : $profileData['status']['away'] ? 'Away' : '' ; ?>
<br />
Bio: <?php echo $profileData['aboutme']; ?>
<?php endif; ?>

<br />
<strong><?php echo $profileData['levelData']['points']; ?></strong>/<?php echo $profileData['levelData']['ceiling']; ?>
<br />
<br />
<h4>Trophies</h4>
<?php foreach ($profileData['trophies'] as $trophieKey => $trophieValue): ?>
<?php echo ucfirst($trophieKey); ?> <?php echo $trophieValue; ?><br />
<?php endforeach; ?>
<br />
<h4>Games List</h4>
<?php foreach ($gamesList['games'] as $game): ?>
<img src="<?php echo $game['image']; ?>" />
<br />
<?php echo $game['title']; ?>
<br />
Points <strong><?php echo $game['userPoints']; ?></strong>/<?php echo $game['totalPoints']; ?>
<br />
Tropies <strong><?php echo $game['trophiesCount']['total']; ?></strong>/<?php echo $game['totalTrophies']; ?>
<br />
<?php endforeach; ?>