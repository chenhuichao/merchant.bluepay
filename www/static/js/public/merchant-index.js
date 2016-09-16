  function delById(id){
	     var r = confirm(JS_LANG['tips.confirm.delete'])
		 if(r == true){
			 var tr = $('#tr_'+id);
			 //alert(tr.html());
			 $.ajax({
				type: "POST",
				data:{'id':id},	
				url: "/merchnat/del/?id="+id,
				dataType: "json",
				success: function(data) {
					//alert(data);
					if(data.status =='0'){
						 tr.remove();
					}else{
						alert(data.msg);
					}
				},
				error:function(){
					//alert("error");
				}
			});
		}
	}

	function preview(title,content){
		//alert(content);
		$.dialog({
			padding: 0,
			title: title,
			content: content,
			lock: true
		});
	}

	
function goto(){
    var p = $('#p').val();
	p = p>0?p:1;
	window.location.href = '/merchnat/?p='+p;
	//alert(88);
}

function getData(id){
		var url = '/merchant/pos/?id='+id;
		$.get(url,function(data){
			//alert(data.status);
			if(data.status == '0'){
				var title = data.data.title,
				    content = data.data.content;
				preview(title,content);
			}else{
				if(data.status == '9002'){
					alert(data.msg);
				}else{
					$('#err').html(JS_LANG['js.tips.error.exec']);
				}
			}
		},"json");
}
