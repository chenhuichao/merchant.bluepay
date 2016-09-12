
	function saveAuth(id){
		   var nids = getChecked();
		   $.ajax({
					url: '/role/auth/?type=save',
					type: 'post',
					data:{'id':id,'nids':nids},
					dataType: 'json',
					timeout: 30000,
					error: function(){
					},
					success: function(data){
						if(data.status == '0'){
							window.location.href = "/role/auth/?id="+id;
						}else{
							alert(data.msg);
						}									
					}
		  });
		}



		function checkalla(id,that){
			var obj = $(that);
			var cls = $('.checkbox-'+id);
			if(obj.is(":checked")){
//				cls.attr("checked",'true');
				 $.each(cls, function(i,item){   
					 $(item).prop("checked","checked");
				  });   
//				cls.each(function(){
//					$(this).attr("checked",'true');
//				});
			}else{
				cls.each(function(){
						$(this).removeAttr("checked");
				});
//				obj.removeAttr("checked");
//				cls.removeAttr("checked");
				
			}
		}

		function getChecked(){
			var nids = [];
			$('input[type=checkbox]').each(function(){
				if($(this).prop("checked") && $(this).attr('value') > 0){
					//&& $(this).value >0
					//alert($(this).attr('value'));
					nids.push($(this).attr('value'));
				}
			});
			return nids.join('-');
		}

		function writeObj(obj){ 
		    var description = ""; 
		    for(var i in obj){   
		        var property=obj[i];   
		        description+=i+" = "+property+"\n";  
		    }   
		    alert(description); 
		} 


