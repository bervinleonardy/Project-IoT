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
    new wax.tilejson('http://tileserver.maptiler.com/nasa.jsonp',
    function(tilejson) {
		var map = L.map('mapwlds',{ zoomControl: true ,gestureHandling: true}).setView([-6.884172,107.550585],11.5);
		map.invalidateSize();
		var osmDataAttr = 'Map data &copy; <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors | develop by <a href=https://github.com/bervinleonardy>Blaxtech</a> ';
	    var mopt = {
		  			url: 'https://api.mapbox.com/styles/v1/mapbox/streets-v9/tiles/256/{z}/{x}/{y}?access_token=pk.eyJ1IjoiYmVydmlubGVvbmFyZHkiLCJhIjoiY2pqNDgxYjNjMWcxYTNvbnd1Y3lheWd1ZSJ9.0ULezPS8a9o8cC0e5kIIRQ',
		  			options: {attribution:'© <a href="https://www.mapbox.com/map-feedback/">Mapbox</a>| develop by <a href=https://github.com/bervinleonardy>Blaxtech</a>'}
				  };
		var osm = L.tileLayer("http://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png",				
								{attribution:osmDataAttr});
		
		var mq=L.tileLayer(mopt.url,mopt.options);
		var googleDataAttr = '<a href="https://www.google.com/maps/">Google</a> develop by <a href=https://github.com/bervinleonardy>Blaxtech</a>';
        var google = L.tileLayer('http://www.google.cn/maps/vt?lyrs=s@189&gl=cn&x={x}&y={y}&z={z}',{attribution:googleDataAttr });
		  google.addTo(map);
		new L.Control.Fullscreen({ position: 'topright' }).addTo(map);
		var baseMaps = {
			"Google Maps": google,
			"Mapbox Streets": mq,
			"Open Street Map":osm
		};
		var editableLayers = new L.FeatureGroup();
		map.addLayer(editableLayers);	
		
		var MyCustomMarker = L.Icon.extend({
			options: {
					iconUrl: 'maps/images/reservoir.png',
					iconSize: [32, 32],
					iconAnchor: [13, 38],
					popupAnchor: [0, 0],
					shadowUrl: 'maps/images/marker-shadow.png',
					shadowSize: [41, 41],
					shadowAnchor: [13, 38]
			}
		});
			
		
//	   		      map.scrollWheelZoom.disable();
//			new L.control.scale({ position: 'topright' }).addTo(map);
//            new L.Control.Zoom({ position: 'bottomleft' }).addTo(map);
		var deskReservoir = '<div class="card card-success"> \
              <div class="card-header">\
                <h3 class="card-title" title="Reservoir">Reservoir</h3>\
              </div>\
              <div class="card-body">\
						<div >Kapasitas : 50.000 Liter</div>\
						<div >Tekanan Air Reservoir : PSi</div>\
						<div >Status Reservoir : </div>\
              </div>\
				<div></div> \
			</div>';
		
		var IconReservoir = new L.icon({ 
			iconUrl: 'maps/images/reservoir.png',
			iconSize: [32, 32],
			iconAnchor: [13, 38],
			popupAnchor: [0, 0],
			shadowUrl: 'maps/images/marker-shadow.png',
			shadowSize: [41, 41],
			shadowAnchor: [13, 38]
		});			
		var reservoir = new L.marker([-6.86936635454, 107.55469228300],{icon: IconReservoir}).bindPopup(deskReservoir).addTo(map);
		
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
		var peringatan = new L.LayerGroup();

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
				// does this feature have a property named popupContent?
				if (feature.properties && feature.properties.nama_kecamatan ) {
					layer.bindPopup(feature.properties.nama_kecamatan);
				}
				else if (feature.properties && feature.properties.nama_kelurahan) {				
						layer.bindPopup(feature.properties.nama_kelurahan);
				}
				else if (feature.properties && feature.properties.nama_kota) {				
						layer.bindPopup(feature.properties.nama_kota);
				}
				else if (feature.properties && feature.properties.nama_pipa) {	
						console.log("lat long: " + feature.geometry.coordinates);
				 		layer.bindPopup(feature.properties.nama_pipa);
					
				}				 
			}		
			
			function style(features) {
				return {
					fillColor: fills(features.properties.fill),
					stroke:false,
					weight: 2,
					opacity: 1,
//					color: 'white',
					dashArray: '3',
					fillOpacity: 0.5
				};
			}
			function style_pipa(features) {
				return {
					color: fills(features.properties.fill),
					stroke:true,
					weight: 2,
					opacity: 1,
					dashArray: '3'
				};
			}		
			var cimahi 		 = new L.geoJson(cimahi,{style: style,onEachFeature:onEachFeature});
			var kecamatan 	 = new L.LayerGroup();
			var kelurahan 	 = new L.LayerGroup();
			var pretikulasi	 = new L.LayerGroup();
			var pdinas		 = new L.LayerGroup();
		
		    var GEOkecamatan 	= new L.geoJson(GEOkecamatan,{style: style,onEachFeature:onEachFeature}).addTo(kecamatan);
		    var GEOkelurahan 	= new L.geoJson(GEOkelurahan,{style: style,onEachFeature:onEachFeature}).addTo(kelurahan);		
			var GEOpretikulasi  = new L.geoJson(GEOpretikulasi,{style: style_pipa,onEachFeature:onEachFeature}).addTo(pretikulasi);
		    var GEOpdinas 		= new L.geoJson(GEOpdinas,{style: style_pipa,onEachFeature:onEachFeature }).addTo(pdinas);
			//update get function error xhr , status, error and also run with jQuery 2.xx	

		
			$.ajax({
			dataType: "json",
			url: "https://raw.githubusercontent.com/bervinleonardy/Project-IoT/master/GEOJSON_PIPA%2BKOTA/kota_cimahi.geojson",
			success: function(data) {
				$(data.features).each(function(key, data) {
					cimahi.addData(data);
					console.log("JSON Data Kota Cimahi: " + data);
				});
			},
		    error: function(xhr, status, error) {
			    alert("An AJAX error occured: " + status + "\nError: " + error);
				var err = status + ", " + error;
				console.log( "Request Failed Kota Cimahi: " + err );				
		    }					
			});
		
			$.ajax({
			dataType: "json",
			url: "https://raw.githubusercontent.com/bervinleonardy/Project-IoT/master/GEOJSON_PIPA%2BKOTA/kecamatan/cimahi_tengah.geojson",				
				
			success: function(data) {
				$(data.features).each(function(key, data) {						
					GEOkecamatan.addData(data);
					console.log("JSON Data Kecamatan: " + data);
				});
			},
		    error: function(xhr, status, error) {
			    alert("An AJAX error occured: " + status + "\nError: " + error);
				var err = status + ", " + error;
				console.log( "Request Failed Data Kecamatan: " + err );				
		    }			
			});	
		
			$.ajax({
			dataType: "json",
			url: "https://raw.githubusercontent.com/bervinleonardy/Project-IoT/master/GEOJSON_PIPA%2BKOTA/kelurahan/cigugur_tengah.geojson",				
				
			success: function(data) {
				$(data.features).each(function(key, data) {						
					GEOkelurahan.addData(data);
					console.log("JSON Data Kelurahan: " + data);
				});
			},
		    error: function(xhr, status, error) {
			    alert("An AJAX error occured: " + status + "\nError: " + error);
				var err = status + ", " + error;
				console.log( "Request Failed Data Kelurahan: " + err );				
		    }			
			});	
		
			$.ajax({
			dataType: "json",
			url: "https://raw.githubusercontent.com/bervinleonardy/Project-IoT/master/GEOJSON_PIPA%2BKOTA/retikulasi.geojson",
			success: function(data) {
				$(data.features).each(function(key, data) {						
					GEOpretikulasi.addData(data);
					console.log("JSON Data Pipa Retikulasi: " + data);
				});
			},
		    error: function(xhr, status, error) {
			    alert("An AJAX error occured: " + status + "\nError: " + error);
				var err = status + ", " + error;
				console.log( "Request Failed Data Pipa Retikulasi: " + err );				
		    }			
			});	
		
		
			$.ajax({
			dataType: "json",
			url: "https://raw.githubusercontent.com/bervinleonardy/Project-IoT/master/GEOJSON_PIPA%2BKOTA/pdinas.geojson",	
			success: function(data) {
				$(data.features).each(function(key, data) {						
					GEOpdinas.addData(data);
					console.log("JSON Data Pipa Dinas: " + data);
				});
			},
		    error: function(xhr, status, error) {
			    alert("An AJAX error occured: " + status + "\nError: " + error);
				var err = status + ", " + error;
				console.log( "Request Failed Pipa Dinas: " + err );				
		    }			
			});	

		
			var overlays={
			"Kota":cimahi,
			"Kecamatan":kecamatan,
			"Kelurahan":kelurahan,	
			"Pipa Retikulasi":pretikulasi,
		    "Pipa Dinas": pdinas,
			"Peringatan" : peringatan
			}		
			var lc=L.control.layers(baseMaps,overlays,{position: 'bottomleft'});
			lc.addTo(map);	
		
			var legend = L.control({position: 'bottomright'});

			legend.onAdd = function (map) {

			  var div = L.DomUtil.create("div", "legend");
			  div.innerHTML += "<h4>Legenda</h4>";
			  div.innerHTML += '<i style="background: #0e1ee2"></i><span>Kota</span><br>';	
			  div.innerHTML += '<i style="background: #80ff80"></i><span>Kecamatan</span><br>';
			  div.innerHTML += '<i style="background: #942916"></i><span>Kelurahan</span><br>';
			  div.innerHTML += '<i style="background: #0065ca"></i><span>Pipa Retikulasi</span><br>';
			  div.innerHTML += '<i style="background: #00e6e6"></i><span>Pipa Dinas</span><br>';	
			  div.innerHTML += '<i class="icon" style="background-image: url(maps/images/reservoir.png);background-repeat: no-repeat;"></i><span>Reservoir</span><br>';				
//			  div.innerHTML += '<i style="background: #448D40"></i><span>Forest</span><br>';
//			  div.innerHTML += '<i style="background: #E6E696"></i><span>Land</span><br>';
//			  div.innerHTML += '<i style="background: #E8E6E0"></i><span>Residential</span><br>';
//			  div.innerHTML += '<i style="background: #FFFFFF"></i><span>Ice</span><br>';
//			  div.innerHTML += '<i class="icon" style="background-image: url(https://d30y9cdsu7xlg0.cloudfront.net/png/194515-200.png);background-repeat: no-repeat;"></i><span>Grænse</span><br>';



			  return div;
			};
			legend.addTo(map);		
    });
	
</script>	
<!--<div id="mapwlds" style="height:300px; width:100%; "></div>-->
