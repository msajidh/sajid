var xmlhttp;

// ======================================================
// AJAX functions for inserting to database, via POST/GET to the corresponding PHP files
// ======================================================

function add_cart(data)  
{
	var data_encoded = {'cart_insert_input_query':  JSON.stringify(data)};

	$("#add_to_cart_response").append(data_encoded);
	
	$.ajax({
			type: "POST",
			url: "../ajax/components/inserts/db_insert_cart.php",
			data: data_encoded,
			success: display_add_cart_response
		   });
}

// success function - will contain HTML formatting - can be in a separate file during non-testing stages
function display_add_cart_response(x,y,z) 
{
	var o = JSON.parse(x);

	$("#add_to_cart_response").append("<br>response code: " + o.response_code + "<br>insert id: " + o.response);
}

function add_category(data)  
{
	var data_encoded = {'category_insert_input_query':  JSON.stringify(data)};

	$("#add_to_category_response").append(data_encoded);
	
	$.ajax({
			type: "POST",
			url: "../ajax/components/inserts/db_insert_category.php",
			data: data_encoded,
			success: display_add_category_response
		   });
}

// success function - will contain HTML formatting - can be in a separate file during non-testing stages
function display_add_category_response(x,y,z) 
{
	var o = JSON.parse(x);

	$("#add_to_category_response").append("<br>response code: " + o.response_code + "<br>insert id: " + o.response);
}

function add_books(data)  
{
	var data_encoded = {'books_insert_input_query':  JSON.stringify(data)};

	$("#add_to_books_response").append(data_encoded);
	
	$.ajax({
			type: "POST",
			url: "../ajax/components/inserts/db_insert_books.php",
			data: data_encoded,
			success: display_add_books_response
		   });
}

// success function - will contain HTML formatting - can be in a separate file during non-testing stages
function display_add_books_response(x,y,z) 
{
	var o = JSON.parse(x);

	$("#add_to_books_response").append("<br>response code: " + o.response_code + "<br>insert id: " + o.response);
}

function add_orders(data)  
{
	var data_encoded = {'orders_insert_input_query':  JSON.stringify(data)};

	$("#add_to_orders_response").append(data_encoded);
	
	$.ajax({
			type: "POST",
			url: "../ajax/components/inserts/db_insert_orders.php",
			data: data_encoded,
			success: display_add_orders_response
		   });
}

// success function - will contain HTML formatting - can be in a separate file during non-testing stages
function display_add_orders_response(x,y,z) 
{
	var o = JSON.parse(x);

	$("#add_to_orders_response").append("<br>response code: " + o.response_code + "<br>insert id: " + o.response);
}

function add_bookdiscounts(data)  
{
	var data_encoded = {'bookdiscounts_insert_input_query':  JSON.stringify(data)};

	$("#add_to_bookdiscounts_response").append(data_encoded);
	
	$.ajax({
			type: "POST",
			url: "../ajax/components/inserts/db_insert_bookdiscounts.php",
			data: data_encoded,
			success: display_add_bookdiscounts_response
		   });
}

// success function - will contain HTML formatting - can be in a separate file during non-testing stages
function display_add_bookdiscounts_response(x,y,z) 
{
	var o = JSON.parse(x);

	$("#add_to_bookdiscounts_response").append("<br>response code: " + o.response_code + "<br>insert id: " + o.response);
}

function add_wishlist(data)  
{
	var data_encoded = {'wishlist_insert_input_query':  JSON.stringify(data)};

	$("#add_to_wishlist_response").append(data_encoded);
	
	$.ajax({
			type: "POST",
			url: "../ajax/components/inserts/db_insert_wishlist.php",
			data: data_encoded,
			success: display_add_wishlist_response
		   });
}

// success function - will contain HTML formatting - can be in a separate file during non-testing stages
function display_add_wishlist_response(x,y,z) 
{
	var o = JSON.parse(x);

	$("#add_to_wishlist_response").append("<br>response code: " + o.response_code + "<br>insert id: " + o.response);
}

