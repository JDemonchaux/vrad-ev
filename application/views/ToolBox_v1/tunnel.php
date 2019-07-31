<div class="row-fluid text-center">
<nav id='<?php echo $tunnel->getName();?>'>
  <ul class="pagination pagination-lg">
  	<!-- Exemple bootstrap
    <li class="disabled"><a href="#" aria-label="Previous"><span aria-hidden="true">&laquo;</span></a></li>
    <li class="active"><a href="#">1 <span class="sr-only">(current)</span></a></li>
    -->
  	<?php 
  	foreach ($tunnel->getSteps() as $number => $step) {
  		$url = $step->getURL();
  		if ($step->getNumber() < $tunnel->getCurentStep() && !$tunnel->is_backwardable()){
  			$class="disabled";
  			$span='<span aria-hidden="true">';
  			$url="#";
  		}
  		if ($step->getNumber() < $tunnel->getCurentStep() && $tunnel->is_backwardable()){
  			$class="";
  			$span='<span>';
  		}
  		if ($step->getNumber() == $tunnel->getCurentStep() ){
  			$class="active";
  			//  $span='<span class="sr-only">'; // a quoi ca sert ???
  			$span='<span>';
  		}
  		if ($step->getNumber() > $tunnel->getCurentStep() && $tunnel->is_navigable()){
  			$class="";
  			$span='<span>';
  		}
  		if ($step->getNumber() > $tunnel->getCurentStep() && !$tunnel->is_navigable()){
  			$class="disabled";
  			$span='<span aria-hidden="true">';
  			$url="#";
  		}
  		$li = '<li class="'.$class.'">';
  		$ahref = '<a href="'.$url.'" aria-label="'.$step->getShortName().'" >';
  		$end_span_a_li = "</span></a></li>";

  		echo $li.$ahref.$span.$step->getName().$end_span_a_li;
  	}
  	?>
  </ul>
</nav>
</div>