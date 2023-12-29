<?php



$string = "
Room
108
doc_cam
SC8-001-2020
Cleartouch
40190219000789
Room
502
Adapt4
004405703
Chromebook
PF3ZVGYD
doc_cam
SC8-001-0342
Room
504
Cleartouch
40200610900599
Adapt4
004405695
Room
505
Room
507
Cleartouch
40190622000348
Room
509
Cleartouch
68211125000114
Room
510
Cleartouch
40190622000374
Room
407
Cleartouch
40190622000240
Room
409
Cleartouch
40210119000797
Room
408
Cleartouch
40200610900430
Room
405
Cleartouch
40190702000960
Room
403
Cleartouch
40200610900447
Chromebook
PF3ZWK5R
Room
401
Cleartouch
40200610900442
Chromebook
PF3ZWPPF
Chromebook
PF3ZTDLK
Room
402
cleartouch
40190726000276
Room
105
Cleartouch
40200610900586
Room
301
Cleartouch
40190706000194
Adapt4
004405701
Chromebook
PF3ZTDJZ
Chromebook
PF3ZT8ZW
Chromebook
PF3ZT25T
Chromebook
PF3ZT6P0
Room
303
Cleartouch
40190712000552
Adapt4
004405690
Room
305
Cleartouch
40190712000553
Room
307
Adapt4
004405697
Cleartouch
40190219000753
Room
308
Cleartouch
40190726000109
Adapt4
004405693
Room
202
Cleartouch
40201202008013
Room
203
Cleartouch
40190712000557
doc_cam
SC13 - 002 - 5446
Room
204
Cleartouch
40200610900382
Room
207
Room
209
Cleartouch
40200610900443
Room
211
Cleartouch
40190622000243
doc_cam
SC13 - 002 - 5458
Room
210
Cleartouch
40190622000246
doc_cam
SC8-001-0340
Room
101
cleartouch
68211125000115
Room
501
cleartouch
40190712000599
Adapt4
004405700
Chromebook
PF3ZW5HW
Chromebook
PF3ZTBCX
Chromebook
PF3ZWRXM
Room
503
cleartouch
40190726000085
Adapt4
004405694
Chromebook
PF3ZTBCB
Chromebook
PF3ZWMEP
Chromebook
PF3ZVET3
Chromebook
PF400E7P
doc_cam
SC8-001-1225
Room
505
Adapt4
004405692
Room
404
Room
107
cleartouch
40190219000762
Room
101
cleartouch
40190805000854
Room
302
cleartouch
40190219000790
Adapt4
004405704
Room
304
cleartouch
40190805000798
Adapt4
004405691
Chromebook
PF3ZTBDF
Chromebook
PF3ZT28K
Chromebook
PF3ZT6NQ
Chromebook
PF3ZW5HM
Chromebook
PF3ZT26Z
Room
306
cleartouch
40190622000203
Adapt4
004405699
Chromebook
PF3ZWRYW
Chromebook
PF3ZT6PA
Chromebook
PF3ZTBCD
Chromebook
PF3ZT4GC
Chromebook
PF3ZT920
Room
310
cleartouch
68211125000108
Adapt4
004405698
Chromebook
PF3ZT90G
Chromebook
PF3ZT28T
Chromebook
PF3ZWS13
Chromebook
PF3ZT8Z1
Room
201
cleartouch
40190219000798
Room
205
cleartouch
40190623001320
Room
206
cleartouch
68211125000112
Room
208
cleartouch
40190817000170
doc_cam
SC8-001-1865
Room
100
cleartouch
40190805000789
";

function str_to_list($var)
{
    $temp_var = preg_split('/\r\n|\r|\n/', $var);
    $next_var = [];

    foreach ($temp_var as $key => $val) {
        $next_var[] = strtolower(str_replace(' ', '_', $val));
    }

    return $next_var;
}

$tmp_arr = str_to_list($string);
$clean_raw = [];

foreach ($tmp_arr as $val)
{
	if (!empty($val))
	{
		$clean_raw[] = $val;
	}
}

$master = [];

$rooms = $cleartouch = [];

foreach ($clean_raw as $i => $raw)
{
	// if (strtolower($raw) == 'room')
	// {
	// 	$rooms[] = $clean_raw[$i + 1];
	// 	$master[$clean_raw[$i + 1]] = [];
	// }

	$doc_cam = $chromebook = $cleartouch = $adapt = '';

	if (strtolower($raw) == 'room')
	{
		// $master[$clean_raw[$i + 1]]['room'] = $clean_raw[$i + 1];
		$room = $clean_raw[$i + 1];
	}

	if (strtolower($raw) == 'doc_cam')
	{
		$master[$room]['doc_cam'] = $clean_raw[$i + 1];
	}


	if (strtolower($raw) == 'cleartouch')
	{
		$master[$room]['cleartouch'] = $clean_raw[$i + 1];
	}


	if (strtolower($raw) == 'adapt4')
	{
		$master[$room]['adapt'] = $clean_raw[$i + 1];
	}


	if (strtolower($raw) == 'chromebook')
	{
		$master[$room]['chromebook'][] = $clean_raw[$i + 1];
	}
}

$sorted_master = [];

$master_keys = array_keys($master);
sort($master_keys);

foreach($master_keys as $key)
{
	$sorted_master[$key] = $master[$key];
}


echo "<table>";
foreach ($sorted_master as $rm => $inv)
{
	foreach ($inv as $device => $serial)
	{
		if ($device != 'chromebook')
		{
			$upser = strtoupper($serial);
			echo "<tr>
					<td>{$rm}</td>
					<td>{$device}</td>
					<td>{$upser}</td>
				</tr>";
		}
		else
		{
			// echo '<tr>';
			foreach ($serial as $ser)
			{
				$upper = strtoupper($ser);
				echo "<tr>
						<td>{$rm}</td>
						<td>chromebook</td>
						<td>{$upper}</td>
					<tr>";
			}
			// echo '</tr>';
		}
	}
}

echo '</table>';


echo "<pre>";
// print_r($clean_raw);
// print_r($rooms);
// print_r($cleartouch);
// print_r($master);
print_r($sorted_master);
// print_r($master_keys);
// print_r ($excel);
echo "</pre>";