function add_customerdiscounts(data)  
{
	var data_encoded = {'customerdiscounts_insert_input_query':  JSON.stringify(data)};

	$("#add_to_customerdiscounts_response").append(data_encoded);
	
	$.ajax({
			type: "POST",
			url: "../ajax/components/inserts/db_insert_customerdiscounts.php",
			data: data_encoded,
			success: display_add_customerdiscounts_response
		   });
}

// success function - will contain HTML formatting - can be in a separate file during non-testing stages
function display_add_customerdiscounts_response(x,y,z) 
{
	var o = JSON.parse(x);

	$("#add_to_customerdiscounts_response").append("<br>response code: " + o.response_code + "<br>insert id: " + o.response);
}

function add_discounts(data) 
{
	var data_encoded = {'discounts_insert_input_query':  JSON.stringify(data)};

	$("#add_to_discounts_response").append(data_encoded);
	
	$.ajax({
			type: "POST",
			url: "../ajax/components/inserts/db_insert_discounts.php",
			data: data_encoded,
			success: display_add_discounts_response
		   });
}

// success function - will contain HTML formatting - can be in a separate file during non-testing stages
function display_add_discounts_response(x,y,z) 
{
	var o = JSON.parse(x);

	$("#add_to_discounts_response").append("<br>response code: " + o.response_code + "<br>insert id: " + o.response);
}


function add_ratings(data)  
{
	var data_encoded = {'ratings_insert_input_query':  JSON.stringify(data)};

	$("#add_to_ratings_response").append(data_encoded);
	
	$.ajax({
			type: "POST",
			url: "../ajax/components/inserts/db_insert_ratings.php",
			data: data_encoded,
			success: display_add_ratings_response
		   });
}

// success function - will contain HTML formatting - can be in a separate file during non-testing stages
function display_add_ratings_response(x,y,z) 
{
	var o = JSON.parse(x);

	$("#add_to_ratings_response").append("<br>response code: " + o.response_code + "<br>insert id: " + o.response);
}

function add_reviews(data)  
{
	var data_encoded = {'reviews_insert_input_query':  JSON.stringify(data)};

	$("#add_to_reviews_response").append(data_encoded);
	
	$.ajax({
			type: "POST",
			url: "../ajax/components/inserts/db_insert_reviews.php",
			data: data_encoded,
			success: display_add_reviews_response
		   });
}

// success function - will contain HTML formatting - can be in a separate file during non-testing stages
function display_add_reviews_response(x,y,z) 
{
	var o = JSON.parse(x);

	$("#add_to_reviews_response").append("<br>response code: " + o.response_code + "<br>insert id: " + o.response);
}

// ======================================================
// AJAX functions for updating in database, via POST/GET to the corresponding PHP files
// ======================================================

function update_cart(data) 
{
	var data_encoded = {'cart_update_input_query':  JSON.stringify(data)};

	$("#update_to_cart_response").append(data_encoded);
	
	$.ajax({
			type: "POST",
			url: "../ajax/components/updates/db_update_cart.php",
			data: data_encoded,
			success: display_update_cart_response
		   });
}

// success function - will contain HTML formatting - can be in a separate file during non-testing stages
function display_update_cart_response(x,y,z) 
{
	var o = JSON.parse(x);

	$("#update_in_cart_response").append("<br>response code: " + o.response_code + "<br>update id: " + o.response);
}


function update_category(data) 
{
	var data_encoded = {'category_update_input_query':  JSON.stringify(data)};

	$("#update_to_category_response").append(data_encoded);
	
	$.ajax({
			type: "POST",
			url: "../ajax/components/updates/db_update_category.php",
			data: data_encoded,
			success: display_update_category_response
		   });
}

// success function - will contain HTML formatting - can be in a separate file during non-testing stages
function display_update_category_response(x,y,z) 
{
	var o = JSON.parse(x);

	$("#update_in_category_response").append("<br>response code: " + o.response_code + "<br>update id: " + o.response);
}

function update_bookdiscounts(data) 
{
	var data_encoded = {"bookdiscounts_update_input_query": JSON.stringify(data)};

	$("#update_to_bookdiscounts_response").append(data_encoded);
	
	$.ajax({
			type: "POST",
			url: "../ajax/components/updates/db_update_bookdiscounts.php",
			data: data_encoded,
			success: display_update_bookdiscounts_response
		   });
}

