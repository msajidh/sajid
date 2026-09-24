var xmlhttp;

// function show_orders() {
// 	xmlhttp = new XMLHttpRequest();
// 	xmlhttp.onreadystatechange = show_orders_response;
// 	xmlhttp.open("GET","ajax/showall_orders.php",true);
// 	xmlhttp.send();
// }
	
// function show_orders_response() {
// 	if (xmlhttp.readyState==4 && xmlhttp.status==200) {
// 		document.getElementById("maincontent").innerHTML = xmlhttp.responseText;
// 	}
// }


// function show_customers() {
// 	$.ajax('ajax/show_allusers_json.php', { success: show_customers_json} );
// }


// function show_customers_json(x,y,z) {
// 	var o = JSON.parse(x);
// 	$('#maincontent').html('<table class="table" id="custtable"><thead><tr><th>ID</th><th>Fname</th><th>Lname</th></tr></thead><tbody></tbody></table>');
// 	for(var i = 0; i< o.length;i++) {
// 		var t = '<tr><td>'+ o[i].ID+'</td><td>'+o[i].Fname+'</td><td>'+o[i].Lname+'</td></tr>';
// 		$('#custtable TBODY').append(t);

// 	}

// 	$.each(o,function(i,x) {
// 		$('#custtable TBODY').append('<tr><td>'+ x.ID+'</td><td>'+x.Fname+'</td><td>'+x.Lname+'</td></tr>');
// 	});
// }

 


// ======================================================
// AJAX functions for selecting from the database, via POST/GET to the corresponding PHP files
// ======================================================
// function show_cart(data) 
// {
// 	var data_encoded = {'cart_select_input_query':  JSON.stringify(data)};

// 	// $("#select_from_cart_response").append(data_encoded);
	
// 	$.ajax({
// 			type: "POST",
// 			url: "ajax/components/selects/db_select_cart.php",
// 			data: data_encoded,
// 			success: display_show_cart_response
// 		   });
// }

// function show_books(data) 
// {
// 	var data_encoded = {'books_select_input_query':  JSON.stringify(data)};

// 	// $("#select_from_books_response").append(data_encoded);
	
// 	$.ajax({
// 			type: "POST",
// 			url: "../ajax/components/selects/db_select_books.php",
// 			data: data_encoded,
// 			success: display_show_books_response
// 		   });
// }

// // success function - will contain HTML formatting - can be in a separate file during non-testing stages
// function display_show_cart_response(x,y,z) 
// {
// 	var o = JSON.parse(JSON.parse(x).response);


// 	$("#select_from_cart_response").html('<table class="table" id="custtablecart"><thead><tr><th>customerID</th><th>bookId</th><th>quantity</th></tr></thead><tbody></tbody></table>');
	
// 	for(var i = 0; i < o.length; i++) 
// 	{
// 		var t = '<tr><td>'+ o[i].customerId +'</td><td>'+ o[i].bookId+'</td><td>'+o[i].quantity+'</td></tr>';

// 		$('#custtablecart TBODY').append(t);

// 	}
// }

function search_bookpreview(data) 
{
	var data_encoded = {'bookpreview_select_input_query':  JSON.stringify(data)};
	
	$.ajax({
			type: "POST",
			url: "ajax/specialized_components/db_select_bookpreview_by_search.php",
			data: data_encoded,
			success: display_search_bookpreview_response
		   });
}

// // success function - will contain HTML formatting - can be in a separate file during non-testing stages
// function display_search_bookpreview_response(x,y,z) 
// {
// 	var o = JSON.parse(JSON.parse(x).response);

// 	var json = o[0];
// 	var keys = [];

// 	html_table = "<table class=\"table\" id=\"custtablebookpreview\"><thead><tr>";
	
// 	keys = Object.keys(json);
	
// 	for(k in keys) 
// 	{
// 		// keys.append(k.toString());
// 		html_table += ("<th>" + keys[k].toString() + "</th>");
// 	}
// 	html_table += "</tr></thead><tbody></tbody></table>";

// 	$("#response").html(html_table);

// 	for(var i = 0; i < o.length; i++) 
// 	{
// 		var t = "<tr>";

