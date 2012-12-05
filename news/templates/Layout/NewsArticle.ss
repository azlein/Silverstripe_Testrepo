	<div class="row-fluid">
		<div class="span3">
			<blockquote>
				<p>Software built on pride and love of subject is superior to software built for profit.</p>
				<small>Ravi  Simhambhatla, CIO, Virgin America</small>
			</blockquote>
		</div>

		<div class="span9 typography">
			<div class="page-header">
				<h1>$Title.RAW</h1>
				<p class="author">Von $Author, $Date</p>
			</div>
			<div class="row-fluid">
				<p class="summary">
					$Summary
				</p>
			</div>
			<hr>
			<div class="row-fluid">
				$Content
			</div>
			<% if $Source %>
				<div class="row-fluid">
					<% if $ExternalUrl %>
						Quelle: <a href="$ExternalUrl">$Source</a>
					<% else %>
						Quelle: $Source
					<% end_if %>
				</div>
			<% end_if %>
		</div>
	</div>
