<?PHP
# CHART BUILDER
class Charts
{
    const RED = '#DD4B39', GREEN = '#00A65A', BLUE = '#00C0EF', YELLOW = '#F39C12';
    const LABELS = array('Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday'),
    RATES = array(10, 20, 30, 40, 50, 60, 70),
    LANGS = array('Java', 'JavaScript', 'C#', 'Python', 'C/C++', 'PHP', 'Ruby', 'SQL', 'Objective-C', 'Swift', 'Scratch'),
    VALUES = array(26269, 24248, 13523, 11757, 8584, 4971, 4417, 2962, 1730, 1510, 700),
    TRENDS = array(10, 20, 50, 130, 100, 90, 80, 35, 110, 50, 60, 50),
    QTRS = array('First Quarter', 'Second Quarter', 'Third Quarter', 'Fourth Quarter'),
    MONTHS = array('Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec');

    function get_color($rate)
    {
        if ($rate <= 25) {
            $color = self::RED;
        } else if ($rate > 25 && $rate <= 50) {
            $color = self::YELLOW;
        } else if ($rate > 50 && $rate <= 75) {
            $color = self::BLUE;
        } else {
            $color = self::GREEN;
        }

        return $color;
    }
    function get_rates($values)
    {
        $max = max($values);
        $new_arr = array();
        foreach ($values as $i => $value) {
            $rate = ($value * 100) / $max;
            $new_arr['n'][$i] = $rate; // default
            $new_arr['int'][$i] = round($rate); // nearrest whole number
            $new_arr['ten'][$i] = round($rate, -1); // nearest 10
        }
        return $new_arr;
    }

    function macro_demo($type = 9)
    {
        switch ($type) {
            case 1:
                $arr = array('Ethereum Price (ETH)', '&#8358; 335,627', 85);
                break;
            case 2:
                $arr = array('Ripple Price (XRP)', '&#8358; 107', 15);
                break;
            case 3:
                $arr = array('Bitcoin Cash Price (BCH)', '&#8358; 161,896', 75);
                break;
            case 4:
                $arr = array('Litecoin Price (LTC)', '&#8358; 59,718', 50);
                break;
            default:
                $arr = array('Charts::macro', '$ 1,509.19', 92);
        }
        return Charts::macro($arr[0], $arr[1], $arr[2]);
    }
    function macro($caption, $value, $rate)
    {
        $color = self::get_color($rate);
        $rate .= '%';

        $chart = '<table border="0" class="chart chart_macro">
			<caption>' . $caption . '</caption>
			<tr>
				<th>' . $value . '</th>
				<td class="rate">' . $rate . '</td>
			</tr>
			<tr>
				<th colspan="2">
					<ol><li style="background-color:' . $color . '; width:' . $rate . ';" title="' . $rate . '"></li></ol>
				</th>
			</tr>
			</table>';
        return $chart;
    }

    function progress_demo($use_color)
    {
        return self::progress('Progress Chart', self::LABELS, self::RATES, $use_color);
    }
    function progress($caption, $labels, $values, $use_color = false)
    {
        $get_rates = self::get_rates($values);
        $rates = $get_rates['ten'];

        $chart = '<table border="0" class="chart chart_progress">
			<caption>' . $caption . '</caption>
			<tr><td></td></tr>';
        for ($i = 0; $i < count($labels); $i++) {
            $label = $labels[$i];
            $rate = $rates[$i] . '%';
            $color = $use_color == true ? self::get_color($rate) : '#555';

            $chart .= '<tr>
				<th width="1">' . $label . '</th>
				<td>
					<ol title="' . $rate . '">
						<li style="background-color:' . $color . '; width:' . $rate . ';">' . $rate . '</li>
					</ol>
				</td>
			</tr>';
        }
        $chart .= '<tr><td></td></tr>
		</table>';
        return $chart;
    }

    function meter_demo()
    {
        return self::meter('Charts::meter', self::LANGS, self::VALUES);
    }
    function meter($caption, $labels, $values)
    {
        $get_rates = self::get_rates($values);
        $rates = $get_rates['int'];

        $chart = '<table border="0" class="chart chart_meter">
			<caption>' . $caption . '</caption>
			<tr><td></td></tr>';
        for ($i = 0; $i < count($labels); $i++) {
            $label = $labels[$i];
            $rate = $rates[$i] . '%';
            $value = number_format($values[$i]);

            $chart .= '<tr>
				<th width="1">' . $label . '</th>
				<td><ol><li style="width:' . $rate . ';" title="' . $rate . '">&nbsp;</li></ol></td>
				<td width="1">' . $value . '</td>
			</tr>';
        }
        $chart .= '<tr><td></td></tr>
		</table>';
        return $chart;
    }

