<meta charset="utf8">
<?php

$tutar=$_POST["tutar"];
$taksit=$_POST["adet"];
$tarih=$_POST["tarih"];

$i=0;
$taksittutar=array();
$top=0;

$taksitmiktar=$tutar/$taksit;

for($i=0;$i<$taksit;$i++){
	$taksittutar[$i]["tutar"]=number_format($taksitmiktar,2);
	$taksittutar[$i]["tarih"]=date( "d.m.Y", strtotime("$tarih,+$i month"));
	$top+=$taksittutar[$i]["tutar"];
}

if($top<$tutar){
	$fark=number_format($tutar-$top,2);
	$taksittutar[0]["tutar"]=$taksittutar[1]["tutar"]+$fark;
}

if($top>$tutar){
	$fark=number_format($top-$tutar,2);
	$taksittutar[0]["tutar"]=$taksittutar[1]["tutar"]-$fark;
}
?>

<table border="1">
	<tr>
		<td>Taksit Sayısı</td>
		<td>Taksit Tarihi</td>
		<td>Taksit Tutarı</td>
	</tr>
	<?php $toplamtutar=0; ?>
	<?php foreach($taksittutar as $key => $val): ?>
		<?php $toplamtutar+=$val["tutar"];?>
	<tr>
		<td align="center"><?php echo $key+1;?>. taksit</td>
		<td align="center"><?php echo $val["tarih"];?></td>
		<td align="center"><?php echo number_format($val["tutar"],2);?></td>
	</tr>
	<?php endforeach; ?>
	<tr>
		<td colspan="2" align="center">Toplam Tutar</td>
		<td align="center"><?php echo $toplamtutar; ?></td>
	</tr>
</table>
