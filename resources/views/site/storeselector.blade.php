<!DOCTYPE html>
<html>
<head>
	<title>Choose your store</title>
	<style>
html { 
  background: url(/images/space-2015-12-16-2212.jpg) no-repeat center center fixed; 
  -webkit-background-size: cover;
  -moz-background-size: cover;
  -o-background-size: cover;
  background-size: cover;
  color: #fff;
}

#bannerSelect{
	text-transform: capitalize;
}

select{
 -webkit-appearance: none;
  -webkit-border-radius: 0px;
  padding: 10px 20px;
	border: 1px solid white;
	background: transparent;
	color: #fff;
	font-size: 16px;
	width: 300px;

/*	outline: 1px solid #CCC;*/

}

table{
	margin: 0 auto;
}
section{
	position: relative;
	top: 150px;
	text-align: center;
	width: 800px;
	margin: 0 auto;
}

	</style>
</head>
<body >


		<section>
			
			<table>
				<tr>
					<td>
						<p>Banner</p>
						<select id="bannerSelect" class="cs-select cs-skin-slide">
							<option></option>
						</select>
					</td>
					<td>
						<p>Store</p>
						<select id="storeSelect">
						</select>						
					</td>
				</tr>

			</table>



		</section>


	<script type="text/javascript" src="/js/jquery-2.1.1.min.js"></script>
	<script type="text/javascript" src="/js/custom/site/storeselector/storeSelector.js"></script>


	</body>
</html>