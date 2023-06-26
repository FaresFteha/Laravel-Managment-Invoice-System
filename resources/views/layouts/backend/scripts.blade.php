<script src="{{ asset('asset/backend/src/js/jq.js') }}"></script>
<script src="{{ asset('asset/backend/src/js/plugins-jquery.js') }}"></script>
<script src="{{ asset('asset/backend/src/vendors/popper/popper.min.js') }}"></script>
<script src="{{ asset('asset/backend/src/vendors/anchorjs/anchor.min.js') }}"></script>
<script src="{{ asset('asset/backend/src/vendors/is/is.min.js') }}"></script>
<script src="{{ asset('asset/backend/src/vendors/chart/chart.min.js') }}"></script>
<script src="{{ asset('asset/backend/src/vendors/leaflet/leaflet.js') }}"></script>
<script src="{{ asset('asset/backend/src/vendors/leaflet.markercluster/leaflet.markercluster.js') }}"></script>
<script
    src="{{ asset('asset/backend/src/vendors/leaflet.tilelayer.colorfilter/leaflet-tilelayer-colorfilter.min.js') }}">
</script>
<script src="{{ asset('asset/backend/src/vendors/countup/countUp.umd.js') }}"></script>
<script src="{{ asset('asset/backend/src/vendors/echarts/echarts.min.js') }}"></script>
<script src="{{ asset('asset/backend/src/vendors/vendors/fullcalendar/main.min.js') }}"></script>
<script src="{{ asset('asset/backend/src/js/flatpickr.js') }}"></script>
<script src="{{ asset('asset/backend/src/vendors/vendors/dayjs/dayjs.min.js') }}"></script>
<script src="{{ asset('asset/backend/src/vendors/fontawesome/all.min.js') }}"></script>
<script src="{{ asset('asset/backend/src/vendors/lodash/lodash.min.js') }}"></script>
<script src="https://polyfill.io/v3/polyfill.min.js?features=window.scroll"></script>
<script src="{{ asset('asset/backend/src/vendors/list.js/list.min.js') }}"></script>
<script src="{{ asset('asset/backend/src/js/theme.js') }}"></script>
<script src="{{ asset('asset/backend/src/vendors/choices/choices.min.js') }}"></script>
<script src="{{ asset('asset/backend/src/vendors/prism/prism.js') }}"></script>
<script src="{{ asset('asset/backend/src/vendors/choices/choices.min.js') }}"></script>
<script src="{{ asset('asset/backend/src/js_style/js-backend.js') }}"></script>

@yield('js')
<script>
    const userId = "{{ Auth::id() }}";
</script>
@vite(['resources/js/app.js'])