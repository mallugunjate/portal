<!-- Mainly scripts -->
<script src="/js/env.js"></script>
<script src="/js/jquery-2.1.1.min.js"></script>
<script src="/js/custom/admin/global/bannerSelector.js"></script>
<script src="/js/bootstrap.min.js"></script>
<script src="/js/plugins/metisMenu/jquery.metisMenu.js"></script>
<script src="/js/plugins/slimscroll/jquery.slimscroll.min.js"></script>

<!-- Flot -->
{{-- <script src="/js/plugins/flot/jquery.flot.js"></script>
<script src="/js/plugins/flot/jquery.flot.tooltip.min.js"></script>
<script src="/js/plugins/flot/jquery.flot.spline.js"></script>
<script src="/js/plugins/flot/jquery.flot.resize.js"></script>
<script src="/js/plugins/flot/jquery.flot.pie.js"></script>
<script src="/js/plugins/flot/jquery.flot.symbol.js"></script>
<script src="/js/plugins/flot/curvedLines.js"></script> --}}

<!-- Peity -->
{{-- <script src="/js/plugins/peity/jquery.peity.min.js"></script>
<script src="/js/demo/peity-demo.js"></script> --}}

<!-- Custom and plugin javascript -->
<script src="/js/inspinia.js"></script>
<script src="/js/plugins/pace/pace.min.js"></script>

<!-- jQuery UI -->
<script src="/js/plugins/jquery-ui/jquery-ui.min.js"></script>

<!-- Jvectormap -->
{{-- <script src="/js/plugins/jvectormap/jquery-jvectormap-2.0.2.min.js"></script>
<script src="/js/plugins/jvectormap/jquery-jvectormap-world-mill-en.js"></script> --}}

<!-- Sparkline -->
{{-- <script src="/js/plugins/sparkline/jquery.sparkline.min.js"></script> --}}

<!-- Sparkline demo data  -->
{{-- <script src="/js/demo/sparkline-demo.js"></script> --}}

<!-- ChartJS-->
{{-- <script src="/js/plugins/chartJs/Chart.min.js"></script> --}}

<script src="/js/plugins/sweetalert/sweetalert.min.js"></script>

<!-- date range picker -->
<script src="/js/vendor/moment.js"></script>
<!-- <script src="/js/plugins/datapicker/bootstrap-datepicker.js"></script> -->
<script src="/js/vendor/bootstrap-datetimepicker.min.js"></script>
<script src="/js/custom/sendBugReportAdmin.js"></script>

<!-- editor -->
{{-- <script src="/js/plugins/summernote/summernote.min.js"></script> --}}

<script type="text/javascript">
	$('.datetimepicker-start').datetimepicker({
        format: 'YYYY-MM-DD HH:mm:ss'
    });
    $('.datetimepicker-end').datetimepicker({
        format: 'YYYY-MM-DD HH:mm:ss',
        useCurrent: false 
    });
     $(".datetimepicker-start").on("dp.change", function (e) {
        $('.datetimepicker-end').data("DateTimePicker").minDate(e.date);
    });
    $(".datetimepicker-end").on("dp.change", function (e) {
        $('.datetimepicker-start').data("DateTimePicker").maxDate(e.date);
    });
    $(".datetimepicker-start").data('DateTimePicker').defaultDate(new Date());
</script>