// success function - will contain HTML formatting - can be in a separate file during non-testing stages
function display_update_bookdiscounts_response(x,y,z) 
{
	var o = JSON.parse(x);

	$("#update_in_bookdiscounts_response").append("<br>response code: " + o.response_code + "<br>update id: " + o.response);
}

function update_wishlist(data) 
{
	var data_encoded = {'wishlist_update_input_query':  JSON.stringify(data)};

	$("#update_to_wishlist_response").append(data_encoded);
	
	$.ajax({
			type: "POST",
			url: "../ajax/components/updates/db_update_wishlist.php",
			data: data_encoded,
			success: display_update_wishlist_response
		   });
}

// success function - will contain HTML formatting - can be in a separate file during non-testing stages
function display_update_wishlist_response(x,y,z) 
{
	var o = JSON.parse(x);

	$("#update_in_wishlist_response").append("<br>response code: " + o.response_code + "<br>update id: " + o.response);
}

function update_customerdiscounts(data) 
{
	var data_encoded = {'customerdiscounts_update_input_query':  JSON.stringify(data)};

	$("#update_to_customerdiscounts_response").append(data_encoded);
	
	$.ajax({
			type: "POST",
			url: "../ajax/components/updates/db_update_customerdiscounts.php",
			data: data_encoded,
			success: display_update_customerdiscounts_response
		   });
}

// success function - will contain HTML formatting - can be in a separate file during non-testing stages
function display_update_customerdiscounts_response(x,y,z) 
{
	var o = JSON.parse(x);

	$("#update_in_customerdiscounts_response").append("<br>response code: " + o.response_code + "<br>update id: " + o.response);
}

function update_discounts(data)
{
	var data_encoded = {'discounts_update_input_query':  JSON.stringify(data)};

	$("#update_to_discounts_response").append(data_encoded);
	
	$.ajax({
			type: "POST",
			url: "../ajax/components/updates/db_update_discounts.php",
			data: data_encoded,
			success: display_update_discounts_response
		   });
}

// success function - will contain HTML formatting - can be in a separate file during non-testing stages
function display_update_discounts_response(x,y,z) 
{
	var o = JSON.parse(x);

	$("#update_in_discounts_response").append("<br>response code: " + o.response_code + "<br>update id: " + o.response);
}

function update_ratings(data) 
{
	var data_encoded = {'ratings_update_input_query':  JSON.stringify(data)};

	$("#update_in_ratings_response").append(data_encoded);
	
	$.ajax({
			type: "POST",
			url: "../ajax/components/updates/db_update_ratings.php",
			data: data_encoded,
			success: display_update_ratings_response
		   });
}

// success function - will contain HTML formatting - can be in a separate file during non-testing stages
function display_update_ratings_response(x,y,z) 
{
	var o = JSON.parse(x);

	$("#update_in_ratings_response").append("<br>response code: " + o.response_code + "<br>update id: " + o.response);
}


function update_reviews(data) 
{
	var data_encoded = {'reviews_update_input_query':  JSON.stringify(data)};

	$("#update_in_reviews_response").append(data_encoded);
	
	$.ajax({
			type: "POST",
			url: "../ajax/components/updates/db_update_reviews.php",
			data: data_encoded,
			success: display_update_reviews_response
		   });
}

// success function - will contain HTML formatting - can be in a separate file during non-testing stages
function display_update_reviews_response(x,y,z) 
{
	var o = JSON.parse(x);

	$("#update_in_reviews_response").append("<br>response code: " + o.response_code + "<br>update id: " + o.response);
}


// ======================================================
// AJAX functions for selecting from the database, via POST/GET to the corresponding PHP files
// ======================================================
function show_cart(data) 
{
	var data_encoded = {'cart_select_input_query':  JSON.stringify(data)};

	// $("#select_from_cart_response").append(data_encoded);
	
	$.ajax({
			type: "POST",
			url: "../ajax/components/selects/db_select_cart.php",
			data: data_encoded,
			success: display_show_cart_response
		   });
}

