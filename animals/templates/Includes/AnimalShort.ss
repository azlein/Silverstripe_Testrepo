<div class="row">
	<div class="span9 animal">
		<div class="span3">
			<img src="$ProfilePic.setWidth(150).URL"/>
		</div>
		<div class="span8">
			<h2 style="padding-top: 5px;">$Name</h2>
			<div class="span5">
				<p><b>Alter: </b>$Age $translateAgeUnit($AgeUnit)</p>
				<p><b>Rasse: </b>$Race</p>
				<p><b>Farbe: </b>$Color</p>
			</div>
			<div class="span4">
				<p><b>Kontakt: </b>$Contact</p>
				<p><b>Geschlecht: </b>$Gender</p>
				<p><a href="{$BaseLink}{$Category.Name}/{$ID}">Mehr Information</a></p>
			</div>
		</div>
	</div>
</div>