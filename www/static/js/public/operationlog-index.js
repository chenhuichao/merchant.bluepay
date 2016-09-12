function delById(id){
	 var r = confirm("确定要删除该数据吗？")
	 if(r == true){
		 var tr = $('#tr_'+id);
		 //alert(tr.html());
		 $.ajax({
			type: "POST",
			data:{'id':id},	
			url: "/operationlog/del/?id="+id,
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
	p = p >0 ? p : 1;
	window.location.href = '/operationlog/?p='+p;
}
