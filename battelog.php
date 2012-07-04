<?php
require_once 'libs/gamer/import.php';
require_once 'libs/battlelog/import.php';

$username = $_GET['username'];

if (empty($username))
{
	die('Please type your solider username: battelog.php?username=Julian Gregarks');
}

$user = new BattlelogUser($username);

//get all soliders from user
$soliders = $user->getSoldiers();

//get first solider object
$soliderObject = $soliders[0];

$personaObject = $soliderObject->getPersona();
//get stats from persona solider
$overviewStats = $personaObject->getOverviewStatistics();

//get solider data
$soliderData = $soliderObject->toArray();

$nextRank = $personaObject->getRankNeeded();
$actualRank = $personaObject->getCurrentRankNeeded();

$rankScore = $overviewStats['totalScore'] - $actualRank['pointsNeeded'];
$rankDiff = $nextRank['pointsNeeded'] - $actualRank['pointsNeeded'];
?>
<?php echo !empty($soliderData['persona']['clanTag']) ? '['.$soliderData['persona']['clanTag'].'] ' : '' ; ?><?php echo $soliderData['persona']['personaName']; ?>
<br />
<img src="<?php echo BattlelogUtil::getRankImage($overviewStats['rank'],'medium'); ?>" />
<br />
RANK <?php echo $overviewStats['rank']; ?>
<br />
<?php echo BattlelogLanguage::Translate('ID_P_RANK'.$overviewStats['rank'].'_NAME'); ?>
<br />
<?php echo number_format($rankScore); ?>/<?php echo number_format($rankDiff); ?>
<br />
<br />
<strong>All Time Statistics</strong>
<br />
Kills <?=$overviewStats['kills'];?>
<br />
Deaths <?=$overviewStats['deaths'];?>
<br />
K/D ratio <?=number_format($overviewStats['kdRatio'],3); ?>
<br />
Kill assists <?=$overviewStats['killAssists'];?>
<br />
Score/Min <?=round($overviewStats['scorePerMinute']);?>
<br />
Quits <?=round($overviewStats['quitPercentage']); ?>%
<br />
Vehicles Destroyed <?=$overviewStats['vehiclesDestroyed'];?>
<br />
Vehicles Destroyed Assists <?=$overviewStats['vehiclesDestroyedAssists'];?>
<br />
Avg. Weapon Accuracy <?=round($overviewStats['quitPercentage']); ?>%
<br />
Longest Headshot <?=round($overviewStats['longestHeadshot']);?>m
<br />
Kill Streak Bonus <?=$overviewStats['killStreakBonus'];?>
<br />
Skill <?=round($overviewStats['elo']);?>
<br />
Squad Score Bonus <?=number_format($overviewStats['sc_squad'],0,'',' ');?>
<br />
Repairs <?=$overviewStats['repairs'];?>
<br />
Revives <?=$overviewStats['revives'];?>
<br />
Heals <?=$overviewStats['heals'];?>
<br />
Resupplies <?=$overviewStats['resupplies'];?>