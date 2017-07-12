<?php 
$google_api = 'AIzaSyBW5-HhAyyOjv4IyW5ALGau-rQbhw6-fkA';
print_r($google_api);
?>

<section id="local_info">
				<?php print_r($location); ?>
				<div class="row">
					<div class="col-md-6 col-xs-12">
						<div class="panel panel-default add-info-panel">
							<div class="panel-heading bus">
								<h3 class="panel-title">
									<i class="fa fa-bus" style="font-weight: bold;"></i> Bus Stops
								</h3>
							</div>
							<div class="panel-body">
								<ul class="list-unstyled property_features-list">
									<?php
									$bus_stops = file_get_contents('https://maps.googleapis.com/maps/api/place/nearbysearch/json?location='.$location.'&radius=10000&keyword=bus%20station&key='.$google_api);
									$bus_stops = json_decode($bus_stops);
									$i = 1;
									foreach ($bus_stops->results as $bus_stop) {
										echo $bus_stop->name.'<br/>';
										if($i==3) break;
										$i++;
									}
									?>
								</ul>
							</div>
						</div>
					</div>
					<div class="col-md-6 col-xs-12">
						<div class="panel panel-default add-info-panel">
							<div class="panel-heading trains">
								<h3 class="panel-title">
									<i class="fa fa-train" style="font-weight: bold;"></i> Trains
								</h3>
							</div>
							<div class="panel-body">
								<ul class="list-unstyled property_features-list">
									<?php
									$train_stations = file_get_contents('https://maps.googleapis.com/maps/api/place/nearbysearch/json?location='.$location.'&radius=30000&keyword=train%20station&key='.$google_api);
									$train_stations = json_decode($train_stations);
									$i = 1;
									foreach ($train_stations->results as $train_station) {
										echo $train_station->name."<br/>";
										if($i==3) break;
										$i++;
									}
									?>
								</ul>
							</div>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-md-6 col-xs-12">
						<div class="panel panel-default add-info-panel">
							<div class="panel-heading airports">
								<h3 class="panel-title">
									<i class="fa fa-plane" style="font-weight: bold;"></i> Airports
								</h3>
							</div>
							<div class="panel-body">
								<ul class="list-unstyled property_features-list">
									<?php
									$airports = file_get_contents('https://maps.googleapis.com/maps/api/place/nearbysearch/json?location='.$location.'&radius=50000&keyword=airport&key='.$google_api);
									$airports = json_decode($airports);
									$i = 1;
									foreach ($airports->results as $airport) {
										echo $airport->name."<br/>";
										if($i==3) break;
										$i++;
									}
									?>
								</ul>
							</div>
						</div>
					</div>
					<div class="col-md-6 col-xs-12">
						<div class="panel panel-default add-info-panel">
							<div class="panel-heading gyms">
								<h3 class="panel-title">
									<i class="fa fa-heartbeat" style="font-weight: bold;"></i> Gyms
								</h3>
							</div>
							<div class="panel-body">
								<ul class="list-unstyled property_features-list">
									<?php
									$gyms = file_get_contents('https://maps.googleapis.com/maps/api/place/nearbysearch/json?location='.$location.'&radius=10000&keyword=gym&key='.$google_api);
									$gyms = json_decode($gyms);
									$i = 1;
									foreach ($gyms->results as $gym) {
										echo $gym->name."<br/>";
										if($i==3) break;
										$i++;
									}
									?>
								</ul>
							</div>
						</div>
					</div>
				</div>



				<div class="row">
					<div class="col-md-6 col-xs-12">
						<div class="panel panel-default add-info-panel">
							<div class="panel-heading schools">
								<h3 class="panel-title">
									<i class="fa fa-graduation-cap" style="font-weight: bold;"></i> Schools
								</h3>
							</div>
							<div class="panel-body">
								<ul class="list-unstyled property_features-list">
									<?php
									$schools = file_get_contents('https://maps.googleapis.com/maps/api/place/nearbysearch/json?location='.$location.'&radius=10000&keyword=school&key='.$google_api);
									$schools = json_decode($schools);
									$i = 1;
									foreach ($schools->results as $school) {
										echo $school->name."<br/>";
										if($i==3) break;
										$i++;
									}
									?>
								</ul>
							</div>
						</div>
					</div>
					<div class="col-md-6 col-xs-12">
						<div class="panel panel-default add-info-panel">
							<div class="panel-heading hospitals">
								<h3 class="panel-title">
									<i class="fa fa-h-square" style="font-weight: bold;"></i> Hospitals
								</h3>
							</div>
							<div class="panel-body">
								<ul class="list-unstyled property_features-list">
									<?php
									$hospitals = file_get_contents('https://maps.googleapis.com/maps/api/place/nearbysearch/json?location='.$location.'&radius=10000&keyword=hospital&key='.$google_api);
									$hospitals = json_decode($hospitals);
									$i = 1;
									foreach ($hospitals->results as $hostpital) {
										echo $hostpital->name."<br/>";
										if($i==3) break;
										$i++;
									}
									?>
								</ul>
							</div>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-md-6 col-xs-12">
						<div class="panel panel-default add-info-panel">
							<div class="panel-heading shops">
								<h3 class="panel-title">
									<i class="fa fa-cutlery" style="font-weight: bold;"></i> Shops
								</h3>
							</div>
							<div class="panel-body">
								<ul class="list-unstyled property_features-list">
									<?php
									$shops = file_get_contents('https://maps.googleapis.com/maps/api/place/nearbysearch/json?location='.$location.'&radius=10000&keyword=store&key='.$google_api);
									$shops = json_decode($shops);
									$i = 1;
									foreach ($shops->results as $shop) {
										echo $shop->name."<br/>";
										if($i==3) break;
										$i++;
									}
									?>
								</ul>
							</div>
						</div>
					</div>
					<div class="col-md-6 col-xs-12">
						<div class="panel panel-default add-info-panel">
							<div class="panel-heading bars">
								<h3 class="panel-title">
									<i class="fa fa-glass" style="font-weight: bold;"></i> Bars
								</h3>
							</div>
							<div class="panel-body">
								<ul class="list-unstyled property_features-list">
									<?php
									$bars = file_get_contents('https://maps.googleapis.com/maps/api/place/nearbysearch/json?location='.$location.'&radius=10000&keyword=bar&key='.$google_api);
									$bars = json_decode($bars);
									$i = 1;
									foreach ($bars->results as $bar) {
										echo $bar->name."<br/>";
										if($i==3) break;
										$i++;
									}
									?>
								</ul>
							</div>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-md-6 col-xs-12">
						<div class="panel panel-default add-info-panel">
							<div class="panel-heading restaurants">
								<h3 class="panel-title">
									<i class="fa fa-cutlery" style="font-weight: bold;"></i> Restaurants
								</h3>
							</div>
							<div class="panel-body">
								<ul class="list-unstyled property_features-list">
									<?php
									$restaurants = file_get_contents('https://maps.googleapis.com/maps/api/place/nearbysearch/json?location='.$location.'&radius=10000&keyword=restaurant&key='.$google_api);
									$restaurants = json_decode($restaurants);
									$i = 1;
									foreach ($restaurants->results as $restaurant) {
										echo $restaurant->name."<br/>";
										if($i==3) break;
										$i++;
									}
									?>
								</ul>
							</div>
						</div>
					</div>
					<div class="col-md-6 col-xs-12">
						<div class="panel panel-default add-info-panel">
							<div class="panel-heading parks">
								<h3 class="panel-title">
									<i class="fa fa-tree" style="font-weight: bold;"></i> Parks
								</h3>
							</div>
							<div class="panel-body">
								<ul class="list-unstyled property_features-list">
									<?php
									$parks = file_get_contents('https://maps.googleapis.com/maps/api/place/nearbysearch/json?location='.$location.'&radius=10000&keyword=park&key='.$google_api);
									$parks = json_decode($parks);
									$i = 1;
									foreach ($parks->results as $park) {
										echo $park->name."<br/>";
										if($i==3) break;
										$i++;
									}
									?>
								</ul>
							</div>
						</div>

</div>
</div>
</section><!-- /#local-info -->