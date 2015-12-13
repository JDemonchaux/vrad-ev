<?php

/**
 * Classe de calcul de l'avancement selon le modèle de la gestion par la valeur aquise
 *
 * manageEV description.
 *
 * @version 1.0
 * @author Marie
 */
class ManageEV
{
    /**
     * calcul de l'avancemet par tache, règle 0-100%
     * @param $listItemHDoHDone
     *    $listItemHDoHDone["idItem"]
     *    $listItemHDoHDone["idItem"]["idTask"]
     *    $listItemHDoHDone["idItem"]["idTask"]["hDo"]
     *    $listItemHDoHDone["idItem"]["idTask"]["hDone"]
     *    $listItemHDoHDone["idItem"]["idTask"]["raf"] = 0;
     * @return $avancementItem["idItem"] = av%;
     */
    public function avancementItems(array $listItemHDoHDone, $item_full_list)
    {
        foreach ($item_full_list as $idItem => $item) {
            if($item->getLivrable()==1){
                $avancementItems[$idItem] = 0;
            }
        }
        foreach ($listItemHDoHDone as $idItem => $tasks) {
            $sumDo = 0;
            $sumDone = 0;
            foreach ($tasks as $idTask => $data) {

                $sumDo = $sumDo + $data["hDo"];
                    // règle d'avancemen 0-100% : on ne prend en compte l'avancement que quand le raf vaux zéro
                if (!is_null($data["raf"]) && $data["raf"] === 0) {
                    $sumDone = $sumDone + $data["hDo"];
                }
            }
            if ($sumDo > 0) {
                $avancementItems[$idItem]= round((($sumDone / $sumDo) * 100));
            } 
        }
        return $avancementItems;
    }

    /**
     * calcul de l'avancement du projet par item
     * @param $avancementItem ["idItem"] = av%;
     * @return av%;
     */
    public function avancementProject(array $avancementItems)
    {
        $avancement = 0;
        $total = 0;
        foreach ($avancementItems as $idItem => $value) {
            $avancement = $avancement + $value;
            $total = $total + 100;
        }

        if ($total > 0) {
            /*var_dump($avancement);
            var_dump($total);
            var_dump(($avancement / $total) * 100);
            die;*/
            return round(($avancement / $total) * 100);
        } else {
            return 0;
        }
    }

    /**
     * Calcul les intervals en heure des taches et indique le RAF
     * @param $listTask $listTask["idIask"] = $objTask;
     * @return $listItemHDoHDone
     *    $listItemHDoHDone["idItem"]
     *    $listItemHDoHDone["idItem"]["idTask"]
     *    $listItemHDoHDone["idItem"]["idTask"]["hDo"]
     *    $listItemHDoHDone["idItem"]["idTask"]["hDone"]
     *    $listItemHDoHDone["idItem"]["idTask"]["raf"] = 0;
     */
    public function getHDoHDoneFromListItem(array $listTask)
    {
        $listItemHDoHDone = array();
        load_library('Task','Projet');

        foreach ($listTask as $idTask => $objTask) {
           //var_dump($objTask);
            if (isset($objTask)) {
                if (!$objTask->getIsNp() && $objTask->getItem()->getLivrable()==1) {
                    $id = $objTask->getItem()->getIdItem();
                    $listItemHDoHDone[$id][$idTask]['hDo'] = $objTask->getPlanning()->getHoursToDo();
                    $listItemHDoHDone[$id][$idTask]['hDone'] = $objTask->getPlanning()->getHoursDone();
                    $listItemHDoHDone[$id][$idTask]['raf'] = $objTask->getPlanning()->getRAF();
                }
            }

        }
        return $listItemHDoHDone;

    }
}
