<!DOCTYPE html>
<?php
	require "./php/partials/secured.php";
?>
<html lang="en">
<?php
	include "./php/partials/header.php";
	include "./php/partials/body.php";
?>

	<main>
		<header><h2>Creazione documento</header>

		<form id="createForm" method="POST" action="php/upload.php" enctype="multipart/form-data">
			<article class="left">
				<header><h3>Copertina</h3></header>
					<div class="fileInput">
						<input type="file" name="cover">
					</div>
			</article>

			<article class="left">
				<header><h3>Informazioni Principali</header>
					<label for="title">Titolo</label><br>
					<input type="text" name="title" id="title">
					<label for="price">Prezzo</label><br>
					<input type="text" name="price" id="price">
					<label for="tags">Tags</label><br>
					<input type="text" name="tags" id="tags">
					<input type="hidden" name="description">
					<button type="submit">Create</button>
			</article>

			<article class="left">
				<header><h3>Descrizione</h3></header>
				<p contenteditable="true" id="description"></p>
			</article>

			<article class="wide">
				<header><h3>Aggiunta file</h3></header>
					<input type="file" name="file[]" id="file">

			</article>
		</form>

	</main>


<script type="text/javascript">
	var createForm = document.getElementById("createForm");
	var formH = new Form("createForm");
	formH.addConstraint("title",/^([A-Z]{1}[a-z ]{1,45})$/);
	formH.addConstraint("price",/^\d{1,2}$/)
	formH.addConstraint("tags",/^(\w+;)+$/);


	var editor = document.getElementById("description");
	var cout = "";
	
	function parse(dm) {
		if(!dm) return;

		if(dm.tagName) {
			var startTag = "<" + dm.tagName + " ";

			for(var i = 0; i < dm.attributes.length; ++i) {
				if(dm.attributes[i].nodeName == "contenteditable") continue;
				startTag+= dm.attributes[i].nodeName + "='" + dm.attributes[i].nodeValue + "' ";
			}

			startTag+=">";
			
			var endTag = String("</" + String(dm.tagName) +">");
			cout+=startTag;
		} else {
			cout+=dm.textContent;

		}

		var chdrn = dm.childNodes;
		for(var i = 0; i < chdrn.length; ++i) {
			parse(chdrn[i]);
		}


		if(dm.tagName) {
			cout+=endTag;
		}

	}

	createForm.onsubmit = function(e) {
		e.preventDefault();
		cout = "";
		parse(editor)
		this.description.value = cout;
		console.log(cout);
		this.submit();
	}


</script>