<?php
	include "./php/partials/secured.php";
?>
<!DOCTYPE html>
<html lang="it">
<?php
	include "./php/partials/header.php";
	include "./php/partials/body.php";
?>

	<main>
		<header><h2>Creazione documento</header>

		<form  id="createForm" method="POST" action="php/upload.php" enctype="multipart/form-data">

			<article data-fragment data-name="Aggiungeri un file al tuo documento">
				<header><h3>Clicca per aggiungere file al tuo documento</h3></header>
				<p>
					Fai click col tasto sinistro su "Aggiungi File" ( oppure toccalo sullo schermo) per aggiungere un nuovo file al tuo documento.
					Fai click col tasto destro su un file (o tieni premuto su di esso) per rimuoverlo.
				</p>
				<div id="uploadWrapper">
					<div id="initial" class="fileInput fileUploader" >
						<span>Aggiungi file</span>
					</div>
				</div>
				<a onclick="instance.fragments.next()" class="prettyButton">Procedi</a>
			</article>

			<article data-fragment data-name="Inserirsci una descrizione" >
				<header><h3>Clicca per inserire una descrizione</h3></header>
				<label>Inserisci una descrizione di almeno 100 caratteri che illustri il contenuto del tuo documento.</label><br>
				<strong id="count">0</strong> caratteri inseriti. 
				<div class="comboButton">
					<a class="prettyButton" href="#" onclick="command(event)" id="bold">Grassetto</a>
					<a class="prettyButton" href="#" onclick="command(event)" id="underline">Sottolineato</a>
					<a class="prettyButton" href="#" onclick="command(event)" id="italic">Corsivo</a>
				</div>
				<div class="description" contenteditable="true" id="description"></div><br>
				<a onclick="instance.fragments.next()" class="prettyButton">Procedi</a>
			</article>


			<article data-fragment data-name="Inserisci titolo, prezzo e tags" >
				<header><h3>Inserisci le informazioni principali</h3></header>

					<div class="left">
						<label for="file">Copertina (clicca per cambiare)</label>
						<div id="uploader" class="fileInput pictureInput">
							<img src="" alt="cover picture">
							<input type="file" name="cover" id="file">
							<progress max="100" value="0"></progress>
						</div><br>

					</div>
					
					<div class="left">
						<label for="title">Titolo</label><br>
						<input size="50"  pattern="([a-zA-Z0-9]( ){0,1}){6,50}" title="Inserisci un titolo: da 6 a 50 caratteri o numeri"  class="light" type="text" name="title" id="title" required>
						<label for="price">Prezzo</label><br>
						<input required max="90" min="0" title="Inserisci un prezzo valido: da 0 a 90 crediti" class="light" type="number" name="price" id="price">
						<label for="tags">Tags (esempio tag1, tag2, tag3, tag4)</label><br>
						<input required pattern="([a-zA-Z0-9]+)||(([a-zA-Z0-9]+, )+[a-zA-Z0-9]+)" title="Inserisci tag validi, esempio: tag1, tag2, tag3, tag4" class="light" type="text" name="tags" id="tags">
						<input type="hidden" name="description">
						<input class="prettyButton" id="submitForm" type="submit" value="Hai finito. Crea il documento!">
					</div>
			</article>


		</form>


	</main>
		<?php include("./php/partials/footer.php");?>
</body>

<script type="text/javascript" src="./js/components/create.js"></script>
<script type="text/javascript">var instance = new Create();
</script>