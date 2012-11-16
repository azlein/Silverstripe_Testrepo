<% if $pagination.MoreThanOnePage %>
    <div class="row-fluid">
        <div class="span10 pagination-centered pagination">
            <ul>
                <% if $pagination.PrevLink %>
                    <li><a href="$pagination.PrevLink">Prev</a></li>
                <% end_if %>
                <% control $pagination.Pages %>
                    <% if CurrentBool %>
                        <li class="active"><a href="$Link"><strong>$PageNum</strong></a></li>
                    <% else %>
                       <li><a  href="$Link">$PageNum</a></li>
                    <% end_if %>
                <% end_control %>
                <% if $pagination.NextLink %>
                    <li><a href="$pagination.NextLink">Next</a></li>
                <% end_if %>
            </ul>
        </div>
    </div>
<% end_if %>