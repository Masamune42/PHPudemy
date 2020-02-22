<?php

// TABLEAUX DE MULTIPLICITE

echo '<table border style="border-collapse: collapse;">
		<tr>
			<th></th>
			<th>1</th>
			<th>2</th>
			<th>3</th>
			<th>4</th>
			<th>5</th>
			<th>6</th>
			<th>7</th>
			<th>8</th>
			<th>9</th>
			<th>10</th>
		</tr>';

for($i = 1; $i <= 10; $i++)
{
	echo '<tr><th>'.$i.'</th>';

		for($j = 1; $j <= 10; $j++)
		{
			echo '<td>'.$i*$j.'</td>';
		}

	echo '</tr>';
}