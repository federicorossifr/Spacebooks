<!DOCTYPE html>
<?php
	require "./php/partials/secured.php";
?>
<html lang="en">
<?php
	include "./php/partials/header.php";
	include "./php/partials/body.php";

	if($user->role == "user") header("Location: ./home.php");
	$users = User::fetchAll();
	$documents = Document::fetchAll();
?>

	<main id="coso">
		<article data-fragment data-name="Utenti">
			<form class="combo">
				<input class="light" type="search" id="userFilter">
				<select class="light" id="userSelector"></select>
			</form>
			<header><h2>Utenti</h2></header>
			<table class="userTable">
				<thead>
					<th>Nome</th>
					<th>Cognome</th>
					<th>Username</th>
					<th>Email</th>
					<th>Password</th>
					<th>Data di nascita</th>
					<th>Nazionalità</th>
				</thead>
				<tbody id="userTable">
					<?php
						foreach ($users as $tmp) {
							echo "
								<tr>
									<td>$tmp->name</td>
									<td>$tmp->surname</td>
									<td>$tmp->username</td>
									<td>$tmp->email</td>
									<td>$tmp->password</td>
									<td>$tmp->birthdate</td>
									<td>$tmp->country</td>
								</tr>
							";
						}
				?>	
				</tbody>
			</table>

		</article>

		<article data-fragment data-name="Documenti">
			<header><h2>Documenti</h2></header>
			<form class="combo">
				<input class="light" type="search" id="documentFilter">
				<select class="light" id="documentSelector"></select>
			</form>
			<table class="userTable">
				<thead>
					<th>Titolo</th>
					<th>Creazione</th>
					<th>Ultima Modifica</th>
					<th>Autore</th>
					<th>Prezzo</th>
					<th>Punteggio</th>
					<th>Votazioni</th>
					<th>Disponibile</th>
					<th>Azione</th>
				</thead>
				<tbody id="documentTable">
					<?php
						foreach ($documents as $tmp) {
							echo "
								<tr>
									<td>$tmp->title</td>
									<td>$tmp->created</td>
									<td>$tmp->updated</td>
									<td>$tmp->author</td>
									<td>$tmp->price</td>
									<td>$tmp->score</td>
									<td>$tmp->votings</td>
									<td>$tmp->available</td>
									<td>
										<select onchange='action(this)' data-id='$tmp->id' data-model='document'>
											<option value='-1'>Scegli azione</option>
											<option value='0'>Convalida</option>
											<option value='1'>Sospendi</option>
											<option value='2'>Rimuovi</option>
										</select>
									</td>
								</tr>
							";
						}
				?>	
				</tbody>
			</table>
			
		</article>
		
		<article data-fragment data-name="Moderatori">
			<header><h2>Moderatori</h2></header>

			
		</article>

	</main>

<script type="text/javascript">
	var coso = new Fragment("coso");
	coso.makeSelectors("a");

	function initData(table,filter,selector) {
		var table = document.getElementById(table);
		var filter = document.getElementById(filter);
		var selector = document.getElementById(selector);
		var selectors = generateSelector(table.parentElement.rows[0]);
		selector.parentElement.replaceChild(selectors,selector);

		filter.oninput = function(event) {
			if(selectors.value != "-1")
			applyFilter(table,this,selectors);
		}

		selectors.onchange = function(event) {
			if(event.target.value != "-1")
			applyFilter(table,filter,this);	
		}
		
	}


	function applyFilter(targetTable,textInputField,selectorField) {
		var text =textInputField.value;
		var num = selectorField.value;
		filterTable(targetTable,num,text);
	}

	function actionPerformed(obj) {
		var rowAffected = obj.parentElement.parentElement;

		if(obj.value == "2")
			rowAffected.parentElement.removeChild(rowAffected);	
	}


	function action(obj) {
		var dbModel = obj.getAttribute("data-model");
		var dbModelId = obj.getAttribute("data-id");
		var dbModelAction = obj.value;
		var requestClient = null;
		switch(dbModel) {
			case "document": requestClient = new AsyncReq('./php/authority/documentModeration.php',function() {actionPerformed(obj);}); break;
			case "user" : requstClient = new AsyncReq('',cccc);
		}

		var params = [{'id':'id','value':dbModelId},{'id':'action','value':dbModelAction}];
		var conf = confirm("Procedere?");
		if(conf)
			requestClient.POST(params,'application/x-www-form-urlencoded');
	}

	initData("userTable","userFilter","userSelector");
	initData("documentTable","documentFilter","documentSelector");



	
</script>