    function bar_demo()
    {
        return self::bar('Programming Language Trends 2019/2020', self::LANGS, self::VALUES);
    }
    function bar($caption, $labels, $values)
    {
        $get_rates = self::get_rates($values);
        $rates = $get_rates['int'];

        $chart = '<table border="0" class="chart chart_bar">
			<caption>' . $caption . '</caption>
			<tr><td></td></tr>';
        for ($i = 0; $i < count($labels); $i++) {
            $label = $labels[$i];
            $color = self::get_color($rates[$i]);
            $rate = $rates[$i] . '%';
            $value = number_format($values[$i]);

            $chart .= '<tr>
				<th width="1">' . $label . '</th>
				<td>
					<ol>
						<li style="background-color:' . $color . '; width:' . $rate . ';" title="' . $rate . '">' . $value . '</li>
					</ol>
				</td>
				<td width="15">&nbsp;</td>
			</tr>';
        }
        $chart .= '<tr><td></td></tr>
		</table>';
        return $chart;
    }

    function postit_demo()
    {
        $values = array_map('number_format', self::VALUES);
        return self::postit('Status Chart', $values, self::QTRS, self::RATES);
    }
    function postit($caption, $values, $labels, $rates)
    {
        $chart = '<table border="0" class="chart chart_postit">
			<caption>' . $caption . '</caption>
			<tr><td></td></tr>';
        for ($i = 0; $i < count($labels); $i++) {
            $value = $values[$i];
            $label = $labels[$i];
            $rate = $rates[$i] . '%';

            $chart .= '<tr>
				<td>
					<h2>' . $value . '</h2>
					<label>' . $label . '</label>
				</td>
				<th width="1">' . $rate . '</th>
			</tr>';
        }
        $chart .= '<tr><td></td></tr>
		</table>';
        return $chart;
    }

    function splot_demo()
    {
        $labels = self::MONTHS;
        $values = self::TRENDS;
        return self::splot('Scatter Plot', $labels, $values);
    }
    function splot($caption, $labels, $values)
    {
        $cols = count($labels);
        $get_rates = self::get_rates($values);
        $rates = $get_rates['ten'];

        $rows = '';
        for ($i = 100; $i >= 0; $i -= 10) {
            $row = '<th><var>' . $i . ' %</var></th>';
            for ($j = 0; $j <= $cols; $j++) {
                $label = $labels[$j];
                $value = $values[$j];
                $rate = $rates[$j];

                if ($j != $cols && $rate == $i) {
                    $row .= '<td><var title="' . $label . ', ' . $value . '">&nbsp;</var></td>';
                } else {
                    $row .= '<td></td>';
                }

            }
            $rows .= '<tr>' . $row . '</tr>' . "\r\n";
        }
        $tbody = '<tbody>' . $rows . '</tbody>';

        $assoc = array($labels, $values);
        $rows = '';
        for ($i = 0; $i < 2; $i++) {
            $row = '<th>&nbsp;</th>';
            for ($j = 0; $j < $cols; $j++) {
                $row .= '<td>' . $assoc[$i][$j] . '</td>';
            }
            $rows .= '<tr>' . $row . '</tr>' . "\r\n";
        }
        $rows .= '<tr><td width="1">&nbsp;</td></tr>' . "\r\n";
        $tfoot = '<tfoot>' . $rows . '</tfoot>';

        $chart = '<table border="0" class="chart chart_splot">
			<caption>' . $caption . '</caption>
			' . $tbody . "\r\n" . $tfoot . '
		</table>';
        return $chart;
    }

    function column_demo()
    {
        $labels = self::MONTHS;
        $values = self::TRENDS;
        return self::column('Column Chart', $labels, $values);
    }
    function column($caption, $labels, $values, $tilt = null)
    {
        $style = is_null($tilt) ? '' : 'style="height:40px;font-size:10px;transform:rotate(-45deg);-webkit-transform:rotate(-45deg);-o-transform:rotate(-45deg);-moz-transform:rotate(-45deg);"';
        $cols = count($labels);
        $get_rates = self::get_rates($values);
        $rates = $get_rates['ten'];

        $rows = '';
        $track = array();
        for ($i = 100; $i >= 0; $i -= 10) {
            $row = '<th><var>' . $i . ' %</var></th>';
            for ($j = 0; $j <= $cols; $j++) {
                $label = $labels[$j];
                $value = $values[$j];
                $rate = $rates[$j] - 10;

                if ($j != $cols && ($rate == $i || in_array($rate, $track))) {
                    array_push($track, $rate);
                    $row .= '<td class="active" title="' . $label . ', ' . $value . '"></td>';
                } else {
                    $row .= '<td></td>';
                }

            }
            $rows .= '<tr>' . $row . '</tr>' . "\r\n";
        }
        $tbody = '<tbody>' . $rows . '</tbody>';

        $assoc = array($labels, $values);
        $rows = '';
        for ($i = 0; $i < 2; $i++) {
            $row = '<th>&nbsp;</th>';
            for ($j = 0; $j < $cols; $j++) {
                $f = $i == 1 ? number_format($assoc[$i][$j]) : $assoc[$i][$j];
                $row .= '<td ' . $style . '>' . $f . '</td>';
            }
            $rows .= '<tr>' . $row . '</tr>' . "\r\n";
        }
        $rows .= '<tr><td width="1">&nbsp;</td></tr>' . "\r\n";
        $tfoot = '<tfoot>' . $rows . '</tfoot>';

        $chart = '<table border="0" class="chart chart_column">
			<caption>' . $caption . '</caption>
			' . $tbody . "\r\n" . $tfoot . '
		</table>';
        return $chart;
    }