// 		for (k in keys)
// 		{
// 			t += ('<td>'+ (o[i])[keys[k]] +'</td><td>');
// 		}
// 		t += "</tr>"

// 		$('#custtablebookpreview TBODY').append(t);
// 	}
// }
function display_search_bookpreview_response(x,y,z) 
{
            var o = JSON.parse(JSON.parse(x).response);
            
            var response_length = o.length;

			// console.log(o[1].displayImage);

            // var json = o[0];
            // var keys = [];
            
            // html_table = "<table class=\"table\" id=\"custtablebookpreview\"><thead><tr>";
            
            // keys = Object.keys(json);
            
            // for(k in keys) 
            // {
            //     // keys.append(k.toString());
            //     html_table += ("<th>" + keys[k].toString() + "</th>");
            // }
            // html_table += "</tr></thead><tbody></tbody></table>";

            // $("#response").html(html_table);

            // for(var i = 0; i < o.length; i++) 
            // {
            //     var t = "<tr>";

            //     for (k in keys)
            //     {
            //         t += ('<td>'+ (o[i])[keys[k]] +'</td><td>');
            //     }
            //     t += "</tr>"

            //     $('#custtablebookpreview TBODY').append(t);
            // }

            var num_books_displayed = 0;
			// $("#books_result").append("<div class=\"row\"></div>");
			$("#books_result").html("");
			t = "<div class=\"row\"></div>";

            while(num_books_displayed < response_length)
            {
    	        t += "<div class=\"row\" style=\"background: #ffffff;opacity: 1;\">";
				var inner_ctr = 0;
            	while(inner_ctr < 3)
                {
                    t += "<div class=\"col\" style=\"text-align: center;\"><img class=\"img-fluid\" src=\"" + 			
					o[num_books_displayed + inner_ctr].displayImage + "\" height=\"100px\" style=\"width: 150px;height: 199px;text-align: center;\"></div>";

                    // $("#books_result").append(t);
                    
					// num_books_displayed = num_books_displayed + 1;
					inner_ctr = inner_ctr + 1;
                }
				// $("#books_result").append("</div>");
				// $("#books_result").append("<div class=\"row\" style=\"background: rgb(255,255,255);opacity: 1;transform: perspective(0px);\">");
				t += "</div>";
				$("#books_result").append(t);

				t = "<div class=\"row\" style=\"background: rgb(255,255,255);opacity: 1;transform: perspective(0px);\">";

				inner_ctr = 0;
            	while(inner_ctr < 3)
                {
				    t += "<div class=\"col\">                    <h3 class=\"my-3\" style=\"text-align: center;font-size: 20px;\"></h3><h3 class=\"my-3\" style=\"text-align: center;font-size: 20px;\"><a href=\"home.php?p=book_preview&isbn=" + o[num_books_displayed  + inner_ctr].isbn + "\" style=\"color: rgb(0,0,0);\">" + o[num_books_displayed  + inner_ctr].title + "</a></h3>                    <h3 class=\"my-3\" style=\"text-align: center;font-size: 15px;\"><a href=\"#\" style=\"color: rgb(0,0,0)\">"  + o[num_books_displayed  + inner_ctr].authorName + "</a></h3><h3 class=\"my-3\" style=\"text-align: center;font-size: 15px;color: rgb(66,76,86);\"><a href=\"#\" style=\"color: rgb(0,0,0);\">" + o[num_books_displayed  + inner_ctr].price + "$</a></h3><h6 style=\"text-align: center;\">&nbsp;<button class=\"btn btn-secondary btn-sm\" style=\"background: #FF0800;border-color: rgba(255,255,255,0);text-align: center;\">Buy</button>&nbsp; &nbsp;&nbsp;<button class=\"btn btn-secondary btn-sm\" style=\"background: #FF0800;border-color: rgba(255,255,255,0);\"><svg xmlns=\"http://www.w3.org/2000/svg\" width=\"1em\" height=\"1em\" viewBox=\"0 0 24 24\" fill=\"none\">                            <path d=\"M2 5H14V7H2V5Z\" fill=\"currentColor\"></path>                                <path d=\"M2 9H14V11H2V9Z\" fill=\"currentColor\"></path>                                <path d=\"M10 13H2V15H10V13Z\" fill=\"currentColor\"></path><path d=\"M16 9H18V13H22V15H18V19H16V15H12V13H16V9Z\" fill=\"currentColor\"></path></svg></button></h6></div>";


                    // $("#books_result").append(t);
					inner_ctr = inner_ctr + 1;
					num_books_displayed = num_books_displayed + 1;
                }
				// $("#books_result").append("</div>");
				// $("#books_result").append("<div class=\"row\"></div>");
				t += "</div>";
				t += "<div class=\"row\"></div>";
				$("#books_result").append(t);
            }
} 




