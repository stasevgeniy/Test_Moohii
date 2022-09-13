var last_id_marker = 0;
var map;

function initMap() {

    var uluru = { lat: 50.4546600, lng: 30.5238000 };
    map = new google.maps.Map(document.getElementById("map"), {
      zoom: 5,
      center: uluru,
    });

    console.log(actual_markers);
    AddMarkers(actual_markers);

    timerActual();
    searchActualMarkers();
  }

  function AddMarkers(markers) {
    var i=0;

    var clone_markers = markers.slice(0);

    for(; i<clone_markers.length;i++) {
      var ul = { lat: Number(clone_markers[i]["lat"]), lng: Number(clone_markers[i]["lng"]) };
      clone_markers[i]["marker_object"] = new google.maps.Marker({
        position: ul,
        map: map,
      });
      actual_markers.push(clone_markers[i]);
    }

    if(i>0) {
      map.setCenter({lat: Number(clone_markers[i-1]["lat"]), lng: Number(clone_markers[i-1]["lng"])});
      last_id_marker = clone_markers[i-1]["id"];
    }

  }

  function timerActual() {
    for(var i = 0; i<actual_markers.length;i++) {
      actual_markers[i]["server_time"]++;
      if(actual_markers[i]["server_time"] >= actual_markers[i]["actual_time"]) {
        actual_markers[i]["marker_object"].setMap(null);
        actual_markers.splice(i, 1);
      }
    }
    setTimeout(timerActual, 1000);
  }

  function searchActualMarkers() { // If service has many users use WebSockets

    $.ajax({
      type: "GET",
      url: "/updateMarkers",
      data: {
          "last_id_marker": last_id_marker
      },
      success: function (data) {
        if(data){
          AddMarkers(data);
        }
      },
      error: function (data) {
          alert("Error server");
      }
    });

    setTimeout(searchActualMarkers, 1500);

  }
  
  window.initMap = initMap;