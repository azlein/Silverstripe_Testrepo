
<div class="page-header">
    <h1>$Title.RAW</h1>
</div>

<div class="row-fluid">
    <div class="span3">
        <% include CategoriesBar %>
    </div>
    <div class="span9 typography">
            <% loop $pagination %>
                <% include AnimalShort BaseLink=$Top.Link %>
            <% end_loop %>

            <% include PaginationLinks %>
    </div>

</div>