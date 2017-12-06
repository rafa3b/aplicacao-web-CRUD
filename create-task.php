<section>
	<header>
		<?php include "header.php"; ?>
	</header>		
	<main>
		<div class="w3-container">
		  	<h1 class="azul-dae">Criar Terefa</h1>                        
	        <form action="index.php" method="post"  enctype="multipart/form-data">          	 
	        <input type="hidden" name="Dados" value="tasks">                                                    		
	       
	        <div class="w3-padding w3-container">
	            <label  name="name" class="w3-label"><strong>* </strong>Nome: </label>
	            <input type="text" name="name" class="w3-input w3-hover-light-grey w3-border" required>
	        </div>
	        <div class="w3-padding w3-container">
	            <label  name="desc" class="w3-label"><strong>* </strong>Descri&ccedil;&atilde;o: </label>
	            <textarea name="desc" rows="6" class="w3-input w3-hover-light-grey w3-border"></textarea>
	        </div>
	        <div class="w3-padding w3-container">
	            <label name="attach" class="w3-label"><strong>* </strong>Arquivo: </label>
	                <input type="file" name="attach" class="w3-input w3-hover-light-grey w3-border" required>
	        </div>
	                                         
	        <div class="w3-padding w3-container">                 
	        	<input type="submit" name="btnCreate" class="w3-btn w3-teal"  value="Criar"> 
	        </div>                             
	        </form>
	        
	        <div class="w3-container">&nbsp;</div>
	        <div class="w3-display-container w3-light-grey">
	            <a href="index.php" class="w3-btn w3-blue"><i class="fa fa-arrow-circle-left"></i> voltar</a>
	        </div>
	        <div class="w3-container">&nbsp;</div>		  	
		</div>
	</main>	
	<footer>
		<?php include "footer.php"; ?>
	</footer>
</section>