// success function - will contain HTML formatting - can be in a separate file during non-testing stages
function display_show_cart_response(x,y,z) 
{
	var o = JSON.parse(JSON.parse(x).response);

	$("#select_from_cart_response").html('<table class="table" id="custtablecart"><thead><tr><th>customerID</th><th>bookId</th><th>quantity</th></tr></thead><tbody></tbody></table>');
	
	for(var i = 0; i < o.length; i++) 
	{
		var t = '<tr><td>'+ o[i].customerId +'</td><td>'+ o[i].bookId+'</td><td>'+o[i].quantity+'</td></tr>';

		$('#custtablecart TBODY').append(t);

	}
}


function show_category(data) 
{
	var data_encoded = {'category_select_input_query':  JSON.stringify(data)};

	// $("#select_from_category_response").append(data_encoded);
	
	$.ajax({
			type: "POST",
			url: "../ajax/components/selects/db_select_category.php",
			data: data_encoded,
			success: display_show_category_response
		   });
}

// success function - will contain HTML formatting - can be in a separate file during non-testing stages
function display_show_category_response(x,y,z) 
{
	var o = JSON.parse(JSON.parse(x).response);
	
	$("#select_from_category_response").html('<table class="table" id="custtablecategory"><thead><tr><th>ID</th><th>Name</th></tr></thead><tbody></tbody></table>');
	
	for(var i = 0; i < o.length; i++) 
	{
		var t = '<tr><td>'+ o[i].id +'</td><td>'+ o[i].name+'</td><td>';

		$('#custtablecategory TBODY').append(t);

	}
}

function show_bookdiscounts(data) 
{
	var data_encoded = {'bookdiscounts_select_input_query':  JSON.stringify(data)};

	$("#select_from_category_response").append(data_encoded);
	
	$.ajax({
			type: "POST",
			url: "../ajax/components/selects/db_select_bookdiscounts.php",
			data: data_encoded,
			success: display_show_bookdiscounts_response
		   });
}

// success function - will contain HTML formatting - can be in a separate file during non-testing stages
function display_show_bookdiscounts_response(x,y,z) 
{
	var o = JSON.parse(JSON.parse(x).response);
	
	$("#select_from_bookdiscounts_response").html('<table class="table" id="custtablebookdiscounts"><thead><tr><th>bookId</th><th>discountId</th></tr></thead><tbody></tbody></table>');
	
	for(var i = 0; i < o.length; i++) 
	{
		var t = '<tr><td>'+ o[i].bookId+'</td><td>'+ o[i].discountId+'</td><td>';

		$('#custtablebookdiscounts TBODY').append(t);

	}
}


function show_wishlist(data) 
{
	var data_encoded = {'wishlist_select_input_query':  JSON.stringify(data)};

	// $("#select_from_wishlist_response").append(data_encoded);
	
	$.ajax({
			type: "POST",
			url: "../ajax/components/selects/db_select_wishlist.php",
			data: data_encoded,
			success: display_show_wishlist_response
		   });
}

// success function - will contain HTML formatting - can be in a separate file during non-testing stages
function display_show_wishlist_response(x,y,z) 
{
	var o = JSON.parse(JSON.parse(x).response);

	$("#select_from_wishlist_response").html('<table class="table" id="custtablewishlist"><thead><tr><th>customerID</th><th>bookId</th><th>dateAdded</th></tr></thead><tbody></tbody></table>');
	
	for(var i = 0; i < o.length; i++) 
	{
		var t = '<tr><td>'+ o[i].customerId +'</td><td>'+ o[i].bookId+'</td><td>'+ o[i].dateAdded+'</td></tr>';

		$('#custtablewishlist TBODY').append(t);

	}
}

function show_customerdiscounts(data) 
{
	var data_encoded = {'customerdiscounts_select_input_query':  JSON.stringify(data)};

	// $("#select_from_customerdiscounts_response").append(data_encoded);
	
	$.ajax({
			type: "POST",
			url: "../ajax/components/selects/db_select_customerdiscounts.php",
			data: data_encoded,
			success: display_show_customerdiscounts_response
		   });
}

