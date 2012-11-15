<% if $pagination.MoreThanOnePage %>
    <div class="row-fluid">
        <div class="span9 pagination-centered">
                <% if $pagination.PrevLink %>
                    <a href="$pagination.PrevLink">&lt;&lt; Prev</a> |
                <% end_if %>

                <% control $pagination.Pages %>
                    <% if CurrentBool %>
                        <strong>$PageNum</strong>
                    <% else %>
                        <a href="$Link">$PageNum</a>
                    <% end_if %>
                <% end_control %>

                <% if $pagination.NextLink %>
                    <a href="$pagination.NextLink">Next &gt;&gt;</a>
                <% end_if %>
        </div>
    </div>
<% end_if %>