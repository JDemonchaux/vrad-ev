<div class="row-fluid">
	<h1 class="hcenter">Liste des Items</h1>
</div>
 <div class="row">
        <div class="col-sm-12">
            <table class="table table-bordered tableToDoList">
                <thead>
                <tr>
                        <tr class="text-center">
                            <td class="valign">Categorie</td>
                            <td class="valign">Item</td>
                            <td class="valign">Priorité</td>
                                <td class="valign">Points BTS</td>
                                <td class="valign">Points Post BTS</td>
             
                            
                            <td class="valign">Description</td>
                        </tr>
</thead>
                <tbody>
<?php 

 foreach ($les_items as $id_item => $item) {




        //ligne pour un item
        ?>
                    <tr class="text-center" style="background-color: <?php echo $item->getCategorie()->getHexaColor();?>;" >
                        <td class="valign"><?php echo $item->getCategorie()->getLibelle(); ?></td>
                        <td class="valign">
                            <?php if ($item->getNiveau()>1){ echo "<b>";}?>
                            <?php echo $item->getLibelle(); ?></td>
                             <?php if ($item->getNiveau()>1){ echo "</b>";}?>
                        <td class="valign"><?php echo $item->getPriority(); ?></td>
                        <?php if ($item->getNiveau()>1){ ?>
                            <td class="valign"></td>
                            <td class="valign"><?php echo $item->getCoef(); ?></td>
                        <?php }else{ ?>
                            <td class="valign"><?php echo $item->getCoef(); ?></td>
                            <td class="valign"></td>
                       <?php  }?>
                        
                        <td class="valign"><?php echo $item->getDescription(); ?></td>
                    </tr>

                <?php

                }//fin for items

                ?>
                </tbody>
            </table>
        </div>
    </div>
