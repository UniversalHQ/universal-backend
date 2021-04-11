<template>
  <l-map style="height: 880px; width: 100%"
         :zoom="zoom"
         :center="center"
         :maxBounds="maxBounds"
         :crs="crs"
         :maxBoundsViscosity="1"
         :bounceAtZoomLimits="true"
         :options="{zoomDelta:0.5, zoomSnap:0.5, minZoom:0.5, maxZoom:7.5}"
  >
    <l-image-overlay
      :pane="'tilePane'"
      :url="backgroundImage"
      :bounds="backgroundBounds"
    >
    </l-image-overlay>
    <l-tile-layer
      :url="url"
      :noWrap="noWrap"
      :bounds="bounds"
      :options="{maxNativeZoom:5}"
    ></l-tile-layer>
    <l-geo-json
      :geojson="hexes"
      :optionsStyle="styleHexGrid"
    >
    </l-geo-json>
  </l-map>
</template>

<script>

import { CRS } from 'leaflet';
import {
  LMap,
  LTileLayer,
  LImageOverlay,
  LGeoJson,
} from 'vue2-leaflet';
import hexes from '../hex.geojson';

export default {
  name: 'Map',
  components: {
    LMap,
    LTileLayer,
    LImageOverlay,
    LGeoJson,
  },
  data() {
    return {
      url: 'https://raw.githubusercontent.com/Kastow/Foxhole-Map-Tiles/master/Tiles/{z}/{z}_{x}_{y}.png',
      backgroundImage: 'https://cdn.glitch.com/84b19724-a86b-4caa-8e69-1e9c973e043f%2Fdd3f06b2-b7d4-4ccchhhh5_WorldMapBG.jpg?v=1565481206934',
      backgroundBounds: [[-349.538, -265.846], [93.538, 521.846]],
      zoom: 1,
      center: [-128, 128],
      crs: CRS.Simple,
      noWrap: true,
      bounds: [[-128, 0], [0, 128]],
      maxBounds: [[90.5, 590], [-349, -320]],
      attribution: 'Clapfoot, Kastow, Blade, Derp',
      hexes,
    };
  },
  mounted() {
  },
  methods: {
    styleHexGrid() {
      return {
        color: 'black',
        fillColor: 'none',
      };
    },
  },
};

</script>
