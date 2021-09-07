// Get filename
$("input#customFile[type='file']").change(function(e)
{	
	$file_name = e.target.files[0].name;
	$("label#file_name").html($file_name + "<i class='fas fa-times' onclick='remove()' id='remove_upload'></i>");

});
// Remove input file
function remove()
{
	$("label#file_name").html('');
	$("input#customFile[type='file']").attr("value",null);
}

// Default cart-message-box is hidden
$("div#cart-message").hide();

//Jquery for append products on shop page
$("body").on("click","a#see-products",function(e) {
	$("#shop-category").val("").change();
	$("i.fa-spinner").show();
	$.ajax({
        type: "post",
        url: "./shop_append_products.php",
        data: "type=fetch_products",
        success: function (data)
        {
            $("div#shop-products").html('');
         	$("div#shop-products").html(data);
        	$("i.fa-spinner").hide();
        }
    });
});

//Jquery for categorizing products on shop page
$("body").on("change","#shop-category",function(e) {
	$category_p_id = $(this).val();
	$("i.fa-spinner").show();
	$.ajax({
		type: "post",
		url: "./shop_categorize_products.php",
		data: "category_p_id=" + $category_p_id + "&type=categorize_product",
		success: function(data)
		{
			$("div#shop-products").html('');
         	$("div#shop-products").html(data);
        	$("i.fa-spinner").hide();
		}
	});
});

// Toggle Password visibility
$("div.password-field .toggle-password").click(function() 
{
		$(this).toggleClass("fa-eye fa-eye-slash");
		
		if ($("div.password-field input").attr("type") == "password") 
		{
		$("div.password-field input").attr("type", "text");
		} 
		else
		{
		$("div.password-field input").attr("type", "password");
		}
});

// Toggle Password visibility
$("div.confirm-password-field .toggle-password").click(function() 
{
		$(this).toggleClass("fa-eye fa-eye-slash");
		
		if ($("div.confirm-password-field input").attr("type") == "password") 
		{
		$("div.confirm-password-field input").attr("type", "text");
		} 
		else
		{
		$("div.confirm-password-field input").attr("type", "password");
		}
});


// Add to cart process
$("body").on("click",".add-to-cart-btn",function(e) 
{
	//Preventing default action on click
	e.preventDefault();
	
	// Get product id from attribute	
	$product_id = $(this).attr("product_id");

	// Ajax request for adding product to cart 
	$.ajax({
		type: "post",
		url: "./cart_process.php",
		data: "product_id=" + $product_id + "&action=home_add_to_cart",
		success: function(data)
		{
			$cart_product_count = $.parseJSON(data);		
			$("span#cart_product_count").text('');	
			$("span#cart_product_count").text($cart_product_count.cart_count);	
			$("div#cart-message h3").text('');
			$("div#cart-message h3").text($cart_product_count.cart_message_r);
		}
	});

	// fade cart message box After storing message 
	$("div#cart-message").fadeIn("slow");
	$("div#cart-message").delay(1500).fadeOut("slow");
});


//Jquery for removing product from cart
$("body").on("click","#remove-cart-product",function(e) 
{
	e.preventDefault();
	$product_cart_array_id = $(this).attr('product_key');
	$("i.fa-spinner").show();
	// ajax request to remove product from cart table
	$.ajax({
		type: "post",
		url: "./cart_process.php",
		data: "product_cart_array_id=" + $product_cart_array_id + "&action=remove_from_cart",
		success: function(data)
		{
			$removed_product_cart = $.parseJSON(data);
			$("span#cart_product_count").text('');	
			$("span#cart_product_count").text($removed_product_cart.cart_count);	
			$("div#cart-message h3").text('');
			$("div#cart-message h3").text($removed_product_cart.cart_message_r);
			$("table#cart-table tbody").html('');
			$("table#cart-table tbody").html($removed_product_cart.updated_cart);
			$("i.fa-spinner").hide();
		}
	});
	// fade cart message box After storing message 
	$("div#cart-message").fadeIn("slow");
	$("div#cart-message").delay(1500).fadeOut("slow");
});


// Jquery for add product to cart from single product page
$("body").on("click",".btn-single-product",function()
{
	$product_single_id = $(this).attr('product_key');
	$quantity = $("input#product_quantity").val();

	$.ajax({
		type: "post",
		url: "./cart_process.php",
		data: "product_single_id=" + $product_single_id + "&action=add_from_single_page&quantity=" + $quantity,
		success: function(data)
		{
			$cart_product_count = $.parseJSON(data);		
			$("span#cart_product_count").text('');	
			$("span#cart_product_count").text($cart_product_count.cart_count);	
			$("div#cart-message h3").text('');
			$("div#cart-message h3").text($cart_product_count.cart_message_r);
		}
	});

	// fade cart message box After storing message 
	$("div#cart-message").fadeIn("slow");
	$("div#cart-message").delay(1500).fadeOut("slow");
});


// Jquery for updating quantity from quantity button on cart page
$("body").on("click","#quantity-btn",function()
{
	$quantity = $(this).parent("div.cv-cart-quantity").find("input#quantity-val").val();
	$cart_key = $(this).parent("div.cv-cart-quantity").find("input#quantity-val").attr("cart_key");
//	$(this).parentsUntil("td").parentsUntil("tbody").find("td#total-price").html('');
	$total_price = $(this).parentsUntil("td").parentsUntil("tbody").find("td#total-price");
	
	$.ajax({
		type: "post",
		url: "./cart_process.php",
		data: "quantity=" + $quantity + "&action=update_cart&cart_key=" + $cart_key,
		success: function(data)
		{
			$update_cart = $.parseJSON(data);
			// Update product total price
			$total_price.text('');
			$total_price.text($update_cart.product_total_price);
			$("td#grand-total").text('');
			$("td#grand-total").text($update_cart.cart_grand_total);
			console.log(data);	
		}
	});
});

$("#forum-spinner").hide();

// to fill dependable product dropdown
$("body").on("change","#forum_category",function(){
	$category_id = $(this).find(":selected").data('id');
	$("i#forum-spinner").fadeIn("slow");
	$.ajax({
		type: "post",
		url: "./insert_forum.php",
		data: "category_id=" + $category_id + "&action=change_category",
		success: function(data)
		{
		
			$("#forum_product").html('');
			$("#forum_product").html(data);
			$("i#forum-spinner").fadeOut("slow");
			
		}
	});

});



