<?php
if(!defined('INITIALIZED'))
	exit;

$main_content = "<h1 align=\"center\">Guild Wars</h1>
!war invite,guild name,fraglimit                              Send an invitation to start a war. Example: !war invite,Black Ninjas,150 <br>
!war invite,guild name,fraglimit,money,time                   Send an invitation to start a war. <br>
Example: !war invite,Rexis,150,10000,3 days <br>

<b>!war accept,guild name </b> <u>                                      Accept the invitation to start a war. <br></u>
<b>!war reject,guild name  </b>    <u>                                  Reject the invitation to start a war. <br></u>
<b>!war end,guild name    </b>        <u>                               Ends an active war with another guild. <br></u>
<b>!war cancel,guild name   </b>         <u>                            This will cancel the invitation to the guild Black Ninjas <br></u>
<b>Talk to banker npc deposit   </b>         <u>                            Command for founder of guilds for pay money<br>
<b>Talk to banker npc withdraw   </b>         <u>                           Command for founder of guilds for payout money<br></u>
<br>
<script type=\"text/javascript\"><!--
function show_hide(flip)
{
        var tmp = document.getElementById(flip);
        if(tmp)
                tmp.style.display = tmp.style.display == 'none' ? '' : 'none';
}
--></script>
<table width=\"100%\" border=\"0\" cellspacing=\"1\" cellpadding=\"4\">
<tr>
<td style=\"background: " . $config['site']['vdarkborder'] . "\" class=\"white\" width=\"150\"><b>Aggressor</b></td>
<td style=\"background: " . $config['site']['vdarkborder'] . "\" class=\"white\"><b>Information</b></td>
<td style=\"background: " . $config['site']['vdarkborder'] . "\" class=\"white\" width=\"150\"><b>Enemy</b></td>
</tr>";
 