    function ring_demo($width = 9, $fill = 0)
    {
        switch ($width) {
            case 1:
                $rate = 65;
                break;
            case 2:
                $rate = 35;
                break;
            case 3:
                $rate = 45;
                break;
            case 4:
                $rate = 85;
                break;
            default:
                $rate = date('Y') - 1992;
        }

        return self::ring('Ring Chart', 'Battery Life', $rate, $width, $fill);
    }
    function ring($caption, $label, $rate, $width = 2, $fill = 0)
    {
        $stroke = self::get_color($rate);
        if ($rate < 0) {
            $append = 'chart_ring_negative';
            $rate = abs($rate);
        }
				
				$fill = is_null($fill)? 0: $fill;
        $fill_map = array(array('#222', '#555'), array('#fff', '#ccc'));
        $fill_key = $fill_map[$fill];
        //var_dump($fill, $fill_key);

        $chart = '<table border="0" class="chart chart_ring">
			<caption>' . $caption . '</caption>
			<tr><td></td></tr>
			<tr>
				<td>
					<svg viewbox="0 0 36 36.9" width="250" height="250" xmlns="http://www.w3.org/2000/svg">
						<circle stroke="lavender" stroke-width="' . $width . '" fill="none" cx="17.9" cy="18.5" r="15.9" />
						<circle class="chart_ring ' . $append . '" stroke-dasharray="' . $rate . ',100" stroke="' . $stroke . '"
							stroke-width="' . $width . '" fill="none" stroke-linecap="round" cx="17.9" cy="18.5" r="15.9" />
						<g class="chart_ring_inner">
							<text class="chart_ring_rate" fill="' . $fill_key[0] . '" x="18" y="19" text-anchor="middle">' . $rate . '%</text>
							<text class="chart_ring_label" fill="' . $fill_key[1] . '" x="18" y="23"	text-anchor="middle">' . $label . '</text>
						</g>
					</svg>
				</td>
			</tr>
			<tr><td></td></tr>
		</table>';
        return $chart;
    }

    function cstick_demo()
    {
        $labels = self::MONTHS;
        $values = self::TRENDS;
        return self::cstick('Candlestick Chart', $labels, $values);
    }
    function cstick($caption, $labels, $values)
    {
        $cols = count($labels);
        $get_rates = self::get_rates($values);
        $rates = $get_rates['ten'];

        $rows = '';
        for ($i = 100; $i >= 0; $i -= 10) {
            $row = '<th><var>' . $i . ' %</var></th>';
            for ($j = 0; $j <= $cols; $j++) {
                $label = $labels[$j];
                $value = $values[$j];
                $rate = $rates[$j];

                if ($j != $cols && $rate == $i) {
                    if ($rate < 50) {
                        $row .= '<td><var class="alt" title="' . $label . ', ' . $value . '">&nbsp;</var></td>';
                    } else {
                        $row .= '<td><var title="' . $label . ', ' . $value . '">&nbsp;</var></td>';
                    }

                } else {
                    $row .= '<td></td>';
                }

            }
            $rows .= '<tr>' . $row . '</tr>' . "\r\n";
        }
        $tbody = '<tbody>' . $rows . '</tbody>';

        $assoc = array($labels, $values);
        $rows = '';
        for ($i = 0; $i < 2; $i++) {
            $row = '<th>&nbsp;</th>';
            for ($j = 0; $j < $cols; $j++) {
                $row .= '<td>' . $assoc[$i][$j] . '</td>';
            }
            $rows .= '<tr>' . $row . '</tr>' . "\r\n";
        }
        $rows .= '<tr><td width="1">&nbsp;</td></tr>' . "\r\n";
        $tfoot = '<tfoot>' . $rows . '</tfoot>';

        $chart = '<table border="0" class="chart chart_cstick">
			<caption>' . $caption . '</caption>
			' . $tbody . "\r\n" . $tfoot . '
		</table>';
        return $chart;
    }
}
