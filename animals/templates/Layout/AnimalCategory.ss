
<div class="page-header">
    <h1>$Title.RAW</h1>
</div>

<div class="row-fluid">
    <div class="span3">
        <% include CategoriesBar %>
    </div>
    <div class="span9 typography">
        <% control $category %>
            <% loop Animals %>
                <div class=" row-fluid animal">
                    <a  href="{$Top.Top.Link}{$category.Name}/{$ID}">$Name</a>
                    <img class="span2 "  src="$ProfilePic.setWidth(100).URL"/>
                <p><b>Alter:</b>$Age</p>
                 <p><b>Rasse:</b>$Race</p>
                <p> <a href="{$Top.Top.Link}{$category.Name}/{$ID}">Mehr Informatin</a></p>
                </div>
            <% end_loop %>
        <% end_control %>
    </div>

</div>