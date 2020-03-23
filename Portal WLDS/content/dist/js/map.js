// JavaScript Document
var a = 0; 
function menuClick(id){
	var name = id.id;
	$('.menu ul li a.active').removeClass('active');
	$('.menu ul li a#'+name).addClass('active');

	if(a<=name){
		$('.'+a).hide();
	} a++;

};
new wax.tilejson('http://a.tiles.mapbox.com/v3/shre.map-ime6dajf.jsonp',
function(tilejson) {
	var map = L.map('mapwlds',{ zoomControl: true ,gestureHandling: true}).setView([-6.884172,107.550585],11.5);
	var osmDataAttr = 'Map data &copy; <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors | develop by <a href="https://github.com/bervinleonardy">Blaxtech</a> ';
	var mopt = {
				url: 'https://api.mapbox.com/styles/v1/mapbox/streets-v9/tiles/256/{z}/{x}/{y}?access_token=pk.eyJ1IjoiYmVydmlubGVvbmFyZHkiLCJhIjoiY2pqNDgxYjNjMWcxYTNvbnd1Y3lheWd1ZSJ9.0ULezPS8a9o8cC0e5kIIRQ',
				options: {attribution:'© <a href="https://www.mapbox.com/map-feedback/">Mapbox</a>| develop by <a href=https://github.com/bervinleonardy/">Blaxtech</a>'}
			  };
	var osm = L.tileLayer("http://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png",				
							{attribution:osmDataAttr});

	var mq=L.tileLayer(mopt.url,mopt.options);
	var googleDataAttr = '<a href="https://www.google.com/maps/">Google</a>';
	var google = L.tileLayer('http://www.google.cn/maps/vt?lyrs=s@189&gl=cn&x={x}&y={y}&z={z}',{attribution:googleDataAttr });
	  google.addTo(map);

	  var baseMaps = {
		  "Google Maps": google,
		  "Mapbox Streets": mq,
		  "Open Street Map":osm
	  };


//	   		      map.scrollWheelZoom.disable();
		new L.Control.Fullscreen({ position: 'topright' }).addTo(map);
//			new L.control.scale({ position: 'topright' }).addTo(map);
//            new L.Control.Zoom({ position: 'bottomleft' }).addTo(map);


	var marker;
	function getAllMarker(){
		var urls = 'ajaxpeta.php';
		jQuery.ajax({type: 'GET', url: urls, dataType: 'json',
			success: function(v){
				for(i in v){
					if (v[i].lnt != '' && v[i].lng != ''){

					//printMarker(v[i].id,v[i].nama,v[i].lnt,v[i].lng,v[i].luas);
					updateMarkerStatus(v[i].id, v[i].nama, v[i].pengurus, v[i].lnt, v[i].lng, v[i].benkop, v[i].jenkop,v[i].kelkop, v[i].sktr, v[i].almt, v[i].kel,  v[i].gam);
					}
				}
			}
		});
	}
	var datakop = new L.LayerGroup();
	function updateMarkerStatus(id,nama,pengurus,lnt,lng,benkop,jenkop,kelkop,sktr,almt,kel,eml,gam){

		var html = '<div ><div class="img" onclick="overlay2('+id+')"> \
		<img src="" alt="" /> \
		</div> \
			<span  title="Nama Koperasi">'+nama+'</span>\
			<div >\
				<div >\
					<label title="Pengurus Koperasi">Pengurus</label>\
					<div >'+pengurus+'</div>\
					<div ></div>\
				</div>\
				<div c>\
					<label title="Bentuk Koperasi">Bentuk Koperasi</label>\
					<div >'+benkop+'</div>\
					<div ></div>\
				</div>\
				<div >\
					<label title="Jenis Koperasi">Jenis Koperasi</label>\
					<div >'+jenkop+'</div>\
					<div ></div>\
				</div>\
				<div>\
					<label title="Kelompok Koperasi">Kelompok Koperasi</label>\
					<div >'+kelkop+'</div>\
					<div ></div>\
				</div>\
				<div >\
					<label title="Sektor Usaha">Sektor Usaha</label>\
					<div >'+sktr+'</div>\
					<div ></div>\
				</div>\
				<div >\
					<label title="Alamat">Alamat</label>\
					<div >'+almt+' Kel '+kel+'</div>\
					<div ></div>\
				</div>\
				<div>\
					<label title="Gambar">Gambar</label>\
					<h5>&nbsp;</h5>\
					<img alt="" class="img-thumbnail" src="content/images/koperasi/'+gam+'" width="145px" height="145px" /> \
					<img alt="" class="img-thumbnail" src="content/images/koperasi/'+gam+'" width="145px" height="145px" /> \
					<h5>&nbsp;</h5>\
					<img alt="" class="img-thumbnail" src="content/images/koperasi/'+gam+'" width="95px" height="95px" /> \
					<img alt="" class="img-thumbnail" src="content/images/koperasi/'+gam+'" width="95px" height="95px" /> \
					<img alt="" class="img-thumbnail" src="content/images/koperasi/'+gam+'" width="95px" height="95px" /> \
					<div ></div>\
				</div>\
			</div>\
			<div ></div> \
		</div>';

		var myIcon = new L.icon({ 
			iconUrl: 'maps/images/marker-icon1.png',
			iconSize: [27, 39],
			iconAnchor: [13, 38],
			popupAnchor: [0, 0],
			shadowUrl: 'maps/images/marker-shadow.png',
			shadowSize: [41, 41],
			shadowAnchor: [13, 38]
		});
		var datakoperasi = new L.marker([lnt, lng], {icon: myIcon, bounceOnAdd: true}, ).bindPopup(html).addTo(datakop);
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
			if (feature.properties && feature.properties.nama_kelurahan) {				
			layer.bindPopup(feature.properties.nama_kelurahan);
			}
			if (feature.properties && feature.properties.nama_kota) {				
			layer.bindPopup(feature.properties.nama_kota);
			}				
		}		
		function style(features) {
			return {
				fillColor: fills(features.properties.fill),
				weight: 2,
				opacity: 1,
				color: 'white',
				dashArray: '3',
				fillOpacity: 0.5
			};
		}	
		var cimahi = new L.geoJson(cimahi,{style: style,onEachFeature:onEachFeature}).addTo(map);
		var kecamatan = new L.LayerGroup();
		var kelurahan = new L.LayerGroup();

		var GEOkecamatan = new L.geoJson(GEOkecamatan,{style: style,onEachFeature:onEachFeature}).addTo(kecamatan);
		var GEOkelurahan = new L.geoJson(GEOkelurahan,{style: style,onEachFeature:onEachFeature}).addTo(kelurahan);		
//update get function error xhr , status, error and also run with jQuery 2.xx		
		$.ajax({
		dataType: "json",
		url: "maps/GeoJSON/cimahi.geojson",

		success: function(data) {
			$(data.features).each(function(key, data) {
				cimahi.addData(data);
			});
		},
		error: function(xhr, status, error) {
			alert("An AJAX error occured: " + status + "\nError: " + error);
		}					
		});

		$.ajax({
		dataType: "json",
		url: "maps/GeoJSON/kecamatan/cimahi_tengah.geojson",				

		success: function(data) {
			$(data.features).each(function(key, data) {						
				GEOkecamatan.addData(data);
			});
		},
		error: function(xhr, status, error) {
			alert("An AJAX error occured: " + status + "\nError: " + error);
		}			
		});	

		$.ajax({
		dataType: "json",
		url: "maps/GeoJSON/kelurahan/cigugur_tengah.geojson",				

		success: function(data) {
			$(data.features).each(function(key, data) {						
				GEOkelurahan.addData(data);
			});
		},
		error: function(xhr, status, error) {
			alert("An AJAX error occured: " + status + "\nError: " + error);
		}			
		});		



		var overlays={
		"Kota":cimahi,
		"Kecamatan":kecamatan,
		"Kelurahan":kelurahan	
//		"Koperasi" : datakop	
		}		
		var lc=L.control.layers(baseMaps,overlays,{position: 'bottomleft'});
		lc.addTo(map);	

		var legend = L.control({position: 'bottomright'});

		legend.onAdd = function (map) {

		  var div = L.DomUtil.create("div", "legend");
		  div.innerHTML += "<h4>Legenda</h4>";
		  div.innerHTML += '<i style="background: #477AC2"></i><span>Kota</span><br>';	
		  div.innerHTML += '<i style="background: #477AC2"></i><span>Kecamatan</span><br>';
		  div.innerHTML += '<i style="background: #477AC2"></i><span>Kelurahan</span><br>';
		  div.innerHTML += '<i style="background: #477AC2"></i><span>Pipa Retikulasi</span><br>';
		  div.innerHTML += '<i style="background: #477AC2"></i><span>Pipa Dinas</span><br>';	
//			  div.innerHTML += '<i style="background: #448D40"></i><span>Forest</span><br>';
//			  div.innerHTML += '<i style="background: #E6E696"></i><span>Land</span><br>';
//			  div.innerHTML += '<i style="background: #E8E6E0"></i><span>Residential</span><br>';
//			  div.innerHTML += '<i style="background: #FFFFFF"></i><span>Ice</span><br>';
//			  div.innerHTML += '<i class="icon" style="background-image: url(https://d30y9cdsu7xlg0.cloudfront.net/png/194515-200.png);background-repeat: no-repeat;"></i><span>Grænse</span><br>';



		  return div;
		};
		legend.addTo(map);		
});