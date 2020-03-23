<script type="text/javascript">
    var a = 0; 
    function menuClick(id){
		var name = id.id;
		$('.menu ul li a.active').removeClass('active');
		$('.menu ul li a#'+name).addClass('active');
		
   		if(a<=name){
			$('.'+a).hide();
		} a++;
		
	};

</script>

<script type="text/javascript">
    new wax.tilejson('http://tileserver.maptiler.com/grandcanyon@2x.jsonp',
    function(tilejson) {
		var map = L.map('mapwlds',{ zoomControl: true ,gestureHandling: true}).setView([-6.883352,107.551609],17);
		map.invalidateSize();
		var osmDataAttr = 'Map data &copy; <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors | develop by <a href=https://github.com/bervinleonardy>Blaxtech</a> ';
	    var mopt = {
		  			url: 'https://api.mapbox.com/styles/v1/mapbox/streets-v9/tiles/256/{z}/{x}/{y}?access_token=pk.eyJ1IjoiYmVydmlubGVvbmFyZHkiLCJhIjoiY2pqNDgxYjNjMWcxYTNvbnd1Y3lheWd1ZSJ9.0ULezPS8a9o8cC0e5kIIRQ',
		  			options: {attribution:'© <a href="https://www.mapbox.com/map-feedback/">Mapbox</a>| develop by <a href=https://github.com/bervinleonardy>Blaxtech</a>'}
				  };
		var osm = L.tileLayer("http://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png",				
								{attribution:osmDataAttr});
		
		var mq = L.tileLayer(mopt.url,mopt.options);
		var googleDataAttr = '<a href="https://www.google.com/maps/">Google</a> develop by <a href=https://github.com/bervinleonardy>Blaxtech</a>';
        var google = L.tileLayer('http://www.google.cn/maps/vt?lyrs=s@189&gl=cn&x={x}&y={y}&z={z}',{attribution:googleDataAttr });
		  google.addTo(map);

		  var baseMaps = {
			  "Google Maps": google,
			  "Mapbox Streets": mq,
			  "Open Street Map":osm
		  };
	
		new L.Control.Fullscreen({ position: 'topright' }).addTo(map);

        var marker;
		function getAllMarker(){
			var urls = 'ajaxpeta.php';
			jQuery.ajax({type: 'GET', url: urls, dataType: 'json',
				success: function(v){
					for(i in v){
						if (v[i].latitude != '' && v[i].longitude != ''){
						
						//printMarker(v[i].id,v[i].nama,v[i].lnt,v[i].lng,v[i].luas);
						updateMarkerStatus(v[i].id, v[i].pipa_retikulasi_awal, v[i].pipa_retikulasi_akhir, v[i].tekanan_reservoir, v[i].volume_reservoir, v[i].latitude, v[i].longitude, v[i].waktu,v[i].tanggal);
							console.log("JSON SUKSES: " + v[i].latitude, v[i].longitude);
//							console.log("JSON SUKSES: " + updateMarkerStatus);
						}
						
					}
				},
				error: function(xhr, status, error) {
					var err = status + ", " + error;
					console.log( "Request Failed: " + err );	
				}
			});
		}
		var peringatan = new L.LayerGroup().addTo(map);

        function updateMarkerStatus(id, pipa_retikulasi_awal, pipa_retikulasi_akhir, tekanan_reservoir,volume_reservoir, latitude, longitude, waktu, tanggal){
			
			var html = 
			'<div class="card card-danger"> \
				<div class="img" onclick="overlay2('+id+')"> </div> \
				  <div class="card-header">\
					<h3 class="card-title" title="Peringatan">Peringatan Kebocoran</h3>\
				  </div>\
				<div class="card-body">\
					<div>Volume Reservoir  : '+volume_reservoir+' Liter </div>\
					<div>Tekanan Reservoir : '+tekanan_reservoir+' PSi</div>\
					<div>Debit Pipa Retikulasi Awal   :'+pipa_retikulasi_awal+' Liter/detik</div>\
					<div>Debit Pipa Retikulasi Akhir  :'+pipa_retikulasi_akhir+' Liter/detik</div>\
					<div>Tanggal Peringatan:'+tanggal+'</div>\
					<div>Jam : '+waktu+' WIB</div>\
				</div>\
				<div ></div> \
			</div>';

		 	var myIcon = new L.icon({ 
				iconUrl: 'maps/images/alert.png',
				iconSize: [27, 39],
				iconAnchor: [13, 38],
				popupAnchor: [0, 0],
				shadowUrl: 'maps/images/marker-shadow.png',
				shadowSize: [41, 41],
				shadowAnchor: [13, 38]
			});
		
			var iconPulse = L.icon.pulse({iconSize:[5,5],color:'red'});
			var dataperingatan = new L.marker([latitude, longitude], {icon: iconPulse} ).bindPopup(html).addTo(peringatan);
		
//			map.addLayer(peringatan); 
//		map.fitBounds(peringatan.getBounds());

        }
		getAllMarker();
		
			function fills(fill){
				return fill ;
			}
		
			function onEachFeature(feature, layer) {
				if (feature.properties && feature.properties.nama_pipa) {				
				 	layer.bindPopup(feature.properties.nama_pipa);
				}				 
			}	
			function style_pipa(features) {
				return {
					color: fills(features.properties.fill),
					stroke:true,
					weight: 3,
					dashArray: '3',
					fillOpacity: 1	
				};
			}		
			var sekunder	 = new L.LayerGroup().addTo(map);
		    var tersier	 	 = new L.LayerGroup().addTo(map);
			var pretikulasi	 = new L.LayerGroup().addTo(map);
			var pdinas		 = new L.LayerGroup().addTo(map);
			//update get function error xhr , status, error and also run with jQuery 2.xx OR lastest
		    // Load GeoJSON
			$.ajax({
				type : "GET",	
				dataType: "json",
				url: "https://raw.githubusercontent.com/bervinleonardy/Project-IoT/master/GEOJSON_PIPA%2BKOTA/sekunder.geojson",	
				success: function (response_sekunder) {
						//we have successfully loaded the data, so turn it into a layer on the map
					//when we add the data to the map we also say how we want each feature (or point)
					//to behave. In this case we add a popup
					var geojsonLayer = new L.geoJson(response_sekunder, {
					onEachFeature: onEachFeature ,style : style_pipa}).addTo(sekunder);
					//make the map zoom out so it includes all of the data
//					map.fitBounds(geojsonLayer.getBounds());			

					//remove our loading message
//					$("#status").fadeOut(500);
					console.log("JSON Data Pipa Sekunder: " + response_sekunder);
				},
				error: function(xhr, status, error) {
					alert("An AJAX error occured: " + status + "\nError: " + error);
					var err = status + ", " + error;
					console.log( "Request Failed Data Pipa Sekunder: " + err );				
				}			
			});	
		
			$.ajax({
				type : "GET",	
				dataType: "json",
				url: "https://raw.githubusercontent.com/bervinleonardy/Project-IoT/master/GEOJSON_PIPA%2BKOTA/tersier.geojson",		
				success: function (response_tersier) {
						//we have successfully loaded the data, so turn it into a layer on the map
					//when we add the data to the map we also say how we want each feature (or point)
					//to behave. In this case we add a popup
					var geojsonLayer = new L.geoJson(response_tersier, {
					onEachFeature: onEachFeature ,style : style_pipa}).addTo(tersier);
					//make the map zoom out so it includes all of the data
//					map.fitBounds(geojsonLayer.getBounds());			

					//remove our loading message
//					$("#info").fadeOut(500);
					console.log("JSON Data Pipa Tersier: " + response_tersier);
				},
				error: function(xhr, status, error) {
					alert("An AJAX error occured: " + status + "\nError: " + error);
					var err = status + ", " + error;
					console.log( "Request Failed Data Pipa Tersier: " + err );				
				}			
			});			
		
			$.ajax({
				type : "GET",	
				dataType: "json",
				url: "https://raw.githubusercontent.com/bervinleonardy/Project-IoT/master/GEOJSON_PIPA%2BKOTA/retikulasi.geojson",	
				success: function (response_retikulasi) {
						//we have successfully loaded the data, so turn it into a layer on the map
					//when we add the data to the map we also say how we want each feature (or point)
					//to behave. In this case we add a popup
					var geojsonLayer = new L.geoJson(response_retikulasi, {
					onEachFeature: onEachFeature ,style : style_pipa}).addTo(pretikulasi);
					//make the map zoom out so it includes all of the data
//					map.fitBounds(geojsonLayer.getBounds());			

					//remove our loading message
//					$("#info").fadeOut(500);
					console.log("JSON Data Pipa Retikulasi: " + response_retikulasi);
				},
				error: function(xhr, status, error) {
					alert("An AJAX error occured: " + status + "\nError: " + error);
					var err = status + ", " + error;
					console.log( "Request Failed Data Pipa Retikulasi: " + err );				
				}			
			});	
			//Load the data
			$.ajax({
				type: "GET",
				url: 'https://raw.githubusercontent.com/bervinleonardy/Project-IoT/master/GEOJSON_PIPA%2BKOTA/pdinas.geojson',
				dataType: 'json',
				success: function (response) {
						//we have successfully loaded the data, so turn it into a layer on the map
					//when we add the data to the map we also say how we want each feature (or point)
					//to behave. In this case we add a popup
					var geojsonLayer = new L.geoJSON(response, {
						
					onEachFeature: onEachFeature ,
					style : style_pipa
					
					}).addTo(pdinas);
					//make the map zoom out so it includes all of the data
//                    geojsonLayer.addGeoJSON(response);
//                    map.layeradd(geojsonLayer);
					
//					map.fitBounds(geojsonLayer.getBounds());			
					
					//remove our loading message
//					$("#info").fadeOut(500);
					console.log("JSON Data Pipa Dinas: " + response);
				},
		    error: function(xhr, status, error) {
			    alert("An AJAX error occured: " + status + "\nError: " + error);
				var err = status + ", " + error;
				console.log( "Request Failed Pipa Dinas: " + err );				
		    }					
			});		

		
			var overlays={	
			"Pipa Sekunder" : sekunder,
			"Pipa Tersier" : tersier,	
			"Pipa Tersier" : tersier,	
			"Pipa Retikulasi":pretikulasi,
		    "Pipa Dinas": pdinas,
			"Peringatan" :peringatan	
			}		
			var lc= new L.control.layers(baseMaps,overlays,{position: 'bottomleft'}).addTo(map);
		
			var legend = L.control({position: 'bottomright'});

			legend.onAdd = function (map) {

			  var div = L.DomUtil.create("div", "legend");
			  div.innerHTML += "<h4>Legenda</h4>";
			  div.innerHTML += '<i style="background: #ff8000"></i><span>Pipa Sekunder</span><br>';
			  div.innerHTML += '<i style="background: #00ff00"></i><span>Pipa Tersier</span><br>';				
			  div.innerHTML += '<i style="background: #0065ca"></i><span>Pipa Retikulasi</span><br>';
			  div.innerHTML += '<i style="background: #00e6e6"></i><span>Pipa Dinas</span><br>';	
			  div.innerHTML += '<i class="far fa-dot-circle" style="color: red"></i><span>Peringatan</span><br>';

			  return div;
			};
			legend.addTo(map);		
    });
	
</script>	
<!--<div id="mapwlds" style="height:300px; width:100%; "></div>-->
