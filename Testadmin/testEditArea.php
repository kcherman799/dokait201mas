
<!doctype html>
<html>
	<head>
		<meta charset="UTF-8">
		<title> Добавит новую страницу! </title>
		<link href="jHtmlArea/jHtmlArea.css" rel="stylesheet" type="text/css" />
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
		<script src="jHtmlArea/jHtmlArea-0.8.js"></script>


		<script>
			$(document).ready( function () {
				$("#TextPage").htmlarea();

			});
		</script>
		
		<style>
			.jHtmlArea {
				background-color: aqua;
			}
		</style>

	</head>

	<body>
		<header>
			<h1> Админ панель CMS MyBlog </h1>


		</header>

		<section class="MainBlock">
			<div id="SubDiv">
				<p> Добавить новую страницу </p>

				<form name="insertpage" action="newpageform.php" method="post">
				<section id="messageError"> </section>
				<label> Название страницы: </label>
					<input id="NamePage" name="namepage" type="text" placeholder="Ввидете название страницы" /> <br />
					<p id="Text"> Текст страницы: </p>
					<textarea id="TextPage" name="textpage" cols="80" rows="10"> </textarea> <br />
					<input type="button" id="send" value="Добавить страницу!" />
				</form>
			</div>
		</section>

		<p id="Avtor"> Данную CMS написал Чермантеев Камиль </p>


	</body>
</html>
