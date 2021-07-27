function search_select_from_bookpreview(query, orderBy, limit, offset)
{
    // var query = $("#search_query").val();
    var data = {"query": query,
                "orderBy" : orderBy,
                "limit": parseInt(limit),
                "offset": parseInt(offset)
    };

    // Calls below function in the ajax/ajax.js file 
    search_bookpreview(data); 
}
 
function bookpreview_select_from_bookpreview(isbn)
{
    // var query = $("#search_query").val();
    var data = {"queryBy": "isbn",
                "isbn" : isbn
    };

    // Calls below function in the ajax/ajax.js file 
    select_bookpreview(data); 
}

// =====================================================
// JS functions for inserting a row to the database
// =====================================================
function add_to_customers(first, last, email, dob, pass, phone)
    {
        console.log("passed to add_to_customers() successfully");

        $("#response").append("here");

		var data = {"email":email,
					"firstName": first,
					"lastName": last,
					"postalCode": 0,
					"street":"null",
					"addessLine1":"null",
					"addressLine2":"null",
					"city": "null",
					"country":"null",
					"phone":phone,
					"username":"null",
					"passwordencrypted":pass,
					"isAdmin": 0,
					"emailVerified": 0,
					"phoneVerified": 0,
					"registrationDate": now(),
					"lastOnline": now(),
					"referralCode":"null",
					"referredBy":"null",
					"dataStoragePermission":1,
					"dob": dob
	};
// Calls below function in the ajax/ajax.js file
        add_customers(data);
     }

function add_customers(data)  
{
	var data_encoded = {'customers_insert_input_query':  JSON.stringify(data)};

	// $("#add_to_customers_response").append(data_encoded);
    console.log("in add_Customers");
	
	// $.ajax({
	// 		type: "POST",
	// 		url: "ajax/components/inserts/db_insert_customers.php",
	// 		data: data_encoded,
	// 		success: add_customer_success,
	// 	   });
}
function add_customer_success(x,y,z)
{
    console.log("SUCCESS!!!!!!!!!!");
    $("#response").append("internal/registration_confirmation.php");
    $_SESSION['username'] = (JSON.parse(x).response);
    $_SESSION['is_admin'] = 0;
    console.log("userid: " + $_SESSION['username']);
}