<!DOCTYPE html>
<html lang="en">
	<head>
		<title>SHELFARI 1.0</title>
		<meta name="viewport" content="width=device-width , initial-scale=1.0">
		<link href="/libraries/css/main.css" rel="stylesheet">
		<link href="/libraries/css/bootstrap.min.css" rel="stylesheet" media="screen">
	</head>
	<body>
		<div class="page-header">
  			<h1 class="text-center">Shelfari <small>v1.0</small></h1>
		</div>
		<div id="booksContainer" class="container-fluid">
			<div class="row-fluid">
				<div class="span9">
					<table class="table table-bordered table-hover">
						<thead>
							<tr class="well well-small">
								<th> Title </th>
								<th> Author </th>
								<th> Status // Modify </th>
							</tr>
						</thead>
						<tbody id="tableBody">
						</tbody>
					</table>
				</div>
				<div id="formContainer" class="span3">
					<div class="input-append well well-small">
					  <input class="span9" id="filterText" placeholder="filter books" type="text">
					  <button id="reset" class="btn btn-primary" type="button">reset</button>
					</div>
					<form id="addBook" action="#">
						<input id="title" type="text" placeholder="book title" maxlength=50/>
						<input id="author" type="text" placeholder="author name" maxlength=30/></br>
						<select id="status">
							<option value="false" selected>incomplete</option>
							<option value="true">completed</option>
						</select>
						<button id="addNew" class="btn btn-primary" type="button"><b>ADD BOOK</b></button>
					</form>
				</div>
			</div>
		</div>
		<div id="myModal" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
		  <div class="modal-header">
		    <h3 id="myModalLabel"><small>EDIT BOOK TITLE AND AUTHOR </small></h3>
		  </div>
		  <div class="modal-body">
		    <input class="pull-left" id="title" type="text" placeholder="new title or leave blank..."/>
		    <input class="pull-right" id="author" type="text" placeholder="new author or leave blank..."/>
		  </div>
		  <div class="modal-footer">
		    <button id="closeModal" class="btn" data-dismiss="modal" aria-hidden="true">Close</button>
		    <button id="saveChanges" class="btn btn-primary">Save changes</button>
		  </div>
		</div>
		<script id="bookTemplate" type="text/template">
				<td><small><b><%- title %></b></small></td>
				<td><small><b><%- author %></b></small></td>
				<td style="text-align:center"><i class=<%= status? '"icon-ok-sign toggle"' : '"icon-remove-sign toggle"' %>></i><i class="icon-remove delete"></i><i class="icon-edit edit"></i></td>
		</script>
		<script src="/libraries/js/lib/jquery.js"></script>
		<script src="/libraries/js/lib/bootstrap.min.js"></script>
		<script src="libraries/js/lib/underscore.js"></script>
		<script src="/libraries/js/lib/backbone.js"></script>
		<script src="/libraries/js/models/book.js"></script>
		<script src="/libraries/js/collections/library.js"></script>
		<script src="/libraries/js/views/book.js"></script>
		<script src="/libraries/js/views/library.js"></script>
		<script src="/libraries/js/views/edit.js"></script>
		<script src="/libraries/js/app.js"></script>
	</body>
</html>