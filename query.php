<?php

$dbconn = pg_connect('host='.HOST.' dbname='.DBNAME.' user='.USER.' password='.PW)
    or die('Could not connect: ' . pg_last_error());

$sql = "SELECT nesting.id, nesting.parent_id, nesting.is_link::int, link_data.text, link_data.href, link_data.nofollow::int, link_data.target
		FROM nesting
		INNER JOIN link_data
		ON nesting.id = link_data.id";

$result = pg_query($sql) or die('Query failed: ' . pg_last_error());

$top = array();
$child = array();

// organize result set
while ($link = pg_fetch_assoc($result)) {
	if ($link['parent_id'] > 0) { // sub menu element
		$child[$link['parent_id']][] = $link;
	} else { // top-level element
		$top[$link['id']] = $link;
	}
}

foreach ($top as $item) {
	echo "<li id=\"top-{$item['id']}\">";

	if ((bool)$item['is_link']) { // top level that has no sub menu
		echo "<a href=\"{$item['href']}\" target=\"_{$item['target']}\"" . ((bool)$item['nofollow'] ? ' rel="nofollow"' : null) .">{$item['text']}</a>";
	} else {
		echo $item['text'];
		$children = $child[$item['id']];
		if (isset($children) && !empty($children)) {
			echo "<ul>";
			foreach ($children as $child_link) {
				echo "<li id=\"sub-{$item['id']}-{$child_link['id']}\"><a href=\"{$child_link['href']}\" target=\"_{$child_link['target']}\"" . ((bool)$child_link['nofollow'] ? ' rel="nofollow"' : null) .">{$child_link['text']}</a></li>";
			}
			echo "</ul>";
		}
	}

	echo "</li>";
}
