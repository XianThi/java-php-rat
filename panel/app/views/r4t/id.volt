{{content()}}
<div class="row">
<div align="right">{{ link_to('r4t/olustur', 'Düzenle', 'class': 'btn btn-primary') }}</div>
<h2 align="center">R4t</h2>

<table class="table table-bordered table-striped">
    <thead>
        <tr>
<?php
foreach ($attrs as $attr){
echo "<td>".$attr."</td>";
}
?>
        </tr>
    </thead>
    <tbody><tr>
    <?php 
foreach ($attrs as $attr){
echo "<td>".$r4t->$attr."</td>";
}
?>
</tr></tbody>
</table>