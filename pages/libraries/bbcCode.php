<?PHP

function replaceSmile($text, $smile)
{
    $smileys = array(';D' => 1, ':D' => 1, ':cool:' => 2, ';cool;' => 2, ':ekk:' => 3, ';ekk;' => 3, ';o' => 4, ';O' => 4, ':o' => 4, ':O' => 4, ':(' => 5, ';(' => 5, ':mad:' => 6, ';mad;' => 6, ';rolleyes;' => 7, ':rolleyes:' => 7, ':)' => 8, ';d' => 9, ':d' => 9, ';)' => 10);
    if($smile == 1)
        return $text;
    else
    {
        foreach($smileys as $search => $replace)
            $text = str_replace($search, '<img src="images/forum/smile/'.$replace.'.gif" />', $text);
        return $text;
    }
}

function replaceAll($text, $smile)
{
    $rows = 0;
    while(stripos($text, '[color') !== false && stripos($text, '[/color]') !== false && stripos($text, '[color') < stripos($text, '[/color]'))
    {
        $outer_section = substr($text, stripos($text, '[color'), stripos($text, '[/color]') + 8 - stripos($text, '[color'));
        $outer_value = substr($outer_section, stripos($outer_section, '[color')+7, stripos($outer_section, ']') - stripos($outer_section, '[color') - 7);
		$inner_text = substr($outer_section, stripos($outer_section, ']')+1, stripos($outer_section, '[/color]') - stripos($outer_section, ']') - 1);
        $text = str_ireplace($outer_section, '<span style="color: '.$outer_value.';">'.$inner_text.'</span>', $text);
    }
    while(stripos($text, '[code]') !== false && stripos($text, '[/code]') !== false && stripos($text, '[code]') < stripos($text, '[/code]'))
    {
        $code = substr($text, stripos($text, '[code]')+6, stripos($text, '[/code]') - stripos($text, '[code]') - 6);
        if(!is_int($rows / 2)) { $bgcolor = 'ABED25'; } else { $bgcolor = '23ED25'; } $rows++;
        $text = str_ireplace('[code]'.$code.'[/code]', '<i>Code:</i><br /><table cellpadding="0" style="background-color: #'.$bgcolor.'; width: 480px; border-style: dotted; border-color: #CCCCCC; border-width: 2px"><tr><td>'.$code.'</td></tr></table>', $text);
    }
    $rows = 0;
    while(stripos($text, '[quote]') !== false && stripos($text, '[/quote]') !== false && stripos($text, '[quote]') < stripos($text, '[/quote]'))
    {
        $quote = substr($text, stripos($text, '[quote]')+7, stripos($text, '[/quote]') - stripos($text, '[quote]') - 7);
        if(!is_int($rows / 2)) { $bgcolor = 'AAAAAA'; } else { $bgcolor = 'CCCCCC'; } $rows++;
        $text = str_ireplace('[quote]'.$quote.'[/quote]', '<table cellpadding="0" style="background-color: #'.$bgcolor.'; width: 480px; border-style: dotted; border-color: #007900; border-width: 2px"><tr><td>'.$quote.'</td></tr></table>', $text);
    }
    $rows = 0;
    while(stripos($text, '[url]') !== false && stripos($text, '[/url]') !== false && stripos($text, '[url]') < stripos($text, '[/url]'))
    {
        $url = substr($text, stripos($text, '[url]')+5, stripos($text, '[/url]') - stripos($text, '[url]') - 5);
        $text = str_ireplace('[url]'.$url.'[/url]', '<a href="'.$url.'" target="_blank">'.$url.'</a>', $text);
    }
    while(stripos($text, '[url') !== false && stripos($text, '[/url]') !== false && stripos($text, '[url') < stripos($text, '[/url]'))
    {
        $url_section = substr($text, stripos($text, '[url'), stripos($text, '[/url]') + 6 - stripos($text, '[url'));
        $url = substr($url_section, stripos($url_section, '[url')+5, stripos($url_section, ']') - stripos($url_section, '[url') - 5);
		$anchor_name = substr($url_section, stripos($url_section, ']')+1, stripos($url_section, '[/url]') - stripos($url_section, ']') - 1);
        $text = str_ireplace($url_section, '<a href="'.$url.'" target="_blank">'.$anchor_name.'</a>', $text);
    }
    while(stripos($text, '[player]') !== false && stripos($text, '[/player]') !== false && stripos($text, '[player]') < stripos($text, '[/player]'))
    {
        $player = substr($text, stripos($text, '[player]')+8, stripos($text, '[/player]') - stripos($text, '[player]') - 8);
        $text = str_ireplace('[player]'.$player.'[/player]', '<a href="?subtopic=characters&name='.urlencode($player).'">'.$player.'</a>', $text);
    }
    while(stripos($text, '[img]') !== false && stripos($text, '[/img]') !== false && stripos($text, '[img]') < stripos($text, '[/img]'))
    {
        $img = substr($text, stripos($text, '[img]')+5, stripos($text, '[/img]') - stripos($text, '[img]') - 5);
        $text = str_ireplace('[img]'.$img.'[/img]', '<img src="'.$img.'">', $text);
    }
    while(stripos($text, '[b]') !== false && stripos($text, '[/b]') !== false && stripos($text, '[b]') < stripos($text, '[/b]'))
    {
        $b = substr($text, stripos($text, '[b]')+3, stripos($text, '[/b]') - stripos($text, '[b]') - 3);
        $text = str_ireplace('[b]'.$b.'[/b]', '<b>'.$b.'</b>', $text);
    }
    while(stripos($text, '[i]') !== false && stripos($text, '[/i]') !== false && stripos($text, '[i]') < stripos($text, '[/i]'))
    {
        $i = substr($text, stripos($text, '[i]')+3, stripos($text, '[/i]') - stripos($text, '[i]') - 3);
        $text = str_ireplace('[i]'.$i.'[/i]', '<i>'.$i.'</i>', $text);
    }
    while(stripos($text, '[u]') !== false && stripos($text, '[/u]') !== false && stripos($text, '[u]') < stripos($text, '[/u]'))
    {
        $u = substr($text, stripos($text, '[u]')+3, stripos($text, '[/u]') - stripos($text, '[u]') - 3);
        $text = str_ireplace('[u]'.$u.'[/u]', '<u>'.$u.'</u>', $text);
    }
    return replaceSmile($text, $smile);
}

