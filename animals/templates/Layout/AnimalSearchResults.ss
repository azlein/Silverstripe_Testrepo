
<div class="page-header">
    <h1>$Title.RAW</h1>
</div>

<div class="row-fluid">
    <div class="span3">
        <% include CategoriesBar %>
    </div>
    <div class="span9 typography">
        <div class="row-fluid">
            $animalSearchForm
        </div>

        <% loop results %>
            <% include AnimalShort BaseLink=$Top.Link %>
        <% end_loop %>
		<div class="row-fluid">
			<div class="span9 pagination-centered">
				<% if results.MoreThanOnePage %>
					<ul>
						<% if results.PrevLink %>
							<a href="$results.PrevLink">&lt;&lt; Prev</a> |
						<% end_if %>

						<% control results.Pages %>
							<% if CurrentBool %>
								<strong>$PageNum</strong>
							<% else %>
								<a href="$Link">$PageNum</a>
							<% end_if %>
						<% end_control %>

						<% if results.NextLink %>
							<a href="$results.NextLink">Next &gt;&gt;</a>
						<% end_if %>
					</ul>
				<% end_if %>
			</div>
		</div>
    </div>
</div>