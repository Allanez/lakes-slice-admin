<template>

  <div style="height: 600px; width: 100%">
    <div style="height: 100px; overflow: auto;">
     
<!--      <p>First marker is placed at {{ withPopup.lat }}, {{ withPopup.lng }}</p>
-->    
      <p>Center is at {{ currentCenter }} and the zoom is: {{ currentZoom }}</p>
     
      <button @click="showLongText">
        Toggle long popup
      </button>
      <button @click="showMap = !showMap">
        Toggle map
      </button>
    </div>
    <l-map
      v-if="showMap"
      :zoom="zoom"
      :center="center"
      :options="mapOptions"
      style="height: 80%"
      @update:center="centerUpdate"
      @update:zoom="zoomUpdate"
    >
      <l-tile-layer
        :url="url"
        :attribution="attribution"
      />

      <l-marker :lat-lng="withPopup">
        <l-icon
          :icon-anchor="staticAnchor"
          class-name="customIcon">

          <l-popup>
            <div @click="innerClick">
              click here to subscribe
              <p v-show="showParagraph">
                center of ph
              </p>
            </div>
          </l-popup>
        </l-icon>
      </l-marker>
      <l-marker :lat-lng="withTooltip">

        <l-icon
          :icon-size="dynamicSize"
          :icon-anchor="dynamicAnchor"
          :icon="icon"
        />

          <l-tooltip :options="{ permanent: true, interactive: true }">
            <div @click="innerClick">
              Tooltip ini hehe
              <p v-show="showParagraph">
                tooltip ini hiya hehe
              </p>
            </div>
          </l-tooltip>

      </l-marker>
    </l-map>
  </div>
</template>

<script>
import { latLng, icon } from "leaflet";
import { LMap, LTileLayer, LMarker, LPopup, LTooltip, LIcon } from "vue2-leaflet";

export default {
  name: "Example",
  components: {
    LMap,
    LTileLayer,
    LMarker,
    LPopup,
    LTooltip,
    LIcon
  },
  data() {
    return {
      zoom: 5,
      center: latLng(12.554564, 123.442383),
      url: 'https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png',
      attribution:
        '&copy; <a href="http://osm.org/copyright">OpenStreetMap</a> contributors',

      icon: icon({
        iconUrl: "slice_fe/public/img/marker.png",
        iconSize: [32, 37],
        iconAnchor: [16, 37]
      }),
      staticAnchor: [16, 37],

      iconSize: 35,

      withPopup: latLng(12.8797, 121.7740),
      withTooltip: latLng(11.0708, 124.6953),
      currentZoom: 5,
      currentCenter: latLng(12.554564, 123.442383),
      showParagraph: false,
      mapOptions: {
        zoomSnap: 0.5
      },
      showMap: true
    };
  },

  computed: {
    dynamicSize() {
      return [this.iconSize, this.iconSize * 1.15];
    },
    dynamicAnchor() {
      return [this.iconSize / 2, this.iconSize * 1.15];
    }
  },

  methods: {
    zoomUpdate(zoom) {
      this.currentZoom = zoom;
    },
    centerUpdate(center) {
      this.currentCenter = center;
    },
    showLongText() {
      this.showParagraph = !this.showParagraph;
    },
    innerClick() {
      alert("Lake Danao ini");
    }
  }
};
</script>

<style>
  .customIcon {
    background-color: rgb(148, 255, 193);
    padding: 10px;
    border: 1px solid #333;
    border-radius: 0 20px 20px 20px;
    box-shadow: 5px 3px 10px rgba(0, 0, 0, 0.2);
    text-align: center;
    width: auto !important;
    height: auto !important;
    margin: 0 !important;
  }
</style>