function removeBBCode($text)
{
    while(stripos($text, '[color') !== false && stripos($text, '[/color]') !== false )
    {
        $outer_section = substr($text, stripos($text, '[color'), stripos($text, '[/color]') + 8 - stripos($text, '[color'));
        $outer_value = substr($outer_section, stripos($outer_section, '[color')+7, stripos($outer_section, ']') - stripos($outer_section, '[color') - 7);
		$inner_text = substr($outer_section, stripos($outer_section, ']')+1, stripos($outer_section, '[/color]') - stripos($outer_section, ']') - 1);
        $text = str_ireplace('[color='.$outer_value.']'.$inner_text.'[/color]', $inner_text, $text);
    }
    while(stripos($text, '[code]') !== false && stripos($text, '[/code]') !== false )
    {
        $code = substr($text, stripos($text, '[code]')+6, stripos($text, '[/code]') - stripos($text, '[code]') - 6);
        $text = str_ireplace('[code]'.$code.'[/code]', $code, $text);
    }
    while(stripos($text, '[quote]') !== false && stripos($text, '[/quote]') !== false )
    {
        $quote = substr($text, stripos($text, '[quote]')+7, stripos($text, '[/quote]') - stripos($text, '[quote]') - 7);
        $text = str_ireplace('[quote]'.$quote.'[/quote]', $quote, $text);
    }
	while(stripos($text, '[url]') !== false && stripos($text, '[/url]') !== false )
    {
        $url = substr($text, stripos($text, '[url]')+5, stripos($text, '[/url]') - stripos($text, '[url]') - 5);
        $text = str_ireplace('[url]'.$url.'[/url]', $url, $text);
    }
    while(stripos($text, '[url') !== false && stripos($text, '[/url]') !== false )
    {
        $url_section = substr($text, stripos($text, '[url'), stripos($text, '[/url]') + 6 - stripos($text, '[url'));
        $url = substr($url_section, stripos($url_section, '[url')+5, stripos($url_section, ']') - stripos($url_section, '[url') - 5);
		$anchor_name = substr($url_section, stripos($url_section, ']')+1, stripos($url_section, '[/url]') - stripos($url_section, ']') - 1);
        $text = str_ireplace('[url='.$url.']'.$anchor_name.'[/url]', $anchor_name, $text);
    }
    while(stripos($text, '[player]') !== false && stripos($text, '[/player]') !== false )
    {
        $player = substr($text, stripos($text, '[player]')+8, stripos($text, '[/player]') - stripos($text, '[player]') - 8);
        $text = str_ireplace('[player]'.$player.'[/player]', $player, $text);
    }
    while(stripos($text, '[img]') !== false && stripos($text, '[/img]') !== false )
    {
        $img = substr($text, stripos($text, '[img]')+5, stripos($text, '[/img]') - stripos($text, '[img]') - 5);
        $text = str_ireplace('[img]'.$img.'[/img]', $img, $text);
    }
    while(stripos($text, '[b]') !== false && stripos($text, '[/b]') !== false )
    {
        $b = substr($text, stripos($text, '[b]')+3, stripos($text, '[/b]') - stripos($text, '[b]') - 3);
        $text = str_ireplace('[b]'.$b.'[/b]', $b, $text);
    }
    while(stripos($text, '[i]') !== false && stripos($text, '[/i]') !== false )
    {
        $i = substr($text, stripos($text, '[i]')+3, stripos($text, '[/i]') - stripos($text, '[i]') - 3);
        $text = str_ireplace('[i]'.$i.'[/i]', $i, $text);
    }
    while(stripos($text, '[u]') !== false && stripos($text, '[/u]') !== false )
    {
        $u = substr($text, stripos($text, '[u]')+3, stripos($text, '[/u]') - stripos($text, '[u]') - 3);
        $text = str_ireplace('[u]'.$u.'[/u]', $u, $text);
    }
    return $text;
}

function availableBBCCode()
{
	return '<b>Message:</b><br />
	<font size="1">
		You can use:<br />
		[color=blue]This text is in a color.[/color] OR [color=#ff00ff]This text is also in a color.[/color]<br/>
		[player]Nick[/player]<br />
		[url=http://address.com/]Address Search - Find Email and Addresses @ Address.com[/url]<br />
		[img]http://images.com/images3.gif[/img]<br />
		[code]Code[/code]<br />
		[b]<b>Text</b>[/b]<br />
		[i]<i>Text</i>[/i]<br />
		[u]<u>Text</u>[/u]<br />
		and smileys:<br />;) , :) , :D , :( , :rolleyes:<br />:cool: , :eek: , :o , :p
	</font>';
}

?>