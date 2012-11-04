<div id="Sidebar">
	<div class="content well">
		<ul class="nav nav-list">

            <% if $activeLink %>
                <li class="link"><a href="$Link"><i class="icon-home"></i>$Title</a></li>
            <% else %>
                <li class="current"><a href="$Link"><i class="icon-home icon-white"></i>$Title</a></li>
            <% end_if %>

			<% loop getCategories() %>
                <% if $Top.activeLink==$Name %>
				    <li class="current"><a href="{$Top.Link}{$Name}"mce_href="{$Top.Link}{$Name}"><i class="icon-file icon-white"></i>$Name</a></li>
                <% else %>
                    <li class="link"><a href="{$Top.Link}{$Name}"mce_href="{$Top.Link}{$Name}"><i class="icon-file"></i>$Name</a></li>
                <% end_if %>
			<% end_loop %>
		</ul>
	</div>
</div>
