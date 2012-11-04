<div class="page-header" xmlns="http://www.w3.org/1999/html">
    <h1>$Title.RAW</h1>
</div>


<div class="row-fluid">
    <div class="span3">
        <% include Sidebar %>
    </div>
    <div class="span9 typography">
        <div class="span9">
            <ul class="thumbnails">
                <% loop Children %>
                    <li class="span4">
                        <div class="thumbnail">
                            <a href="$Link" class="stack">
                                <% loop GetImages(1) %>
                                    <img class="stack photo$Pos" src="$Image.setWidth(200).URL">
                                <% end_loop %>
                            </a>
                        </div>
                    </li>
                <% end_loop %>
            </ul>
            <div class="clearfix">
                $Content
            </div>
        </div>
<!--        <div class="span9">
            <% loop Children %>
                &lt;!&ndash;<div class="span5 blah">&ndash;&gt;
                    &lt;!&ndash;<a href="$Link" class="stack">&ndash;&gt;
                        <ul class="stack">
                            <% loop GetImages %>
                                <li class="photo$Pos">
                                    <img src="$Image.setWidth(200).URL" />
                                </li>
                            <% end_loop %>
                        </ul>
                    &lt;!&ndash;</a>&ndash;&gt;
                &lt;!&ndash;</div>&ndash;&gt;
            <% end_loop %>
        </div>-->
    </div>
</div>
<div class="row" style="width: 20px; height: 2px;"></div>