function select_bookpreview(data) 
{
	var data_encoded = {'bookpreview_select_input_query':  JSON.stringify(data)};
	
	$.ajax({
			type: "POST",
			url: "ajax/components/selects/db_select_bookpreview.php",
			data: data_encoded,
			success: display_select_bookpreview_response
		   });
}

function display_select_bookpreview_response(x,y,z) 
{
            var o = JSON.parse(JSON.parse(x).response);
            
            var response_length = o.length;
            
            if(response_length != 1)
            {
                $("#bookpreview_result").html("Book Not Found");
                return;
            }
            o = o[0];


            t = "<div class=\"row\" style=\"padding-top: 100px;\"><div class=\"col-md-8\"><img class=\"img-fluid\" src=\"" + o.displayImage + "\">                <div class=\"user-body\"><span class=\"heading\">Rating</span><span class=\"fa fa-star checked\"></span><span class=\"fa fa-star checked\"></span><span class=\"fa fa-star checked\"></span><span class=\"fa fa-star checked\"></span><span class=\"fa fa-star\"></span>          <p>4.1 average based on 34 reviews.</p>                </div>  </div>";

            t += "<div class=\"col-md-4\">    <h3 class=\"my-3\" style=\"text-align: left;\">Book Description</h3>           <p>" + o.description + "</p><a class=\"stretched-link\" href=\"https://" + o.previewLink + "\" style=\"text-align: left;\">Sneakpeek</a>            <h3 class=\"my-3\">"+  o.price + "$</h3><button class=\"btn btn-primary border rounded\" type=\"button\" style=\"text-align: left;\">Add to Wishlist</button><button class=\"btn btn-primary\" type=\"button\" style=\"text-align: left;\">Add to Cart</button>           <ul class=\"list-unstyled\"></ul>        </div> </div>";

			$("#bookpreview_result").append(t);

            t = "        <h5 class=\"my-4\" style=\"color: var(--bs-blue);height: 49px;font-size: 30px;text-align: left;\">Reviews</h5>            <div class=\"row row-cols-1\">                <div class=\"col-sm-6 col-md-3 mb-4\"><a href=\"#\"></a><input class=\"form-control-plaintext\" type=\"text\" value=\"Review 1\" readonly=\"\"></div>                <div class=\"col-sm-6 col-md-3 mb-4\"><a href=\"#\"></a><input class=\"form-control-plaintext\" type=\"text\" value=\"Review 2\" readonly=\"\"></div>                <div class=\"col-sm-6 col-md-3 mb-4\"><a href=\"#\"></a><input class=\"form-control-plaintext\" type=\"text\" value=\"Review 3\" readonly=\"\"></div>                <div class=\"col-sm-6 col-md-3 mb-4\" style=\"padding-top: 0px;\"><input class=\"form-control-plaintext\" type=\"text\" value=\"Review 4\" readonly=\"\"><a href=\"#\"></a></div>            </div>";

			$("#bookpreview_result").append(t);
} 



// function add_customers(data)  
// {
// 	var data_encoded = {'customers_insert_input_query':  JSON.stringify(data)};

// 	// $("#add_to_customers_response").append(data_encoded);
	
// 	$.ajax({
// 			type: "POST",
// 			url: "ajax/components/inserts/db_insert_customers.php",
// 			data: data_encoded,
// 			success: add_customer_success,
// 		   });
// }
// function add_customer_success(x,y,z)
// {
//     $("#response").append("internal/registration_confirmation.php");
//     $_SESSION['username'] = (JSON.parse(x).response);
//     $_SESSION['is_admin'] = 0;
//     console.log("userid: " + $_SESSION['username']);
// }