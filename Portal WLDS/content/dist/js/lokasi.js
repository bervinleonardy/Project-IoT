var L,wax;
new wax.tilejson('http://tileserver.maptiler.com/nasa.jsonp',
function(tilejson) {
	var map = L.map('mappipa',{ gestureHandling: true})
		.setView([-6.883352,107.551609],17,{reset: true,animate: false});
//	map.invalidateSize();
	var osmDataAttr = 'Map data &copy; <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors | develop by <a href=https://github.com/bervinleonardy>Blaxtech</a> ';
	var mopt = {
				url: 'https://api.mapbox.com/styles/v1/mapbox/streets-v9/tiles/256/{z}/{x}/{y}?access_token=pk.eyJ1IjoiYmVydmlubGVvbmFyZHkiLCJhIjoiY2pqNDgxYjNjMWcxYTNvbnd1Y3lheWd1ZSJ9.0ULezPS8a9o8cC0e5kIIRQ',
				options: {attribution:'© <a href="https://www.mapbox.com/map-feedback/">Mapbox</a>| develop by <a href=https://github.com/bervinleonardy>Blaxtech</a>'}};
	var osm = L.tileLayer("http://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png",{attribution:osmDataAttr});

	var mq = L.tileLayer(mopt.url,mopt.options);
	var googleDataAttr = '<a href="https://www.google.com/maps/">Google</a> develop by <a href=https://github.com/bervinleonardy>Blaxtech</a>';
	var google = L.tileLayer('http://www.google.cn/maps/vt?lyrs=s@189&gl=cn&x={x}&y={y}&z={z}',{attribution:googleDataAttr });
	google.addTo(map);
	var baseMaps = {"Google Maps": google,"Mapbox Streets": mq,"Open Street Map":osm};

	new L.Control.Fullscreen({ position: 'topright' }).addTo(map);
	var updateMarker;
	
	$.ajax({
		type : "GET",	
		dataType: "json",
		url: "ajaxpeta_lokasi(develop).php",		
		success: function(v){
			for(i in v){
				if (v[i].latitude != '' && v[i].longitude != ''){
				updateMarker(v[i].id, v[i].latitude, v[i].longitude);
					console.log("JSON LOKASI SUKSES : " + v[i].latitude, v[i].longitude);
				}

			}
		},
		error: function(xhr, status, error) {
			alert("An AJAX error occured: " + status + "\nError: " + error);
			var err = status + ", " + error;
			console.log( "Request Failed Data Lokasi: " + err );				
		}			
	});	
   function updateMarker(latitude, longitude){	
	//Geser Marker
	  var marker = new L.marker([-6.883389,107.551268], {
		draggable: 'true'
	  }).addTo(map);	
	
	  marker.on('dragend', function(event) {
		var position = marker.getLatLng();
		marker.setLatLng(position, {
		  draggable: 'true'
		}).bindPopup(position).update();
		$("#lat").val(position.lat);
		$("#lng").val(position.lng).keyup();
	  });

	  $("#lat, #lng").change(function() {
		var position = [parseInt($("#lat").val()), parseInt($("#lng").val())];
		marker.setLatLng(position, {
		  draggable: 'true'
		}).bindPopup(position).update();
		map.panTo(position);
	  });

	  map.addLayer(marker);	
    }
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
				var geojsonLayer = new L.geoJson(response_sekunder, {
				onEachFeature: onEachFeature ,style : style_pipa}).addTo(sekunder);
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
				var geojsonLayer = new L.geoJson(response_tersier, {
				onEachFeature: onEachFeature ,style : style_pipa}).addTo(tersier);
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
				var geojsonLayer = new L.geoJson(response_retikulasi, {
				onEachFeature: onEachFeature ,style : style_pipa}).addTo(pretikulasi);
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
				var geojsonLayer = new L.geoJSON(response, {
				onEachFeature: onEachFeature ,style : style_pipa}).addTo(pdinas);
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
		"Pipa Retikulasi":pretikulasi,
		"Pipa Dinas": pdinas	
		}		
		new L.control.layers(baseMaps,overlays,{position: 'bottomleft'}).addTo(map);

		var legend = L.control({position: 'bottomright'});

		legend.onAdd = function (map) {

        var div = L.DomUtil.create("div", "legend");
        div.innerHTML += "<h4>Legenda</h4>";
        div.innerHTML += '<i style="background: #ff8000"></i><span>Pipa Sekunder</span><br>';
        div.innerHTML += '<i style="background: #00ff00"></i><span>Pipa Tersier</span><br>';				
        div.innerHTML += '<i style="background: #0065ca"></i><span>Pipa Retikulasi</span><br>';
        div.innerHTML += '<i style="background: #00e6e6"></i><span>Pipa Dinas</span><br>';	
        div.innerHTML += '<i class="fa fa-map-marker" style="color: black" aria-hidden="true"></i><span>Marker</span><br>';
        return div;
		};
		legend.addTo(map);
        setTimeout(function(){ map.invalidateSize()}, 100);
});