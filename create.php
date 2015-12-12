<!DOCTYPE html>
<?php
	require "./php/partials/secured.php";
?>
<html lang="it">
<?php
	include "./php/partials/header.php";
	include "./php/partials/body.php";
?>

	<main>
		<header><h2>Creazione documento</header>

		<form  id="createForm" method="POST" action="php/upload.php" enctype="multipart/form-data">

			<article data-fragment data-name="Clicca per aggiungere file al tuo documento" class="right">
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

			<article data-fragment data-name="Clicca per inserire una descrizione" class="right">
				<header><h3>Clicca per inserire una descrizione</h3></header>
				<label for="description">Inserisci una descrizione di almeno 100 caratteri che illustri il contenuto del tuo documento.</label><br>
				<strong><label id="count">0</label></strong> caratteri inseriti. 
				<div class="comboButton">
					<button class="prettyButton" onclick="command(event)" id="bold">Grassetto</button>
					<button class="prettyButton" onclick="command(event)" id="underline">Sottolineato</button>
					<button class="prettyButton" onclick="command(event)" id="italic">Corsivo</button>
				</div>
				<div contenteditable="true" id="description"></div><br>
				<a onclick="instance.fragments.next()" class="prettyButton">Procedi</a>
			</article>


			<article data-fragment data-name="Titolo, prezzo e tags" class="left">
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
						<button id="submitForm" type="submit">Hai finito. Crea il documento!</button>
					</div>
			</article>


		</form>

	</main>


<script type="text/javascript" src="./js/components/create.js"></script>
<script type="text/javascript">var instance = new Create();

	var bold = document.getElementById("bold");
	function command(event) {
		event.preventDefault();
		var command = event.target.id;
		document.execCommand(command);
	}

	document.getElementById("description").oninput = function() {
		var counter = document.getElementById("count");
		var value = this.textContent;
		console.log(value);
		var valueLength = value.length;
		console.log(valueLength);
		var valueGoal = 100;
		console.log(valueGoal);
		if(valueGoal - valueLength >= 0) {
			counter.className = "error";
		} else {
			counter.className = "success";
		}

		counter.textContent = valueLength;
	}

</script>