// success function - will contain HTML formatting - can be in a separate file during non-testing stages
function display_show_customerdiscounts_response(x,y,z) 
{
	var o = JSON.parse(JSON.parse(x).response);

	$("#select_from_customerdiscounts_response").html('<table class="table" id="custtablecustomerdiscounts"><thead><tr><th>customerID</th><th>discountId</th></tr></thead><tbody></tbody></table>');
	
	for(var i = 0; i < o.length; i++) 
	{
		var t = '<tr><td>'+ o[i].customerId +'</td><td>'+ o[i].discountId+'</td></tr>';

		$('#custtablecustomerdiscounts TBODY').append(t);

	}
}


function show_discounts(data) 
{
	var data_encoded = {'discounts_select_input_query':  JSON.stringify(data)};

	// $("#select_from_discounts_response").append(data_encoded);
	
	$.ajax({
			type: "POST",
			url: "../ajax/components/selects/db_select_discounts.php",
			data: data_encoded,
			success: display_show_discounts_response
		   });
}

// success function - will contain HTML formatting - can be in a separate file during non-testing stages
function display_show_discounts_response(x,y,z) 
{
	var o = JSON.parse(JSON.parse(x).response);

	$("#select_from_discounts_response").html('<table class="table" id="custtablediscounts"><thead><tr><th>type</th><th>code</th><th>value</th><th>maxDiscount</th></tr></thead><tbody></tbody></table>');
	
	for(var i = 0; i < o.length; i++) 
	{
		var t = '<tr><td>'+ o[i].type +'</td><td>'+ o[i].code+'</td><td>'+ o[i].value+'</td><td>'+ o[i].maxDiscount+'</td></tr>';

		$('#custtablediscounts TBODY').append(t);

	}
}

function show_ratings(data) 
{
	var data_encoded = {'ratings_select_input_query':  JSON.stringify(data)};

	// $("#select_from_ratings_response").append(data_encoded);
	
	$.ajax({
			type: "POST",
			url: "../ajax/components/selects/db_select_ratings.php",
			data: data_encoded,
			success: display_show_ratings_response
		   });
}

// success function - will contain HTML formatting - can be in a separate file during non-testing stages
function display_show_ratings_response(x,y,z) 
{
	var o = JSON.parse(JSON.parse(x).response);

	$("#select_from_ratings_response").html('<table class="table" id="custtableratings"><thead><tr><th>id</th><th>rating</th><th>bookId</th><th>customerId</th><th>dateUpdated</th></tr></thead><tbody></tbody></table>');
	
	for(var i = 0; i < o.length; i++) 
	{
		var t = '<tr><td>'+ o[i].id +'</td><td>'+ o[i].rating+'</td><td>'+o[i].bookId+'</td><td>'+o[i].customerId+'</td><td>'+o[i].dateUpdated+'</td></tr>';

		$('#custtableratings TBODY').append(t);

	}
}

function show_reviews(data) 
{
	var data_encoded = {'reviews_select_input_query':  JSON.stringify(data)};

	// $("#select_from_reviews_response").append(data_encoded);
	
	$.ajax({
			type: "POST",
			url: "../ajax/components/selects/db_select_reviews.php",
			data: data_encoded,
			success: display_show_reviews_response
		   });
}

// success function - will contain HTML formatting - can be in a separate file during non-testing stages
function display_show_reviews_response(x,y,z) 
{
	var o = JSON.parse(JSON.parse(x).response);

	$("#select_from_reviews_response").html('<table class="table" id="custtablereviews"><thead><tr><th>id</th><th>ratingId</th><th>review</th><th>dateUpdated</th></tr></thead><tbody></tbody></table>');
	
	for(var i = 0; i < o.length; i++) 
	{
		var t = '<tr><td>'+ o[i].id +'</td><td>'+ o[i].ratingId+'</td><td>'+o[i].review+'</td><td>'+o[i].dateUpdated+'</td></tr>';

		$('#custtablereviews TBODY').append(t);

	}
}
