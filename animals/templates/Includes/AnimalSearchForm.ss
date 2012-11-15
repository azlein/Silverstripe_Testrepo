<form $FormAttributes>
<legend><% _t('AnimalSearchForm.LEGEND', 'Animal Search') %></legend>

<% if Message %>
<p id="{$FormName}_error" class="message $MessageType">$Message</p>
<% else %>
<p id="{$FormName}_error" class="message $MessageType" style="display: none"></p>
<% end_if %>

<div class="row-fluid">
    <fieldset>
        $Fields.dataFieldByName(Hidden)
        <div class="span4">
            <div class="control-group">
                <label class="control-label" for="{$FormName}_Name"><% _t('Animals.NAME','Name') %></label>

                <div class="controls">
                    $Fields.dataFieldByName(Name)
                </div>
            </div>

            <div class="control-group">
                <label class="control-label" for="{$FormName}_Category"><% _t('Animals.CATEGORY', 'Category') %></label>

                <div class="controls">
                    $Fields.dataFieldByName(Category)
                </div>

            </div>
        </div>
        <div class="span2"><br/></div>
        <div class="span4">
            <div class="control-group">
                <label class="control-label" for="{$FormName}_Color"><% _t('Animals.COLOR', 'Color') %></label>

                <div class="controls">
                    $Fields.dataFieldByName(Color)
                </div>
            </div>

            <div class="control-group">
                <label class="control-label" for="{$FormName}_Race"><% _t('Animals.RACE', 'Race') %></label>

                <div class="controls">
                    $Fields.dataFieldByName(Race)
                </div>
            </div>
        </div>
    </fieldset>
</div>
<div class="row-fluid">
    <% if Actions %>
    <div class="Actions control-group">
        <div class="controls">
            <% loop Actions %>$Field<% end_loop %>
        </div>
    </div>
    <% end_if %>
</div>
</form>