$count = 0;
foreach($SQL->query('SELECT * FROM `guild_wars` WHERE `status` IN (0,1,2,3,4,5);') as $war)
{
        $a = new Guild();
        $a->load($war['guild_id']);
        if(!$a->isLoaded())
                continue;
 
        $e = new Guild();
        $e->load($war['opponent_id']);
        if(!$e->isLoaded())
                continue;
 
        $count++;
        $main_content .= "<tr style=\"background: " . (is_int($count / 2) ? $config['site']['darkborder'] : $config['site']['lightborder']) . ";\">
<td align=\"center\"><a href=\"?subtopic=guilds&action=show&guild=".$a->getId()."\"><img src=\"" . $a->getGuildLogoLink() . "\" width=\"64\" height=\"64\" border=\"0\"/><br />".htmlspecialchars($a->getName())."</a></td>
<td class=\"white\" align=\"center\">";
   	switch($war['status'])
	{
		case 4:
		{
			$main_content .= "<b>Pending acceptation</b><br />Invited on " . date("M d Y, H:i:s", $war['declaration_date']) . " for " . ($war['end_date'] > 1471497823 ? (($war['end_date'] - $war['declaration_date']) / 86400) : "unspecified") . " days. The frag limit is set to " . $war['frag_limit'] . " frags, " . ($war['guild_fee'] > 0 ? "with payment of " . $war['guild_fee'] . " gold coins." : "without any payment.")."<br />Will expire in two days.";
			break;
		}
 		case 0:
		{
			$main_content .= "War has almost started the guild leaders have to pay " . $war['guild_fee'] . " gold coins from bank. Will expire in two days.";
			break;
		}
 
		case 3:
		{
			$main_content .= "<s>Canceled invitation</s><br />Sent invite on " . date("M d Y, H:i:s", $war['declaration_date']) . ", canceled on " . date("M d Y, H:i:s", $war['end_date']) . ".";
			break;
		}
 
		case 2:
		{
			$main_content .= "Rejected invitation<br />Invited on " . date("M d Y, H:i:s", $war['declaration_date']) . ", rejected on " . date("M d Y, H:i:s", $war['end_date']) . ".";
			break;
		}
 
		case 1:
		{
			$main_content .= "<span style=\"color: red;\"><font size=\"5\">" . $war['guild_frags'] . " : " . $war['opponent_frags'] . "</font><br /><br /><b>On a brutal war</b></span><br />Began on " . date("M d Y, H:i:s", $war['declaration_date']) . ($war['end_date'] > 1471497823 ? ", will end up at " . date("M d Y, H:i:s", $war['end_date']) : "") . ".<br />The frag limit is set to " . $war['frag_limit'] . " frags, " . ($war['guild_fee'] > 0 ? "with payment of " . $war['guild_fee'] . " gold coins." : "without any payment.");
			break;
		}
 
		case 5:
		{
			$main_content .= "<i>Ended</i><br />Began on " . date("M d Y, H:i:s", $war['declaration_date']) . ", ended on " . date("M d Y, H:i:s", $war['end_date']) . ". Frag statistics: " . $war['guild_frags'] . " to " . $war['opponent_frags'] . ".";
			break;
		}
 
		default:
		{
			$main_content .= "Unknown, please contact with gamemaster.";
			break;
		}
	}
 
        $main_content .= "<br /><br /><a onclick=\"show_hide('war-details:" . $war['id'] . "'); return false;\" style=\"cursor: pointer;\">&raquo; Details &laquo;</a></td>
<td align=\"center\"><a href=\"?subtopic=guilds&action=show&guild=".$e->getId()."\"><img src=\"" . $e->getGuildLogoLink() . "\" width=\"64\" height=\"64\" border=\"0\"/><br />".htmlspecialchars($e->getName())."</a></td>
</tr>
<tr id=\"war-details:" . $war['id'] . "\" style=\"display: none; background: " . (is_int($count / 2) ? $config['site']['darkborder'] : $config['site']['lightborder']) . ";\">
<td colspan=\"3\">";
        if(in_array($war['status'], array(1,4,5)))
        {
                $deaths = $SQL->query('SELECT ' . $SQL->tableName('pd') . '.' . $SQL->fieldName('id') . ', ' . $SQL->tableName('pd') . '.' . $SQL->fieldName('date') . ', ' . $SQL->tableName('gk') . '.' . $SQL->fieldName('guild_id') . ' AS ' . $SQL->fieldName('enemy') . ', ' . $SQL->tableName('p') . '.' . $SQL->fieldName('name') . ', ' . $SQL->tableName('pd') . '.' . $SQL->fieldName('level') . ' FROM ' . $SQL->tableName('guild_kills') . ' gk LEFT JOIN ' . $SQL->tableName('player_deaths') . ' pd ON ' . $SQL->tableName('gk') . '.' . $SQL->fieldName('death_id') . ' = ' . $SQL->tableName('pd') . '.' . $SQL->fieldName('id') . ' LEFT JOIN ' . $SQL->tableName('players') . ' p ON ' . $SQL->tableName('pd') . '.' . $SQL->fieldName('player_id') . ' = ' . $SQL->tableName('p') . '.' . $SQL->fieldName('id') . ' WHERE ' . $SQL->tableName('gk') . '.' . $SQL->fieldName('war_id') . ' = ' . $SQL->quote($war['id']) . ' AND ' . $SQL->tableName('p') . '.' . $SQL->fieldName('deleted') . ' = 0 ORDER BY ' . $SQL->tableName('pd') . '.' . $SQL->fieldName('date') . ' DESC')->fetchAll();
                if(!empty($deaths))
                {
                        foreach($deaths as $death)
                        {
                                $killers = $SQL->query('SELECT ' . $SQL->tableName('p') . '.' . $SQL->fieldName('name') . ' AS ' . $SQL->fieldName('player_name') . ', ' . $SQL->tableName('p') . '.' . $SQL->fieldName('deleted') . ' AS ' . $SQL->fieldName('player_exists') . ', ' . $SQL->fieldName('k') . '.' . $SQL->fieldName('war') . ' AS ' . $SQL->fieldName('is_war') . ' FROM ' . $SQL->fieldName('killers') . ' k LEFT JOIN ' . $SQL->tableName('player_killers') . ' pk ON ' . $SQL->tableName('k') . '.' . $SQL->fieldName('id') . ' = ' . $SQL->tableName('pk') . '.' . $SQL->fieldName('kill_id') . ' LEFT JOIN ' . $SQL->tableName('players') . ' p ON ' . $SQL->tableName('p') . '.' . $SQL->fieldName('id') . ' = ' . $SQL->tableName('pk') . '.' . $SQL->fieldName('player_id') . ' WHERE ' . $SQL->tableName('k') . '.' . $SQL->fieldName('death_id') . ' = ' . $SQL->quote($death['id']) . ' ORDER BY ' . $SQL->tableName('k') . '.' . $SQL->fieldName('final_hit') . ' DESC, ' . $SQL->tableName('k') . '.' . $SQL->fieldName('id') . ' ASC')->fetchAll();
                                $count = count($killers); $i = 0;
 
                                $others = false;
                                $main_content .= date("j M Y, H:i", $death['date']) . " <span style=\"font-weight: bold; color: " . ($death['enemy'] == $war['guild_id'] ? "red" :"lime") . ";\">+</span>
<a href=\"?subtopic=characters&name=" . urlencode($death['name']) . "\"><b>".htmlspecialchars($death['name'])."</b></a> ";
                                foreach($killers as $killer)
                                {
                                        $i++;
                                        if($killer['is_war'] != 0)
                                        {
                                                if($i == 1)
                                                        $main_content .= "killed at level <b>".$death['level']."</b> by ";
                                                else if($i == $count && $others == false)
                                                        $main_content .= " and by ";
                                                else
                                                        $main_content .= ", ";
 
                                                if($killer['player_exists'] == 0)
                                                        $main_content .= "<a href=\"?subtopic=characters&name=".urlencode($killer['player_name'])."\">";
 
                                                $main_content .= htmlspecialchars($killer['player_name']);
                                                if($killer['player_exists'] == 0)
                                                        $main_content .= "</a>";
                                        }
                                        else
                                                $others = true;
 
                                        if($i == $count)
                                        {
                                            if($others == true)
                                                $main_content .= " and few others";
                                            $main_content .= ".<br />";
                                        }
                                }
                        }
                }
                else
                        $main_content .= "<center>There were no frags on this war so far.</center>";
        }
        else
                $main_content .= "<center>This war did not began yet.</center>";
 
        $main_content .= "</td>
</tr>";
}
 
if($count == 0)
        $main_content .= "<tr style=\"background:".$config['site']['darkborder'].";\">
<td colspan=\"3\">Currently there are no active wars.</td>
</tr>";
 
$main_content .= "</table>";
