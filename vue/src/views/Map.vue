<template>
  <l-map
    style="height: 880px; width: 100%"
    :zoom="zoom"
    :center="center"
    :crs="crs"
    :bound="bounds"
    :maxBounds="maxBounds"
    :options="{
      zoomDelta: 0.5,
      zoomSnap: 0.5,
      minZoom: 1,
      maxZoom: 5,
    }"
    :noWrap="noWrap"
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
      :crs="crs"
      :options="{
        maxNativeZoom: 5,
        bounds: bounds,
      }"
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
      attribution: 'Clapfoot, Kastow, Blade, Derp',
      backgroundBounds: [
        [-349.538, -265.846],
        [93.538, 521.846],
      ],
      backgroundImage:
        'https://cdn.glitch.com/84b19724-a86b-4caa-8e69-1e9c973e043f%2Fdd3f06b2-b7d4-4ccchhhh5_WorldMapBG.jpg?v=1565481206934',
      bounds: [
        [-256, 0],
        [0, 256],
      ],
      center: [0, 0],
      crs: CRS.Simple,
      maxBounds: [
        [-256, 0],
        [0, 256],
      ],
      noWrap: true,
      hexes,
      url:
        'https://raw.githubusercontent.com/Kastow/Foxhole-Map-Tiles/master/Tiles/{z}/{z}_{x}_{y}.png',
      zoom: 1,
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
