<div class="container">

    <hr>

    <!-- Footer -->
    <footer>
        <div class="row">
            <div class="col-lg-12">
                <p>Copyright &copy; WTI Projekt 2016</p>
            </div>
        </div>
    </footer>

</div>
<!-- /.container -->

  <link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
  <script src="//code.jquery.com/jquery-1.10.2.js"></script>
  <script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
  <link rel="stylesheet" href="/resources/demos/style.css">
<script src="js/bootstrap.min.js"></script>
        <script type="text/javascript">
            function submitFormSearch(action)
            {
                document.getElementById('my_search_form').action = action;
                document.getElementById('my_search_form').submit();
            }
        </script>
				<script type="text/javascript" charset="utf-8">
		
	function setCookie(cname,cvalue,exdays) {
		var d = new Date();
		d.setTime(d.getTime() + (exdays*24*60*60*1000));
		var expires = "expires=" + d.toGMTString();
		document.cookie = cname+"="+cvalue+"; "+expires;
	}

	function getCookie(name)
	{
		var re = new RegExp(name + "=([^;]+)");
		var value = re.exec(document.cookie);
		return (value != null) ? unescape(value[1]) : null;
	}

	function checkCookie() {
		var user=getCookie("username");
		if (user != "") {
			alert("Welcome again " + user);
		} 	
		else {
				user = prompt("Please enter your name:","");
				if (user != "" && user != null) {
					setCookie("username", user, 30);
				}
			}
	}


	function usunCookie(nazwa) {                
		var data = new Date();
		data.setTime(date.getMonth()-1);
 
		document.cookie=nazwa + "=;expires=" + data.toGMTString();
	}
		
		
	function onloadFunction(){
    	
		if(window.location.href == "http://localhost/sklep/item.php")
		{
			var id_product = document.getElementsByName("id_product")[0].value;
			var time_display = new Date();
			// drugim argumentem będzie data oglądania produktu , żeby móc wstawiać rekomendacje powiązanych z produktów z aktualnie przeglądanymi
			setCookie(id_product,time_display,15);
		}
		
	}
		
	window.onload = onloadFunction; // wywołanie funkcji po przeładowaniu strony
</script>