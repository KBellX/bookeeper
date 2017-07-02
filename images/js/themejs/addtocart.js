/* -------------------------------------------------------------------------------- /
	
	Magentech jQuery
	Created by Magentech
	v1.0 - 20.9.2016
	All rights reserved.
	
/ -------------------------------------------------------------------------------- */


	// Cart add remove functions
	var cart = {
		'add': function(product_id, quantity) {
			addProductNotice('成功发送借阅请求', '', '<h3>'+ product_id + ' &nbsp;&nbsp;请求 借阅!</h3>', 'success');
		}
	}

	var wishlist = {
		'add': function(product_id) {
			addProductNotice('添加到收藏书单','', '<h3>已将&nbsp;&nbsp;'+ product_id + '&nbsp;&nbsp;保存到 你的 收藏书单!</h3>', 'success');
		}
	}


	/* ---------------------------------------------------
		jGrowl – jQuery alerts and message box
	-------------------------------------------------- */
	function addProductNotice(title, thumb, text, type) {
		$.jGrowl.defaults.closer = false;
		//Stop jGrowl
		//$.jGrowl.defaults.sticky = true;
		var tpl = thumb + '<h3>'+text+'</h3>';
		$.jGrowl(tpl, {		
			life: 4000,
			header: title,
			speed: 'slow',
			theme: type
		});
	}

