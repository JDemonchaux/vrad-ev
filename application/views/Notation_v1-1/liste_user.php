<div class="row-fluid">
	<h1 class="hcenter">Liste des Membres</h1>
</div>
 <div class="row">
        <div class="col-sm-12">
  <form action="<?php echo $form_valideAccount_uri; ?>" method="POST" class="formHome">

            <table class="table table-bordered tableToDoList">
                <thead>
                <tr>
                        <tr class="text-center">
                            <td class="valign">Nom</td>
                            <td class="valign">Prénom</td>
                            <td class="valign">email</td>
                                <td class="valign">Validé</td>
                        </tr>
</thead>
                <tbody>
<?php 

 foreach ($les_users as $id_user => $user) {


        //ligne pour un item
        ?>
                    <tr class="text-center" >
                        <td class="valign"><?php echo $user->getNom(); ?></td>
                        <td class="valign"><?php echo $user->getPrenom(); ?></td>
                        <td class="valign"><?php echo $user->getMail(); ?></td>
                        <td class="valign">
                        <?php 
                        echo "<INPUT TYPE='checkbox' name='CBvalid_$id_user' ";
                        if ( $user->getAccountValid()  == 1) { echo " CHECKED ";} 
                          echo ">";
?>
                        </td>
                    </tr>

                <?php

                }//fin for items

                ?>
                </tbody>
            </table>
                                        <div class="hcenter">
                                <button type="submit" class="btn rouge white-text">Valider</button>
                            </div>
                           </form>
        </div>
    </div>
