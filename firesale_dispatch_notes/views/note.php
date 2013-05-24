<div class="container">
	<!-- CH: Don't ask! I got the address label template from amazonpaper.co.uk
		It works well with converting HTML into PDFs too-->
	<table align="left" width="600" border="0">
		<tr>
			<td width="3%" height="40">&nbsp;</td>
			<td width="97%"><br></td>
		</tr>
		<tr>
			<td>&nbsp;</td>
			<td class="is1">Dispatch to: </td>
		</tr>
		<tr>
			<td height="300">&nbsp;</td>
			<td valign="top">
				<font style="line-height:30px" size="6" face="Verdana, Arial, Helvetica, sans-serif">
					{{ ship_to.firstname }} {{ ship_to.lastname }}
					<br>{{ ship_to.address1 }}
					{{ if ship_to.address2 }}
						<br>{{ ship_to.address2 }}
					{{ endif }}
					<br>{{ ship_to.city }}
					<br>{{ ship_to.county }}
					<br>{{ ship_to.postcode }}
				</font>
			</td>
		</tr>
		<tr>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
		</tr>
	</table>

	<table align="right" width="350" border="0">
		<tr>
			<td width="3%" height="40">&nbsp;</td>
			<td width="97%"><br></td>
		</tr>
		<tr>
			<td>&nbsp;</td>
			<td class="is1">Return to: </td>
		</tr>
		<tr>
			<td height="300">&nbsp;</td>
			<td valign="top">
				<font style="line-height:30px" size="4" face="Verdana, Arial, Helvetica, sans-serif">
					Address 1
					<br>Address 2
					<br>Address 3
					<br>Town/City
					<br>County
					<br>Postcode
				</font>
			</td>
		</tr>
		<tr>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
		</tr>
	</table>

	<header>
		<div class="logo">
			Logo Here
		</div>
		<h1 class="title">Dispatch Note</h1>
		<p>Thank you for shopping with us. Should you need to return an item then please fill out this form and send it back to us along with the item(s) that you are returning.</p>
		<p>Items must be returned within 7 days from the date of receipt.</p>
		<p><strong>SALE ITEMS ARE NON RETURNABLE</strong></p>
	</header>

	<section>
		<h2>Original summary for order: #{{ id }}</h2>
		<table class="shopping-basket order-history">
			<thead>
				<tr class="table-headings">
					<th class="number">#</th> 
					<th style="width: 75px" class="date">Date</th>         
					<th colspan="2" class="thumb">Item(s) Purchased</th>
					<th class="qty">Quantity</th>
					<th class="options">Options</th>
					<th class="total">Total</th>
					<th class="select">Return?</th>
					<th class="select">Reason</th>
				</tr>
			</thead>
			<tbody>
				{{ items }}
					<tr>
						<td>
						{{ no }}.</td>
						<td>{{ helper:date timestamp=created format="d/m/Y" }}</td>
						<td style="width: 75px">
							{{ if { helper:isset var=image } }}
								<img src="{{ url:site }}files/thumb/{{ image }}/65/65" alt="{{ title }}" />
							{{ else }}
								{{ theme:image file="not_found.jpg" alt="Not Found" width="65" height="65" }}
							{{ endif }}
						</td>
						<td class="description"><strong>{{ title }}</strong><p>Product Code: {{ code }}</td>
						<td>{{ qty }}</td>   
						<td class="options">
							{{ options }}
								<strong>{{ title }}: </strong>{{ value }}<br />
							{{ /options }}
						</td>
						<td class="price">{{ settings:currency }} {{ helper:number_format string=price decimals="2" }}</td>
						<td class="select"><div class="box"></div></td>
						<td class="select"><div class="box"></div></td>
					</tr>
				{{ /items }}

			</tbody>
		</table>

		<div class="totals">
			<ul id="basket-total">
				<li><span>Order Total:</span><span class="price subtotal">Â£<em>{{ price_sub }}</em></span></li>
				<li>
					<span>Delivery:</span>
					<span class="price">Â£<em>{{ price_ship }}</em></span>
				</li>
				<li class="grand-total"><span>Total:</span><span class="total">Â£<em>{{ price_total }}</em></span></li>
			</ul>     
		</div>
		<div class="reason_codes">
			<h2>Reason Codes</h2>
			<ol>
				<li><span>Looks Different To Image On Site</span></li>
				<li><span>Ordered More Than One</span></li>
				<li><span>Poor Quality/Faulty</span></li>
				<li><span>Incorrect Item Received</span></li>
				<li><span>Parcel Damaged On Arrival</span></li>
				<li><span>Other</span></li>
			</ol>
		</div>
	</section>
</div>