<!-- Javascripts -->
        <script src="assets/plugins/jquery/jquery-3.1.0.min.js"></script>
        <script src="assets/plugins/bootstrap/popper.min.js"></script>
        <script src="assets/plugins/bootstrap/js/bootstrap.min.js"></script>
        <script src="assets/plugins/jquery-slimscroll/jquery.slimscroll.min.js"></script>
        <script src="assets/plugins/switchery/switchery.min.js"></script>
        <script src="assets/js/concept.min.js"></script>
        <script>
            function validation(){
                var email = document.getElementById('exampleInputEmail1').value;
                var password = document.getElementById('exampleInputPassword1').value;
                if (email == 'admin@admin.com' && password == 'admin'){
                    window.location = "Dashboard.html";
                    return false;
                }else{
                    alert ("Enter valid credential");
                }
            }
        </script>
    </body>
</html>