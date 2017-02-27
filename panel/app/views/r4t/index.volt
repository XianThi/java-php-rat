{{content()}}
<div class="row">
<div align="right">{{ link_to('r4t/olustur', lang._('create_button'), 'class': 'btn btn-primary') }}</div>
<h2 align="center">{{lang._('r4t_list')}}</h2>

<ul class="list-group">
<?php
if(count($r4ts)>0){ 
$i=1;
foreach($r4ts as $r4t){
?>
<li class="list-group-item">{{i}} - {{ link_to('r4t/id/'~r4t.id, r4t.name, 'class': '') }}</li>
<?php
$i++;
}}else{?>
<li class="list-group-item">Hiç r4t oluşturmamışsınız.</li>
<?php }
?>
</ul>
</div>