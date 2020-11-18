<!-- BEGIN TITLE OVERRIDE -->
	<h1 class="page-title">~$Title~</h1>
<!-- END TITLE OVERRIDE -->
<!-- BEGIN CONTENT OVERRIDE -->
<div class="content">
	<div class="container">
		<div class="row">
			<% if $DemoAction == 'index' %>
				<h3>Add two numbers</h3>
				$DemoEntryForm
			<% else %>
				<h3>Your result</h3>
				$numOne + $numTwo = $result
			<% end_if %>
		</div>
	</div>
</div>
<!-- END CONTENT OVERRIDE -->
