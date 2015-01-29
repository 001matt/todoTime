<hr>
</main> <!-- /container -->
<footer class="container">
    <p>© Company 2014</p>
</footer>


<!--<script src="//ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>
<script>window.jQuery || document.write('<script src="js/vendor/jquery-1.8.3.min.js"><\/script>')</script>-->



<script type="text/javascript" src="js/vendor/jquery-2.1.3.min.js"></script>
<script src="js/vendor/bootstrap.min.js"></script>
<script src="js/vendor/bootstrap-timepicker.min.js"></script>
<script src="js/listUser.js"></script>
<script src="js/plugins.js"></script>
<script src="js/main.js"></script>
<script src="//code.jquery.com/ui/1.11.2/jquery-ui.js"></script>
<script>
    jQuery(function($){
        $('.datepicker').datepicker({
            dateFormat : 'dd/mm/yy',
            minDate : 0
        });
        $('.timepicker2').timepicker({
            minuteStep: 1,
            template: 'modal',
            appendWidgetTo: 'body',
            showSeconds: true,
            showMeridian: false,
            defaultTime: false
        });
        $("#pop").popover();
    });
</script>
</body>
</html>